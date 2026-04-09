<?php
/**
 * PolicyGPT — AI Search System
 * Database, AJAX handlers, admin pages, streaming proxy
 */

// ═══════════════════════════════════════════════
// A. DATABASE SETUP
// ═══════════════════════════════════════════════

function pcgpt_maybe_create_tables() {
    $version = get_option('pcgpt_db_version', '0');
    if ($version === '1.0') return;

    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // Knowledge base
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_knowledge (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        category_id VARCHAR(50) NOT NULL,
        content LONGTEXT NOT NULL,
        updated_by BIGINT UNSIGNED NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY category_id (category_id)
    ) $charset;");

    // Query logs
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_queries (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        query TEXT NOT NULL,
        response LONGTEXT NULL,
        category VARCHAR(50) NULL,
        ip_address VARCHAR(45) DEFAULT '',
        user_agent TEXT DEFAULT '',
        session_id VARCHAR(64) DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY created_at (created_at)
    ) $charset;");

    // Config (contact info, bot behaviour)
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_config (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        config_key VARCHAR(100) NOT NULL,
        config_value LONGTEXT NOT NULL,
        updated_by BIGINT UNSIGNED NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY config_key (config_key)
    ) $charset;");

    // Seed defaults
    pcgpt_seed_defaults();

    update_option('pcgpt_db_version', '1.0');
}
add_action('admin_init', 'pcgpt_maybe_create_tables');

function pcgpt_seed_defaults() {
    global $wpdb;
    $table_kb = $wpdb->prefix . 'pcgpt_knowledge';
    $table_config = $wpdb->prefix . 'pcgpt_config';

    $defaults = pcgpt_get_default_knowledge();
    foreach ($defaults as $cat_id => $content) {
        $wpdb->query($wpdb->prepare(
            "INSERT IGNORE INTO $table_kb (category_id, content, updated_at) VALUES (%s, %s, %s)",
            $cat_id, $content, current_time('mysql')
        ));
    }

    // Contact defaults
    $contact = json_encode(array(
        'name'  => 'Kaizad Shroff',
        'role'  => 'Business Head',
        'phone' => '+91 98909 88498',
        'email' => 'contact@policycentral.ai',
        'web'   => 'https://www.policycentral.ai',
        'wa'    => 'https://wa.me/919890988498',
    ));
    $wpdb->query($wpdb->prepare(
        "INSERT IGNORE INTO $table_config (config_key, config_value, updated_at) VALUES (%s, %s, %s)",
        'contact', $contact, current_time('mysql')
    ));

    // Behaviour defaults
    $behaviour = json_encode(array(
        'name'    => 'PolicyGPT',
        'tone'    => 'confident_witty',
        'length'  => 'balanced',
        'pricing' => 'deflect',
        'custom'  => 'Always emphasise that PolicyCentral.ai is trusted by leading BFSI organisations including HDFC Life and Kotak Mahindra Bank. Be direct and confident. Avoid generic AI-sounding language.',
        'avoid'   => 'Specific pricing numbers, competitor names, unannounced features, internal roadmap details',
    ));
    $wpdb->query($wpdb->prepare(
        "INSERT IGNORE INTO $table_config (config_key, config_value, updated_at) VALUES (%s, %s, %s)",
        'behaviour', $behaviour, current_time('mysql')
    ));
}

