<?php
/* Template Name: Thank You */
get_header();
?>

<style>
/* Thank You page styles — scoped */
#confetti-canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:999}

.ty-main{max-width:1240px;margin:0 auto;width:100%;padding:64px clamp(20px,4vw,72px) 80px;display:grid;grid-template-columns:1fr 460px;gap:72px;align-items:start}

/* Published stamp */
.published-stamp{
  display:inline-flex;align-items:center;gap:10px;
  padding:7px 16px 7px 10px;border-radius:8px;
  background:#D1FAE5;border:1.5px solid #A7F3D0;
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:11.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:#059669;margin-top:24px;margin-bottom:32px;
}
.stamp-icon{width:22px;height:22px;border-radius:6px;background:#059669;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stamp-icon svg{width:11px;height:11px;color:#fff}

/* Hero copy */
.ty-hero-copy{margin-bottom:36px}
h1.ty-big{font-size:clamp(34px,4vw,54px);font-weight:900;line-height:1.12;margin-bottom:16px;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:-.02em}
.name-highlight{
  display:inline;
  background:linear-gradient(135deg,rgba(6,148,162,.08),rgba(67,56,202,.08));
  border-radius:6px;padding:0 6px 2px;
  border-bottom:2.5px solid rgba(6,148,162,.35);
  font-style:normal;
}
.ty-sub-hed{font-size:clamp(14.5px,1.5vw,17px);color:var(--gray-500);line-height:1.8;max-width:480px;font-weight:400;margin-bottom:32px}
.ty-sub-hed strong{color:var(--gray-700);font-weight:700}

/* Role reversal callout */
.reversal-box{
  border-radius:14px;padding:20px 22px;
  background:linear-gradient(135deg,rgba(6,148,162,.04),rgba(67,56,202,.04));
  border:1.5px solid rgba(6,148,162,.15);
  margin-bottom:32px;
  position:relative;overflow:hidden;
}
.reversal-box::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);
}
.rb-eyebrow{font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#0694A2;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.rb-text{font-size:14px;color:var(--gray-600);line-height:1.7}
.rb-text strong{color:var(--gray-900);font-weight:700}

/* Timeline */
.next-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:16px}
.timeline{display:flex;flex-direction:column;gap:0;margin-bottom:36px;position:relative}
.tl-item{display:flex;gap:16px;align-items:flex-start;position:relative;padding-bottom:20px}
.tl-item:last-child{padding-bottom:0}
.tl-item:last-child .tl-line{display:none}
.tl-left{display:flex;flex-direction:column;align-items:center;flex-shrink:0;width:32px}
.tl-circle{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;z-index:1}
.tl-circle svg{width:13px;height:13px}
.tl-line{width:2px;flex:1;background:var(--gray-200);margin-top:4px;min-height:20px}
.tl-content{padding-top:4px;flex:1}
.tl-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;font-weight:700;color:var(--gray-800);margin-bottom:3px}
.tl-sub{font-size:12px;color:var(--gray-400);line-height:1.5}
.tl-time{font-family:'JetBrains Mono',monospace;font-size:10.5px;color:var(--gray-400);margin-top:2px}
.tl-done .tl-circle{background:#D1FAE5;border:1.5px solid #A7F3D0}
.tl-done .tl-circle svg{color:#059669}
.tl-done .tl-label{color:#059669}
.tl-active .tl-circle{background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);box-shadow:0 0 0 4px rgba(6,148,162,.12)}
.tl-active .tl-circle svg{color:#fff}
.tl-active .tl-label{color:#0694A2}
.tl-pending .tl-circle{background:var(--gray-100);border:1.5px solid var(--gray-200)}
.tl-pending .tl-circle svg{color:var(--gray-400)}

/* Buttons */
.ty-btn-row{display:flex;gap:12px;flex-wrap:wrap}
.ty-btn{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;border-radius:9999px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;transition:all .25s cubic-bezier(.4,0,.2,1);cursor:pointer;text-decoration:none;white-space:nowrap;border:none}
.ty-btn svg{width:14px;height:14px;transition:transform .15s}
.ty-btn:hover svg{transform:translateX(3px)}
.ty-btn-primary{background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);color:#fff;box-shadow:0 4px 20px rgba(6,148,162,.28)}
.ty-btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(6,148,162,.4)}
.ty-btn-ghost{background:var(--gray-50);color:var(--gray-600);border:1.5px solid var(--gray-200)}
.ty-btn-ghost:hover{background:var(--gray-100);color:var(--gray-800);transform:translateY(-1px)}

/* RIGHT: Policy Card */
.policy-card{
  background:#fff;
  border:1.5px solid var(--gray-200);
  border-radius:20px;
  box-shadow:0 24px 64px rgba(0,0,0,.09),0 6px 20px rgba(0,0,0,.05);
  overflow:hidden;
  position:sticky;
  top:calc(var(--nav-h,68px) + 24px);
}
.card-bar{
  display:flex;align-items:center;gap:7px;
  padding:11px 16px;background:var(--gray-50);
  border-bottom:1px solid var(--gray-200);
}
.bar-dot{width:10px;height:10px;border-radius:50%}
.bar-url{flex:1;max-width:240px;margin:0 auto;background:#fff;border:1px solid var(--gray-200);border-radius:6px;padding:3px 10px;font-size:11px;color:var(--gray-400);text-align:center;font-family:'JetBrains Mono',monospace;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.card-body{padding:20px}

.policy-header{
  border-radius:12px;
  background:linear-gradient(135deg,rgba(6,148,162,.05),rgba(67,56,202,.05));
  border:1px solid rgba(6,148,162,.12);
  padding:16px 17px;
  margin-bottom:16px;
  position:relative;overflow:hidden;
}
.policy-header::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%)}
.ph-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.ph-type{font-size:9.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#0694A2;font-family:'Plus Jakarta Sans',sans-serif}
.ph-status{display:flex;align-items:center;gap:5px;font-size:10px;font-weight:700;color:#059669;font-family:'Plus Jakarta Sans',sans-serif}
.ph-status-dot{width:6px;height:6px;border-radius:50%;background:#059669;animation:tyBlink 2s infinite}
@keyframes tyBlink{0%,100%{opacity:1}50%{opacity:.3}}
.ph-name{font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:800;color:var(--gray-900);margin-bottom:5px;line-height:1.3}
.ph-company{font-size:12px;font-weight:600;color:var(--gray-500);display:flex;align-items:center;gap:6px}
.ph-company::before{content:'';width:5px;height:5px;border-radius:50%;background:linear-gradient(135deg,#0694A2,#4338CA);display:inline-block;flex-shrink:0}

/* Stats */
.card-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:14px}
.cs-box{background:var(--gray-50);border:1px solid var(--gray-200);border-radius:9px;padding:10px 11px;text-align:center}
.cs-val{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:900;line-height:1;margin-bottom:3px}
.cs-lbl{font-size:9.5px;color:var(--gray-400);font-weight:500}

/* SLA */
.sla-box{
  border-radius:10px;padding:13px 15px;
  background:#fff;border:1.5px solid #A7F3D0;
  display:flex;align-items:center;gap:13px;
  margin-bottom:14px;
}
.sla-icon{width:34px;height:34px;border-radius:9px;background:#D1FAE5;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sla-icon svg{width:15px;height:15px;color:#059669}
.sla-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:#059669}
.sla-sub{font-size:11px;color:#059669;opacity:.75;margin-top:2px}
.sla-timer{margin-left:auto;font-family:'JetBrains Mono',monospace;font-size:16px;font-weight:700;color:#059669;letter-spacing:-.02em}

/* Read rate */
.rr-section{margin-bottom:14px}
.rr-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:7px}
.rr-label{font-size:12px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.rr-pct{font-family:'JetBrains Mono',monospace;font-size:13px;font-weight:700;color:#0694A2}
.rr-track{height:8px;border-radius:4px;background:var(--gray-200);overflow:hidden;margin-bottom:5px}
.rr-fill{height:100%;border-radius:4px;background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);width:0%;transition:width 2.5s cubic-bezier(.4,0,.2,1)}
.rr-note{font-size:10px;color:var(--gray-400);font-style:italic}

.card-div{height:1px;background:var(--gray-100);margin:12px 0}
.card-section-label{font-size:9.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);margin-bottom:10px;font-family:'Plus Jakarta Sans',sans-serif}

/* Target */
.target-row{
  display:flex;align-items:center;gap:9px;
  padding:9px 11px;border-radius:9px;
  background:var(--gray-50);border:1px solid var(--gray-200);
  margin-bottom:12px;
}
.target-icon{width:28px;height:28px;border-radius:7px;background:#E0F5F7;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.target-icon svg{width:13px;height:13px;color:#0694A2}
.target-label{font-size:11.5px;font-weight:600;color:var(--gray-700);flex:1}
.target-email{font-size:10.5px;color:var(--gray-400);font-family:'JetBrains Mono',monospace;margin-top:1px}
.target-check{width:18px;height:18px;border-radius:50%;background:#D1FAE5;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.target-check svg{width:9px;height:9px;color:#059669}

/* Team assignments */
.assign-row{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
.assign{display:flex;align-items:center;gap:10px;padding:8px 11px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-200)}
.assign-av{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:9.5px;font-weight:800;color:#fff;flex-shrink:0;font-family:'Plus Jakarta Sans',sans-serif}
.assign-name{flex:1;font-size:12px;font-weight:600;color:var(--gray-700)}
.assign-role{font-size:10px;color:var(--gray-400);margin-top:1px}
.assign-badge{font-size:10px;font-weight:700;padding:2px 9px;border-radius:20px;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0}
.badge-notified{background:#D1FAE5;color:#059669}
.badge-queued{background:#EDE9FE;color:#7C3AED}
.badge-briefed{background:#E0F5F7;color:#0694A2}

/* AI note */
.ai-note{
  border-radius:9px;padding:11px 13px;
  background:linear-gradient(135deg,rgba(124,58,237,.03),rgba(67,56,202,.03));
  border:1px solid rgba(124,58,237,.12);
  display:flex;align-items:flex-start;gap:10px;
}
.ai-ic{width:26px;height:26px;border-radius:7px;background:linear-gradient(135deg,#7C3AED,#4338CA);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.ai-ic svg{width:12px;height:12px;color:#fff}
.ai-tag{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:#7C3AED;margin-bottom:3px}
.ai-txt{font-size:11px;color:var(--gray-600);line-height:1.55}
.ai-txt .co{color:#0694A2;font-weight:700}
.ai-txt .muted{color:var(--gray-400)}

/* Reference */
.card-ref{margin-top:14px;display:flex;align-items:center;justify-content:space-between}
.ref-code{font-family:'JetBrains Mono',monospace;font-size:10px;color:var(--gray-300)}
.ref-time{font-size:10px;color:var(--gray-300)}

/* Animations */
.ty-fade-up{opacity:0;transform:translateY(18px);animation:tyFadeUp .55s cubic-bezier(.4,0,.2,1) forwards}
@keyframes tyFadeUp{to{opacity:1;transform:none}}
.td1{animation-delay:.08s}.td2{animation-delay:.18s}.td3{animation-delay:.28s}
.td4{animation-delay:.38s}.td5{animation-delay:.48s}.td6{animation-delay:.58s}

/* Responsive */
@media(max-width:960px){
  .ty-main{grid-template-columns:1fr;gap:48px;padding:48px clamp(20px,4vw,40px) 64px}
  .policy-card{position:static}
}
</style>

<canvas id="confetti-canvas"></canvas>

<div class="ty-main">

  <!-- LEFT SIDE -->
  <div class="ty-left">

    <div class="published-stamp ty-fade-up td1">
      <div class="stamp-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      Enquiry Published &middot; Read Receipt Pending
    </div>

    <div class="ty-hero-copy">
      <h1 class="ty-big ty-fade-up td2">
        Welcome to<br>
        <span class="g-text">the other side,</span><br>
        <em class="name-highlight" id="hero-name">Friend</em>.
      </h1>
    </div>

    <p class="ty-sub-hed ty-fade-up td3" id="sub-text">
      For years, you've tracked whether employees read their policies.<br>
      Today, <strong>your contact form filled is our policy.</strong> And in the next few hours,
      <strong>we are the ones who need to comply.</strong>
    </p>

    <!-- Role reversal callout -->
    <div class="reversal-box ty-fade-up td4">
      <div class="rb-eyebrow">What just happened</div>
      <div class="rb-text" id="reversal-text">
        Your enquiry has been <strong>published</strong> to our team.
        They've been <strong>targeted and notified</strong>.
        Reminders are scheduled if they don't respond.
        Our AI has already <strong>indexed your requirements</strong>.
      </div>
    </div>

    <!-- What happens next -->
    <div class="ty-fade-up td5">
      <div class="next-title">What happens next</div>
      <div class="timeline">

        <div class="tl-item tl-done">
          <div class="tl-left">
            <div class="tl-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="tl-line"></div>
          </div>
          <div class="tl-content">
            <div class="tl-label">Enquiry published &amp; received</div>
            <div class="tl-sub">Your details are in our system. Maker approved. Checker notified.</div>
            <div class="tl-time" style="font-family:'JetBrains Mono',monospace">Just now &middot; Ref: <span id="ref-code">EQ-0001</span></div>
          </div>
        </div>

        <div class="tl-item tl-active">
          <div class="tl-left">
            <div class="tl-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="tl-line"></div>
          </div>
          <div class="tl-content">
            <div class="tl-label">Our team reads your enquiry</div>
            <div class="tl-sub">They have 24 hours. They know. The reminders are already set.</div>
            <div class="tl-time" style="font-family:'JetBrains Mono',monospace">Within 24 business hours</div>
          </div>
        </div>

        <div class="tl-item tl-pending">
          <div class="tl-left">
            <div class="tl-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07"/></svg>
            </div>
          </div>
          <div class="tl-content">
            <div class="tl-label">We call or write to you</div>
            <div class="tl-sub">A real human. With an actual plan for your organisation.</div>
            <div class="tl-time" style="font-family:'JetBrains Mono',monospace">Same day &middot; Promise</div>
          </div>
        </div>

      </div>
    </div>

    <div class="ty-btn-row ty-fade-up td6">
      <a href="<?php echo home_url('/'); ?>" class="ty-btn ty-btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Back to PolicyCentral
      </a>
      <a href="<?php echo home_url('/#demo'); ?>" class="ty-btn ty-btn-ghost">
        Watch the Demo
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
      </a>
    </div>

  </div>

  <!-- RIGHT: LIVE POLICY CARD -->
  <div class="policy-card ty-fade-up td3">
    <div class="card-bar">
      <div class="bar-dot" style="background:#FF5F57"></div>
      <div class="bar-dot" style="background:#FEBC2E"></div>
      <div class="bar-dot" style="background:#28C840"></div>
      <div class="bar-url" id="bar-url">app.policycentral.ai/enquiries</div>
    </div>

    <div class="card-body">

      <!-- Policy identity -->
      <div class="policy-header">
        <div class="ph-meta">
          <span class="ph-type">New Enquiry &mdash; Published</span>
          <span class="ph-status">
            <span class="ph-status-dot"></span>
            Live
          </span>
        </div>
        <div class="ph-name" id="card-policy-name">Your Enquiry &mdash; Initial Assessment</div>
        <div class="ph-company" id="card-company">Your Organisation</div>
      </div>

      <!-- Stats -->
      <div class="card-stats">
        <div class="cs-box">
          <div class="cs-val" style="color:#059669">1</div>
          <div class="cs-lbl">Published</div>
        </div>
        <div class="cs-box">
          <div class="cs-val g-text" id="team-read-count">0</div>
          <div class="cs-lbl">Team Read</div>
        </div>
        <div class="cs-box">
          <div class="cs-val" style="color:#D97706">24hr</div>
          <div class="cs-lbl">SLA</div>
        </div>
      </div>

      <!-- SLA countdown -->
      <div class="sla-box">
        <div class="sla-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
          <div class="sla-label">Response SLA Active</div>
          <div class="sla-sub">Our read receipt is due by</div>
        </div>
        <div class="sla-timer" id="sla-timer">24:00:00</div>
      </div>

      <!-- Read rate -->
      <div class="rr-section">
        <div class="rr-header">
          <span class="rr-label">Team Read Rate</span>
          <span class="rr-pct" id="rr-pct">0%</span>
        </div>
        <div class="rr-track">
          <div class="rr-fill" id="rr-fill"></div>
        </div>
        <div class="rr-note">Climbing... our team has been notified.</div>
      </div>

      <div class="card-div"></div>

      <!-- Target -->
      <div class="card-section-label">Targeted Delivery</div>
      <div class="target-row">
        <div class="target-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <div>
          <div class="target-label" id="target-name">Confirmation sent to you</div>
          <div class="target-email" id="target-email"></div>
        </div>
        <div class="target-check">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
      </div>

      <div class="card-div"></div>
      <div class="card-section-label">Team Assignments</div>

      <div class="assign-row">
        <div class="assign">
          <div class="assign-av" style="background:linear-gradient(135deg,#0694A2,#4338CA)">PC</div>
          <div>
            <div class="assign-name">Pre-Sales Team</div>
            <div class="assign-role">Reviewing your requirements</div>
          </div>
          <span class="assign-badge badge-notified">Notified &#10003;</span>
        </div>
        <div class="assign">
          <div class="assign-av" style="background:linear-gradient(135deg,#059669,#0694A2)">SO</div>
          <div>
            <div class="assign-name">Solutions Consultant</div>
            <div class="assign-role">Preparing your demo environment</div>
          </div>
          <span class="assign-badge badge-queued">Queued</span>
        </div>
        <div class="assign">
          <div class="assign-av" style="background:linear-gradient(135deg,#7C3AED,#4338CA)">AI</div>
          <div>
            <div class="assign-name">PolicyBot &mdash; AI Assistant</div>
            <div class="assign-role">Has already briefed the team</div>
          </div>
          <span class="assign-badge badge-briefed">Briefed &#10003;</span>
        </div>
      </div>

      <div class="card-div"></div>

      <!-- AI note -->
      <div class="ai-note">
        <div class="ai-ic">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <div>
          <div class="ai-tag">PolicyBot &mdash; AI Assistant</div>
          <div class="ai-txt" id="ai-text">
            "I've indexed this enquiry and briefed the team.
            <span class="muted">Based on what you've shared, I've already flagged the relevant features.
            The team will be in touch. They don't want to be the ones who didn't read a policy."</span>
          </div>
        </div>
      </div>

      <!-- Reference -->
      <div class="card-ref">
        <span class="ref-code" id="ref-footer">REF: EQ-0001 &middot; Contact Us</span>
        <span class="ref-time" id="ref-time">Just now</span>
      </div>

    </div>
  </div>

</div>

<script>
// ── READ COOKIES ──────────────────────────────────────────────────
function getCookie(name) {
  var match = document.cookie.match(new RegExp('(^|;\\s*)' + name + '=([^;]+)'));
  return match ? decodeURIComponent(match[2]) : '';
}
var pcName    = getCookie('pc_ty_name')    || 'Friend';
var pcCompany = getCookie('pc_ty_company') || 'Your Organisation';
var pcEmail   = getCookie('pc_ty_email')   || '';

// Clear cookies after reading (one-time use)
document.cookie = 'pc_ty_name=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
document.cookie = 'pc_ty_company=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
document.cookie = 'pc_ty_email=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';

var firstName = pcName.split(' ')[0];

// Generate a ref code
var refNum = 'EQ-' + String(Math.floor(1000 + Math.random() * 9000));

// ── POPULATE FIELDS ──────────────────────────────────────────────────
document.getElementById('hero-name').textContent = firstName + '.';
document.getElementById('card-policy-name').textContent = pcName + ' — Initial Enquiry';
document.getElementById('card-company').textContent = pcCompany;

if (pcEmail) {
  document.getElementById('target-email').textContent = pcEmail;
  document.getElementById('target-name').textContent = 'Confirmation → ' + firstName;
  document.getElementById('bar-url').textContent = 'app.policycentral.ai/eq/' + pcEmail.split('@')[0];
}

document.getElementById('ai-text').innerHTML =
  '"I\'ve indexed <strong class="co">' + pcCompany + '\'s</strong> enquiry and briefed the team. ' +
  '<span class="muted">Based on what ' + firstName + ' shared, I\'ve flagged the right features. ' +
  'The team is on it. Nobody wants to be the one who didn\'t read a policy."</span>';

// Set all ref codes
document.querySelectorAll('#ref-code, #ref-footer').forEach(function(el) {
  el.textContent = el.id === 'ref-footer'
    ? 'REF: ' + refNum + ' · Contact Us'
    : refNum;
});

// ── SLA COUNTDOWN TIMER (24 hours) ────────────────────────────────────
var totalSecs = 24 * 60 * 60;
var timerEl = document.getElementById('sla-timer');

function formatTime(s) {
  var h = Math.floor(s / 3600);
  var m = Math.floor((s % 3600) / 60);
  var sc = s % 60;
  return [h, m, sc].map(function(n){ return String(n).padStart(2, '0'); }).join(':');
}

var timerInterval = setInterval(function() {
  if (totalSecs <= 0) { clearInterval(timerInterval); return; }
  totalSecs--;
  timerEl.textContent = formatTime(totalSecs);
  if (totalSecs < 1800) timerEl.style.color = '#D97706';
  if (totalSecs < 600)  timerEl.style.color = '#E11D48';
}, 1000);

// ── ANIMATE READ RATE ─────────────────────────────────────────────────
var rrCurrent = 0;
var rrFill = document.getElementById('rr-fill');
var rrPct  = document.getElementById('rr-pct');
var teamCount = document.getElementById('team-read-count');

setTimeout(function() {
  var rrInterval = setInterval(function() {
    if (rrCurrent >= 68) { clearInterval(rrInterval); return; }
    rrCurrent += 0.6;
    rrFill.style.width = rrCurrent + '%';
    rrPct.textContent  = Math.round(rrCurrent) + '%';
    if (rrCurrent > 30) teamCount.textContent = '1';
    if (rrCurrent > 55) teamCount.textContent = '2';
  }, 60);
}, 1400);

// ── CONFETTI ─────────────────────────────────────────────────────────
var canvas = document.getElementById('confetti-canvas');
var ctx    = canvas.getContext('2d');
canvas.width  = window.innerWidth;
canvas.height = window.innerHeight;

var colors = ['#0694A2','#4338CA','#7C3AED','#059669','#D97706'];
var pieces = [];
for (var i = 0; i < 80; i++) {
  pieces.push({
    x: Math.random() * canvas.width,
    y: -20 - Math.random() * canvas.height * 0.3,
    r: 3 + Math.random() * 5,
    d: 1.5 + Math.random() * 2.5,
    color: colors[Math.floor(Math.random() * colors.length)],
    tilt: Math.random() * 10 - 5,
    tiltAngle: 0,
    tiltSpeed: 0.07 + Math.random() * 0.05,
    opacity: 0.8 + Math.random() * 0.2
  });
}

var confettiAlive = true;
var confettiFrame = 0;

function drawConfetti() {
  if (!confettiAlive) return;
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  pieces.forEach(function(p) {
    p.tiltAngle += p.tiltSpeed;
    p.y += p.d;
    p.x += Math.sin(p.tiltAngle) * 0.8;
    p.tilt = Math.sin(p.tiltAngle) * 12;
    if (p.y > canvas.height + 20) {
      p.y = -20; p.x = Math.random() * canvas.width;
    }
    ctx.save();
    ctx.globalAlpha = p.opacity;
    ctx.fillStyle = p.color;
    ctx.beginPath();
    ctx.ellipse(p.x, p.y, p.r, p.r * 0.45, p.tilt * 0.1, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  });
  confettiFrame++;
  if (confettiFrame < 180) {
    requestAnimationFrame(drawConfetti);
  } else {
    // Fade out
    var fadeAlpha = 1;
    var fadeInterval = setInterval(function() {
      fadeAlpha -= 0.05;
      canvas.style.opacity = fadeAlpha;
      if (fadeAlpha <= 0) {
        clearInterval(fadeInterval);
        confettiAlive = false;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        canvas.style.display = 'none';
      }
    }, 30);
  }
}

requestAnimationFrame(drawConfetti);

// Resize handler
window.addEventListener('resize', function() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
});
</script>

<?php get_footer(); ?>
