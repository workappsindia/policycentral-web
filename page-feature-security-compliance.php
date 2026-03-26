<?php
/* Template Name: Feature - Security & Compliance */
get_header();
?>
<style>
/* Page-specific accent color override */
:root { --accent:#047857; --accent-dark:#065F46; --accent-light:#ECFDF5; --accent-border:rgba(4,120,87,.15); }

/* Page-specific glow colors and hero mockup CSS */
.hsg1{width:300px;height:200px;background:rgba(15,23,42,.2);top:-40px;left:-60px}
.hsg2{width:260px;height:180px;background:rgba(5,150,105,.14);bottom:-30px;right:-50px}

/* Security Hero Mockup */
.sec-mockup{position:relative;width:100%;max-width:520px;animation:secFloat 7s ease-in-out infinite}
@keyframes secFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes secCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

/* Main Security Dashboard */
.sec-panel{background:#0F172A;border-radius:14px;border:1px solid rgba(255,255,255,.08);box-shadow:0 20px 60px rgba(0,0,0,.30),0 8px 24px rgba(0,0,0,.15);overflow:hidden;position:relative;z-index:2}
.sec-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:#1E293B;border-bottom:1px solid rgba(255,255,255,.06)}
.sec-dots{display:flex;gap:5px}
.sec-dots span{width:9px;height:9px;border-radius:50%}
.sec-dots span:nth-child(1){background:#EF4444}
.sec-dots span:nth-child(2){background:#F59E0B}
.sec-dots span:nth-child(3){background:#22C55E}
.sec-titlebar-text{font-size:11px;font-weight:700;color:rgba(255,255,255,.5);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.sec-titlebar-badge{padding:3px 9px;border-radius:6px;background:rgba(5,150,105,.25);border:1px solid rgba(16,185,129,.3);color:#6EE7B7;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.sec-body{padding:14px 16px}
.sec-status-row{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:8px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);margin-bottom:6px}
.sec-status-icon{width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sec-status-icon svg{width:13px;height:13px;color:#fff}
.sec-status-icon.green{background:linear-gradient(135deg,#059669,#10B981)}
.sec-status-icon.blue{background:linear-gradient(135deg,#1D4ED8,#3B82F6)}
.sec-status-icon.amber{background:linear-gradient(135deg,#B45309,#D97706)}
.sec-status-info{flex:1}
.sec-status-title{font-size:11px;font-weight:700;color:rgba(255,255,255,.85);font-family:'Plus Jakarta Sans',sans-serif}
.sec-status-sub{font-size:9px;color:rgba(255,255,255,.35);margin-top:1px}
.sec-ok{font-size:9px;font-weight:700;color:#10B981;font-family:'Plus Jakarta Sans',sans-serif}
.sec-section-label{font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.3);font-family:'Plus Jakarta Sans',sans-serif;margin:10px 0 6px}
.sec-score-row{display:flex;align-items:center;gap:8px}
.sec-score-bar-wrap{flex:1;height:6px;border-radius:3px;background:rgba(255,255,255,.08);overflow:hidden}
.sec-score-bar{height:100%;border-radius:3px}
.sec-score-bar.full{background:linear-gradient(90deg,#059669,#10B981);width:100%}
.sec-score-bar.high{background:linear-gradient(90deg,#0891B2,#06B6D4);width:90%}
.sec-score-label{font-size:9px;font-weight:700;color:rgba(255,255,255,.5);font-family:'Plus Jakarta Sans',sans-serif;white-space:nowrap}

/* MFA floating card */
.sec-mfa{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:155px;animation:secCardIn .6s ease-out both;animation-delay:.3s}
.sec-mfa-header{display:flex;align-items:center;gap:7px;margin-bottom:8px}
.sec-mfa-icon{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,#1D4ED8,#3B82F6);display:flex;align-items:center;justify-content:center}
.sec-mfa-icon svg{width:13px;height:13px;color:#fff}
.sec-mfa h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.sec-mfa-steps{display:flex;flex-direction:column;gap:4px}
.sec-mfa-step{display:flex;align-items:center;gap:6px;padding:3px 0}
.sec-step-num{width:16px;height:16px;border-radius:50%;background:linear-gradient(135deg,#059669,#10B981);display:flex;align-items:center;justify-content:center;font-size:8px;font-weight:800;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0}
.sec-step-text{font-size:9px;font-weight:600;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif}
.sec-step-check{font-size:10px;color:#22C55E;font-weight:700;margin-left:auto}

/* Encryption floating card */
.sec-enc{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:secCardIn .6s ease-out both;animation-delay:.5s}
.sec-enc h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.sec-enc-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 9px;border-radius:6px;background:linear-gradient(135deg,#059669,#10B981);margin-bottom:6px}
.sec-enc-badge svg{width:10px;height:10px;color:#fff}
.sec-enc-badge span{font-size:9px;font-weight:800;color:#fff;font-family:'Plus Jakarta Sans',sans-serif}
.sec-enc-row{display:flex;align-items:center;gap:5px;margin-bottom:3px}
.sec-enc-dot{width:5px;height:5px;border-radius:50%;background:#22C55E;flex-shrink:0}
.sec-enc-label{font-size:9px;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif}

/* Audit Log floating card */
.sec-audit{position:absolute;bottom:30px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:secCardIn .6s ease-out both;animation-delay:.7s}
.sec-audit h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.sec-log-entry{display:flex;align-items:center;gap:6px;padding:4px 0;border-bottom:1px solid var(--gray-100)}
.sec-log-entry:last-child{border-bottom:none;padding-bottom:0}
.sec-log-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.sec-log-dot.ok{background:#22C55E}
.sec-log-dot.warn{background:#F59E0B}
.sec-log-info{flex:1}
.sec-log-action{font-size:9px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.sec-log-meta{font-size:8px;color:var(--gray-400);margin-top:1px}
/* Feature Hero Illustrations - MFA */.sec-feat-mfa,.sec-feat-audit,.sec-feat-comp{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;width:100%;max-width:420px}.sec-feat-mfa-head,.sec-feat-audit-head,.sec-feat-comp-head{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100);font-size:11px;font-weight:700;color:var(--gray-500);font-family:"Plus Jakarta Sans",sans-serif}.sec-feat-mfa-head-icon,.sec-feat-audit-head-icon,.sec-feat-comp-head-icon{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,#4338CA,#6366F1);display:flex;align-items:center;justify-content:center;flex-shrink:0}.sec-feat-mfa-head-icon svg,.sec-feat-audit-head-icon svg,.sec-feat-comp-head-icon svg{width:14px;height:14px;color:#fff}.sec-feat-audit-head-icon{background:linear-gradient(135deg,#059669,#047857)}.sec-feat-comp-head-icon{background:linear-gradient(135deg,#4338CA,#6366F1)}.sec-feat-mfa-body,.sec-feat-audit-body,.sec-feat-comp-body{padding:14px 16px}/* MFA Steps */.sec-feat-mfa-steps{display:flex;flex-direction:column;gap:10px;margin-bottom:14px}.sec-feat-mfa-step{display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--gray-50);border-radius:10px;border:1px solid var(--gray-100)}.sec-feat-mfa-step-num{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:800;font-family:"Plus Jakarta Sans",sans-serif;flex-shrink:0}.sec-feat-mfa-step-num.s1{background:linear-gradient(135deg,#4338CA,#6366F1)}.sec-feat-mfa-step-num.s2{background:linear-gradient(135deg,#059669,#34d399)}.sec-feat-mfa-step-num.s3{background:linear-gradient(135deg,#D97706,#F59E0B)}.sec-feat-mfa-step-info{flex:1}.sec-feat-mfa-step-title{font-size:11px;font-weight:700;color:var(--gray-900);font-family:"Plus Jakarta Sans",sans-serif}.sec-feat-mfa-step-sub{font-size:9px;color:var(--gray-400);font-family:"Plus Jakarta Sans",sans-serif;margin-top:1px}.sec-feat-mfa-step-check{color:#059669;font-size:14px;font-weight:700}.sec-feat-mfa-result{display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(5,150,105,.08);border-radius:8px;border:1px solid rgba(5,150,105,.2)}.sec-feat-mfa-result-dot{width:8px;height:8px;border-radius:50%;background:#059669;flex-shrink:0;animation:pulse 2s infinite}@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}.sec-feat-mfa-result-text{font-size:10px;font-weight:700;color:#059669;font-family:"Plus Jakarta Sans",sans-serif}/* Audit Trail */.sec-feat-audit-entry{display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid var(--gray-50)}.sec-feat-audit-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-top:4px}.sec-feat-audit-dot.ok{background:#059669}.sec-feat-audit-dot.info{background:#4338CA}.sec-feat-audit-dot.warn{background:#EF4444}.sec-feat-audit-info{flex:1}.sec-feat-audit-action{font-size:10px;font-weight:700;color:var(--gray-700);font-family:"Plus Jakarta Sans",sans-serif}.sec-feat-audit-meta{font-size:8px;color:var(--gray-400);font-family:"Plus Jakarta Sans",sans-serif;margin-top:2px}.sec-feat-audit-time{font-size:9px;color:var(--gray-400);font-family:"Plus Jakarta Sans",sans-serif;flex-shrink:0}.sec-feat-audit-badge{display:inline-flex;align-items:center;gap:5px;margin-top:10px;padding:5px 10px;border-radius:6px;background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.2);font-size:9px;font-weight:700;color:#059669;font-family:"Plus Jakarta Sans",sans-serif}/* Compliance Framework */.sec-feat-comp-label{font-size:9px;font-weight:700;color:var(--gray-500);font-family:"Plus Jakarta Sans",sans-serif;margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em}.sec-feat-comp-badges{display:grid;grid-template-columns:repeat(4,1fr);gap:6px;margin-bottom:12px}.sec-feat-comp-badge{display:flex;flex-direction:column;align-items:center;padding:8px 4px;border-radius:8px;border:1px solid var(--gray-100);background:var(--gray-50);text-align:center}.sec-feat-comp-badge-icon{font-size:16px;margin-bottom:3px}.sec-feat-comp-badge-name{font-size:9px;font-weight:800;color:var(--gray-700);font-family:"Plus Jakarta Sans",sans-serif}.sec-feat-comp-badge-sub{font-size:7px;color:var(--gray-400);font-family:"Plus Jakarta Sans",sans-serif}.sec-feat-comp-badge.soc{border-color:rgba(67,56,202,.2);background:rgba(67,56,202,.04)}.sec-feat-comp-badge.iso{border-color:rgba(5,150,105,.2);background:rgba(5,150,105,.04)}.sec-feat-comp-badge.gdpr{border-color:rgba(217,119,6,.2);background:rgba(217,119,6,.04)}.sec-feat-comp-badge.rbi{border-color:rgba(239,68,68,.2);background:rgba(239,68,68,.04)}.sec-feat-comp-divider{height:1px;background:var(--gray-100);margin:12px 0}.sec-feat-comp-bar-row{display:flex;align-items:center;gap:8px;margin-bottom:6px}.sec-feat-comp-bar-label{font-size:9px;font-weight:600;color:var(--gray-500);font-family:"Plus Jakarta Sans",sans-serif;width:80px;flex-shrink:0;text-align:right}.sec-feat-comp-bar-wrap{flex:1;height:10px;background:var(--gray-200);border-radius:5px;overflow:hidden}.sec-feat-comp-bar-fill{height:100%;border-radius:5px}.sec-feat-comp-bar-val{font-size:9px;font-weight:800;color:var(--gray-600);font-family:"Plus Jakarta Sans",sans-serif;width:30px;flex-shrink:0}
</style>


<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Banking-Grade Security <br>&amp; <span class="accent">Compliance</span></h1>
    <p class="subtitle">Enterprise-grade security controls to meet the requirements of banks, financial institutions, and large enterprises.</p>
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
      <span style="color:var(--accent)">Security &amp; Compliance</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="sec-mockup">

      <!-- Main Security Dashboard -->
      <div class="sec-panel">
        <div class="sec-titlebar">
          <div class="sec-dots"><span></span><span></span><span></span></div>
          <span class="sec-titlebar-text">PolicyCentral.ai - Security Dashboard</span>
          <span class="sec-titlebar-badge">ALL SYSTEMS SECURE</span>
        </div>
        <div class="sec-body">
          <div class="sec-status-row">
            <div class="sec-status-icon green">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="sec-status-info">
              <div class="sec-status-title">Active Directory + MFA</div>
              <div class="sec-status-sub">AD Auth · OTP · Biometric verified</div>
            </div>
            <span class="sec-ok">Active</span>
          </div>
          <div class="sec-status-row">
            <div class="sec-status-icon blue">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <div class="sec-status-info">
              <div class="sec-status-title">AES-256 Encryption</div>
              <div class="sec-status-sub">Data at rest &amp; in transit · TLS 1.3</div>
            </div>
            <span class="sec-ok">Enabled</span>
          </div>
          <div class="sec-status-row">
            <div class="sec-status-icon amber">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
            <div class="sec-status-info">
              <div class="sec-status-title">Tamper-Proof Audit Log</div>
              <div class="sec-status-sub">Immutable · Timestamped · VAPT Ready</div>
            </div>
            <span class="sec-ok">Live</span>
          </div>

          <div class="sec-section-label">Security Posture</div>
          <div style="display:flex;flex-direction:column;gap:5px">
            <div class="sec-score-row">
              <span style="font-size:9px;font-weight:700;color:rgba(255,255,255,.4);font-family:'Plus Jakarta Sans',sans-serif;width:70px;flex-shrink:0">VAPT Score</span>
              <div class="sec-score-bar-wrap"><div class="sec-score-bar full"></div></div>
              <span class="sec-score-label">Pass</span>
            </div>
            <div class="sec-score-row">
              <span style="font-size:9px;font-weight:700;color:rgba(255,255,255,.4);font-family:'Plus Jakarta Sans',sans-serif;width:70px;flex-shrink:0">Encryption</span>
              <div class="sec-score-bar-wrap"><div class="sec-score-bar full"></div></div>
              <span class="sec-score-label">100%</span>
            </div>
            <div class="sec-score-row">
              <span style="font-size:9px;font-weight:700;color:rgba(255,255,255,.4);font-family:'Plus Jakarta Sans',sans-serif;width:70px;flex-shrink:0">MFA Coverage</span>
              <div class="sec-score-bar-wrap"><div class="sec-score-bar high"></div></div>
              <span class="sec-score-label">90%</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: MFA / Auth Steps -->
      <div class="sec-mfa">
        <div class="sec-mfa-header">
          <div class="sec-mfa-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg>
          </div>
          <h3>MFA Verification</h3>
        </div>
        <div class="sec-mfa-steps">
          <div class="sec-mfa-step">
            <div class="sec-step-num">1</div>
            <span class="sec-step-text">AD Password</span>
            <span class="sec-step-check">&#10003;</span>
          </div>
          <div class="sec-mfa-step">
            <div class="sec-step-num">2</div>
            <span class="sec-step-text">OTP / Authenticator</span>
            <span class="sec-step-check">&#10003;</span>
          </div>
          <div class="sec-mfa-step">
            <div class="sec-step-num" style="background:linear-gradient(135deg,#1D4ED8,#3B82F6)">3</div>
            <span class="sec-step-text">Biometric (Mobile)</span>
            <span class="sec-step-check">&#10003;</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: Encryption -->
      <div class="sec-enc">
        <h3>Data Security</h3>
        <div class="sec-enc-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <span>AES-256 Encrypted</span>
        </div>
        <div class="sec-enc-row">
          <div class="sec-enc-dot"></div>
          <span class="sec-enc-label">SSL/TLS 1.3 in transit</span>
        </div>
        <div class="sec-enc-row">
          <div class="sec-enc-dot"></div>
          <span class="sec-enc-label">Data at rest encrypted</span>
        </div>
        <div class="sec-enc-row">
          <div class="sec-enc-dot"></div>
          <span class="sec-enc-label">Screenshot protection</span>
        </div>
      </div>

      <!-- Floating Card: Audit Log -->
      <div class="sec-audit">
        <h3>Audit Trail</h3>
        <div class="sec-log-entry">
          <div class="sec-log-dot ok"></div>
          <div class="sec-log-info">
            <div class="sec-log-action">Policy viewed &amp; acknowledged</div>
            <div class="sec-log-meta">a.sharma@corp.com · 192.168.1.5 · 2m ago</div>
          </div>
        </div>
        <div class="sec-log-entry">
          <div class="sec-log-dot ok"></div>
          <div class="sec-log-info">
            <div class="sec-log-action">User login via AD SSO</div>
            <div class="sec-log-meta">r.mehta@corp.com · 10.0.0.22 · 5m ago</div>
          </div>
        </div>
        <div class="sec-log-entry">
          <div class="sec-log-dot warn"></div>
          <div class="sec-log-info">
            <div class="sec-log-action">Failed login attempt</div>
            <div class="sec-log-meta">unknown · 203.0.113.42 · 12m ago</div>
          </div>
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
    <h2>Comprehensive <span style="color:var(--accent)">Security Architecture</span></h2>
    <p>From encryption to audit logging, every layer of PolicyCentral is designed to meet the highest security standards.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: Active Directory + MFA ═══ -->
  <div class="feat-hero feat-hero-navy reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      </div>
      <h3>Active Directory Authentication with MFA</h3>
      <p>Leverage your existing Active Directory infrastructure for seamless authentication, with multi-factor authentication adding a critical second layer of verification: OTP, authenticator apps, or biometrics on mobile.</p>
      <span class="feature-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        AD + MFA Authentication
      </span>
    </div>
    <div class="feat-hero-visual">
      <div class="sec-feat-mfa">
        <div class="sec-feat-mfa-head">
          <div class="sec-feat-mfa-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
          <span>Multi-Factor Authentication Flow</span>
        </div>
        <div class="sec-feat-mfa-body">
          <div class="sec-feat-mfa-steps">
            <div class="sec-feat-mfa-step">
              <div class="sec-feat-mfa-step-num s1">1</div>
              <div class="sec-feat-mfa-step-info">
                <div class="sec-feat-mfa-step-title">AD Password Verification</div>
                <div class="sec-feat-mfa-step-sub">Active Directory · LDAP · Azure AD</div>
              </div>
              <span class="sec-feat-mfa-step-check">&#10003;</span>
            </div>
            <div class="sec-feat-mfa-step">
              <div class="sec-feat-mfa-step-num s2">2</div>
              <div class="sec-feat-mfa-step-info">
                <div class="sec-feat-mfa-step-title">OTP / Authenticator</div>
                <div class="sec-feat-mfa-step-sub">TOTP · SMS OTP · Google Authenticator</div>
              </div>
              <span class="sec-feat-mfa-step-check">&#10003;</span>
            </div>
            <div class="sec-feat-mfa-step">
              <div class="sec-feat-mfa-step-num s3">3</div>
              <div class="sec-feat-mfa-step-info">
                <div class="sec-feat-mfa-step-title">Biometric (Mobile)</div>
                <div class="sec-feat-mfa-step-sub">Fingerprint · Face ID · TouchID</div>
              </div>
              <span class="sec-feat-mfa-step-check">&#10003;</span>
            </div>
          </div>
          <div class="sec-feat-mfa-result">
            <div class="sec-feat-mfa-result-dot"></div>
            <span class="sec-feat-mfa-result-text">Access Granted - Session Authenticated &#10003;</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: VAPT, IP Restrict, Screenshot, Downloads ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-rose reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h3>Annual VAPT &amp; Source Code Review</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Pen Test</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Reports</span>
      </div>
      <p>Regular vulnerability assessment and penetration testing with full source code review. Certification reports available for vendor risk assessment.</p>
      <span class="feature-tag">Certified Reports</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Restricted Access via Office Network</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> IP Whitelist</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> VPN</span>
      </div>
      <p>IP-based access controls ensure the platform is only accessible from authorized office networks or VPN, preventing unauthorized external access.</p>
      <span class="feature-tag">IP Whitelisting</span>
    </div>
    <div class="feature-card fc-amber reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h3>Screenshot Protection on Mobile</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/></svg> Android Block</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> iOS Alert</span>
      </div>
      <p>Block screenshots on Android devices and receive notifications on iOS when screenshots are taken, preventing unauthorized capture of sensitive policy content.</p>
      <span class="feature-tag">DLP Control</span>
    </div>
    <div class="feature-card fc-violet reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></div>
      <h3>Restricted Policy Downloads</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Granular</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg> Per Role</span>
      </div>
      <p>Prevent unauthorized distribution by controlling who can download policy documents. Granular download permissions ensure sensitive content stays in authorized channels.</p>
      <span class="feature-tag">Download Control</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Tamper-Proof Audit Logging (reversed) ═══ -->
  <div class="feat-hero feat-hero-emerald reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      </div>
      <h3>Tamper-Proof Audit Logging</h3>
      <p>Every action on the platform, including policy views, edits, approvals, downloads, logins, and failures, is captured in an immutable, timestamped audit trail with user identity and IP address. Built for regulatory compliance and forensic readiness.</p>
      <span class="feature-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Full Audit Trail
      </span>
    </div>
    <div class="feat-hero-visual">
      <div class="sec-feat-audit">
        <div class="sec-feat-audit-head">
          <div class="sec-feat-audit-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/></svg></div>
          <span>Tamper-Proof Audit Log</span>
        </div>
        <div class="sec-feat-audit-body">
          <div class="sec-feat-audit-entry">
            <div class="sec-feat-audit-dot ok"></div>
            <div class="sec-feat-audit-info">
              <div class="sec-feat-audit-action">Policy acknowledged &amp; e-signed</div>
              <div class="sec-feat-audit-meta">a.sharma@corp.com · 192.168.1.5 · Leave Policy v3.2</div>
            </div>
            <span class="sec-feat-audit-time">2m ago</span>
          </div>
          <div class="sec-feat-audit-entry">
            <div class="sec-feat-audit-dot info"></div>
            <div class="sec-feat-audit-info">
              <div class="sec-feat-audit-action">Policy published by HR Admin</div>
              <div class="sec-feat-audit-meta">hr.admin@corp.com · 10.0.0.14 · Code of Conduct v5</div>
            </div>
            <span class="sec-feat-audit-time">18m ago</span>
          </div>
          <div class="sec-feat-audit-entry">
            <div class="sec-feat-audit-dot ok"></div>
            <div class="sec-feat-audit-info">
              <div class="sec-feat-audit-action">User login via AD SSO</div>
              <div class="sec-feat-audit-meta">r.mehta@corp.com · 10.0.0.22 · Session #A4F2</div>
            </div>
            <span class="sec-feat-audit-time">31m ago</span>
          </div>
          <div class="sec-feat-audit-entry">
            <div class="sec-feat-audit-dot warn"></div>
            <div class="sec-feat-audit-info">
              <div class="sec-feat-audit-action">Failed login attempt - locked</div>
              <div class="sec-feat-audit-meta">unknown · 203.0.113.42 · 3 attempts</div>
            </div>
            <span class="sec-feat-audit-time">47m ago</span>
          </div>
          <span class="sec-feat-audit-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:10px;height:10px"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Immutable &amp; Tamper-Proof
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: File Storage, Data Security, Auto-Remove, No Mobile Data ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg></div>
      <h3>Secure File Storage Integration</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/></svg> Own S3</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Sovereign</span>
      </div>
      <p>Connect your own AWS S3 buckets for file storage. Keep all policy documents within your organization's cloud infrastructure for complete data sovereignty.</p>
      <span class="feature-tag">Own Cloud Storage</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
      <h3>Advanced Data Security Controls</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/></svg> AES-256</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Custom Keys</span>
      </div>
      <p>Payload encryption with custom encryption keys ensures data is protected both in transit (TLS 1.3) and at rest (AES-256). Manage your own encryption keys for maximum control.</p>
      <span class="feature-tag">Custom Encryption</span>
    </div>
    <div class="feature-card fc-emerald reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg></div>
      <h3>Automatic Access Removal for Ex-Employees</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Auto</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/></svg> AD Sync</span>
      </div>
      <p>When employees are removed from Active Directory, their access is automatically revoked in PolicyCentral. No manual deprovisioning required, ensuring zero access window.</p>
      <span class="feature-tag">Auto-Revoke</span>
    </div>
    <div class="feature-card fc-amber reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg></div>
      <h3>No Data Storage on Mobile Devices</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Server-Only</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/></svg> No Cache</span>
      </div>
      <p>All data stays on the server. Mobile apps do not cache or store any policy data locally, eliminating data exposure risk from lost or stolen devices.</p>
      <span class="feature-tag">Zero Local Storage</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 3: Compliance Framework ═══ -->
  <div class="feat-hero feat-hero-indigo reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      </div>
      <h3>Compliance Framework</h3>
      <p>PolicyCentral is aligned with ISO 27001, SOC 2 Type II, GDPR, NIST cybersecurity framework, and RBI BFSI guidelines, giving regulated enterprises a platform that meets their compliance requirements out of the box.</p>
      <span class="feature-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        Multi-Framework Compliance
      </span>
    </div>
    <div class="feat-hero-visual">
      <div class="sec-feat-comp">
        <div class="sec-feat-comp-head">
          <div class="sec-feat-comp-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
          <span>Compliance Dashboard</span>
        </div>
        <div class="sec-feat-comp-body">
          <div class="sec-feat-comp-label">Aligned Frameworks</div>
          <div class="sec-feat-comp-badges">
            <div class="sec-feat-comp-badge soc">
              <span class="sec-feat-comp-badge-icon">&#128737;</span>
              <span class="sec-feat-comp-badge-name">SOC 2</span>
              <span class="sec-feat-comp-badge-sub">Type II</span>
            </div>
            <div class="sec-feat-comp-badge iso">
              <span class="sec-feat-comp-badge-icon">&#9989;</span>
              <span class="sec-feat-comp-badge-name">ISO 27001</span>
              <span class="sec-feat-comp-badge-sub">ISMS</span>
            </div>
            <div class="sec-feat-comp-badge gdpr">
              <span class="sec-feat-comp-badge-icon">&#127466;&#127482;</span>
              <span class="sec-feat-comp-badge-name">GDPR</span>
              <span class="sec-feat-comp-badge-sub">Data Privacy</span>
            </div>
            <div class="sec-feat-comp-badge rbi">
              <span class="sec-feat-comp-badge-icon">&#127470;&#127475;</span>
              <span class="sec-feat-comp-badge-name">RBI BFSI</span>
              <span class="sec-feat-comp-badge-sub">Guidelines</span>
            </div>
          </div>
          <div class="sec-feat-comp-divider"></div>
          <div class="sec-feat-comp-label">Compliance Posture</div>
          <div class="sec-feat-comp-bar-row">
            <span class="sec-feat-comp-bar-label">Access Control</span>
            <div class="sec-feat-comp-bar-wrap"><div class="sec-feat-comp-bar-fill" style="width:100%;background:linear-gradient(90deg,#4338CA,#6366F1)"></div></div>
            <span class="sec-feat-comp-bar-val">100%</span>
          </div>
          <div class="sec-feat-comp-bar-row">
            <span class="sec-feat-comp-bar-label">Audit Logging</span>
            <div class="sec-feat-comp-bar-wrap"><div class="sec-feat-comp-bar-fill" style="width:100%;background:linear-gradient(90deg,#059669,#10B981)"></div></div>
            <span class="sec-feat-comp-bar-val">100%</span>
          </div>
          <div class="sec-feat-comp-bar-row">
            <span class="sec-feat-comp-bar-label">Encryption</span>
            <div class="sec-feat-comp-bar-wrap"><div class="sec-feat-comp-bar-fill" style="width:100%;background:linear-gradient(90deg,#D97706,#F59E0B)"></div></div>
            <span class="sec-feat-comp-bar-val">100%</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Security Controls, Continuous Enhancements, Deployment, Secure Storage ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-indigo reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
      <h3>Enterprise-Grade Security Controls</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg> RBAC</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/></svg> TLS 1.3</span>
      </div>
      <p>Role-based access control, MFA, TLS 1.2+ encryption in transit, AES-256 at rest, comprehensive audit logs, and file integrity monitoring for defense-in-depth.</p>
      <span class="feature-tag">Defense in Depth</span>
    </div>
    <div class="feature-card fc-teal reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>Continuous Security Enhancements</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/></svg> ~60 Days</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Patches</span>
      </div>
      <p>Platform security is updated every ~60 days with the latest patches, vulnerability fixes, and improvements to stay ahead of emerging threats across all deployment models.</p>
      <span class="feature-tag">~60 Day Cycle</span>
    </div>
    <div class="feature-card fc-violet reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg></div>
      <h3>Flexible Deployment Options</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/></svg> SaaS</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="14" width="20" height="8" rx="2"/></svg> Own AWS</span>
      </div>
      <p>Choose between SaaS deployment or hosting on your own AWS account. Both provide the same security controls with different data residency and sovereignty models.</p>
      <span class="feature-tag">SaaS or Own AWS</span>
    </div>
    <div class="feature-card fc-emerald reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg></div>
      <h3>Secure Data Storage</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/></svg> S3 Lock</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Immutable</span>
      </div>
      <p>Encrypted databases, S3 with Object Lock for immutable storage, automated backup, and versioning ensure data integrity against tampering or accidental deletion.</p>
      <span class="feature-tag">Immutable Storage</span>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Backup & Recovery, Security Architecture ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-rose reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>Backup and Recovery</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/></svg> Auto Backup</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> PITR</span>
      </div>
      <p>Automated backups with point-in-time recovery and configurable retention policies ensure business continuity. Recover data from any point in time with minimal downtime and zero data loss.</p>
      <span class="feature-tag">Point-in-Time Recovery</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg></div>
      <h3>Security Architecture</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/></svg> 3-Tier</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Private Subnet</span>
      </div>
      <p>3-tier architecture with private subnet deployment isolates application, database, and storage layers. Network segmentation and security groups provide defense-in-depth at the infrastructure level.</p>
      <span class="feature-tag">3-Tier Architecture</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Security That Meets <br><span style="color:var(--accent)">Banking Standards</span></h2>
    <p>See how PolicyCentral's security architecture meets the requirements of regulated industries.</p>
    <div class="cta-buttons">
      <a href="<?php echo esc_url(home_url("/download/presentation/")); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
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
    <h2>Other <span style="color:var(--accent)">Features</span></h2>
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
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
      <h4>Publisher Controls &amp; Workflow</h4>
      <p>Approvals, publishing, workflows</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Policy Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal Employee Portal &amp; Mobileamp; Mobile App</h4>
      <p>Mobile app, multi-language access</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h4>Employee Interaction &amp; Acknowledgement</h4>
      <p>Read receipts, e-sign, quizzes</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h4>Tracking, Analytics &amp; Reporting</h4>
      <p>Dashboards, compliance reports</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      <h4>Enterprise Features</h4>
      <p>AD, SSO, white-label, multi-entity</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