function pcgpt_get_default_knowledge() {
    return array(
        'platform' => 'PolicyCentral.ai is an AI-driven policy management and access platform designed for large organisations, particularly in BFSI (Banking, Financial Services, Insurance).

It enables organisations to create, publish, distribute, track, and manage all organisational policies with Gen AI capabilities. Beyond policies, it handles Corporate Updates, Product Information, SOPs, Branch Circulars, and Business Requirement Documents.

LIVE CUSTOMERS:
- HDFC Life
- Kotak Mahindra Bank
- SBI Life Insurance
- L&T Financial Services
- Reliance Nippon Life Insurance
- Arohan Financial Services

TECHNOLOGY STACK:
- Amazon Bedrock — Gen AI summaries, FAQs, infographics, chatbot, quiz creation
- Amazon Polly — Text-to-speech (60+ voices, Neural engine)
- AWS Translate — 10 Indian language translation
- Amazon Lex — Conversational chatbot (PolicyGPT inside the platform)',

        'gen_ai' => 'GEN AI-POWERED POLICY INTELLIGENCE:

- 10 Indian Language Translation (AWS Translate): Hindi, Marathi, Punjabi, Gujarati, Tamil, Telugu, Malayalam, Kannada, Bengali, Urdu
- Audio Policies (Amazon Polly): 60+ voices, Neural engine, MP3 format, employees can listen on any device
- AI Policy Summaries (Amazon Bedrock): Auto-summarize long documents into key highlights
- Auto-Generate FAQs (Amazon Bedrock): AI generates FAQs from policy documents; publisher reviews and edits before publishing
- Infographics from Policy Content (Amazon Bedrock): Convert sections into diagrams, flowcharts, visual summaries
- Policy Content Improvement (Amazon Bedrock): Enhance structure, clarity, and readability
- PolicyGPT Chatbot (Bedrock + Lex): Answers employee questions ONLY from policies shared with that specific employee — not general internet answers. Conversational, contextual, 24/7.
- Policy Quiz Creation (In development, Amazon Bedrock): Auto-generate MCQs to assess employee understanding',

        'creation' => 'POLICY CREATION & CONTENT MANAGEMENT:

- Word-style editor: headings, fonts, tables, lists — familiar for non-technical teams
- Rich media support: images, videos, YouTube links, audio files, GIFs
- Web article-style responsive display: looks great on desktop, tablet, and mobile
- Word document upload: .docx auto-converted to HTML for portal display
- Built-in PDF viewer: responsive layout, no download needed
- Secure video hosting: private, login-only access — not publicly accessible
- Secure audio hosting: multiple formats supported
- No content size restrictions: no limits on policy length, attachments, images, or media',

        'publisher' => 'PUBLISHER CONTROLS & WORKFLOW MANAGEMENT:

- Dedicated publisher role: scoped permissions, manages only own policies and reports
- Maker-checker approval workflow: single or multi-level; one-click approval
- Policy expiry date management: set expiry dates, reports on approaching-expiry policies
- Event/due dates: appear in employee calendar view
- Resend to all employees: one click, no reconfiguration needed
- Remind only unread users: targeted resend to non-readers only
- Unpublish instantly: removed from portal, stored internally
- Recall or delete published policies: permanent removal
- Real-time policy editing post-publication: content, targeting, settings — notify or silent update
- Version control: multiple versions with version numbers, simultaneous publishing possible
- Email notifications: customisable, integrated with org email system
- Automated policy deletion on scheduled date',

        'distribution' => 'POLICY DISTRIBUTION & TARGETING:

- Target by employee profile fields: department, location, grade, designation (from AD/HRMS)
- Share with specific employees by name
- Upload custom employee lists via spreadsheet — any size
- Reuse previously saved target groups: one click
- Evergreen mode: auto-share with future employees who join and match criteria
- Personalised content / mail merge equivalent: different content per employee via spreadsheet upload
- Publicly accessible policies: for vendors, candidates, visitors — no login required',

        'portal' => 'EMPLOYEE PORTAL & MOBILE APP:

- Web-based viewing: responsive web article format — no downloads needed
- White-label mobile app: Android (Play Store) + iOS (App Store) published under organisation\'s own accounts
- Structured folder-wise policy access: by department, use case, or importance
- Unique URL per policy: human-readable, easy to share and bookmark
- Chronological listing: most recent policies first
- List and tile view options
- Content snippets: text preview, image thumbnail, read %, signature status
- Content organised by tabs: Video, Audio, Files, Calendar
- Calendar view: deadlines, expiry dates, events
- Sender-based folders: organised by publisher/department
- Unread count per folder, one-click unread view
- Response pending view: see all policies awaiting action
- Personalised employee dashboard: unread count, pending actions, compliance score
- Top Deck banner: highlight up to 5 critical policies
- Advanced search: across titles, content, and inside Word, PDF, Excel, PowerPoint files
- Star important policies: saved in dedicated folder
- Image zoom, rotate, and download',

        'interaction' => 'EMPLOYEE INTERACTION & ACKNOWLEDGEMENT:

- Policy signing: AD password, Aadhaar-based, or digital signature tools; secure timestamped audit trail
- One-click response buttons: Helpful/Not Helpful, Approve/Reject, Conditional Approval — configurable
- Employees can ask questions: consolidated into downloadable Excel reports for publishers
- Employee comments: policy-level, visible to all employees
- Peer-to-peer policy recommendations: encourage knowledge sharing
- Emoji reactions: 12+ emojis for sentiment capture and quantifiable feedback',

        'reporting' => 'TRACKING, ANALYTICS & REPORTING:

- Policy-level read receipts: who read, when, how many times — per employee
- Individual employee policy report: all policies + read/unread status per employee
- Summary report: timeline view of read receipt trends and engagement patterns
- All policy report: consolidated engagement across all published policies
- Search analytics: monthly keyword report — what employees are searching for
- Employee response report: participation and acknowledgement rates per policy
- Employee questions report: all questions per policy consolidated for publishers
- Employee comments report: aggregated employee feedback across policies',

        'enterprise' => 'ENTERPRISE FEATURES:

- SSO & Active Directory integration: AD, LDAP, Azure AD; MFA support; employees use existing credentials
- White-label platform on organisation\'s custom subdomain: fully branded, own logo
- White-label mobile apps: published under organisation\'s own Play Store and App Store accounts
- HRMS/Intranet/ERP integration via open API: WebView embedding, redirect-based quick setup
- Non-AD users: OTP-based login for partners, contractors, off-payroll staff
- WebView integration: embed employee portal in other enterprise mobile apps
- Multiple departments and publishers: each manages policies independently in one account
- Multi-entity support: separate tenants, isolated data',

        'hosting' => 'HOSTING & DEPLOYMENT OPTIONS:

1. SaaS (Hosted by PolicyCentral.ai)
   - Hosted on AWS Mumbai (ap-south-1)
   - DR site on AWS Singapore (ap-southeast-1)
   - GDPR-compliant option on AWS Frankfurt (eu-central-1)
   - Pricing: Per user account per month
   - Best for: Organisations wanting quick deployment with no infrastructure overhead

2. Hybrid SaaS
   - SaaS platform + organisation\'s own Amazon S3 for policy/media storage
   - Data sovereignty for document storage, hosted platform
   - Pricing: Per user account per month
   - Best for: Organisations needing document data residency control

3. Own AWS Account / On-Premise
   - Entire platform deployed within organisation\'s own AWS environment
   - Full data sovereignty and infrastructure control
   - Pricing: Fixed monthly license fee, unlimited users
   - Best for: Large enterprises with strict data governance, banks, regulators',

        'security' => 'BANKING-GRADE SECURITY & COMPLIANCE:

TECHNICAL SECURITY:
- AES-256 encryption at rest, TLS 1.2+ in transit
- Payload-level encryption with custom encryption keys configurable
- Role-Based Access Control (RBAC)
- Multi-Factor Authentication (MFA)
- IP-based access restriction (office network only, if required)
- 3-tier security architecture: application, services, and data layers separated
- Private subnet deployment — no direct public access to core systems
- Annual VAPT and source code review — certification reports available

DATA PROTECTION:
- No data stored on mobile devices — all on server
- Screenshot protection: blocked on Android, notifications on iOS
- Restricted policy downloads configurable per policy
- Automatic access removal when employee leaves (synced with AD)
- Tamper-proof audit logs: views, edits, approvals, downloads, logins
- AWS S3 Object Lock for immutable document storage
- Automated backups with point-in-time recovery

COMPLIANCE FRAMEWORKS:
- ISO 27001 (Information Security)
- SOC 2 Type II
- GDPR (Data Protection)
- NIST Cybersecurity Framework
- RBI BFSI Guidelines
- Data classification: Public, Internal, Confidential, Restricted

SLA: 99.9% uptime. Platform updates approximately every 60 days.',

        'pricing' => 'PRICING MODEL:

PolicyCentral.ai offers three commercial models. Exact pricing is shared during a demo call and depends on organisation size, deployment type, and required features.

1. SaaS — Per user account per month
   Billed based on number of active employee accounts. Includes hosting, maintenance, updates, and support.

2. Hybrid SaaS — Per user account per month
   Same as SaaS pricing but with organisation\'s own S3 for storage. Slightly higher due to integration requirements.

3. Own AWS / On-Premise — Fixed monthly license fee
   Unlimited users. Fixed fee regardless of headcount. Ideal for large enterprises (5,000+ employees). Organisation pays their own AWS infrastructure costs.

IMPORTANT: Never share specific rupee/dollar amounts in chat. Always direct pricing queries to Kaizad Shroff for a tailored proposal.',
    );
}

