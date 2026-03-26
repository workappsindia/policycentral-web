<?php
/* Template Name: Feature - Distribution & Targeting */
get_header();
?>
<style>
/* Page-specific accent color */
:root { --accent:#6D28D9; --accent-dark:#5B21B6; --accent-light:#F5F3FF; --accent-border:rgba(109,40,217,.15); }

/* Hero Visual Mockup - Distribution & Targeting */
.dt-mockup{position:relative;width:100%;max-width:520px;animation:dtFloat 7s ease-in-out infinite}
@keyframes dtFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

/* Main Distribution Panel Card */
.dt-panel{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.dt-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.dt-dots{display:flex;gap:5px}
.dt-dots span{width:9px;height:9px;border-radius:50%}
.dt-dots span:nth-child(1){background:#EF4444}
.dt-dots span:nth-child(2){background:#F59E0B}
.dt-dots span:nth-child(3){background:#22C55E}
.dt-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.dt-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#D97706,#B45309);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.dt-body{padding:14px 16px}
.dt-policy-row{display:flex;align-items:center;gap:10px;padding:10px 12px;background:linear-gradient(135deg,rgba(217,119,6,.06),rgba(217,119,6,.02));border-radius:10px;border:1px solid rgba(217,119,6,.15);margin-bottom:12px}
.dt-policy-icon{width:34px;height:34px;border-radius:8px;background:linear-gradient(135deg,#D97706,#B45309);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.dt-policy-icon svg{width:16px;height:16px;color:#fff}
.dt-policy-info{flex:1}
.dt-policy-name{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.dt-policy-meta{font-size:9px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px}
.dt-policy-status{padding:3px 8px;border-radius:5px;background:rgba(217,119,6,.1);color:#D97706;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid rgba(217,119,6,.2)}
.dt-section-label{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:7px}
.dt-audience-list{display:flex;flex-direction:column;gap:5px}
.dt-audience-row{display:flex;align-items:center;gap:8px;padding:7px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100)}
.dt-audience-icon{width:22px;height:22px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.dt-audience-icon svg{width:11px;height:11px;color:#fff}
.dt-aud-dept{background:linear-gradient(135deg,#0694A2,#0E7490)}
.dt-aud-loc{background:linear-gradient(135deg,#7C3AED,#5B21B6)}
.dt-aud-role{background:linear-gradient(135deg,#D97706,#B45309)}
.dt-audience-name{font-size:10px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.dt-audience-count{font-size:9px;font-weight:600;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.dt-send-bar{display:flex;align-items:center;justify-content:space-between;margin-top:12px;padding-top:10px;border-top:1px solid var(--gray-100)}
.dt-send-info{font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.dt-send-info strong{color:var(--gray-800);font-weight:800}
.dt-send-btn{display:flex;align-items:center;gap:5px;padding:6px 12px;border-radius:7px;background:linear-gradient(135deg,#D97706,#B45309);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.dt-send-btn svg{width:10px;height:10px}

/* Floating Card: Target Groups */
.dt-targets{position:absolute;top:-16px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:158px;animation:dtCardIn .6s ease-out both;animation-delay:.3s}
@keyframes dtCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.dt-targets-hd{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.dt-targets-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#D97706,#B45309);display:flex;align-items:center;justify-content:center}
.dt-targets-icon svg{width:11px;height:11px;color:#fff}
.dt-targets h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.dt-chip-row{display:flex;flex-direction:column;gap:4px}
.dt-chip{display:flex;align-items:center;justify-content:space-between;padding:4px 8px;border-radius:6px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.dt-chip-dept{background:rgba(6,148,162,.08);color:#0694A2;border:1px solid rgba(6,148,162,.18)}
.dt-chip-loc{background:rgba(124,58,237,.08);color:#7C3AED;border:1px solid rgba(124,58,237,.18)}
.dt-chip-role{background:rgba(217,119,6,.08);color:#D97706;border:1px solid rgba(217,119,6,.18)}
.dt-chip-count{font-weight:600;opacity:.7}

/* Floating Card: Evergreen */
.dt-evergreen{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;animation:dtCardIn .6s ease-out both;animation-delay:.5s}
.dt-evergreen-hd{display:flex;align-items:center;gap:7px;margin-bottom:5px}
.dt-evergreen-icon{width:26px;height:26px;border-radius:8px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center}
.dt-evergreen-icon svg{width:13px;height:13px;color:#fff}
.dt-evergreen h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.dt-evergreen-sub{font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;padding-left:2px}
.dt-evergreen-badge{display:inline-flex;align-items:center;gap:4px;margin-top:6px;padding:3px 8px;border-radius:5px;background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.2);font-size:8px;font-weight:800;color:#059669;font-family:'Plus Jakarta Sans',sans-serif}
.dt-evergreen-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:#059669}

/* Floating Card: Mail Merge */
.dt-merge{position:absolute;bottom:44px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:148px;animation:dtCardIn .6s ease-out both;animation-delay:.7s}
.dt-merge-hd{display:flex;align-items:center;gap:6px;margin-bottom:7px}
.dt-merge-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#4338CA,#6366F1);display:flex;align-items:center;justify-content:center}
.dt-merge-icon svg{width:11px;height:11px;color:#fff}
.dt-merge h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.dt-merge-preview{background:var(--gray-50);border-radius:7px;padding:7px 9px;border:1px solid var(--gray-100)}
.dt-merge-line{font-size:9px;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.5}
.dt-merge-field{display:inline-block;padding:1px 5px;border-radius:3px;background:rgba(67,56,202,.1);color:#4338CA;font-weight:800;border:1px solid rgba(67,56,202,.2);font-size:8px}

/* ── MINI VISUAL MOCKUPS inside hero blocks ── */
/* Targeting filter mockup */
.fv-target{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.fv-target-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#D97706,#B45309);color:#fff}
.fv-target-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.fv-target-head-icon svg{width:14px;height:14px;color:#fff}
.fv-target-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-target-head-badge{margin-left:auto;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em}
.fv-target-body{padding:14px 16px;display:flex;flex-direction:column;gap:8px}
.fv-filter-row{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;border:1px solid var(--gray-100)}
.fv-filter-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-filter-icon svg{width:12px;height:12px;color:#fff}
.fv-filter-label{font-size:11px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.fv-filter-val{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.02em}
.fv-target-footer{display:flex;align-items:center;justify-content:space-between;padding:10px 16px;border-top:1px solid var(--gray-100);background:var(--gray-50)}
.fv-target-count{font-size:12px;font-weight:800;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif}
.fv-target-count span{color:#D97706}
.fv-target-btn{display:flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;background:linear-gradient(135deg,#D97706,#B45309);color:#fff;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-target-btn svg{width:10px;height:10px}

/* Evergreen timeline mockup */
.fv-evergreen{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.fv-evergreen-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#059669,#047857);color:#fff}
.fv-evergreen-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.fv-evergreen-head-icon svg{width:14px;height:14px;color:#fff}
.fv-evergreen-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-evergreen-head-badge{margin-left:auto;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em}
.fv-evergreen-body{padding:14px 16px;display:flex;flex-direction:column;gap:0}
.fv-ev-timeline-item{display:flex;align-items:flex-start;gap:10px;padding-bottom:12px;position:relative}
.fv-ev-timeline-item:not(:last-child)::after{content:'';position:absolute;left:11px;top:24px;width:2px;bottom:0;background:linear-gradient(180deg,rgba(5,150,105,.3),rgba(5,150,105,.1))}
.fv-ev-dot{width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.fv-ev-dot svg{width:10px;height:10px;color:#fff}
.fv-ev-dot-active{background:linear-gradient(135deg,#059669,#047857)}
.fv-ev-dot-new{background:linear-gradient(135deg,#10B981,#059669);animation:evPulse 2s ease-in-out infinite}
@keyframes evPulse{0%,100%{box-shadow:0 0 0 0 rgba(5,150,105,.4)}50%{box-shadow:0 0 0 5px rgba(5,150,105,0)}}
.fv-ev-dot-future{background:var(--gray-200)}
.fv-ev-info{flex:1}
.fv-ev-label{font-size:11px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ev-sub{font-size:9px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.fv-ev-badge{display:inline-flex;align-items:center;gap:3px;padding:2px 6px;border-radius:4px;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-ev-badge-new{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.fv-ev-badge-auto{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.fv-evergreen-footer{padding:8px 16px 12px;font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;gap:5px}
.fv-evergreen-footer::before{content:'';width:8px;height:8px;border-radius:50%;background:#059669;flex-shrink:0}

/* CTA */
.cta-section{padding:80px 0;background:linear-gradient(135deg,#F5F3FF 0%,#EDE9FE 50%,#F5F3FF 100%);border-top:1px solid var(--accent-border);border-bottom:1px solid var(--accent-border)}
@media(max-width:1024px){
  .dt-mockup{max-width:420px;margin:0 auto}
  .dt-targets{right:-8px;top:-8px}
  .dt-merge{right:-10px;bottom:38px}
  .dt-evergreen{left:-8px}
  .fv-target,.fv-evergreen{max-width:100%}
}
@media(max-width:640px){
  .dt-mockup{max-width:340px}
  .dt-targets{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .dt-merge{position:relative;bottom:0;right:0;margin-top:10px}
  .dt-evergreen{position:relative;left:0;bottom:0;margin-top:10px}
  .cta-section{padding:56px 0}
}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Policy Distribution <br>&amp; <span class="accent">Targeting</span></h1>
    <p class="subtitle">Deliver the right policies to the right employees through flexible targeting and controlled access.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url("/download/presentation/")); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/features/')); ?>">Features</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Distribution &amp; Targeting</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="dt-mockup">

      <!-- Main Distribution Panel -->
      <div class="dt-panel">
        <div class="dt-titlebar">
          <div class="dt-dots"><span></span><span></span><span></span></div>
          <span class="dt-titlebar-text">PolicyCentral.ai</span>
          <span class="dt-titlebar-badge">Distribution Panel</span>
        </div>
        <div class="dt-body">
          <!-- Policy being distributed -->
          <div class="dt-policy-row">
            <div class="dt-policy-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg>
            </div>
            <div class="dt-policy-info">
              <div class="dt-policy-name">Code of Conduct Policy</div>
              <div class="dt-policy-meta">v2.1 · Updated Mar 2026 · PDF + Web</div>
            </div>
            <span class="dt-policy-status">Distributing</span>
          </div>
          <!-- Audience targeting -->
          <div class="dt-section-label">Target Audience</div>
          <div class="dt-audience-list">
            <div class="dt-audience-row">
              <div class="dt-audience-icon dt-aud-dept">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              </div>
              <span class="dt-audience-name">Finance Department</span>
              <span class="dt-audience-count">142 employees</span>
            </div>
            <div class="dt-audience-row">
              <div class="dt-audience-icon dt-aud-loc">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <span class="dt-audience-name">Mumbai &amp; Delhi Offices</span>
              <span class="dt-audience-count">298 employees</span>
            </div>
            <div class="dt-audience-row">
              <div class="dt-audience-icon dt-aud-role">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              </div>
              <span class="dt-audience-name">All Senior Managers</span>
              <span class="dt-audience-count">67 employees</span>
            </div>
          </div>
          <!-- Send bar -->
          <div class="dt-send-bar">
            <div class="dt-send-info">Sending to <strong>507</strong> employees</div>
            <div class="dt-send-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              Send Now
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Target Groups -->
      <div class="dt-targets">
        <div class="dt-targets-hd">
          <div class="dt-targets-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
          </div>
          <h3>Filter By Field</h3>
        </div>
        <div class="dt-chip-row">
          <div class="dt-chip dt-chip-dept">Department <span class="dt-chip-count">8 filters</span></div>
          <div class="dt-chip dt-chip-loc">Location <span class="dt-chip-count">12 offices</span></div>
          <div class="dt-chip dt-chip-role">Role / Grade <span class="dt-chip-count">34 roles</span></div>
        </div>
      </div>

      <!-- Floating Card: Evergreen -->
      <div class="dt-evergreen">
        <div class="dt-evergreen-hd">
          <div class="dt-evergreen-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          </div>
          <h3>Evergreen Share</h3>
        </div>
        <div class="dt-evergreen-sub">Auto-include future joiners</div>
        <div class="dt-evergreen-badge">New Joiners Auto-Included</div>
      </div>

      <!-- Floating Card: Mail Merge -->
      <div class="dt-merge">
        <div class="dt-merge-hd">
          <div class="dt-merge-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <h3>Mail Merge</h3>
        </div>
        <div class="dt-merge-preview">
          <div class="dt-merge-line">Dear <span class="dt-merge-field">{Employee Name}</span>,</div>
          <div class="dt-merge-line">Your <span class="dt-merge-field">{Department}</span> policy</div>
          <div class="dt-merge-line">at <span class="dt-merge-field">{Location}</span> is ready.</div>
        </div>
      </div>

    </div>
  </div>
</div>
</section>

<!-- FEATURES GRID -->
<section class="features-section">
<div class="container">
  <div class="section-header reveal">
    <h2>Precision <span class="g-text">Targeting</span> for Every Policy</h2>
    <p>Flexible tools to ensure the right employees receive the right policies at the right time.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: Target Using Employee Profile Fields ═══ -->
  <div class="feat-hero feat-hero-amber reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
      <h3>Target Using Employee Profile Fields</h3>
      <p>Share policies by department, sub-department, location, grade, or designation. Profile fields sync automatically with your Active Directory or HRMS system, ensuring targeting is always up-to-date without manual maintenance.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> AD/HRMS Sync</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-target">
        <div class="fv-target-head">
          <div class="fv-target-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
          <span>Audience Targeting</span>
          <span class="fv-target-head-badge">AD Synced</span>
        </div>
        <div class="fv-target-body">
          <div class="fv-filter-row">
            <div class="fv-filter-icon fv-fi-dept"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
            <span class="fv-filter-label">Department</span>
            <span class="fv-filter-val fv-fv-teal">Finance + HR</span>
          </div>
          <div class="fv-filter-row">
            <div class="fv-filter-icon fv-fi-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <span class="fv-filter-label">Location</span>
            <span class="fv-filter-val fv-fv-violet">Mumbai, Delhi</span>
          </div>
          <div class="fv-filter-row">
            <div class="fv-filter-icon fv-fi-role"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
            <span class="fv-filter-label">Grade / Role</span>
            <span class="fv-filter-val fv-fv-amber">L4 and above</span>
          </div>
        </div>
        <div class="fv-target-footer">
          <span class="fv-target-count">Matched: <span>342</span> employees</span>
          <div class="fv-target-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg> Send Policy</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 3-CARD GRID: Share / Upload / Reuse ═══ -->
  <div class="features-grid" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
      <h3>Share with Specific Employees</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> By Name</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Controlled</span>
      </div>
      <p>Select individual employees by name from the integrated directory. Perfect for targeted communications, role-specific policies, or sensitive documents requiring limited distribution.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> Individual Select</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Upload Custom Employee Lists</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/></svg> CSV/XLSX</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg> Custom Groups</span>
      </div>
      <p>Upload a spreadsheet with a custom list of employees for targeted distribution. Ideal for cross-functional teams, project groups, or any custom audience outside standard profile fields.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/></svg> Spreadsheet Upload</span>
    </div>
    <div class="feature-card fc-violet reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg></div>
      <h3>Reuse Target Groups</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/></svg> Saved Groups</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Consistent</span>
      </div>
      <p>Save and reuse previous distribution groups or targeting criteria with one click. Eliminates repetitive setup and ensures consistency across recurring policy communications.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/></svg> One-Click Reuse</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Evergreen Auto-Share (reversed) ═══ -->
  <div class="feat-hero feat-hero-emerald reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div>
      <h3>Automatically Share with Future Employees (Evergreen)</h3>
      <p>New hires who match the target profile criteria automatically receive the policy from day one. Ensures 100% coverage without any manual intervention: no chasing, no gaps, no admin overhead.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg> Always-On</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-evergreen">
        <div class="fv-evergreen-head">
          <div class="fv-evergreen-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div>
          <span>Evergreen Distribution</span>
          <span class="fv-evergreen-head-badge">Auto-Active</span>
        </div>
        <div class="fv-evergreen-body">
          <div class="fv-ev-timeline-item">
            <div class="fv-ev-dot fv-ev-dot-active"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div class="fv-ev-info">
              <div class="fv-ev-label">Policy Published &amp; Active</div>
              <div class="fv-ev-sub">Code of Conduct v2.1 · 342 existing employees notified</div>
            </div>
          </div>
          <div class="fv-ev-timeline-item">
            <div class="fv-ev-dot fv-ev-dot-new"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
            <div class="fv-ev-info">
              <div class="fv-ev-label">New Joiner Added <span class="fv-ev-badge fv-ev-badge-new">Auto</span></div>
              <div class="fv-ev-sub">Priya Sharma joined Finance Dept, Mumbai</div>
            </div>
          </div>
          <div class="fv-ev-timeline-item">
            <div class="fv-ev-dot fv-ev-dot-active"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div class="fv-ev-info">
              <div class="fv-ev-label">Policy Sent Automatically <span class="fv-ev-badge fv-ev-badge-auto">Instant</span></div>
              <div class="fv-ev-sub">Priya received policy + acknowledgement request</div>
            </div>
          </div>
          <div class="fv-ev-timeline-item" style="padding-bottom:0">
            <div class="fv-ev-dot fv-ev-dot-future"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg></div>
            <div class="fv-ev-info">
              <div class="fv-ev-label" style="color:var(--gray-400)">Next Joiner → Same Flow</div>
              <div class="fv-ev-sub">No admin action required</div>
            </div>
          </div>
        </div>
        <div class="fv-evergreen-footer">Policies auto-delivered to every matching new hire from day one</div>
      </div>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Mail Merge + Public Policies ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-indigo reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
      <h3>Personalized Policy Content (Mail Merge)</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12"/></svg> {Name} {Dept}</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg> Spreadsheet</span>
      </div>
      <p>Deliver different content to different employees using spreadsheet-driven mail merge. Customize salary figures, benefit details, or role-specific information within a single policy template for every individual.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg> Mail Merge</span>
    </div>
    <div class="feature-card fc-emerald reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Publicly Accessible Policies</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg> Public URL</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/></svg> No Login</span>
      </div>
      <p>Share select policies with external audiences including candidates, vendors, visitors, and partners. Public policies are accessible via URL without requiring authentication or app access.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg> Public URL</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to Transform Your <br>Policy <span class="g-text">Distribution</span>?</h2>
    <p>See how PolicyCentral.ai delivers the right policies to the right people, every time.</p>
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
  <div class="demo-frame reveal" onclick="this.innerHTML='<iframe src='https://www.youtube.com/embed/VhS97FE4UX0?autoplay=1' style='width:100%;height:100%;border:none;position:absolute;inset:0' allow='autoplay;fullscreen' allowfullscreen></iframe>';this.style.cursor='default';this.onclick=null">
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
      <div class="cchip"><?php pc_picture('images/client-logos/HDFC-Life-Logo.png', 'HDFC Life'); ?></div>
      <div class="cchip"><?php pc_picture('images/client-logos/Kotak Mahindra Bank logo.png', 'Kotak Mahindra Bank'); ?></div>
      <div class="cchip"><?php pc_picture('images/client-logos/arohan.png', 'Arohan Financial Services'); ?></div>
      <div class="cchip"><?php pc_picture('images/client-logos/SBI Life Insurance.png', 'SBI Life Insurance'); ?></div>
      <div class="cchip"><?php pc_picture('images/client-logos/LTFS.png', 'L&T Financial Services'); ?></div>
      <div class="cchip"><?php pc_picture('images/client-logos/reliance-nippon-life-insurance-logo.png', 'Reliance Nippon Life Insurance'); ?></div>
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
    <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h4>Gen AI-Powered Policy Intelligence</h4>
      <p>Smart search, summaries, chatbot</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h4>Policy Creation &amp; Content Management</h4>
      <p>Author, version, organize policies</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h4>Publisher Controls &amp; Workflow</h4>
      <p>Approvals, publishing, workflows</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal Employee Portal &amp; Mobileamp; Mobile App</h4>
      <p>Mobile app, multi-language access</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h4>Employee Interaction &amp; Acknowledgement</h4>
      <p>Read receipts, e-sign, quizzes</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h4>Tracking, Analytics &amp; Reporting</h4>
      <p>Dashboards, compliance reports</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      <h4>Enterprise Features</h4>
      <p>AD, SSO, white-label, multi-entity</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h4>Security &amp; Compliance</h4>
      <p>Encryption, RBAC, audit logs</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
