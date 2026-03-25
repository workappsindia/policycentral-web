<?php
/* Template Name: Feature - Employee Interaction */
get_header();
?>
<style>
/* Page-specific accent color */
:root { --accent:#6D28D9; --accent-dark:#5B21B6; --accent-light:#F5F3FF; --accent-border:rgba(109,40,217,.15); }

/* Hero Visual Mockup - Employee Interaction */
.ei-mockup{position:relative;width:100%;max-width:520px;animation:eiMockFloat 7s ease-in-out infinite}
@keyframes eiMockFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes eiCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

/* Main Panel Card */
.ei-panel{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.ei-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.ei-dots{display:flex;gap:5px}
.ei-dots span{width:9px;height:9px;border-radius:50%}
.ei-dots span:nth-child(1){background:#EF4444}
.ei-dots span:nth-child(2){background:#F59E0B}
.ei-dots span:nth-child(3){background:#22C55E}
.ei-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.ei-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#7C3AED,#6D28D9);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.ei-body{padding:16px 18px}
.ei-policy-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px;background:rgba(109,40,217,.08);color:#7C3AED;border:1px solid rgba(109,40,217,.18)}
.ei-policy-title{font-size:14px;font-weight:800;color:var(--gray-900);margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif}
.ei-body-line{height:6px;border-radius:3px;background:var(--gray-100);margin-bottom:5px}
.ei-body-line:nth-child(3){width:90%}
.ei-body-line:nth-child(4){width:75%}
.ei-body-line:nth-child(5){width:82%}
.ei-reactions-row{display:flex;align-items:center;gap:6px;margin-top:12px;padding:8px 10px;background:var(--gray-50);border-radius:8px;border:1px solid var(--gray-100)}
.ei-reaction{display:flex;align-items:center;gap:3px;padding:3px 7px;border-radius:6px;background:#fff;border:1px solid var(--gray-200);font-size:12px;cursor:default}
.ei-reaction-count{font-size:9px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.ei-reaction.active-r{border-color:rgba(109,40,217,.3);background:rgba(109,40,217,.05)}
.ei-comment-row{display:flex;align-items:flex-start;gap:8px;margin-top:10px}
.ei-avatar{width:22px;height:22px;border-radius:50%;background:linear-gradient(135deg,#7C3AED,#6D28D9);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:8px;font-weight:800;color:#fff;font-family:'Plus Jakarta Sans',sans-serif}
.ei-comment-bubble{flex:1;background:var(--gray-50);border:1px solid var(--gray-100);border-radius:8px;padding:6px 9px}
.ei-comment-name{font-size:8px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:2px}
.ei-comment-text{font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.4}

/* E-Sign Floating Card */
.ei-esign{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:162px;animation:eiCardIn .6s ease-out both;animation-delay:.3s}
.ei-esign-icon{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center;margin-bottom:8px}
.ei-esign-icon svg{width:15px;height:15px;color:#fff}
.ei-esign h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.ei-sig-area{height:26px;border-radius:6px;border:1.5px dashed rgba(5,150,105,.4);background:rgba(5,150,105,.04);display:flex;align-items:center;padding:0 8px;margin-bottom:7px}
.ei-sig-line{font-size:14px;color:rgba(5,150,105,.7);font-family:'Plus Jakarta Sans',sans-serif;font-style:italic;font-weight:600;line-height:1}
.ei-ack-btn{display:flex;align-items:center;justify-content:center;gap:5px;padding:5px 10px;border-radius:6px;background:linear-gradient(135deg,#059669,#047857);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;width:100%}
.ei-ack-btn svg{width:10px;height:10px}

/* Q&A Floating Card */
.ei-qa{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:170px;animation:eiCardIn .6s ease-out both;animation-delay:.5s}
.ei-qa h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:7px}
.ei-qa-item{margin-bottom:6px}
.ei-qa-q{display:flex;align-items:flex-start;gap:5px;margin-bottom:3px}
.ei-qa-q-dot{width:14px;height:14px;border-radius:50%;background:rgba(109,40,217,.1);border:1px solid rgba(109,40,217,.2);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:7px;font-weight:800;color:#7C3AED;font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.ei-qa-q span{font-size:9px;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.35}
.ei-qa-a{display:flex;align-items:flex-start;gap:5px;padding-left:4px}
.ei-qa-a-dot{width:14px;height:14px;border-radius:50%;background:rgba(5,150,105,.1);border:1px solid rgba(5,150,105,.2);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:7px;font-weight:800;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.ei-qa-a span{font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.35}

/* Reactions Floating Card */
.ei-react{position:absolute;bottom:52px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:eiCardIn .6s ease-out both;animation-delay:.7s}
.ei-react h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.ei-react-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:4px}
.ei-react-item{display:flex;flex-direction:column;align-items:center;gap:2px;padding:5px 6px;border-radius:7px;background:var(--gray-50);border:1px solid var(--gray-100)}
.ei-react-emoji{font-size:14px;line-height:1}
.ei-react-n{font-size:8px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.ei-react-item.top-r{background:rgba(109,40,217,.06);border-color:rgba(109,40,217,.2)}
.ei-react-item.top-r .ei-react-n{color:#7C3AED}

/* ── MINI VISUAL MOCKUPS inside hero blocks ── */
/* Acknowledgement / Signing mockup */
.fv-ack{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.fv-ack-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#059669,#047857);color:#fff}
.fv-ack-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.fv-ack-head-icon svg{width:14px;height:14px;color:#fff}
.fv-ack-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-ack-head-badge{margin-left:auto;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em}
.fv-ack-body{padding:14px 16px}
.fv-ack-policy-title{font-size:13px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.fv-ack-line{height:5px;border-radius:3px;background:var(--gray-100);margin-bottom:4px}
.fv-ack-divider{height:1px;background:var(--gray-100);margin:12px 0}
.fv-ack-methods{display:flex;gap:5px;margin-bottom:10px;flex-wrap:wrap}
.fv-ack-method{display:flex;align-items:center;gap:3px;padding:3px 8px;border-radius:6px;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-am-ad{background:rgba(5,150,105,.08);color:#059669;border:1px solid rgba(5,150,105,.18)}
.fv-am-aadhar{background:rgba(6,148,162,.08);color:#0694A2;border:1px solid rgba(6,148,162,.18)}
.fv-am-esign{background:rgba(67,56,202,.08);color:#4338CA;border:1px solid rgba(67,56,202,.18)}
.fv-ack-btn{display:flex;align-items:center;justify-content:center;gap:6px;padding:10px;border-radius:8px;background:linear-gradient(135deg,#059669,#047857);color:#fff;font-size:11px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;width:100%}
.fv-ack-btn svg{width:12px;height:12px}
.fv-ack-status{display:flex;align-items:center;justify-content:space-between;padding:8px 16px;background:var(--gray-50);border-top:1px solid var(--gray-100);font-size:9px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ack-status-val{color:#059669;font-weight:800}

/* CTA */
.cta-section{padding:80px 0;background:linear-gradient(135deg,#F5F3FF 0%,#EDE9FE 50%,#F5F3FF 100%);border-top:1px solid var(--accent-border);border-bottom:1px solid var(--accent-border)}
@media(max-width:1024px){
  .ei-mockup{max-width:340px}
  .ei-esign{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .ei-react{position:relative;bottom:0;right:0;margin-top:10px}
  .ei-qa{position:relative;left:0;bottom:0;margin-top:10px}
  .fv-ack,.fv-reactions{max-width:100%}
}
@media(max-width:640px){
  .ei-mockup{max-width:300px}
  .cta-section{padding:56px 0}
}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Employee Interaction<br>&amp; <span class="accent">Acknowledgement</span></h1>
    <p class="subtitle">Capture employee acknowledgement, feedback, and engagement directly within the policy platform.</p>
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
      <span style="color:var(--accent)">Employee Interaction</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ei-mockup">
      <!-- Main Policy Interaction Panel -->
      <div class="ei-panel">
        <div class="ei-titlebar">
          <div class="ei-dots"><span></span><span></span><span></span></div>
          <span class="ei-titlebar-text">PolicyCentral.ai</span>
          <span class="ei-titlebar-badge">Policy Viewer</span>
        </div>
        <div class="ei-body">
          <div class="ei-policy-tag">
            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            HR Compliance
          </div>
          <div class="ei-policy-title">Code of Conduct Policy</div>
          <div class="ei-body-line"></div>
          <div class="ei-body-line"></div>
          <div class="ei-body-line"></div>
          <!-- Reactions Row -->
          <div class="ei-reactions-row">
            <span class="ei-reaction active-r">&#128077; <span class="ei-reaction-count">142</span></span>
            <span class="ei-reaction">&#10084;&#65039; <span class="ei-reaction-count">38</span></span>
            <span class="ei-reaction">&#128076; <span class="ei-reaction-count">21</span></span>
            <span class="ei-reaction">&#128078; <span class="ei-reaction-count">4</span></span>
          </div>
          <!-- Employee Comment -->
          <div class="ei-comment-row">
            <div class="ei-avatar">AK</div>
            <div class="ei-comment-bubble">
              <div class="ei-comment-name">Amit K.</div>
              <div class="ei-comment-text">Does this apply to contractors as well?</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: E-Sign / Acknowledgement -->
      <div class="ei-esign">
        <div class="ei-esign-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h5>Policy Acknowledgement</h5>
        <div class="ei-sig-area">
          <span class="ei-sig-line">Priya Sharma</span>
        </div>
        <div class="ei-ack-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          I Acknowledge &amp; Sign
        </div>
      </div>

      <!-- Floating Card: Q&A -->
      <div class="ei-qa">
        <h5>Employee Questions</h5>
        <div class="ei-qa-item">
          <div class="ei-qa-q">
            <div class="ei-qa-q-dot">Q</div>
            <span>Can I use personal devices for work email?</span>
          </div>
          <div class="ei-qa-a">
            <div class="ei-qa-a-dot">A</div>
            <span>Yes, with MDM enrollment required.</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: Reactions Summary -->
      <div class="ei-react">
        <h5>Reactions</h5>
        <div class="ei-react-grid">
          <div class="ei-react-item top-r">
            <span class="ei-react-emoji">&#128077;</span>
            <span class="ei-react-n">142</span>
          </div>
          <div class="ei-react-item">
            <span class="ei-react-emoji">&#10084;&#65039;</span>
            <span class="ei-react-n">38</span>
          </div>
          <div class="ei-react-item">
            <span class="ei-react-emoji">&#128076;</span>
            <span class="ei-react-n">21</span>
          </div>
          <div class="ei-react-item">
            <span class="ei-react-emoji">&#128078;</span>
            <span class="ei-react-n">4</span>
          </div>
          <div class="ei-react-item">
            <span class="ei-react-emoji">&#128161;</span>
            <span class="ei-react-n">17</span>
          </div>
          <div class="ei-react-item">
            <span class="ei-react-emoji">&#128079;</span>
            <span class="ei-react-n">9</span>
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
    <h2>Drive Employee <span class="g-text">Engagement</span> &amp; Compliance</h2>
    <p>Purpose-built tools to capture acknowledgement, gather feedback, and measure policy engagement.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: Policy Acknowledgement and Signing ═══ -->
  <div class="feat-hero feat-hero-emerald reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg></div>
      <h3>Policy Acknowledgement and Signing</h3>
      <p>Multiple signing methods including AD password authentication, Aadhaar-based verification, and digital signature tools. Every acknowledgement captures a secure timestamp and complete audit trail for compliance reporting, proving that every employee has read and understood the policy.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Audit Trail</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-ack">
        <div class="fv-ack-head">
          <div class="fv-ack-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
          <span>Policy Acknowledgement</span>
          <span class="fv-ack-head-badge">Secure Sign</span>
        </div>
        <div class="fv-ack-body">
          <div class="fv-ack-policy-title">Code of Conduct Policy v2.1</div>
          <div class="fv-ack-line" style="width:95%"></div>
          <div class="fv-ack-line" style="width:80%"></div>
          <div class="fv-ack-line" style="width:88%"></div>
          <div class="fv-ack-divider"></div>
          <div class="fv-sig-label">Employee Signature</div>
          <div class="fv-sig-area"><span class="fv-sig-text">Priya Sharma</span></div>
          <div class="fv-ack-methods">
            <span class="fv-ack-method fv-am-ad"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="8" height="8"><rect x="2" y="3" width="20" height="14" rx="2"/></svg> AD Password</span>
            <span class="fv-ack-method fv-am-aadhar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="8" height="8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Aadhaar OTP</span>
            <span class="fv-ack-method fv-am-esign"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="8" height="8"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg> e-Sign</span>
          </div>
          <div class="fv-ack-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            I Acknowledge &amp; Sign
          </div>
        </div>
        <div class="fv-ack-status">
          <span>342 of 507 acknowledged</span>
          <span class="fv-ack-status-val">67% Complete</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: One-Click, Q&A, Comments, Recommend ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg></div>
      <h3>One-Click Response Buttons</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Helpful</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg> Not Helpful</span>
      </div>
      <p>Create custom response buttons like Helpful/Not Helpful, Agree/Disagree, or any custom labels. Publishers define the options; employees respond with a single tap.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> Customizable</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <h3>Employees Can Ask Questions</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/></svg> Policy Q&amp;A</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16"/></svg> Excel Export</span>
      </div>
      <p>Employees submit questions directly on any policy. All questions are consolidated and available as downloadable Excel reports for policy owners to review and track.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg> Excel Export</span>
    </div>
    <div class="feature-card fc-rose reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
      <h3>Enabling Employee Comments</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> Threaded</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg> Visible</span>
      </div>
      <p>Policy-level commenting allows employees to share observations, ask clarifications, and provide feedback visible to colleagues. Fosters collaborative policy understanding.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> Collaborative</span>
    </div>
    <div class="feature-card fc-indigo reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h3>Recommend a Policy</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg> Send to Peer</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg> Organic Reach</span>
      </div>
      <p>Employees can recommend policies to colleagues, expanding awareness organically. Peer recommendations help surface important policies to team members who might have missed them.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg> Peer Sharing</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Emoji-Based Reactions (reversed) ═══ -->
  <div class="feat-hero feat-hero-violet reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg></div>
      <h3>Emoji-Based Reactions</h3>
      <p>12+ emoji reactions for quick sentiment capture. Employees express how they feel about a policy with a single tap, providing publishers with instant, quantifiable feedback on how policies are being received across the organization. Track trending reactions to spot confusion or approval at a glance.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/></svg> 12+ Emojis</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-reactions">
        <div class="fv-reactions-head">
          <div class="fv-reactions-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg></div>
          <span>Policy Reactions</span>
          <span class="fv-reactions-head-badge">207 total</span>
        </div>
        <div class="fv-reactions-body">
          <div class="fv-policy-snippet">
            <div class="fv-policy-snip-title">Code of Conduct Policy v2.1</div>
            <div class="fv-snip-line" style="width:92%"></div>
            <div class="fv-snip-line" style="width:78%"></div>
          </div>
          <div class="fv-react-bar">
            <div class="fv-react-pill active"><span class="fv-react-emoji">&#128077;</span><span class="fv-react-count">142</span></div>
            <div class="fv-react-pill"><span class="fv-react-emoji">&#10084;&#65039;</span><span class="fv-react-count">38</span></div>
            <div class="fv-react-pill"><span class="fv-react-emoji">&#128076;</span><span class="fv-react-count">21</span></div>
            <div class="fv-react-pill"><span class="fv-react-emoji">&#128161;</span><span class="fv-react-count">17</span></div>
            <div class="fv-react-pill"><span class="fv-react-emoji">&#128079;</span><span class="fv-react-count">9</span></div>
            <div class="fv-react-pill"><span class="fv-react-emoji">&#128078;</span><span class="fv-react-count">4</span></div>
          </div>
          <div class="fv-react-summary">
            <div class="fv-react-stat top">
              <span class="fv-react-stat-emoji">&#128077;</span>
              <span class="fv-react-stat-n">142</span>
              <span class="fv-react-stat-lbl">Liked</span>
            </div>
            <div class="fv-react-stat">
              <span class="fv-react-stat-emoji">&#10084;&#65039;</span>
              <span class="fv-react-stat-n">38</span>
              <span class="fv-react-stat-lbl">Loved</span>
            </div>
            <div class="fv-react-stat">
              <span class="fv-react-stat-emoji">&#128161;</span>
              <span class="fv-react-stat-n">17</span>
              <span class="fv-react-stat-lbl">Insightful</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Turn Policy Compliance into<br>Active <span class="g-text">Engagement</span></h2>
    <p>See how PolicyCentral.ai transforms one-way policy publishing into two-way employee interaction.</p>
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
    <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h4>AI-Powered Policy Intelligence</h4>
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
    <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
    </a>
    <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal &amp; Mobile</h4>
      <p>Mobile app, multi-language access</p>
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