// Category metadata
function pcgpt_get_category_meta() {
    return array(
        'platform'     => array('icon' => '🏢', 'label' => 'Platform Overview',           'desc' => 'Company overview, live customers, technology stack.'),
        'gen_ai'       => array('icon' => '🧠', 'label' => 'Gen AI Features',             'desc' => 'AI-powered features: translation, summaries, PolicyGPT chatbot, audio, infographics.'),
        'creation'     => array('icon' => '✏️', 'label' => 'Policy Creation',             'desc' => 'Editing tools, media support, PDF viewer, document upload capabilities.'),
        'publisher'    => array('icon' => '📋', 'label' => 'Publisher Controls',           'desc' => 'Approval workflows, version control, expiry management, resend and recall.'),
        'distribution' => array('icon' => '🎯', 'label' => 'Distribution & Targeting',    'desc' => 'How policies are shared — profile targeting, evergreen, mail merge, public access.'),
        'portal'       => array('icon' => '📱', 'label' => 'Employee Portal & App',       'desc' => 'The employee-facing experience: web portal, mobile app, search, folders, dashboard.'),
        'interaction'  => array('icon' => '✅', 'label' => 'Interaction & Acknowledgement','desc' => 'Signing, response buttons, Q&A, comments, reactions, recommendations.'),
        'reporting'    => array('icon' => '📊', 'label' => 'Tracking & Reporting',        'desc' => 'Read receipts, engagement analytics, compliance reports, search analytics.'),
        'enterprise'   => array('icon' => '🏛️', 'label' => 'Enterprise Features',         'desc' => 'SSO, AD integration, white-label, multi-department, HRMS integration.'),
        'hosting'      => array('icon' => '☁️', 'label' => 'Hosting Options',             'desc' => 'SaaS, Hybrid SaaS, and own AWS deployment models explained.'),
        'security'     => array('icon' => '🔒', 'label' => 'Security & Compliance',       'desc' => 'Encryption, VAPT, certifications, RBI BFSI guidelines, audit logs.'),
        'pricing'      => array('icon' => '💰', 'label' => 'Pricing Model',               'desc' => 'How pricing works across three models. Never share specific numbers.'),
    );
}


// ═══════════════════════════════════════════════
// B. SYSTEM PROMPT BUILDER
// ═══════════════════════════════════════════════

