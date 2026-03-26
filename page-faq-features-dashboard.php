<?php
/**
 * Template Name: FAQ - Features & Dashboard
 */
get_header(); ?>

<section class="faq-hero">
<div class="container">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faqs/')); ?>">FAQs</a></div>
  <div class="faq-tag">Features &amp; Dashboard FAQs</div>
  <h1>What the platform <em>actually does</em>, feature by feature</h1>
  <p>Detailed breakdowns of search, employee experience, admin dashboards, content formats, version control, and every core capability.</p>
</div>
</section>

<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#search">Search &amp; Discovery</a>
      <a href="#employee-exp">Employee Experience</a>
      <a href="#admin">Admin &amp; Dashboard</a>
      <a href="#version">Version Control &amp; Content</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">13 Questions total</div>
    <div class="sidebar-box"><p>Still have questions? Talk to our team.</p><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></div>
  </aside>

  <div class="faq-content">
    <div class="content-header"><div class="content-icon">⚙️</div><div><p>Detailed breakdowns of search, employee experience, admin dashboards, content formats, version control, and every core capability.</p></div></div>

    <div class="faq-section" data-sec="search" id="search">
      <h2 class="section-title"><span>🔍</span> Search &amp; Discovery</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does the 4D Intelligent Search work?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Search queries across four simultaneous dimensions: <strong>Subject</strong> (policy title and heading), <strong>Content</strong> (full body text), <strong>File name</strong> (original document filename), and <strong>In-file</strong> (content within attachments). It uses NLP so employees search in plain conversational language, not exact policy titles. For an organization with 400+ policies across 10 departments, this is the difference between finding what you need in 10 seconds versus calling HR.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What are "Snippets" and how do they improve scanning?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Snippets are short preview summaries (2–3 lines) and thumbnail images appearing in the policy list view before an employee opens the full document. They give enough context to decide relevance, increasing likelihood of full read when the policy is opened. Combined with AI-generated summaries at the top of each policy, the reading experience is layered: employees can triage at the snippet level, orient at the summary level, then read deeply only when needed.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What is the Long Scroll view?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Long Scroll presents multiple policies in a continuous vertical feed, similar to scrolling through a news feed. Rather than click-in/click-out navigation, employees scan through policy summaries and thumbnails in one uninterrupted view. Scroll-based interfaces consistently show higher engagement completion rates than document-navigation models, particularly for employees reviewing multiple policies during onboarding.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can employees bookmark policies, and does it sync across devices?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. The Star/Favourite feature lets employees bookmark frequently referenced policies. A credit officer stars the lending policy, a branch manager stars the current quarter's operational circular. Favourites are stored against the employee profile and sync across web and mobile. The Quick-Access Sidebar shows bookmarked policies at a glance, reducing repeated searches.</div></div></div>
    </div>

    <div class="faq-section" data-sec="employee-exp" id="employee-exp">
      <h2 class="section-title"><span>👤</span> Employee Experience</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does the employee reading experience look like?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Deliberately not a PDF viewer. Policies are presented in a <strong>web article format</strong> with clean typography, clear paragraphs, reading progress indicator, embedded media. No download prompts, no file attachments. This design choice is the primary driver of the 3x engagement improvement: removing PDF friction means employees read policies rather than downloading and ignoring them.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does the Personalized Dashboard show each employee?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">The dashboard is role-based and personalized to each employee's department, designation, grade, and location. An employee sees: unread policies requiring attention (with deadlines highlighted), starred favourites, "Most Recommended" by peers, pinned priority policies, and reading history. The dashboard surfaces what the employee needs to do, so they don't have to search the entire library to find their compliance actions.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can employees interact with policies, ask questions, give feedback?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. Employees can: use the <strong>Questions</strong> feature to submit written questions against a specific policy (collated for admin review), use <strong>Comments</strong> to discuss with colleagues, give <strong>Feedback</strong> (Helpful/Not Helpful, Explanatory/Not Explanatory) showing admins which policies have comprehension issues, and use <strong>Recommend</strong> to surface useful policies to peers. Admins also see <strong>Search Metrics</strong>, showing what employees search for and which keywords appear most, revealing comprehension gaps before they become compliance issues.</div></div></div>
    </div>

    <div class="faq-section" data-sec="admin" id="admin">
      <h2 class="section-title"><span>🎛️</span> Admin &amp; Dashboard</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does the admin compliance dashboard show in real time?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Real-time view of: overall attestation rate by policy (% read and accepted), read receipt status by individual employee (filterable by department, designation, grade, location), action completion rate (Understood / Accept / Not Clear), e-signature completion status, search queries being run by employees, and feedback scores by policy. All live. A compliance manager can identify a policy with low read rates and act on it the same day it's published.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can we add multiple admins from different departments?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. Multiple admins with department-level access controls are supported. HR publishes HR policies, IT/InfoSec publishes IT security policies, Legal publishes regulatory updates, Operations publishes branch circulars, each admin operating only within their domain. A super-admin role has cross-department visibility for compliance reporting and the master dashboard.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does Search Metrics show and how do we act on it?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Search Metrics records every query employees run, aggregated by frequency and keyword. It answers: what are employees trying to find that they're not finding? Which policies generate the most follow-up searches (a comprehension gap signal)? If 200 employees searched for "loan restructuring process" last month but couldn't find the relevant policy, that's a direct signal to retitle the policy or publish a new one.</div></div></div>
    </div>

    <div class="faq-section" data-sec="version" id="version">
      <h2 class="section-title"><span>📄</span> Version Control &amp; Content</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does version control work when a policy is updated?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Every update creates a numbered version automatically. Change history is maintained (who made changes, when, what changed) with rollback to any previous version. When a new version is published, admins choose: notify all employees, notify only those who read the previous version, or notify only those who didn't. Superseded policies are archived not deleted, remaining available for audit.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can policies have expiry and auto-delete dates?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. When publishing, admins can set an <strong>expiry date</strong> (policy flagged as expired but remains accessible) or an <strong>auto-delete date</strong> (policy automatically removed from the live library on a specified date). Essential for time-bound regulatory circulars, promotional product guidelines, and temporary operational procedures, ensuring the library doesn't accumulate outdated content.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What content formats does the platform support beyond text?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Beyond standard text: embedded images with zoom functionality, GIFs, YouTube video embeds, <strong>secure private video hosting</strong> (outside YouTube for confidential content), audio clips, and AI-generated infographics. Content formatting includes tables, font color, size, bold, and links, all standard rich text options. The reading experience is designed like a web article, not a PDF viewer.</div></div></div>
    </div>

    <div class="other-cats">
      <h2>Explore other FAQ categories</h2>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">🏢</span>Company &amp; Platform</a>
        <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="other-link"><span class="oi">🤖</span>AI Capabilities</a>
        <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="other-link"><span class="oi">✅</span>Compliance &amp; Tracking</a>
        <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="other-link"><span class="oi">📢</span>Publishing &amp; Distribution</a>
        <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="other-link"><span class="oi">🔒</span>Hosting &amp; Security</a>
        <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="other-link"><span class="oi">🚀</span>Implementation &amp; Integration</a>
        <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">📈</span>ROI &amp; Business Case</a>
        <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="other-link"><span class="oi">🛡️</span>IT &amp; CISO</a>
        <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">💰</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
