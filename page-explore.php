<?php
/* Template Name: Explore */
get_header();
?>

<style>
/* ── Explore page variables (scoped) ─────────────────────────── */
.explore-wrap {
  --exp-teal: #179D97;
  --exp-teal2: #0694A2;
  --exp-dark: #0F172A;
  --exp-dark2: #1E293B;
  --exp-gray: #64748B;
  --exp-light: #F9FAFB;
  --exp-border: rgba(15,23,42,.08);
  --exp-r: 16px;
  --exp-r-sm: 10px;
  --exp-ease: cubic-bezier(.4,0,.2,1);
  --exp-grad: linear-gradient(135deg, #179D97 0%, #4338CA 50%, #7C3AED 100%);
  --exp-grad-text: linear-gradient(135deg, #179D97, #4338CA, #7C3AED);
  color: #0F172A;
  font-family: 'Inter', system-ui, -apple-system, sans-serif;
  line-height: 1.6;
}

/* ── Gradient text helper ──────────────────────────────────── */
.explore-wrap .grad-text {
  background: var(--exp-grad-text);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ── HERO ──────────────────────────────────────────────────── */
.explore-wrap .exp-hero {
  padding: calc(68px + 80px) 24px 80px;
  background: #fff;
  position: relative;
  overflow: hidden;
}
.explore-wrap .exp-hero-inner {
  max-width: 1140px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 56px;
  align-items: center;
}
.explore-wrap .exp-hero-text h1 {
  font-size: clamp(2.2rem, 5vw, 3.4rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -.03em;
  margin: 0 0 22px;
  color: var(--exp-dark);
}
.explore-wrap .exp-hero-text h1 em {
  font-style: normal;
  background: var(--exp-grad-text);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.explore-wrap .exp-hero-sub {
  font-size: 1.15rem;
  color: var(--exp-gray);
  max-width: 540px;
  line-height: 1.7;
}
.explore-wrap .exp-stats-card {
  display: grid;
  grid-template-columns: 1fr 1fr;
  background: #fff;
  border-radius: var(--exp-r);
  box-shadow: 0 4px 24px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.04);
  border: 1px solid var(--exp-border);
  overflow: hidden;
}
.explore-wrap .exp-stat {
  padding: 28px 20px;
  text-align: center;
  position: relative;
}
.explore-wrap .exp-stat:nth-child(1),
.explore-wrap .exp-stat:nth-child(2) {
  border-bottom: 1px solid var(--exp-border);
}
.explore-wrap .exp-stat:nth-child(1),
.explore-wrap .exp-stat:nth-child(3) {
  border-right: 1px solid var(--exp-border);
}
.explore-wrap .exp-stat-num {
  font-size: 1.9rem;
  font-weight: 800;
  color: var(--exp-teal);
  letter-spacing: -.02em;
}
.explore-wrap .exp-stat-label {
  font-size: .78rem;
  color: var(--exp-gray);
  margin-top: 4px;
  line-height: 1.4;
}

/* ── SECTION SHARED ────────────────────────────────────────── */
.explore-wrap .exp-section {
  padding: 100px 24px;
}
.explore-wrap .exp-section-alt {
  background: #F9FAFB;
}
.explore-wrap .exp-section-dark {
  background: var(--exp-dark);
  color: #fff;
}
.explore-wrap .exp-inner {
  max-width: 1140px;
  margin: 0 auto;
}
.explore-wrap .exp-sect-title {
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -.025em;
  margin: 0 0 16px;
}
.explore-wrap .exp-sect-sub {
  font-size: 1.08rem;
  color: var(--exp-gray);
  max-width: 820px;
  line-height: 1.7;
  margin: 0 0 56px;
}
.explore-wrap .exp-section-dark .exp-sect-sub {
  color: rgba(255,255,255,.6);
}

/* ── PAIN POINTS ──────────────────────────────────────────── */
.explore-wrap .pain-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-bottom: 56px;
}
.explore-wrap .pain-card {
  background: #fff;
  border-radius: var(--exp-r);
  padding: 32px 28px;
  border: 1px solid var(--exp-border);
  transition: transform .25s var(--exp-ease), box-shadow .25s var(--exp-ease);
}
.explore-wrap .pain-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(0,0,0,.08);
}
.explore-wrap .pain-icon {
  width: 48px; height: 48px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 18px;
  font-size: 1.4rem;
}
.explore-wrap .pain-icon.red    { background: #FEF2F2; color: #DC2626; }
.explore-wrap .pain-icon.amber  { background: #FEF3C7; color: #D97706; }
.explore-wrap .pain-icon.violet { background: #EDE9FE; color: #7C3AED; }
.explore-wrap .pain-icon.rose   { background: #FFE4E6; color: #E11D48; }
.explore-wrap .pain-icon.orange { background: #FFF7ED; color: #EA580C; }
.explore-wrap .pain-icon.slate  { background: #F1F5F9; color: #475569; }
.explore-wrap .pain-card h3 {
  font-size: 1.05rem;
  font-weight: 700;
  margin: 0 0 8px;
  color: var(--exp-dark);
}
.explore-wrap .pain-card p {
  font-size: .9rem;
  color: var(--exp-gray);
  line-height: 1.6;
  margin: 0;
}
.explore-wrap .pain-callout {
  background: var(--exp-dark);
  border-radius: var(--exp-r);
  padding: 48px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
  text-align: center;
  color: #fff;
}
.explore-wrap .pain-callout-num {
  font-size: 2.4rem;
  font-weight: 800;
  background: var(--exp-grad-text);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.explore-wrap .pain-callout-label {
  font-size: .88rem;
  color: rgba(255,255,255,.6);
  margin-top: 6px;
  line-height: 1.5;
}

/* ── OLD WAY ──────────────────────────────────────────────── */
.explore-wrap .old-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 48px;
}
.explore-wrap .old-card {
  background: #fff;
  border-radius: var(--exp-r);
  padding: 32px 24px;
  border: 1px solid var(--exp-border);
  text-align: center;
  position: relative;
}
.explore-wrap .old-card::before {
  content: '';
  position: absolute;
  top: 0; left: 20%; right: 20%;
  height: 3px;
  background: linear-gradient(90deg, #EF4444, #F97316);
  border-radius: 0 0 4px 4px;
}
.explore-wrap .old-emoji {
  font-size: 2rem;
  margin-bottom: 14px;
}
.explore-wrap .old-card h3 {
  font-size: 1rem;
  font-weight: 700;
  margin: 0 0 8px;
  color: var(--exp-dark);
}
.explore-wrap .old-card p {
  font-size: .85rem;
  color: var(--exp-gray);
  line-height: 1.6;
  margin: 0;
}
.explore-wrap .old-bridge {
  text-align: center;
  font-size: 1.15rem;
  color: var(--exp-gray);
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.7;
}
.explore-wrap .old-bridge strong {
  color: var(--exp-teal);
}

/* ── LIFECYCLE ────────────────────────────────────────────── */
.explore-wrap .lc-nav {
  display: flex;
  gap: 6px;
  margin-bottom: 40px;
  flex-wrap: wrap;
  justify-content: center;
}
.explore-wrap .lc-btn {
  padding: 10px 22px;
  border-radius: 999px;
  border: 1px solid var(--exp-border);
  background: #fff;
  font-size: .88rem;
  font-weight: 600;
  color: var(--exp-gray);
  cursor: pointer;
  transition: all .2s var(--exp-ease);
}
.explore-wrap .lc-btn:hover {
  border-color: var(--exp-teal);
  color: var(--exp-teal);
}
.explore-wrap .lc-btn.active {
  background: var(--exp-teal);
  border-color: var(--exp-teal);
  color: #fff;
}
.explore-wrap .lc-panel {
  display: none;
  background: #fff;
  border-radius: var(--exp-r);
  padding: 36px 40px;
  border: 1px solid var(--exp-border);
  box-shadow: 0 4px 24px rgba(0,0,0,.04);
}
.explore-wrap .lc-panel.active {
  display: block;
}
.explore-wrap .lc-panel h3 {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 0 16px;
  color: var(--exp-dark);
}
.explore-wrap .lc-panel p {
  font-size: .95rem;
  color: var(--exp-gray);
  line-height: 1.7;
  margin: 0 0 20px;
}
.explore-wrap .lc-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.explore-wrap .lc-tag {
  padding: 6px 14px;
  background: rgba(23,157,151,.06);
  border: 1px solid rgba(23,157,151,.15);
  border-radius: 999px;
  font-size: .78rem;
  font-weight: 600;
  color: var(--exp-teal);
}

/* ── FEATURES ─────────────────────────────────────────────── */
.explore-wrap .feat-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.explore-wrap .feat-card {
  background: #fff;
  border-radius: var(--exp-r);
  padding: 32px 28px;
  border: 1px solid var(--exp-border);
  transition: transform .25s var(--exp-ease), box-shadow .25s var(--exp-ease);
  text-decoration: none;
  display: block;
  color: inherit;
}
.explore-wrap .feat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(0,0,0,.08);
  text-decoration: none;
  color: inherit;
}
.explore-wrap .feat-card-icon {
  width: 44px; height: 44px;
  border-radius: 10px;
  background: rgba(23,157,151,.08);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 16px;
  color: var(--exp-teal);
}
.explore-wrap .feat-card h3 {
  font-size: 1rem;
  font-weight: 700;
  margin: 0 0 8px;
  color: var(--exp-dark);
}
.explore-wrap .feat-card p {
  font-size: .87rem;
  color: var(--exp-gray);
  line-height: 1.6;
  margin: 0;
}

/* ── USE CASES ────────────────────────────────────────────── */
.explore-wrap .uc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.explore-wrap .uc-card {
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: var(--exp-r);
  padding: 32px 28px;
  transition: transform .25s var(--exp-ease), border-color .25s var(--exp-ease);
}
.explore-wrap .uc-card:hover {
  transform: translateY(-4px);
  border-color: rgba(23,157,151,.4);
}
.explore-wrap .uc-card-emoji {
  font-size: 2rem;
  margin-bottom: 14px;
}
.explore-wrap .uc-card h3 {
  font-size: 1.05rem;
  font-weight: 700;
  margin: 0 0 8px;
  color: #fff;
}
.explore-wrap .uc-card p {
  font-size: .87rem;
  color: rgba(255,255,255,.6);
  line-height: 1.6;
  margin: 0;
}

/* ── RESPONSIVE ───────────────────────────────────────────── */
@media (max-width: 1024px) {
  .explore-wrap .exp-hero-inner { grid-template-columns: 1fr; gap: 40px; }
  .explore-wrap .exp-stats-card { max-width: 480px; }
  .explore-wrap .pain-grid,
  .explore-wrap .feat-grid,
  .explore-wrap .uc-grid { grid-template-columns: repeat(2, 1fr); }
  .explore-wrap .old-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .explore-wrap .exp-hero { padding: calc(68px + 48px) 16px 56px; }
  .explore-wrap .exp-stats-card { grid-template-columns: 1fr 1fr; }
  .explore-wrap .pain-grid,
  .explore-wrap .feat-grid,
  .explore-wrap .uc-grid,
  .explore-wrap .old-grid { grid-template-columns: 1fr; }
  .explore-wrap .pain-callout { grid-template-columns: 1fr; gap: 24px; padding: 32px; }
  .explore-wrap .lc-nav { gap: 4px; }
  .explore-wrap .lc-btn { padding: 8px 14px; font-size: .8rem; }
  .explore-wrap .lc-panel { padding: 24px 20px; }
  .explore-wrap .exp-section { padding: 64px 16px; }
}
</style>

<div class="explore-wrap">

  <!-- ══ HERO ══════════════════════════════════════════════════ -->
  <section class="exp-hero">
    <div class="exp-hero-inner">
      <div class="exp-hero-text">
        <h1>Policies your employees don't read are policies that <em>don't exist.</em></h1>
        <p class="exp-hero-sub">PolicyCentral.ai is the enterprise platform that makes every policy accessible, searchable, and actionable — so compliance is built into your culture, not buried in folders.</p>
      </div>
      <div class="exp-stats-card">
        <div class="exp-stat">
          <div class="exp-stat-num">60%</div>
          <div class="exp-stat-label">Employees never read policies fully</div>
        </div>
        <div class="exp-stat">
          <div class="exp-stat-num">3&times;</div>
          <div class="exp-stat-label">Faster policy rollout</div>
        </div>
        <div class="exp-stat">
          <div class="exp-stat-num">&#8377;2Cr+</div>
          <div class="exp-stat-label">Average annual compliance cost saved</div>
        </div>
        <div class="exp-stat">
          <div class="exp-stat-num">0</div>
          <div class="exp-stat-label">Missed policy acknowledgements</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ PAIN POINTS ══════════════════════════════════════════ -->
  <section class="exp-section exp-section-alt">
    <div class="exp-inner">
      <h2 class="exp-sect-title">What happens when policies are <span class="grad-text">ignored</span></h2>
      <p class="exp-sect-sub">Most organisations create policies.<br>Few ensure they're read, understood, or followed. The cost of that gap is enormous.</p>

      <div class="pain-grid">
        <div class="pain-card">
          <div class="pain-icon red">&#x1F6A8;</div>
          <h3>Regulatory Fines</h3>
          <p>RBI, SEBI, and IRDAI penalties for non-compliance with mandatory policy communication requirements.</p>
        </div>
        <div class="pain-card">
          <div class="pain-icon amber">&#x1F512;</div>
          <h3>Data Breaches</h3>
          <p>Employees unaware of data handling policies become the weakest link in your security chain.</p>
        </div>
        <div class="pain-card">
          <div class="pain-icon violet">&#x2696;&#xFE0F;</div>
          <h3>HR Disputes</h3>
          <p>Without proof of policy acknowledgement, every termination becomes a legal liability.</p>
        </div>
        <div class="pain-card">
          <div class="pain-icon rose">&#x1F4C4;</div>
          <h3>Outdated Policies</h3>
          <p>Version chaos means employees follow obsolete procedures while the latest policy gathers dust.</p>
        </div>
        <div class="pain-card">
          <div class="pain-icon orange">&#x1F4CB;</div>
          <h3>Audit Failures</h3>
          <p>No digital trail of who read what, when. Auditors see gaps, management sees risk.</p>
        </div>
        <div class="pain-card">
          <div class="pain-icon slate">&#x1F310;</div>
          <h3>Policy Chaos</h3>
          <p>Scattered across emails, drives, and intranet pages. Nobody knows where the latest version lives.</p>
        </div>
      </div>

      <div class="pain-callout">
        <div>
          <div class="pain-callout-num">72%</div>
          <div class="pain-callout-label">of compliance failures trace back to employees not reading policies</div>
        </div>
        <div>
          <div class="pain-callout-num">45 days</div>
          <div class="pain-callout-label">average time to roll out a single policy change across branches</div>
        </div>
        <div>
          <div class="pain-callout-num">1 click</div>
          <div class="pain-callout-label">is all it should take to prove an employee read and understood a policy</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ OLD WAY ══════════════════════════════════════════════ -->
  <section class="exp-section">
    <div class="exp-inner">
      <h2 class="exp-sect-title">How policies are managed <span class="grad-text">today</span></h2>
      <p class="exp-sect-sub">Most enterprises still rely on these broken methods to distribute policies. None of them work.</p>

      <div class="old-grid">
        <div class="old-card">
          <div class="old-emoji">&#x1F4E7;</div>
          <h3>Email</h3>
          <p>Policies buried in inboxes. No tracking, no acknowledgement, no version control.</p>
        </div>
        <div class="old-card">
          <div class="old-emoji">&#x1F4C1;</div>
          <h3>Shared Drive</h3>
          <p>Folders within folders. Nobody knows which version is current or where to look.</p>
        </div>
        <div class="old-card">
          <div class="old-emoji">&#x1F5A5;&#xFE0F;</div>
          <h3>Legacy Intranet</h3>
          <p>Outdated platforms with poor search, no mobile access, and zero engagement analytics.</p>
        </div>
        <div class="old-card">
          <div class="old-emoji">&#x1F4E6;</div>
          <h3>Physical Handover</h3>
          <p>Printed manuals and sign-off sheets that are impossible to update or audit at scale.</p>
        </div>
      </div>

      <div class="old-bridge">
        There's a better way. <strong>PolicyCentral.ai</strong> replaces all of these with a single, intelligent platform that manages the entire policy lifecycle.
      </div>
    </div>
  </section>

  <!-- ══ LIFECYCLE ════════════════════════════════════════════ -->
  <section class="exp-section exp-section-alt">
    <div class="exp-inner">
      <h2 class="exp-sect-title">The complete policy lifecycle, managed in <span class="grad-text">one place.</span></h2>

      <div class="lc-nav">
        <button class="lc-btn active" onclick="showLC(0, this)">Host</button>
        <button class="lc-btn" onclick="showLC(1, this)">Publish</button>
        <button class="lc-btn" onclick="showLC(2, this)">Enable AI</button>
        <button class="lc-btn" onclick="showLC(3, this)">Share</button>
        <button class="lc-btn" onclick="showLC(4, this)">Access</button>
        <button class="lc-btn" onclick="showLC(5, this)">Manage</button>
        <button class="lc-btn" onclick="showLC(6, this)">Track</button>
      </div>

      <!-- Panel 0: Host -->
      <div class="lc-panel active">
        <h3>Host &amp; Organise</h3>
        <p>Upload policies in any format — PDF, Word, or rich text. Organise them by department, category, or regulation. Your single source of truth, always up to date.</p>
        <div class="lc-tags">
          <span class="lc-tag">Multi-format Upload</span>
          <span class="lc-tag">Category Hierarchy</span>
          <span class="lc-tag">Version Control</span>
        </div>
      </div>

      <!-- Panel 1: Publish -->
      <div class="lc-panel">
        <h3>Publish &amp; Format</h3>
        <p>Transform dry policy documents into engaging, readable content. Add summaries, key takeaways, and multimedia. Make policies people actually want to read.</p>
        <div class="lc-tags">
          <span class="lc-tag">Rich Text Editor</span>
          <span class="lc-tag">Auto-Summary</span>
          <span class="lc-tag">Multimedia Support</span>
        </div>
      </div>

      <!-- Panel 2: Enable AI -->
      <div class="lc-panel">
        <h3>Enable AI Intelligence</h3>
        <p>Let employees ask questions about policies in natural language. AI-powered search, instant summaries, and a chatbot that understands your policy corpus.</p>
        <div class="lc-tags">
          <span class="lc-tag">Policy Chatbot</span>
          <span class="lc-tag">Smart Search</span>
          <span class="lc-tag">AI Summaries</span>
        </div>
      </div>

      <!-- Panel 3: Share -->
      <div class="lc-panel">
        <h3>Share &amp; Distribute</h3>
        <p>Target policies to specific teams, roles, or locations. Push notifications, email digests, and in-app alerts ensure the right people see the right policies.</p>
        <div class="lc-tags">
          <span class="lc-tag">Role-Based Targeting</span>
          <span class="lc-tag">Push Notifications</span>
          <span class="lc-tag">Email Digests</span>
        </div>
      </div>

      <!-- Panel 4: Access -->
      <div class="lc-panel">
        <h3>Access Anywhere</h3>
        <p>Mobile-first design means employees can read policies on any device. Offline access, multi-language support, and text-to-speech for true accessibility.</p>
        <div class="lc-tags">
          <span class="lc-tag">Mobile App</span>
          <span class="lc-tag">Offline Access</span>
          <span class="lc-tag">Multi-Language</span>
        </div>
      </div>

      <!-- Panel 5: Manage -->
      <div class="lc-panel">
        <h3>Manage &amp; Control</h3>
        <p>Approval workflows, review cycles, and expiry alerts keep your policy library current. Role-based access ensures sensitive policies stay confidential.</p>
        <div class="lc-tags">
          <span class="lc-tag">Approval Workflows</span>
          <span class="lc-tag">Review Cycles</span>
          <span class="lc-tag">Access Controls</span>
        </div>
      </div>

      <!-- Panel 6: Track -->
      <div class="lc-panel">
        <h3>Track &amp; Prove</h3>
        <p>Real-time dashboards show who's read what. Digital acknowledgements, quiz completions, and audit-ready reports at the click of a button.</p>
        <div class="lc-tags">
          <span class="lc-tag">Read Tracking</span>
          <span class="lc-tag">Acknowledgements</span>
          <span class="lc-tag">Audit Reports</span>
        </div>
      </div>

    </div>
  </section>

  <!-- ══ FEATURES ═════════════════════════════════════════════ -->
  <section class="exp-section">
    <div class="exp-inner">
      <h2 class="exp-sect-title">Everything your enterprise needs, <span class="grad-text">out of the box.</span></h2>

      <div class="feat-grid">
        <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <h3>Gen AI-Powered Policy Intelligence</h3>
          <p>Smart search, summaries, chatbot</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </div>
          <h3>Policy Creation &amp; Content Management</h3>
          <p>Author, version, organize policies</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h3>Publisher Controls &amp; Workflow Management</h3>
          <p>Approvals, publishing, workflows</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg>
          </div>
          <h3>Policy Distribution &amp; Targeting</h3>
          <p>Target audiences, push notifications</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg>
          </div>
          <h3>Employee Portal &amp; Mobile App</h3>
          <p>Mobile app, multi-language access</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <h3>Employee Interaction &amp; Acknowledgement</h3>
          <p>Read receipts, e-sign, quizzes</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <h3>Tracking, Analytics &amp; Reporting</h3>
          <p>Dashboards, compliance reports</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          </div>
          <h3>Enterprise Features</h3>
          <p>AD, SSO, white-label, multi-entity</p>
        </a>
        <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="feat-card">
          <div class="feat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h3>Banking-Grade Security &amp; Compliance</h3>
          <p>Encryption, RBAC, audit logs</p>
        </a>
      </div>
    </div>
  </section>

  <!-- ══ USE CASES ════════════════════════════════════════════ -->
  <section class="exp-section exp-section-dark">
    <div class="exp-inner">
      <h2 class="exp-sect-title" style="color:#fff;">More than policies. Every communication,<br>managed and <span class="grad-text">tracked.</span></h2>

      <div class="uc-grid">
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F4DC;</div>
          <h3>Policy Management</h3>
          <p>HR policies, compliance manuals, code of conduct, POSH, whistleblower — the core use case.</p>
        </div>
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F4E2;</div>
          <h3>Corporate Updates</h3>
          <p>Leadership memos, org changes, quarterly updates. Ensure every employee is informed.</p>
        </div>
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F4E6;</div>
          <h3>Product Information</h3>
          <p>Product specs, pricing sheets, feature updates for sales and support teams.</p>
        </div>
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F4CB;</div>
          <h3>SOPs &amp; Procedures</h3>
          <p>Standard operating procedures, process manuals, and work instructions.</p>
        </div>
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F3E2;</div>
          <h3>Branch Circulars</h3>
          <p>RBI circulars, branch-level directives, operational guidelines for banking and NBFC teams.</p>
        </div>
        <div class="uc-card">
          <div class="uc-card-emoji">&#x1F4D0;</div>
          <h3>BRDs &amp; Specifications</h3>
          <p>Business requirement documents, tech specs, and project documentation.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ CUSTOMERS ════════════════════════════════════════════ -->
  <section class="exp-section exp-section-alt" style="text-align:center;">
    <div class="exp-inner">
      <span class="cust-label" style="font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);">Live Customers</span>
      <div class="cust-logos" style="display:flex;flex-wrap:wrap;justify-content:center;gap:16px;margin-top:20px;">
        <div class="cchip"><?php pc_picture('images/client-logos/HDFC-Life-Logo.png', 'HDFC Life'); ?></div>
        <div class="cchip"><?php pc_picture('images/client-logos/Kotak Mahindra Bank logo.png', 'Kotak Mahindra Bank'); ?></div>
        <div class="cchip"><?php pc_picture('images/client-logos/arohan.png', 'Arohan Financial Services'); ?></div>
        <div class="cchip"><?php pc_picture('images/client-logos/SBI Life Insurance.png', 'SBI Life Insurance'); ?></div>
        <div class="cchip"><?php pc_picture('images/client-logos/LTFS.png', 'L&T Financial Services'); ?></div>
        <div class="cchip"><?php pc_picture('images/client-logos/reliance-nippon-life-insurance-logo.png', 'Reliance Nippon Life Insurance'); ?></div>
      </div>
    </div>
  </section>

  <!-- ══ CONTACT / CTA ═══════════════════════════════════════ -->
  <section id="contact" class="exp-section">
    <div class="exp-inner">
      <div class="section-header" style="text-align:center;margin-bottom:48px;">
        <span class="eyebrow">Contact Us</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.6rem);font-weight:800;line-height:1.2;letter-spacing:-.025em;margin:12px 0 0;">Ready to see PolicyCentral.ai <br>at your organisation?</h2>
      </div>
      <div class="contact-wrap">
        <div class="contact-direct" style="text-align:center;margin-bottom:32px;padding:28px 32px;background:linear-gradient(135deg,rgba(6,148,162,.04),rgba(67,56,202,.04));border:1px solid rgba(6,148,162,.15);border-radius:16px;display:flex;align-items:center;justify-content:center;gap:36px;flex-wrap:wrap">
          <div style="font-size:15px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif">Kaizad Shroff <span style="font-weight:500;color:var(--gray-500);font-size:13px">&mdash; Business Head</span></div>
          <a href="tel:+919890988498" style="display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:var(--teal)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.38 2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72"/></svg>+91 98909 88498</a>
          <a href="mailto:contact@policycentral.ai" style="display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:var(--teal)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>contact@policycentral.ai</a>
        </div>
        <div class="contact-form-wrap">
          <p class="form-helper-text">For inquiries or support, please fill out the form below, and we will get back to you as soon as possible.</p>
          <form id="pc-contact-form" autocomplete="off" novalidate>
            <?php wp_nonce_field('pc_contact_submit', 'pc_nonce'); ?>
            <div class="form-row">
              <div class="form-group">
                <label>Your name <span class="req">*</span></label>
                <input type="text" name="full_name" class="form-input" placeholder="Enter your full name" required>
              </div>
              <div class="form-group">
                <label>Company name <span class="req">*</span></label>
                <input type="text" name="company" class="form-input" placeholder="Enter your company name" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Your email <span class="req">*</span></label>
                <input type="email" name="email" class="form-input" placeholder="you@company.com" required>
              </div>
              <div class="form-group">
                <label>Contact number</label>
                <input type="tel" name="phone" class="form-input" placeholder="Enter phone number with country code">
              </div>
            </div>
            <div class="form-group">
              <label>Your message</label>
              <textarea name="message" class="form-input" placeholder="Tell us how we can help you..."></textarea>
            </div>
            <div class="form-status" id="form-status" style="display:none"></div>
            <button type="submit" class="btn-submit" id="btn-submit">
              Send Message
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

</div><!-- .explore-wrap -->

<script>
function showLC(index, btn) {
  document.querySelectorAll('.explore-wrap .lc-panel').forEach(function(p, i) {
    p.classList.toggle('active', i === index);
  });
  document.querySelectorAll('.explore-wrap .lc-btn').forEach(function(b) {
    b.classList.remove('active');
  });
  btn.classList.add('active');
}
</script>

<script>
(function(){
  var form = document.getElementById('pc-contact-form');
  var btn  = document.getElementById('btn-submit');
  var status = document.getElementById('form-status');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Client-side validation
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    // Disable button, show loading
    btn.disabled = true;
    btn.innerHTML = 'Sending... <svg class="spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px;animation:spin .8s linear infinite"><circle cx="12" cy="12" r="10" stroke-dasharray="30 70" stroke-linecap="round"/></svg>';
    status.style.display = 'none';

    var data = new FormData(form);
    data.append('action', 'pc_contact_submit');

    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
      method: 'POST',
      body: data
    })
    .then(function(r){ return r.json(); })
    .then(function(res){
      if (res.success) {
        // GTM event
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({ event: 'form_submit', form_name: 'contact_form' });
        // Store form data in cookies for thank-you page
        var expires = new Date(Date.now() + 5 * 60 * 1000).toUTCString();
        document.cookie = 'pc_ty_name=' + encodeURIComponent(data.get('full_name')) + ';expires=' + expires + ';path=/;SameSite=Lax';
        document.cookie = 'pc_ty_company=' + encodeURIComponent(data.get('company')) + ';expires=' + expires + ';path=/;SameSite=Lax';
        document.cookie = 'pc_ty_email=' + encodeURIComponent(data.get('email')) + ';expires=' + expires + ';path=/;SameSite=Lax';
        // Redirect to thank you
        window.location.href = '<?php echo home_url("/thank-you/"); ?>';
      } else {
        status.style.display = 'block';
        status.className = 'form-status error';
        status.textContent = res.data || 'Something went wrong. Please try again.';
        btn.disabled = false;
        btn.innerHTML = 'Send Message <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
      }
    })
    .catch(function(){
      status.style.display = 'block';
      status.className = 'form-status error';
      status.textContent = 'Network error. Please check your connection and try again.';
      btn.disabled = false;
      btn.innerHTML = 'Send Message <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
    });
  });
})();
</script>

<?php get_footer(); ?>