function pcgpt_build_system_prompt() {
    global $wpdb;

    // Load all knowledge
    $rows = $wpdb->get_results("SELECT category_id, content FROM {$wpdb->prefix}pcgpt_knowledge ORDER BY id ASC");
    $knowledge = array();
    foreach ($rows as $row) {
        $knowledge[$row->category_id] = $row->content;
    }

    // Load config
    $contact_row = $wpdb->get_var($wpdb->prepare(
        "SELECT config_value FROM {$wpdb->prefix}pcgpt_config WHERE config_key = %s", 'contact'
    ));
    $behaviour_row = $wpdb->get_var($wpdb->prepare(
        "SELECT config_value FROM {$wpdb->prefix}pcgpt_config WHERE config_key = %s", 'behaviour'
    ));

    $contact   = json_decode($contact_row, true) ?: array();
    $behaviour = json_decode($behaviour_row, true) ?: array();

    $bot_name = !empty($behaviour['name']) ? $behaviour['name'] : 'PolicyGPT';

    // Tone mapping
    $tone_map = array(
        'confident_witty' => 'Be direct, confident, and slightly witty — like the product itself. You\'re knowledgeable, not generic.',
        'formal'          => 'Be professional, formal, and precise. Use clear business language.',
        'friendly'        => 'Be warm, approachable, and helpful. Use conversational but professional language.',
        'humorous'        => 'Be witty and engaging with subtle humor, while staying accurate and professional.',
    );
    $tone_text = isset($tone_map[$behaviour['tone']]) ? $tone_map[$behaviour['tone']] : $tone_map['confident_witty'];

    // Length mapping
    $length_map = array(
        'concise'  => 'Keep responses concise: 100-200 words maximum.',
        'balanced' => 'Keep responses balanced: 100-300 words. Be thorough but not verbose.',
        'detailed' => 'Provide detailed responses up to 500 words when the question warrants it.',
    );
    $length_text = isset($length_map[$behaviour['length']]) ? $length_map[$behaviour['length']] : $length_map['balanced'];

    // Pricing handling
    $pricing_map = array(
        'deflect' => 'For pricing questions: Three pricing models exist. Exact pricing is discussed in a personalised demo. Direct all pricing queries to ' . ($contact['name'] ?? 'the sales team') . '.',
        'models'  => 'For pricing questions: Explain the three pricing models (SaaS per-user, Hybrid SaaS per-user, Own AWS fixed license) but do not share specific amounts.',
        'open'    => 'Share pricing information openly when asked.',
    );
    $pricing_text = isset($pricing_map[$behaviour['pricing']]) ? $pricing_map[$behaviour['pricing']] : $pricing_map['deflect'];

    // Build the prompt
    $prompt = "You are {$bot_name}, the official AI assistant for PolicyCentral.ai — an enterprise-grade, AI-driven policy management platform for large organisations, with a strong focus on BFSI (Banking, Financial Services, Insurance).\n\n";
    $prompt .= "You help prospects, HR heads, CCOs, CISOs, and enterprise decision-makers understand the platform. {$tone_text}\n\n";
    $prompt .= "{$length_text}\n\n";

    // Add all knowledge sections
    foreach ($knowledge as $cat_id => $content) {
        $label = strtoupper(str_replace('_', ' ', $cat_id));
        $prompt .= "--- {$label} ---\n{$content}\n\n";
    }

    // Contact info
    if (!empty($contact)) {
        $prompt .= "--- CONTACT ---\n";
        if (!empty($contact['name']))  $prompt .= "Contact: {$contact['name']}";
        if (!empty($contact['role']))  $prompt .= " — {$contact['role']}";
        $prompt .= "\n";
        if (!empty($contact['phone'])) $prompt .= "Phone/WhatsApp: {$contact['phone']}\n";
        if (!empty($contact['email'])) $prompt .= "Email: {$contact['email']}\n";
        if (!empty($contact['web']))   $prompt .= "Website: {$contact['web']}\n";
        $prompt .= "\n";
    }

    // Pricing handling
    $prompt .= "{$pricing_text}\n\n";

    // Custom instructions
    if (!empty($behaviour['custom'])) {
        $prompt .= "ADDITIONAL INSTRUCTIONS:\n{$behaviour['custom']}\n\n";
    }

    // Topics to avoid
    if (!empty($behaviour['avoid'])) {
        $prompt .= "TOPICS TO AVOID:\n{$behaviour['avoid']}\n\n";
    }

    $prompt .= "GUIDELINES:\n";
    $prompt .= "- Use bullets when listing multiple things. Keep it concise.\n";
    $prompt .= "- Don't invent features not listed above.\n";
    $prompt .= "- For demos/quotes: refer to {$contact['name']} — WhatsApp {$contact['phone']} or {$contact['email']}.\n";
    $prompt .= "- For IT/CISO audiences: be technical and specific.\n";
    $prompt .= "- For compliance questions: cite specific frameworks.\n";

    return $prompt;
}


// ═══════════════════════════════════════════════
// C. QUERY CATEGORY GUESSING
// ═══════════════════════════════════════════════

