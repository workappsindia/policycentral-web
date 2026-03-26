<?php get_header(); ?>

<style>
.mono{font-family:'JetBrains Mono',monospace}

/* LAYOUT */
.error-main{display:grid;grid-template-columns:1fr 440px;gap:0;max-width:1280px;margin:0 auto;width:100%;padding:calc(var(--nav-h) + 40px) clamp(20px,4vw,72px) 72px;align-items:start}

/* LEFT: COPY */
.error-left{padding-right:72px}

.audit-stamp{
  display:inline-flex;align-items:center;gap:10px;
  padding:6px 14px 6px 8px;border-radius:6px;
  background:#FFF1F2;border:1.5px solid #FECDD3;
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:11.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:#E11D48;margin-bottom:36px;
}
.audit-dot{width:8px;height:8px;border-radius:50%;background:#E11D48;animation:blink 1.2s ease-in-out infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}

.error-left h1{font-size:clamp(38px,4.5vw,60px);font-weight:900;line-height:1.1;margin-bottom:10px}
.sub-hed{font-size:clamp(15px,1.6vw,18px);color:var(--gray-500);line-height:1.75;margin-bottom:44px;max-width:440px;font-weight:400}
.sub-hed strong{color:var(--gray-700);font-weight:600}

/* TIMELINE of shame */
.shame-log{margin-bottom:40px}
.shame-log-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:14px}
.log-item{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid var(--gray-100)}
.log-item:last-child{border:none}
.log-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.log-icon svg{width:12px;height:12px}
.log-text{flex:1}
.log-main{font-size:13px;font-weight:600;color:var(--gray-700)}
.log-time{font-size:11px;color:var(--gray-400);font-family:'JetBrains Mono',monospace;margin-top:2px}
.log-badge{display:inline-block;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}

/* BUTTONS */
.error-btn-row{display:flex;gap:12px;flex-wrap:wrap}

/* RIGHT: DASHBOARD CARD */
.dashboard-card{
  background:#fff;
  border:1.5px solid var(--gray-200);
  border-radius:20px;
  box-shadow:0 20px 60px rgba(0,0,0,.08),0 6px 20px rgba(0,0,0,.04);
  overflow:hidden;
  position:sticky;
  top:calc(var(--nav-h) + 24px);
}
.dc-topbar{
  display:flex;align-items:center;gap:7px;
  padding:11px 16px;background:var(--gray-50);
  border-bottom:1px solid var(--gray-200);
}
.dc-dot{width:10px;height:10px;border-radius:50%}
.dc-url{flex:1;max-width:240px;margin:0 auto;background:#fff;border:1px solid var(--gray-200);border-radius:6px;padding:3px 10px;font-size:11px;color:var(--gray-400);text-align:center;font-family:'JetBrains Mono',monospace}
.dc-body{padding:20px}
.dc-section-label{font-size:9.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);margin-bottom:10px;font-family:'Plus Jakarta Sans',sans-serif}

