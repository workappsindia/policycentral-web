<?php
/* Template Name: Feature - Publisher Controls */
get_header();
?>
<style>
/* Page-specific accent color override */
:root { --accent:#0694A2; --accent-dark:#0E7490; --accent-light:#F0FDFA; --accent-border:rgba(6,148,162,.15); }

/* Page-specific glow colors and hero mockup CSS */
.hsg1{width:300px;height:200px;background:rgba(5,150,105,.18);top:-40px;left:-60px}
.hsg2{width:260px;height:180px;background:rgba(23,157,151,.14);bottom:-30px;right:-50px}

/* Publisher Controls Hero Visual Mockup */
.pwf-mockup{position:relative;width:100%;max-width:520px;animation:pwfFloat 7s ease-in-out infinite}
@keyframes pwfFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

/* Policy Publishing Dashboard Card */
.pwf-dashboard{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.pwf-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.pwf-dots{display:flex;gap:5px}
.pwf-dots span{width:9px;height:9px;border-radius:50%}
.pwf-dots span:nth-child(1){background:#EF4444}
.pwf-dots span:nth-child(2){background:#F59E0B}
.pwf-dots span:nth-child(3){background:#22C55E}
.pwf-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.pwf-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#059669,#0E7490);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.pwf-body{padding:14px 16px}
.pwf-policy-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.pwf-status-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(217,119,6,.1);color:#D97706;border:1px solid rgba(217,119,6,.2)}
.pwf-status-dot{width:6px;height:6px;border-radius:50%;background:#D97706}
.pwf-policy-title{font-size:13px;font-weight:800;color:var(--gray-900);margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif}
.pwf-line{height:5px;border-radius:3px;background:var(--gray-100);margin-bottom:4px}
.pwf-line:nth-child(1){width:88%}
.pwf-line:nth-child(2){width:73%}
.pwf-line:nth-child(3){width:80%}
.pwf-divider{height:1px;background:var(--gray-100);margin:10px 0}
.pwf-workflow-label{font-size:9px;font-weight:700;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;gap:4px;margin-bottom:8px}
.pwf-workflow-label svg{width:10px;height:10px}
.pwf-step-row{display:flex;align-items:center;gap:6px}
.pwf-step{display:flex;flex-direction:column;align-items:center;gap:3px;flex:1}
.pwf-step-dot{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;color:#fff}
.pwf-dot-done{background:linear-gradient(135deg,#059669,#0E7490)}
.pwf-dot-active{background:linear-gradient(135deg,#D97706,#B45309);box-shadow:0 0 0 3px rgba(217,119,6,.2)}
.pwf-dot-pending{background:var(--gray-200);color:var(--gray-400)}
.pwf-step-label{font-size:8px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;text-align:center}
.pwf-step-connector{width:20px;height:2px;background:var(--gray-200);border-radius:1px;margin-bottom:12px}
.pwf-step-connector.done{background:linear-gradient(90deg,#059669,#0E7490)}

/* Approval Flow Card - floating top-right */
.pwf-approval{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:172px;animation:pwfCardIn .6s ease-out both;animation-delay:.3s}
@keyframes pwfCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.pwf-approval-icon{width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#059669,#0E7490);display:flex;align-items:center;justify-content:center;margin-bottom:7px}
.pwf-approval-icon svg{width:14px;height:14px;color:#fff}
.pwf-approval h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.pwf-pipeline{display:flex;align-items:center;gap:4px}
.pwf-pipe-node{display:flex;flex-direction:column;align-items:center;gap:2px}
.pwf-pipe-dot{width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:8px}
.pwf-pipe-done{background:rgba(5,150,105,.15);color:#059669;border:1.5px solid #059669}
.pwf-pipe-active{background:rgba(217,119,6,.15);color:#D97706;border:1.5px dashed #D97706}
.pwf-pipe-wait{background:var(--gray-100);color:var(--gray-400);border:1.5px solid var(--gray-200)}
.pwf-pipe-label{font-size:7px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;text-align:center}
.pwf-pipe-arrow{font-size:10px;color:var(--gray-300);margin-bottom:10px}

/* Version Control Card - floating bottom-left */
.pwf-version{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:pwfCardIn .6s ease-out both;animation-delay:.5s}
.pwf-version h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.pwf-ver-list{display:flex;flex-direction:column;gap:4px}
.pwf-ver-item{display:flex;align-items:center;gap:7px;font-size:9px;font-family:'Plus Jakarta Sans',sans-serif}
.pwf-ver-tag{padding:2px 6px;border-radius:4px;font-weight:700;font-size:8px}
.pwf-ver-current{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.pwf-ver-old{background:var(--gray-100);color:var(--gray-500);border:1px solid var(--gray-200)}
.pwf-ver-date{color:var(--gray-400);font-size:8px;font-weight:500}
.pwf-ver-active-dot{width:6px;height:6px;border-radius:50%;background:#059669;margin-left:auto}

/* Expiry Card - floating bottom-right */
.pwf-expiry{position:absolute;bottom:44px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;min-width:152px;animation:pwfCardIn .6s ease-out both;animation-delay:.7s}
.pwf-expiry-icon{width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#D97706,#B45309);display:flex;align-items:center;justify-content:center;margin-bottom:7px}
.pwf-expiry-icon svg{width:14px;height:14px;color:#fff}
.pwf-expiry h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px}
.pwf-expiry-date{font-size:12px;font-weight:800;color:#D97706;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.pwf-expiry-sub{font-size:8px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.pwf-expiry-bar-wrap{margin-top:6px;background:var(--gray-100);border-radius:3px;height:5px;overflow:hidden}
.pwf-expiry-bar{height:100%;width:72%;background:linear-gradient(90deg,#D97706,#F59E0B);border-radius:3px}
</style>


<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Publisher Controls &amp;<br><span class="accent">Workflow Management</span></h1>
    <p class="subtitle">Structured publishing controls to manage policy creation, approvals, updates, and communication efficiently across your entire organization.</p>
    <div class="hero-btns">
      <a href="https://cdn.prod.website-files.com/68efc4b526c2e63e771e121e/68f20c9b61c79f027f17c460_794813c088428a5b000f3ae90bcb8edd_PolicyCenter.co.pdf" target="_blank" class="btn btn-primary" style="padding:14px 28px;font-size:14px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary" style="padding:14px 28px;font-size:14px;">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost" style="padding:14px 28px;font-size:14px;">Mobile Demo</a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/features/')); ?>">Features</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Publisher Controls</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="pwf-mockup">
      <!-- Main Policy Publishing Dashboard Card -->
      <div class="pwf-dashboard">
        <div class="pwf-titlebar">
          <div class="pwf-dots"><span></span><span></span><span></span></div>
          <span class="pwf-titlebar-text">Policy Publishing Dashboard</span>
          <span class="pwf-titlebar-badge">⏳ In Review</span>
        </div>
        <div class="pwf-body">
          <div class="pwf-policy-header">
            <span class="pwf-status-tag"><span class="pwf-status-dot"></span>Awaiting Checker</span>
          </div>
          <div class="pwf-policy-title">Data Security &amp; Privacy Policy v3.2</div>
          <div class="pwf-line"></div>
          <div class="pwf-line"></div>
          <div class="pwf-line"></div>
          <div class="pwf-divider"></div>
          <div class="pwf-workflow-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Maker-Checker Workflow
          </div>
          <div class="pwf-step-row">
            <div class="pwf-step">
              <div class="pwf-step-dot pwf-dot-done">✓</div>
              <div class="pwf-step-label">Draft</div>
            </div>
            <div class="pwf-step-connector done"></div>
            <div class="pwf-step">
              <div class="pwf-step-dot pwf-dot-done">✓</div>
              <div class="pwf-step-label">Maker</div>
            </div>
            <div class="pwf-step-connector done"></div>
            <div class="pwf-step">
              <div class="pwf-step-dot pwf-dot-active">⏳</div>
              <div class="pwf-step-label">Checker</div>
            </div>
            <div class="pwf-step-connector"></div>
            <div class="pwf-step">
              <div class="pwf-step-dot pwf-dot-pending">○</div>
              <div class="pwf-step-label">Publish</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Approval Flow -->
      <div class="pwf-approval">
        <div class="pwf-approval-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h5>Approval Pipeline</h5>
        <div class="pwf-pipeline">
          <div class="pwf-pipe-node">
            <div class="pwf-pipe-dot pwf-pipe-done">✓</div>
            <div class="pwf-pipe-label">Maker</div>
          </div>
          <div class="pwf-pipe-arrow">→</div>
          <div class="pwf-pipe-node">
            <div class="pwf-pipe-dot pwf-pipe-active">⏳</div>
            <div class="pwf-pipe-label">Checker</div>
          </div>
          <div class="pwf-pipe-arrow">→</div>
          <div class="pwf-pipe-node">
            <div class="pwf-pipe-dot pwf-pipe-wait">○</div>
            <div class="pwf-pipe-label">Published</div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Version Control -->
      <div class="pwf-version">
        <h5>Version History</h5>
        <div class="pwf-ver-list">
          <div class="pwf-ver-item">
            <span class="pwf-ver-tag pwf-ver-current">v3.2</span>
            <span class="pwf-ver-date">Mar 2026</span>
            <span class="pwf-ver-active-dot"></span>
          </div>
          <div class="pwf-ver-item">
            <span class="pwf-ver-tag pwf-ver-old">v2.0</span>
            <span class="pwf-ver-date">Nov 2025</span>
          </div>
          <div class="pwf-ver-item">
            <span class="pwf-ver-tag pwf-ver-old">v1.0</span>
            <span class="pwf-ver-date">Jan 2025</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: Policy Expiry -->
      <div class="pwf-expiry">
        <div class="pwf-expiry-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h5>Policy Expiry</h5>
        <div class="pwf-expiry-date">31 Dec 2026</div>
        <div class="pwf-expiry-sub">282 days remaining</div>
        <div class="pwf-expiry-bar-wrap"><div class="pwf-expiry-bar"></div></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- FEATURES GRID -->
<section class="features-section">
<div class="container">
  <div class="section-header reveal">
    <h2>Complete Control Over Your<br><span class="g-text">Publishing Workflow</span></h2>
    <p>From creation to approval, publishing, and lifecycle management, every step is covered.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: Maker-Checker Approval Workflow ═══ -->
  <div class="feat-hero feat-hero-indigo reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/></svg></div>
      <h3>Maker-Checker Approval Workflow</h3>
      <p>Implement a structured multi-reviewer approval process before any policy goes live. Ensure quality, compliance, and accuracy with clear approval chains that prevent unauthorized publications and give leadership full oversight.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Multi-Reviewer</span>
    </div>
    <div class="feat-hero-visual">
      <div class="pw-workflow">
        <div class="pw-wf-head">
          <div class="pw-wf-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/></svg></div>
          <span>Approval Workflow</span>
          <span class="pw-wf-head-badge">4 Steps</span>
        </div>
        <div class="pw-wf-body">
          <div class="pw-wf-step">
            <div class="pw-wf-dot pw-dot-done"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="12" height="12"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div class="pw-wf-info">
              <div class="pw-wf-label">Draft Created</div>
              <div class="pw-wf-sub">Author · Leave Policy 2025</div>
            </div>
            <span class="pw-wf-badge pw-badge-done">Done</span>
          </div>
          <div class="pw-wf-step">
            <div class="pw-wf-dot pw-dot-done"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="12" height="12"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div class="pw-wf-info">
              <div class="pw-wf-label">Maker Review</div>
              <div class="pw-wf-sub">HR Manager · Reviewed &amp; Approved</div>
            </div>
            <span class="pw-wf-badge pw-badge-done">Done</span>
          </div>
          <div class="pw-wf-step">
            <div class="pw-wf-dot pw-dot-active">✦</div>
            <div class="pw-wf-info">
              <div class="pw-wf-label">Checker Approval</div>
              <div class="pw-wf-sub">Legal Head · Awaiting review</div>
            </div>
            <span class="pw-wf-badge pw-badge-review">In Review</span>
          </div>
          <div class="pw-wf-step">
            <div class="pw-wf-dot pw-dot-pending"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></div>
            <div class="pw-wf-info">
              <div class="pw-wf-label">Published</div>
              <div class="pw-wf-sub">Pending approval</div>
            </div>
            <span class="pw-wf-badge pw-badge-wait">Pending</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Core Publisher Controls ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-indigo reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
      <h3>Dedicated Publisher Role</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> RBAC</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Own Policies</span>
      </div>
      <p>Assign a dedicated publisher role with specific permissions. Publishers can manage their own policies, access reports, and maintain full control without requiring admin privileges.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Role-Based Access</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
      <h3>Policy Expiry Date Management</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Auto-Alerts</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Reports</span>
      </div>
      <p>Assign expiry dates to policies and access reports of approaching-expiry documents. Stay ahead of renewals and ensure no policy lapses go unnoticed with automated expiry tracking.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Expiry Tracking</span>
    </div>
    <div class="feature-card fc-teal reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Event or Action Due Dates</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg> Calendar</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg> Reminders</span>
      </div>
      <p>Set due dates for policy-related events and actions. Employees see these in a calendar view, making it easy to track deadlines for training completions, acknowledgements, and compliance actions.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg> Calendar View</span>
    </div>
    <div class="feature-card fc-rose reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
      <h3>Real-Time Policy Editing</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Live</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg> Notify/Silent</span>
      </div>
      <p>Edit policy content, targeting rules, and metadata after publication. Choose to notify employees of changes or apply updates silently, giving publishers full flexibility over communications.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Live Updates</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Version Control (reversed) ═══ -->
  <div class="feat-hero feat-hero-emerald reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
      <h3>Version Control</h3>
      <p>Maintain multiple versions of every policy with clear version numbers and timestamps. Publish different versions simultaneously for different audiences, track changes over time, and maintain a complete, auditable version history for compliance.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><line x1="1.05" y1="12" x2="7" y2="12"/><line x1="17.01" y1="12" x2="22.96" y2="12"/></svg> Multi-Version</span>
    </div>
    <div class="feat-hero-visual">
      <div class="pw-versions">
        <div class="pw-ver-head">
          <div class="pw-ver-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
          <span>Version History</span>
          <span class="pw-ver-head-badge">Leave Policy</span>
        </div>
        <div class="pw-ver-body">
          <div class="pw-ver-row pw-ver-active">
            <div class="pw-ver-num pw-vnum-active">v3</div>
            <div class="pw-ver-info">
              <div class="pw-ver-title">Current Version - 2025</div>
              <div class="pw-ver-date">Published 12 Mar 2025 · HR Team</div>
            </div>
            <span class="pw-ver-diff"><span class="pw-diff-add">+18</span>&nbsp;<span class="pw-diff-rm">-4</span></span>
            <span class="pw-ver-status pw-status-live">Live</span>
          </div>
          <div class="pw-ver-row">
            <div class="pw-ver-num pw-vnum-old">v2</div>
            <div class="pw-ver-info">
              <div class="pw-ver-title">Previous Version - 2024</div>
              <div class="pw-ver-date">Published 1 Jan 2024 · HR Team</div>
            </div>
            <span class="pw-ver-diff"><span class="pw-diff-add">+9</span>&nbsp;<span class="pw-diff-rm">-2</span></span>
            <span class="pw-ver-status pw-status-arch">Archived</span>
          </div>
          <div class="pw-ver-row">
            <div class="pw-ver-num pw-vnum-old">v1</div>
            <div class="pw-ver-info">
              <div class="pw-ver-title">Initial Version - 2023</div>
              <div class="pw-ver-date">Published 15 Feb 2023 · HR Team</div>
            </div>
            <span class="pw-ver-diff"><span class="pw-diff-add">+42</span></span>
            <span class="pw-ver-status pw-status-arch">Archived</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Distribution Controls ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-emerald reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg></div>
      <h3>Resend Policies for All Employees</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> One-Click</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> All Targets</span>
      </div>
      <p>Resend any published policy to the entire target audience with a single click. No need to reconfigure targeting or distribution settings, making re-communication effortless.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg> One-Click</span>
    </div>
    <div class="feature-card fc-violet reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
      <h3>Remind Only Unread Users</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg> Smart Filter</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> No Spam</span>
      </div>
      <p>Intelligently resend policy notifications only to employees who have not yet read the document. Avoid spamming compliant employees while ensuring complete reach across the organization.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg> Smart Reminders</span>
    </div>
    <div class="feature-card fc-amber reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></div>
      <h3>Unpublish Policies Instantly</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg> Hidden</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4"/></svg> Audit Log</span>
      </div>
      <p>Remove any published policy from employee view with a single click. The policy remains in the system for audit trails but is immediately hidden from the employee portal.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg> Instant Action</span>
    </div>
    <div class="feature-card fc-rose reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg></div>
      <h3>Recall or Delete Published Policies</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg> Recall</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg> Delete</span>
      </div>
      <p>Instantly recall a published policy or permanently delete it from the system. Handle urgent corrections, outdated content, or compliance issues with immediate action capabilities.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg> Recall &amp; Delete</span>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Notifications & Automation ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
      <h3>Email Notifications</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg> Branded</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Customizable</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Triggered</span>
      </div>
      <p>Integrate with your organization's email system to send customizable notifications when policies are published, updated, or require action. Keep employees informed through their preferred communication channel with branded, on-brand email templates.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg> Customizable</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/></svg></div>
      <h3>Automated Policy Deletion</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Scheduled</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg> Auto-Remove</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Compliant</span>
      </div>
      <p>Schedule automatic deletion of policies on a specified future date. Ideal for temporary policies, seasonal guidelines, or time-bound communications that should not persist beyond their relevance period. Fully automated and audit-safe.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Scheduled</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to take control of your<br>publishing <span class="g-text">workflow</span>?</h2>
    <p>See how structured publishing controls, approval workflows, and lifecycle management can transform your policy operations.</p>
    <div class="cta-buttons">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Contact Us <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/features/')); ?>" class="btn btn-outline">View All Features <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<!-- PRODUCT DEMO -->
<section class="demo-section">
<div class="container">
  <div class="section-header reveal">
    <span class="eyebrow">Product Demo</span>
    <h2>Watch PolicyCentral.ai in action</h2>
  </div>
  <div class="demo-frame reveal" onclick="this.innerHTML='<iframe src=\'https://www.youtube.com/embed/VhS97FE4UX0?autoplay=1\' style=\'width:100%;height:100%;border:none;position:absolute;inset:0\' allow=\'autoplay;fullscreen\' allowfullscreen></iframe>';this.style.cursor='default';this.onclick=null">
    <div class="demo-grid"></div>
    <div class="demo-glow dg1"></div>
    <div class="demo-glow dg2"></div>
    <div class="demo-center">
      <div class="play-btn"><svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
      <span class="demo-lbl">Click to play · Product Demo</span>
    </div>
  </div>
  <div class="demo-btns reveal">
    <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-primary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-secondary">Mobile Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
  </div>
</div>
</section>

<!-- CUSTOMERS -->
<section class="customers-bar">
<div class="container">
  <div class="cust-inner">
    <span class="cust-label">Live Customers</span>
    <div class="cust-logos">
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/HDFC-Life-Logo.png" alt="HDFC Life"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/Kotak Mahindra Bank logo.png" alt="Kotak Mahindra Bank"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/arohan.png" alt="Arohan Financial Services"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/SBI Life Insurance.png" alt="SBI Life Insurance"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/LTFS.png" alt="L&T Financial Services"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/reliance-nippon-life-insurance-logo.png" alt="Reliance Nippon Life Insurance"></div>
    </div>
  </div>
</div>
</section>

<!-- OTHER FEATURES -->
<section class="other-features">
<div class="container">
  <div class="section-header reveal">
    <h2>Other Feature Categories</h2>
    <p>Discover the full breadth of PolicyCentral.ai capabilities.</p>
  </div>
  <div class="other-grid">
    <a href="<?php echo esc_url(home_url('/features/ai-intelligence/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h4>AI-Powered Policy Intelligence</h4>
      <p>Smart search, summaries, chatbot</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/content-management/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h4>Policy Creation &amp; Content Management</h4>
      <p>Author, version, organize policies</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/distribution-targeting/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/employee-portal/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal &amp; Mobile</h4>
      <p>Mobile app, multi-language access</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/employee-interaction/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h4>Employee Interaction &amp; Acknowledgement</h4>
      <p>Read receipts, e-sign, quizzes</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/tracking-reporting/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h4>Tracking, Analytics &amp; Reporting</h4>
      <p>Dashboards, compliance reports</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/enterprise/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      <h4>Enterprise Features</h4>
      <p>AD, SSO, white-label, multi-entity</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/security-compliance/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h4>Security &amp; Compliance</h4>
      <p>Encryption, RBAC, audit logs</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