function pcgpt_guess_category($query) {
    $q = strtolower($query);
    $patterns = array(
        'Security'     => array('rbi', 'compliance', 'iso', 'soc', 'gdpr', 'security', 'encryption', 'vapt'),
        'Pricing'      => array('price', 'pricing', 'cost', 'fee'),
        'Hosting'      => array('aws', 'host', 'deploy', 'cloud'),
        'Mobile App'   => array('mobile', 'app', 'android', 'ios'),
        'Gen AI'       => array('ai', 'gpt', 'chatbot', 'summary', 'translation'),
        'Enterprise'   => array('hrms', 'integration', 'sso', 'ad', 'active directory'),
        'Distribution' => array('target', 'distribution', 'send', 'share'),
        'Contact'      => array('demo', 'contact', 'speak', 'call'),
    );

    foreach ($patterns as $category => $keywords) {
        foreach ($keywords as $kw) {
            if (strpos($q, $kw) !== false) {
                return $category;
            }
        }
    }
    return 'General';
}


// ═══════════════════════════════════════════════
// D. PUBLIC STREAMING PROXY (AJAX)
// ═══════════════════════════════════════════════

add_action('wp_ajax_pcgpt_search', 'pcgpt_handle_search');
add_action('wp_ajax_nopriv_pcgpt_search', 'pcgpt_handle_search');

function pcgpt_handle_search() {
    // Rate limiting: 20 queries/hour per IP
    $ip = function_exists('pc_get_client_ip') ? pc_get_client_ip() : $_SERVER['REMOTE_ADDR'];
    $rate_key = 'pcgpt_rate_' . md5($ip);
    $rate_count = (int) get_transient($rate_key);
    if ($rate_count >= 20) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Rate limit exceeded. Please try again later.'));
        wp_die();
    }
    set_transient($rate_key, $rate_count + 1, HOUR_IN_SECONDS);

    // Verify API key exists
    if (!defined('PCGPT_API_KEY') || empty(PCGPT_API_KEY)) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'API key not configured.'));
        wp_die();
    }

    $query      = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    $history    = isset($_POST['history']) ? $_POST['history'] : '[]';
    $session_id = isset($_POST['session_id']) ? sanitize_text_field($_POST['session_id']) : '';

    if (empty($query)) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Empty query.'));
        wp_die();
    }

    // Parse and validate history
    $history_arr = json_decode(stripslashes($history), true);
    if (!is_array($history_arr)) {
        $history_arr = array();
    }
    // Sanitize history — only allow role + content
    $clean_history = array();
    foreach ($history_arr as $msg) {
        if (isset($msg['role'], $msg['content']) && in_array($msg['role'], array('user', 'assistant'), true)) {
            $clean_history[] = array(
                'role'    => $msg['role'],
                'content' => substr($msg['content'], 0, 10000),
            );
        }
    }

    // Add current query
    $clean_history[] = array('role' => 'user', 'content' => $query);

    // Build system prompt from database
    $system_prompt = pcgpt_build_system_prompt();

    // Prepare API request
    $api_body = json_encode(array(
        'model'      => 'claude-sonnet-4-20250514',
        'max_tokens' => 1024,
        'stream'     => true,
        'system'     => $system_prompt,
        'messages'   => $clean_history,
    ));

    // Kill output buffers for streaming
    set_time_limit(120);
    while (ob_get_level()) ob_end_clean();
    ini_set('output_buffering', 'off');
    if (function_exists('apache_setenv')) {
        apache_setenv('no-gzip', '1');
    }
    ini_set('zlib.output_compression', false);

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('X-Accel-Buffering: no');

    // Stream via cURL
    $full_response = '';
    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, array(
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $api_body,
        CURLOPT_HTTPHEADER     => array(
            'Content-Type: application/json',
            'x-api-key: ' . PCGPT_API_KEY,
            'anthropic-version: 2023-06-01',
        ),
        CURLOPT_RETURNTRANSFER => false,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_WRITEFUNCTION  => function($ch, $data) use (&$full_response) {
            // Extract text from SSE for logging
            $lines = explode("\n", $data);
            foreach ($lines as $line) {
                if (strpos($line, 'data: ') === 0) {
                    $d = trim(substr($line, 6));
                    if ($d && $d !== '[DONE]') {
                        $p = json_decode($d, true);
                        if (isset($p['type']) && $p['type'] === 'content_block_delta' && isset($p['delta']['text'])) {
                            $full_response .= $p['delta']['text'];
                        }
                    }
                }
            }
            // Forward raw SSE data to browser
            echo $data;
            flush();
            return strlen($data);
        },
    ));

    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Log query after streaming completes
    if ($http_code === 200 && !empty($full_response)) {
        global $wpdb;
        $wpdb->insert($wpdb->prefix . 'pcgpt_queries', array(
            'query'      => $query,
            'response'   => $full_response,
            'category'   => pcgpt_guess_category($query),
            'ip_address' => $ip,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : '',
            'session_id' => $session_id,
            'created_at' => current_time('mysql'),
        ));
    }

    wp_die();
}


// ═══════════════════════════════════════════════
// E. SCRIPT ENQUEUE (PUBLIC SEARCH PAGE)
// ═══════════════════════════════════════════════

