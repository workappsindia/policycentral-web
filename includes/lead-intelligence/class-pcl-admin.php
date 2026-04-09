<?php
/**
 * PCL_Admin — WP Admin dashboard for Lead Intelligence
 *
 * - Top-level menu "Lead Intelligence" with lead list + detail view
 * - Status filters (all, new, researching, enriched, failed)
 * - Search by name/company/email/reference
 * - CSV export
 * - Manual retry for failed enrichments
 */

defined('ABSPATH') || exit;

class PCL_Admin {

    public function __construct() {
        add_action('admin_menu',              array($this, 'register_menu'));
        add_action('admin_enqueue_scripts',   array($this, 'enqueue_assets'));
        add_action('wp_ajax_pcl_retry',       array($this, 'ajax_retry'));
        add_action('admin_post_pcl_export',   array($this, 'handle_export'));
    }

    public function register_menu() {
        add_menu_page(
            'Lead Intelligence',
            'Lead Intelligence',
            'manage_options',
            'pc-lead-intelligence',
            array($this, 'page_leads'),
            'dashicons-groups',
            31 // Just below PolicyGPT (30)
        );
        add_submenu_page(
            'pc-lead-intelligence',
            'All Leads',
            'All Leads',
            'manage_options',
            'pc-lead-intelligence',
            array($this, 'page_leads')
        );
    }

    public function enqueue_assets($hook) {
        if (strpos($hook, 'pc-lead-intelligence') === false) return;
        wp_enqueue_style(
            'pcl-admin',
            PCL_URL . '/assets/pcl-admin.css',
            array(),
            '1.0.0'
        );
    }