/* Compliance Status Banner */
.compliance-status{
  border-radius:12px;padding:14px 16px;
  background:#FFF1F2;border:1.5px solid #FECDD3;
  display:flex;align-items:center;gap:12px;
  margin-bottom:18px;
}
.cs-icon{width:36px;height:36px;border-radius:10px;background:#E11D48;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cs-icon svg{width:16px;height:16px;color:#fff}
.cs-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:#E11D48;letter-spacing:.06em;text-transform:uppercase}
.cs-sub{font-size:11px;color:#F43F5E;margin-top:2px}

/* Stats Grid */
.stat-grid{display:grid;grid-template-columns:1fr 1fr;gap:9px;margin-bottom:16px}
.stat-box{background:var(--gray-50);border:1px solid var(--gray-200);border-radius:10px;padding:12px 13px}
.stat-val{font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:900;line-height:1;margin-bottom:3px}
.stat-lbl{font-size:10px;color:var(--gray-400);font-weight:500}
.stat-box.danger .stat-val{color:#E11D48}
.stat-box.warn .stat-val{color:#D97706}

/* Progress bar */
.pb-row{margin-bottom:16px}
.pb-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.pb-label{font-size:12px;font-weight:600;color:var(--gray-700)}
.pb-pct{font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:700;color:#E11D48}
.pb-track{height:7px;border-radius:4px;background:var(--gray-200);overflow:hidden}
.pb-fill{height:100%;border-radius:4px;transition:width 1.5s cubic-bezier(.4,0,.2,1)}

/* Maker-checker */
.mkck-row{display:flex;flex-direction:column;gap:6px;margin-bottom:16px}
.mkck{display:flex;align-items:center;justify-content:space-between;padding:8px 11px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-200)}
.mkck-name{font-size:11.5px;font-weight:600;color:var(--gray-700)}
.mkck-badge{font-size:10px;font-weight:700;padding:2px 9px;border-radius:20px;font-family:'Plus Jakarta Sans',sans-serif}
.badge-approved{background:#D1FAE5;color:#059669}
.badge-absent{background:#FFE4E6;color:#E11D48}

/* Reminder counter */
.reminder-box{
  border-radius:10px;padding:12px 14px;
  background:linear-gradient(135deg,rgba(6,148,162,.04),rgba(67,56,202,.04));
  border:1px solid rgba(6,148,162,.15);
  display:flex;align-items:center;gap:12px;
  margin-bottom:16px;
}
.rb-icon{width:30px;height:30px;border-radius:8px;background:var(--grad-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.rb-icon svg{width:13px;height:13px;color:#fff}
.rb-count{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:900;color:var(--teal);line-height:1}
.rb-note{font-size:10px;color:var(--gray-400);margin-top:1px}

/* AI Assistant */
.ai-box{
  border-radius:10px;padding:11px 13px;
  background:linear-gradient(135deg,rgba(124,58,237,.04),rgba(67,56,202,.04));
  border:1px solid rgba(124,58,237,.15);
  display:flex;align-items:flex-start;gap:10px;
}
.ai-icon{width:26px;height:26px;border-radius:7px;background:linear-gradient(135deg,#7C3AED,#4338CA);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.ai-icon svg{width:12px;height:12px;color:#fff}
.ai-tag{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:#7C3AED;margin-bottom:3px}
.ai-text{font-size:11px;color:var(--gray-600);line-height:1.5}
.ai-text span{color:var(--gray-400)}

.dc-div{height:1px;background:var(--gray-100);margin:14px 0}

/* BIG 404 background text */
.hero-404{position:relative;user-select:none;margin-bottom:-24px;margin-top:-16px}
.hero-404 .num{
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:clamp(100px,14vw,180px);
  font-weight:900;letter-spacing:-.04em;line-height:1;
  background:linear-gradient(135deg,#f0f9fa 0%,#eef2ff 50%,#f5f3ff 100%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  display:block;margin-bottom:8px;
}

/* Animations */
.fade-up{opacity:0;transform:translateY(16px);animation:fadeUp .6s cubic-bezier(.4,0,.2,1) forwards}
@keyframes fadeUp{to{opacity:1;transform:none}}
.d1{animation-delay:.05s}.d2{animation-delay:.15s}.d3{animation-delay:.25s}
.d4{animation-delay:.35s}.d5{animation-delay:.45s}

/* Responsive */
@media(max-width:900px){
  .error-main{grid-template-columns:1fr;padding-top:calc(var(--nav-h) + 24px)}
  .error-left{padding-right:0;margin-bottom:40px}
  .dashboard-card{position:static}
}
@media(max-width:640px){
  .error-main{padding:calc(var(--nav-h) + 16px) 20px 48px}
  .error-btn-row{flex-direction:column}
  .error-btn-row .btn{width:100%;justify-content:center}
}
</style>

<div class="error-main">

  <!-- LEFT SIDE -->
  <div class="error-left">

    <div class="audit-stamp fade-up d1">
      <span class="audit-dot"></span>
      Audit Finding — Severity: Embarrassing
    </div>

    <div class="hero-404 fade-up d1">
      <span class="num">404</span>
    </div>

    <h1 class="fade-up d2" style="font-size:clamp(38px,4.5vw,60px);font-weight:900;line-height:1.1;margin-bottom:10px">
      This page never<br>read its <span class="g-text">own policies.</span>
    </h1>

    <p class="sub-hed fade-up d3">
      We published it. We targeted it. We sent <strong>47 automated reminders.</strong><br>
      It acknowledged nothing. Signed nothing. Showed up for no one.<br>
      In a compliance platform. The irony is not lost on us.
    </p>

    <!-- Log of shame -->
    <div class="shame-log fade-up d4">
      <div class="shame-log-title">Timeline of Events</div>

      <div class="log-item">
        <div class="log-icon" style="background:#D1FAE5">
          <svg viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="log-text">
          <div class="log-main">Maker approved the page. All good.</div>
          <div class="log-time">2024-01-15 · 09:42 AM · Ref: MKR-0041</div>
        </div>
        <span class="log-badge" style="background:#D1FAE5;color:#059669">Approved</span>
      </div>

      <div class="log-item">
        <div class="log-icon" style="background:#D1FAE5">
          <svg viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="log-text">
          <div class="log-main">Checker approved the page. Published live.</div>
          <div class="log-time">2024-01-15 · 11:17 AM · Ref: CHK-0041</div>
        </div>
        <span class="log-badge" style="background:#D1FAE5;color:#059669">Approved</span>
      </div>

      <div class="log-item">
        <div class="log-icon" style="background:#FEF3C7">
          <svg viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2.5"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div class="log-text">
          <div class="log-main">Read receipt not received. Reminder #1 sent.</div>
          <div class="log-time">2024-01-16 · 09:00 AM · Auto-reminder</div>
        </div>
        <span class="log-badge" style="background:#FEF3C7;color:#D97706">Reminder</span>
      </div>

      <div class="log-item">
        <div class="log-icon" style="background:#FFE4E6">
          <svg viewBox="0 0 24 24" fill="none" stroke="#E11D48" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="log-text">
          <div class="log-main">Page has gone completely missing. Escalated.</div>
          <div class="log-time"><?php echo date('Y-m-d'); ?> · Right now · You are here</div>
        </div>
        <span class="log-badge" style="background:#FFE4E6;color:#E11D48">Non-Compliant</span>
      </div>

    </div>

    <div class="error-btn-row fade-up d5">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Return to Dashboard
      </a>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-ghost">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        Report to Compliance Team
      </a>
    </div>

  </div>

  <!-- RIGHT SIDE: DASHBOARD -->
  <div class="dashboard-card fade-up d3">
    <div class="dc-topbar">
      <div class="dc-dot" style="background:#FF5F57"></div>
      <div class="dc-dot" style="background:#FEBC2E"></div>
      <div class="dc-dot" style="background:#28C840"></div>
      <div class="dc-url">/this-page/does-not-exist</div>
    </div>

    <div class="dc-body">

      <div class="dc-section-label">Compliance Status</div>

      <div class="compliance-status">
        <div class="cs-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div>
          <div class="cs-label">NON-COMPLIANT</div>
          <div class="cs-sub">This page has failed its compliance audit</div>
        </div>
      </div>

      <div class="stat-grid">
        <div class="stat-box danger">
          <div class="stat-val">0%</div>
          <div class="stat-lbl">Read Rate</div>
        </div>
        <div class="stat-box danger">
          <div class="stat-val">0</div>
          <div class="stat-lbl">Acknowledgements</div>
        </div>
        <div class="stat-box warn">
          <div class="stat-val" id="reminder-count">47</div>
          <div class="stat-lbl">Reminders Sent</div>
        </div>
        <div class="stat-box danger">
          <div class="stat-val">0</div>
          <div class="stat-lbl">E-Signatures</div>
        </div>
      </div>

      <div class="pb-row">
        <div class="pb-header">
          <span class="pb-label">Existence Compliance</span>
          <span class="pb-pct">0%</span>
        </div>
        <div class="pb-track">
          <div class="pb-fill" id="pb" style="width:0%;background:linear-gradient(90deg,#E11D48,#F43F5E)"></div>
        </div>
      </div>

      <div class="dc-div"></div>
      <div class="dc-section-label">Maker-Checker Workflow</div>

      <div class="mkck-row">
        <div class="mkck">
          <span class="mkck-name">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;vertical-align:middle;margin-right:5px"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Maker Review
          </span>
          <span class="mkck-badge badge-approved">&#10003; Approved</span>
        </div>
        <div class="mkck">
          <span class="mkck-name">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;vertical-align:middle;margin-right:5px"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Checker Review
          </span>
          <span class="mkck-badge badge-approved">&#10003; Approved</span>
        </div>
        <div class="mkck">
          <span class="mkck-name">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;vertical-align:middle;margin-right:5px"><rect x="5" y="2" width="14" height="20" rx="2"/></svg>
            Page Itself
          </span>
          <span class="mkck-badge badge-absent">&#10007; Absent</span>
        </div>
      </div>

      <div class="dc-div"></div>
      <div class="dc-section-label">Automated Reminders</div>

      <div class="reminder-box">
        <div class="rb-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div>
          <div class="rb-count" id="reminder-display">47 reminders sent</div>
          <div class="rb-note">Last sent: <span class="mono" style="font-size:10px">just now · no response</span></div>
        </div>
      </div>

      <div class="dc-div"></div>

      <div class="ai-box">
        <div class="ai-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <div>
          <div class="ai-tag">AI Assistant — PolicyBot</div>
          <div class="ai-text">
            "I searched all 247 published policies.<br>
            <span>This page is not among them. It does not exist.<br>
            I have filed a report. Nobody will see it."</span>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<script>
// Animate progress bar
setTimeout(function(){
  document.getElementById('pb').style.width='2%';
  setTimeout(function(){document.getElementById('pb').style.width='0%'},800);
},600);

// Reminder counter that keeps incrementing
var count=47;
var counterEl=document.getElementById('reminder-count');
var displayEl=document.getElementById('reminder-display');
function incrementReminder(){
  count++;
  counterEl.textContent=count;
  displayEl.textContent=count+' reminders sent';
  var delay=Math.min(3000+(count-47)*800,12000);
  setTimeout(incrementReminder,delay);
}
setTimeout(incrementReminder,4000);
</script>

<?php get_footer(); ?>