add_action('wp_enqueue_scripts', 'pcgpt_enqueue_scripts');
function pcgpt_enqueue_scripts() {
    $pcgpt_data = array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('pcgpt_search'),
        'session_id' => wp_generate_uuid4(),
    );

    // Search page JS
    if (is_page_template('page-search.php')) {
        wp_enqueue_script('pcgpt-search',
            get_template_directory_uri() . '/js/pcgpt-search.js',
            array(), '1.0.0', true
        );
        wp_localize_script('pcgpt-search', 'PCGPT', $pcgpt_data);
    } else {
        // Chat widget JS on all other pages
        wp_enqueue_script('pcgpt-widget',
            get_template_directory_uri() . '/js/pcgpt-widget.js',
            array(), '1.0.0', true
        );
        wp_localize_script('pcgpt-widget', 'PCGPT', $pcgpt_data);
    }
}


// ═══════════════════════════════════════════════
// F. ADMIN MENU
// ═══════════════════════════════════════════════

add_action('admin_menu', 'pcgpt_admin_menu');
function pcgpt_admin_menu() {
    add_menu_page(
        'PolicyGPT',
        'PolicyGPT',
        'manage_options',
        'pcgpt-knowledge',
        'pcgpt_admin_knowledge_page',
        'dashicons-search',
        30
    );

    add_submenu_page(
        'pcgpt-knowledge',
        'Knowledge Base',
        'Knowledge Base',
        'manage_options',
        'pcgpt-knowledge',
        'pcgpt_admin_knowledge_page'
    );

    add_submenu_page(
        'pcgpt-knowledge',
        'Bot Config',
        'Bot Config',
        'manage_options',
        'pcgpt-config',
        'pcgpt_admin_config_page'
    );

    add_submenu_page(
        'pcgpt-knowledge',
        'Query Insights',
        'Query Insights',
        'manage_options',
        'pcgpt-insights',
        'pcgpt_admin_insights_page'
    );
}

// Admin scripts
add_action('admin_enqueue_scripts', 'pcgpt_admin_enqueue');
function pcgpt_admin_enqueue($hook) {
    if (strpos($hook, 'pcgpt') === false) return;

    wp_enqueue_script('pcgpt-admin',
        get_template_directory_uri() . '/js/pcgpt-admin.js',
        array('jquery'), '1.0.0', true
    );

    wp_localize_script('pcgpt-admin', 'PCGPT_ADMIN', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('pcgpt_admin'),
    ));
}


// ═══════════════════════════════════════════════
// G. ADMIN AJAX HANDLERS
// ═══════════════════════════════════════════════

// Save knowledge category
add_action('wp_ajax_pcgpt_save_knowledge', 'pcgpt_ajax_save_knowledge');
function pcgpt_ajax_save_knowledge() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');

    global $wpdb;
    $category_id = sanitize_text_field($_POST['category_id']);
    $content     = sanitize_textarea_field($_POST['content']);

    $table = $wpdb->prefix . 'pcgpt_knowledge';
    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE category_id = %s", $category_id));

    if ($exists) {
        $wpdb->update($table,
            array('content' => $content, 'updated_by' => get_current_user_id(), 'updated_at' => current_time('mysql')),
            array('category_id' => $category_id)
        );
    } else {
        $wpdb->insert($table, array(
            'category_id' => $category_id,
            'content'     => $content,
            'updated_by'  => get_current_user_id(),
            'updated_at'  => current_time('mysql'),
        ));
    }

    wp_send_json_success('Saved');
}

// Get all knowledge
add_action('wp_ajax_pcgpt_get_knowledge', 'pcgpt_ajax_get_knowledge');
function pcgpt_ajax_get_knowledge() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');

    global $wpdb;
    $rows = $wpdb->get_results("SELECT category_id, content, updated_at FROM {$wpdb->prefix}pcgpt_knowledge ORDER BY id ASC");

    $data = array();
    foreach ($rows as $row) {
        $data[$row->category_id] = array(
            'content'    => $row->content,
            'updated_at' => $row->updated_at,
        );
    }

    wp_send_json_success($data);
}

// Save config (contact or behaviour)
add_action('wp_ajax_pcgpt_save_config', 'pcgpt_ajax_save_config');
function pcgpt_ajax_save_config() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');

    global $wpdb;
    $config_key   = sanitize_text_field($_POST['config_key']);
    $config_value = stripslashes($_POST['config_value']);

    // Validate JSON
    $decoded = json_decode($config_value, true);
    if ($decoded === null) wp_send_json_error('Invalid JSON');

    $table = $wpdb->prefix . 'pcgpt_config';
    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE config_key = %s", $config_key));

    if ($exists) {
        $wpdb->update($table,
            array('config_value' => $config_value, 'updated_by' => get_current_user_id(), 'updated_at' => current_time('mysql')),
            array('config_key' => $config_key)
        );
    } else {
        $wpdb->insert($table, array(
            'config_key'   => $config_key,
            'config_value' => $config_value,
            'updated_by'   => get_current_user_id(),
            'updated_at'   => current_time('mysql'),
        ));
    }

    wp_send_json_success('Saved');
}

// Get config
add_action('wp_ajax_pcgpt_get_config', 'pcgpt_ajax_get_config');
function pcgpt_ajax_get_config() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');

    global $wpdb;
    $rows = $wpdb->get_results("SELECT config_key, config_value FROM {$wpdb->prefix}pcgpt_config");

    $data = array();
    foreach ($rows as $row) {
        $data[$row->config_key] = json_decode($row->config_value, true);
    }

    wp_send_json_success($data);
}