    /**
     * Main page: list view or detail view depending on ?lead_id
     */
    public function page_leads() {
        if (!empty($_GET['lead_id'])) {
            $this->render_detail((int) $_GET['lead_id']);
            return;
        }

        $status = sanitize_text_field($_GET['status']  ?? '');
        $search = sanitize_text_field($_GET['s']       ?? '');
        $page   = max(1, (int) ($_GET['paged'] ?? 1));
        $limit  = 25;
        $offset = ($page - 1) * $limit;

        $leads = PCL_DB::list_leads(compact('status', 'search', 'limit', 'offset'));
        $total = PCL_DB::count_leads($status);
        $pages = (int) ceil($total / $limit);

        $counts = array(
            'all'        => PCL_DB::count_leads(),
            'new'        => PCL_DB::count_leads('new'),
            'researching'=> PCL_DB::count_leads('researching'),
            'enriched'   => PCL_DB::count_leads('enriched'),
            'failed'     => PCL_DB::count_leads('failed'),
        );

        $export_url = wp_nonce_url(
            admin_url('admin-post.php?action=pcl_export'),
            'pcl_export',
            '_wpnonce'
        );
        ?>
        <div class="wrap pcl-wrap">
            <div class="pcl-head">
                <div>
                    <h1 class="pcl-h1">Lead Intelligence</h1>
                    <p class="pcl-sub">Every contact form submission is automatically researched by Claude AI.</p>
                </div>
                <div class="pcl-head-actions">
                    <a href="<?php echo esc_url($export_url); ?>" class="button button-primary">Export CSV</a>
                </div>
            </div>

            <!-- Status filter tabs -->
            <div class="pcl-tabs">
                <?php
                $tab_labels = array(
                    'all'         => 'All',
                    'new'         => 'New',
                    'researching' => 'Researching',
                    'enriched'    => 'Enriched',
                    'failed'      => 'Failed',
                );
                foreach ($tab_labels as $key => $label) :
                    $is_active = ($status === $key) || ($status === '' && $key === 'all');
                    $url = add_query_arg(array(
                        'page'   => 'pc-lead-intelligence',
                        'status' => $key === 'all' ? '' : $key,
                    ), admin_url('admin.php'));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="pcl-tab <?php echo $is_active ? 'active' : ''; ?>">
                    <?php echo esc_html($label); ?>
                    <span class="pcl-tab-count"><?php echo (int) $counts[$key]; ?></span>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Search -->
            <form method="get" class="pcl-search-form">
                <input type="hidden" name="page" value="pc-lead-intelligence">
                <?php if ($status) : ?>
                <input type="hidden" name="status" value="<?php echo esc_attr($status); ?>">
                <?php endif; ?>
                <input type="search" name="s" value="<?php echo esc_attr($search); ?>" placeholder="Search by name, company, email, or reference…" class="pcl-search-input">
                <button type="submit" class="button">Search</button>
            </form>

            <!-- Leads table -->
            <?php if (empty($leads)) : ?>
                <div class="pcl-empty">
                    <div class="pcl-empty-icon">📭</div>
                    <h3>No leads yet</h3>
                    <p>Leads from the contact form will appear here automatically, with Claude AI-generated intelligence.</p>
                </div>
            <?php else : ?>
            <table class="pcl-leads-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Intel</th>
                        <th>Submitted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($leads as $lead) :
                    $detail_url = add_query_arg(array(
                        'page'    => 'pc-lead-intelligence',
                        'lead_id' => $lead->id,
                    ), admin_url('admin.php'));
                ?>
                    <tr>
                        <td class="pcl-ref">
                            <a href="<?php echo esc_url($detail_url); ?>"><?php echo esc_html($lead->reference_id); ?></a>
                        </td>
                        <td>
                            <div class="pcl-lead-name"><?php echo esc_html($lead->full_name); ?></div>
                            <div class="pcl-lead-email"><?php echo esc_html($lead->email); ?></div>
                        </td>
                        <td>
                            <div class="pcl-lead-company"><?php echo esc_html($lead->company ?: '—'); ?></div>
                            <?php if (!empty($lead->company_industry)) : ?>
                                <div class="pcl-lead-meta"><?php echo esc_html($lead->company_industry); ?><?php if (!empty($lead->company_size)) echo ' · ' . esc_html($lead->company_size); ?></div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $this->status_badge($lead->enrichment_status); ?></td>
                        <td>
                            <?php if (!empty($lead->overall_confidence)) : ?>
                                <span class="pcl-confidence <?php echo $this->confidence_class((int) $lead->overall_confidence); ?>"><?php echo (int) $lead->overall_confidence; ?>%</span>
                                <?php if (!empty($lead->funding_found)) : ?>
                                    <span class="pcl-funding-flag">💰 <?php echo esc_html($lead->funding_latest_round ?: 'Funded'); ?></span>
                                <?php endif; ?>
                            <?php else : ?>
                                <span class="pcl-muted">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="pcl-muted"><?php echo esc_html(mysql2date('d M, H:i', $lead->submitted_at)); ?></td>
                        <td><a href="<?php echo esc_url($detail_url); ?>" class="button button-small">View</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($pages > 1) : ?>
            <div class="pcl-pagination">
                <?php
                for ($i = 1; $i <= $pages; $i++) :
                    $pag_url = add_query_arg(array('paged' => $i), remove_query_arg('paged'));
                    $active = $i === $page ? 'active' : '';
                ?>
                <a href="<?php echo esc_url($pag_url); ?>" class="pcl-page-link <?php echo $active; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render a single lead detail view with enrichment.
     */
    private function render_detail($lead_id) {
        $lead  = PCL_DB::get_lead($lead_id);
        if (!$lead) {
            echo '<div class="wrap"><h1>Lead not found</h1><a href="' . esc_url(admin_url('admin.php?page=pc-lead-intelligence')) . '">← Back to all leads</a></div>';
            return;
        }

        $intel = PCL_DB::get_intel($lead_id);
        $back_url = admin_url('admin.php?page=pc-lead-intelligence');
        $retry_nonce = wp_create_nonce('pcl_retry_' . $lead_id);
        ?>
        <div class="wrap pcl-wrap">
            <a href="<?php echo esc_url($back_url); ?>" class="pcl-back-link">← All leads</a>

            <div class="pcl-detail-head">
                <div>
                    <div class="pcl-detail-ref"><?php echo esc_html($lead->reference_id); ?></div>
                    <h1 class="pcl-detail-name"><?php echo esc_html($lead->full_name); ?></h1>
                    <div class="pcl-detail-meta">
                        <?php echo esc_html($lead->company ?: 'No company'); ?> ·
                        <?php echo esc_html(mysql2date('d M Y, H:i', $lead->submitted_at)); ?>
                    </div>
                </div>
                <div class="pcl-detail-actions">
                    <?php echo $this->status_badge($lead->enrichment_status); ?>
                    <?php if (in_array($lead->enrichment_status, array('failed', 'new'), true)) : ?>
                        <button class="button button-primary pcl-retry-btn" data-lead="<?php echo (int) $lead_id; ?>" data-nonce="<?php echo esc_attr($retry_nonce); ?>">Retry Enrichment</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pcl-detail-grid">

                <!-- Left: contact + message + session -->
                <div class="pcl-col-left">
                    <div class="pcl-card">
                        <div class="pcl-card-head">Contact Details</div>
                        <div class="pcl-card-body">
                            <?php $this->dl_row('Full Name', $lead->full_name); ?>
                            <?php $this->dl_row('Email', $lead->email, 'mailto:' . $lead->email); ?>
                            <?php $this->dl_row('Phone', $lead->phone, 'tel:' . preg_replace('/\D/', '', $lead->phone)); ?>
                            <?php $this->dl_row('Company', $lead->company); ?>
                            <?php $this->dl_row('Location (IP)', trim(implode(', ', array_filter(array($lead->geo_city, $lead->geo_region, $lead->geo_country))))); ?>
                        </div>
                    </div>

                    <?php if (!empty($lead->message)) : ?>
                    <div class="pcl-card">
                        <div class="pcl-card-head">Their Message</div>
                        <div class="pcl-card-body pcl-message"><?php echo esc_html($lead->message); ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="pcl-card">
                        <div class="pcl-card-head">Session &amp; Tracking</div>
                        <div class="pcl-card-body">
                            <?php $this->dl_row('IP Address', $lead->ip_address); ?>
                            <?php $this->dl_row('Device', trim(implode(' · ', array_filter(array($lead->browser, $lead->os, $lead->device_type))))); ?>
                            <?php $this->dl_row('Page URL', $lead->page_url); ?>
                            <?php $this->dl_row('Referrer', $lead->referrer); ?>
                            <?php if (!empty($lead->utm_source)) : ?>
                                <?php $this->dl_row('UTM', "source={$lead->utm_source} · medium={$lead->utm_medium} · campaign={$lead->utm_campaign}"); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Right: intelligence -->
                <div class="pcl-col-right">
                    <?php if ($intel) : ?>
                        <?php $this->render_intel_card($intel); ?>
                    <?php else : ?>
                        <div class="pcl-card pcl-card-empty">
                            <div class="pcl-card-head">Lead Intelligence</div>
                            <div class="pcl-card-body">
                                <?php if ($lead->enrichment_status === 'researching') : ?>
                                    <p>🔄 Claude is researching this lead. Refresh in a minute.</p>
                                <?php elseif ($lead->enrichment_status === 'failed') : ?>
                                    <p>❌ Enrichment failed. Click "Retry Enrichment" above to try again.</p>
                                <?php else : ?>
                                    <p>⏳ Enrichment hasn't run yet.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script>
        (function() {
            document.querySelectorAll('.pcl-retry-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    btn.disabled = true;
                    btn.textContent = 'Queuing...';
                    fetch(ajaxurl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'action=pcl_retry&lead_id=' + btn.dataset.lead + '&_nonce=' + btn.dataset.nonce
                    })
                    .then(function(r) { return r.json(); })
                    .then(function(res) {
                        if (res.success) {
                            btn.textContent = 'Queued ✓ Refreshing...';
                            setTimeout(function() { location.reload(); }, 1500);
                        } else {
                            btn.disabled = false;
                            btn.textContent = 'Retry Enrichment';
                            alert(res.data || 'Retry failed');
                        }
                    })
                    .catch(function() {
                        btn.disabled = false;
                        btn.textContent = 'Retry Enrichment';
                        alert('Network error');
                    });
                });
            });
        })();
        </script>
        <?php
    }

    /**
     * Render the intelligence card.
     */
    private function render_intel_card($intel) {
        $confidence = (int) $intel->overall_confidence;
        $conf_class = $this->confidence_class($confidence);

        $tech = json_decode($intel->tech_stack ?? '[]', true);
        $investors = json_decode($intel->funding_investors ?? '[]', true);
        $news = json_decode($intel->news_items ?? '[]', true);
        $pain = json_decode($intel->pain_points ?? '[]', true);
        $starters = json_decode($intel->conversation_starters ?? '[]', true);
        ?>
        <div class="pcl-card pcl-intel-card">
            <div class="pcl-card-head">
                <span>Lead Intelligence</span>
                <span class="pcl-confidence <?php echo $conf_class; ?>"><?php echo $confidence; ?>% confidence</span>
            </div>
            <div class="pcl-card-body">

                <!-- Person -->
                <div class="pcl-intel-section">
                    <div class="pcl-intel-section-label">Person</div>
                    <div class="pcl-intel-person">
                        <div class="pcl-intel-main"><?php echo esc_html($intel->person_designation ?: 'Unknown designation'); ?></div>
                        <?php if ($intel->person_role_type) : ?>
                            <div class="pcl-intel-tag"><?php echo esc_html(strtoupper($intel->person_role_type)); ?></div>
                        <?php endif; ?>
                        <?php if ($intel->person_linkedin_url) : ?>
                            <a href="<?php echo esc_url($intel->person_linkedin_url); ?>" target="_blank" class="pcl-intel-link">LinkedIn ↗</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Company -->
                <div class="pcl-intel-section">
                    <div class="pcl-intel-section-label">Company</div>
                    <div class="pcl-intel-main"><?php echo esc_html($intel->company_name ?: '—'); ?></div>
                    <?php if ($intel->company_description) : ?>
                        <div class="pcl-intel-desc"><?php echo esc_html($intel->company_description); ?></div>
                    <?php endif; ?>
                    <div class="pcl-intel-meta">
                        <?php
                        $meta_parts = array_filter(array(
                            $intel->company_industry,
                            $intel->company_size,
                            $intel->company_employee_count ? '~' . $intel->company_employee_count . ' employees' : '',
                            $intel->company_hq,
                            $intel->company_founded ? 'Est. ' . $intel->company_founded : '',
                        ));
                        echo esc_html(implode(' · ', $meta_parts));
                        ?>
                    </div>
                    <?php if ($intel->company_website) : ?>
                        <a href="<?php echo esc_url($intel->company_website); ?>" target="_blank" class="pcl-intel-link">Website ↗</a>
                    <?php endif; ?>
                </div>

                <!-- Tech -->
                <?php if (!empty($tech) || !empty($intel->hr_systems)) : ?>
                <div class="pcl-intel-section">
                    <div class="pcl-intel-section-label">Tech Stack</div>
                    <?php if ($intel->hr_systems) : ?>
                        <div class="pcl-intel-desc"><strong>HR/Intranet:</strong> <?php echo esc_html($intel->hr_systems); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($tech)) : ?>
                        <div class="pcl-intel-desc"><strong>Systems:</strong> <?php echo esc_html(implode(', ', $tech)); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Funding -->
                <?php if ($intel->funding_found) : ?>
                <div class="pcl-intel-section pcl-funding-section">
                    <div class="pcl-intel-section-label">💰 Funding Found</div>
                    <div class="pcl-intel-main"><?php echo esc_html($intel->funding_latest_round ?: 'Funded'); ?><?php if ($intel->funding_amount) echo ' · ' . esc_html($intel->funding_amount); ?></div>
                    <?php if ($intel->funding_summary) : ?>
                        <div class="pcl-intel-desc"><?php echo esc_html($intel->funding_summary); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($investors)) : ?>
                        <div class="pcl-intel-meta">Investors: <?php echo esc_html(implode(', ', $investors)); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- News -->
                <?php if (!empty($news)) : ?>
                <div class="pcl-intel-section">
                    <div class="pcl-intel-section-label">Recent News</div>
                    <?php foreach (array_slice($news, 0, 5) as $item) : ?>
                        <div class="pcl-news-item">
                            <div class="pcl-news-headline">• <?php echo esc_html($item['headline'] ?? ''); ?></div>
                            <div class="pcl-news-date"><?php echo esc_html($item['date'] ?? ''); ?></div>
                            <?php if (!empty($item['relevance'])) : ?>
                                <div class="pcl-news-relevance"><?php echo esc_html($item['relevance']); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Pain points -->
                <?php if (!empty($pain)) : ?>
                <div class="pcl-intel-section pcl-pain-section">
                    <div class="pcl-intel-section-label">Pain Points</div>
                    <?php foreach ($pain as $p) : ?>
                        <div class="pcl-pain-item">• <?php echo esc_html($p); ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Conversation starters -->
                <?php if (!empty($starters)) : ?>
                <div class="pcl-intel-section pcl-starters-section">
                    <div class="pcl-intel-section-label">Conversation Starters</div>
                    <?php foreach ($starters as $i => $s) : ?>
                        <div class="pcl-starter-item">
                            <span class="pcl-starter-num"><?php echo str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
                            <span><?php echo esc_html($s); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($intel->research_note) : ?>
                <div class="pcl-research-note"><?php echo esc_html($intel->research_note); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /* ── Helpers ───────────────────────────────────────────── */

    private function dl_row($label, $value, $link = '') {
        $value = trim((string) $value);
        if (empty($value)) $value = '—';
        ?>
        <div class="pcl-dl-row">
            <div class="pcl-dl-label"><?php echo esc_html($label); ?></div>
            <div class="pcl-dl-value">
                <?php if ($link) : ?>
                    <a href="<?php echo esc_attr($link); ?>"><?php echo esc_html($value); ?></a>
                <?php else : ?>
                    <?php echo esc_html($value); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    private function status_badge($status) {
        $colors = array(
            'new'         => 'pcl-badge-gray',
            'researching' => 'pcl-badge-amber',
            'enriched'    => 'pcl-badge-green',
            'failed'      => 'pcl-badge-red',
        );
        $class = $colors[$status] ?? 'pcl-badge-gray';
        return '<span class="pcl-badge ' . $class . '">' . esc_html(ucfirst($status)) . '</span>';
    }

    private function confidence_class($pct) {
        if ($pct >= 75) return 'pcl-conf-high';
        if ($pct >= 45) return 'pcl-conf-medium';
        return 'pcl-conf-low';
    }

    /* ── AJAX: retry enrichment ────────────────────────────── */

    public function ajax_retry() {
        $lead_id = absint($_POST['lead_id'] ?? 0);
        $nonce   = sanitize_text_field($_POST['_nonce'] ?? '');

        if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');
        if (!$lead_id || !wp_verify_nonce($nonce, 'pcl_retry_' . $lead_id)) wp_send_json_error('Invalid request');

        // Reset status and fire background enrichment
        PCL_DB::update_status($lead_id, 'new');
        pc_fire_background('pc_lead_run_enrichment', array('lead_id' => $lead_id));

        wp_send_json_success('Enrichment queued');
    }

    /* ── CSV Export ────────────────────────────────────────── */

    public function handle_export() {
        if (!current_user_can('manage_options')) wp_die('Unauthorized');
        check_admin_referer('pcl_export');

        $leads = PCL_DB::get_all_for_export();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="policycentral-leads-' . date('Y-m-d') . '.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, array(
            'Reference', 'Submitted', 'Name', 'Email', 'Phone', 'Company',
            'City', 'Region', 'Country', 'Status', 'Confidence', 'Industry',
            'Size', 'Funding', 'Round', 'Amount', 'Message', 'IP', 'Page URL'
        ));

        foreach ($leads as $l) {
            fputcsv($out, array(
                $l->reference_id,
                $l->submitted_at,
                $l->full_name,
                $l->email,
                $l->phone,
                $l->company,
                $l->geo_city,
                $l->geo_region,
                $l->geo_country,
                $l->enrichment_status,
                $l->overall_confidence ?? '',
                $l->company_industry ?? '',
                $l->company_size ?? '',
                $l->funding_found ? 'Yes' : 'No',
                $l->funding_latest_round ?? '',
                $l->funding_amount ?? '',
                $l->message,
                $l->ip_address,
                $l->page_url,
            ));
        }

        fclose($out);
        exit;
    }
}