// Get queries (paginated)
add_action('wp_ajax_pcgpt_get_queries', 'pcgpt_ajax_get_queries');
function pcgpt_ajax_get_queries() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');

    global $wpdb;
    $table = $wpdb->prefix . 'pcgpt_queries';

    $page   = max(1, intval($_POST['page'] ?? 1));
    $limit  = 50;
    $offset = ($page - 1) * $limit;
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $where = '';
    if ($search) {
        $like = '%' . $wpdb->esc_like($search) . '%';
        $where = $wpdb->prepare("WHERE query LIKE %s", $like);
    }

    $total = $wpdb->get_var("SELECT COUNT(*) FROM $table $where");
    $rows  = $wpdb->get_results($wpdb->prepare(
        "SELECT id, query, category, ip_address, created_at FROM $table $where ORDER BY created_at DESC LIMIT %d OFFSET %d",
        $limit, $offset
    ));

    // Stats
    $today = current_time('Y-m-d');
    $total_all   = $wpdb->get_var("SELECT COUNT(*) FROM $table");
    $total_today = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE DATE(created_at) = %s", $today));
    $top_cat     = $wpdb->get_var("SELECT category FROM $table GROUP BY category ORDER BY COUNT(*) DESC LIMIT 1");

    wp_send_json_success(array(
        'queries' => $rows,
        'total'   => (int) $total,
        'pages'   => ceil($total / $limit),
        'stats'   => array(
            'total_all'   => (int) $total_all,
            'total_today' => (int) $total_today,
            'unique'      => (int) $total,
            'top_category'=> $top_cat ?: 'N/A',
        ),
    ));
}

// Export queries as CSV
add_action('wp_ajax_pcgpt_export_queries', 'pcgpt_ajax_export_queries');
function pcgpt_ajax_export_queries() {
    check_ajax_referer('pcgpt_admin', 'nonce');
    if (!current_user_can('manage_options')) wp_die('Unauthorized');

    global $wpdb;
    $rows = $wpdb->get_results("SELECT query, category, ip_address, created_at FROM {$wpdb->prefix}pcgpt_queries ORDER BY created_at DESC");

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="policygpt-queries-' . date('Y-m-d') . '.csv"');

    $out = fopen('php://output', 'w');
    fputcsv($out, array('Query', 'Category', 'IP Address', 'Date'));
    foreach ($rows as $row) {
        fputcsv($out, array($row->query, $row->category, $row->ip_address, $row->created_at));
    }
    fclose($out);
    wp_die();
}


// ═══════════════════════════════════════════════
// H. ADMIN PAGE RENDERERS
// ═══════════════════════════════════════════════

function pcgpt_admin_knowledge_page() {
    $categories = pcgpt_get_category_meta();
    ?>
    <div class="wrap">
        <h1>PolicyGPT — Knowledge Base</h1>
        <p>Edit the knowledge that powers PolicyGPT responses. Changes take effect on the next search query.</p>

        <div id="pcgpt-kb-wrap" style="display:flex;gap:20px;margin-top:20px;">
            <!-- Category sidebar -->
            <div style="width:240px;flex-shrink:0;">
                <ul id="pcgpt-kb-nav" style="list-style:none;margin:0;padding:0;">
                    <?php foreach ($categories as $cat_id => $meta) : ?>
                    <li>
                        <a href="#" class="pcgpt-kb-tab" data-cat="<?php echo esc_attr($cat_id); ?>"
                           style="display:flex;align-items:center;gap:8px;padding:8px 12px;text-decoration:none;color:#333;border-radius:6px;margin-bottom:2px;font-size:13px;">
                            <span><?php echo $meta['icon']; ?></span>
                            <span><?php echo esc_html($meta['label']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Editor -->
            <div style="flex:1;max-width:800px;">
                <?php foreach ($categories as $cat_id => $meta) : ?>
                <div class="pcgpt-kb-panel" id="panel-<?php echo esc_attr($cat_id); ?>" style="display:none;">
                    <h2><?php echo $meta['icon'] . ' ' . esc_html($meta['label']); ?></h2>
                    <p style="color:#666;font-size:13px;margin-bottom:12px;"><?php echo esc_html($meta['desc']); ?></p>
                    <textarea class="pcgpt-kb-editor" data-cat="<?php echo esc_attr($cat_id); ?>"
                        rows="20" style="width:100%;font-family:monospace;font-size:13px;line-height:1.7;padding:12px;"></textarea>
                    <p style="margin-top:8px;">
                        <button class="button button-primary pcgpt-kb-save" data-cat="<?php echo esc_attr($cat_id); ?>">Save Changes</button>
                        <span class="pcgpt-save-status" data-cat="<?php echo esc_attr($cat_id); ?>" style="margin-left:10px;font-size:12px;color:#059669;display:none;">Saved ✓</span>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}

function pcgpt_admin_config_page() {
    ?>
    <div class="wrap">
        <h1>PolicyGPT — Bot Configuration</h1>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;max-width:1000px;margin-top:20px;">

            <!-- Contact Info -->
            <div class="card" style="padding:20px;">
                <h2>Contact Information</h2>
                <p style="color:#666;font-size:13px;">Details shared when users ask about demos, pricing, or want to get in touch.</p>
                <table class="form-table" style="margin-top:12px;">
                    <tr><th><label>Full Name</label></th><td><input type="text" id="pcgpt-contact-name" class="regular-text" /></td></tr>
                    <tr><th><label>Role / Title</label></th><td><input type="text" id="pcgpt-contact-role" class="regular-text" /></td></tr>
                    <tr><th><label>Phone / WhatsApp</label></th><td><input type="text" id="pcgpt-contact-phone" class="regular-text" /></td></tr>
                    <tr><th><label>Email</label></th><td><input type="email" id="pcgpt-contact-email" class="regular-text" /></td></tr>
                    <tr><th><label>Website</label></th><td><input type="url" id="pcgpt-contact-web" class="regular-text" /></td></tr>
                    <tr><th><label>WhatsApp Link</label></th><td><input type="url" id="pcgpt-contact-wa" class="regular-text" /></td></tr>
                </table>
                <p><button class="button button-primary" id="pcgpt-save-contact">Save Contact Info</button>
                <span id="pcgpt-contact-status" style="margin-left:10px;font-size:12px;color:#059669;display:none;">Saved ✓</span></p>
            </div>

            <!-- Bot Behaviour -->
            <div class="card" style="padding:20px;">
                <h2>Bot Behaviour</h2>
                <p style="color:#666;font-size:13px;">Control how PolicyGPT responds to queries.</p>
                <table class="form-table" style="margin-top:12px;">
                    <tr><th><label>Bot Name</label></th><td><input type="text" id="pcgpt-behaviour-name" class="regular-text" /></td></tr>
                    <tr><th><label>Tone</label></th><td>
                        <select id="pcgpt-behaviour-tone" class="regular-text">
                            <option value="confident_witty">Confident & Witty</option>
                            <option value="formal">Formal</option>
                            <option value="friendly">Friendly</option>
                            <option value="humorous">Humorous</option>
                        </select>
                    </td></tr>
                    <tr><th><label>Response Length</label></th><td>
                        <select id="pcgpt-behaviour-length" class="regular-text">
                            <option value="concise">Concise (100-200 words)</option>
                            <option value="balanced">Balanced (100-300 words)</option>
                            <option value="detailed">Detailed (up to 500 words)</option>
                        </select>
                    </td></tr>
                    <tr><th><label>Pricing Handling</label></th><td>
                        <select id="pcgpt-behaviour-pricing" class="regular-text">
                            <option value="deflect">Deflect to demo call</option>
                            <option value="models">Explain models, not numbers</option>
                            <option value="open">Share openly</option>
                        </select>
                    </td></tr>
                    <tr><th><label>Custom Instructions</label></th><td>
                        <textarea id="pcgpt-behaviour-custom" rows="4" class="large-text"></textarea>
                    </td></tr>
                    <tr><th><label>Topics to Avoid</label></th><td>
                        <textarea id="pcgpt-behaviour-avoid" rows="3" class="large-text"></textarea>
                    </td></tr>
                </table>
                <p><button class="button button-primary" id="pcgpt-save-behaviour">Save Behaviour</button>
                <span id="pcgpt-behaviour-status" style="margin-left:10px;font-size:12px;color:#059669;display:none;">Saved ✓</span></p>
            </div>
        </div>
    </div>
    <?php
}

function pcgpt_admin_insights_page() {
    ?>
    <div class="wrap">
        <h1>PolicyGPT — Query Insights</h1>

        <!-- Stats -->
        <div id="pcgpt-stats" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin:20px 0;">
            <div class="card" style="padding:16px;text-align:center;">
                <div id="pcgpt-stat-total" style="font-size:28px;font-weight:700;">0</div>
                <div style="font-size:12px;color:#666;">Total Queries</div>
            </div>
            <div class="card" style="padding:16px;text-align:center;">
                <div id="pcgpt-stat-today" style="font-size:28px;font-weight:700;">0</div>
                <div style="font-size:12px;color:#666;">Today</div>
            </div>
            <div class="card" style="padding:16px;text-align:center;">
                <div id="pcgpt-stat-unique" style="font-size:28px;font-weight:700;">0</div>
                <div style="font-size:12px;color:#666;">Unique Queries</div>
            </div>
            <div class="card" style="padding:16px;text-align:center;">
                <div id="pcgpt-stat-topcat" style="font-size:16px;font-weight:700;">—</div>
                <div style="font-size:12px;color:#666;">Top Category</div>
            </div>
        </div>

        <!-- Controls -->
        <div style="display:flex;gap:12px;margin-bottom:16px;align-items:center;">
            <input type="text" id="pcgpt-query-search" class="regular-text" placeholder="Search queries..." />
            <button class="button" id="pcgpt-export-csv">Export CSV</button>
        </div>

        <!-- Table -->
        <table class="wp-list-table widefat fixed striped" id="pcgpt-queries-table">
            <thead>
                <tr>
                    <th style="width:50%;">Query</th>
                    <th>Category</th>
                    <th>IP Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="pcgpt-queries-body">
                <tr><td colspan="4" style="text-align:center;padding:20px;color:#999;">Loading...</td></tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div id="pcgpt-pagination" style="margin-top:12px;"></div>
    </div>
    <?php
}
