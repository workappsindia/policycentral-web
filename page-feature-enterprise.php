<?php
/* Template Name: Feature - Enterprise */
get_header();
?>
<style>
/* Page-specific accent color override */
:root { --accent:#047857; --accent-dark:#065F46; --accent-light:#ECFDF5; --accent-border:rgba(4,120,87,.15); }

/* Page-specific glow colors and hero mockup CSS */
.hsg1{width:300px;height:200px;background:rgba(67,56,202,.18);top:-40px;left:-60px}
.hsg2{width:260px;height:180px;background:rgba(4,120,87,.14);bottom:-30px;right:-50px}

/* Enterprise Hero Mockup */
.ent-mockup{position:relative;width:100%;max-width:520px;animation:entFloat 7s ease-in-out infinite}
@keyframes entFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes entCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

/* Main config panel card */
.ent-panel{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.ent-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:linear-gradient(135deg,#1E1B4B,#312E81);border-bottom:1px solid rgba(255,255,255,.08)}
.ent-dots{display:flex;gap:5px}
.ent-dots span{width:9px;height:9px;border-radius:50%}
.ent-dots span:nth-child(1){background:#EF4444}
.ent-dots span:nth-child(2){background:#F59E0B}
.ent-dots span:nth-child(3){background:#22C55E}
.ent-titlebar-text{font-size:11px;font-weight:700;color:rgba(255,255,255,.7);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.ent-titlebar-badge{padding:3px 9px;border-radius:6px;background:rgba(99,102,241,.4);border:1px solid rgba(129,140,248,.3);color:#C7D2FE;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.ent-body{padding:14px 16px}
.ent-section-label{font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.ent-row{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:6px}
.ent-row-icon{width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ent-row-icon svg{width:13px;height:13px;color:#fff}
.ent-row-icon.indigo{background:linear-gradient(135deg,#4338CA,#6366F1)}
.ent-row-icon.violet{background:linear-gradient(135deg,#7C3AED,#A78BFA)}
.ent-row-icon.slate{background:linear-gradient(135deg,#334155,#475569)}
.ent-row-info{flex:1}
.ent-row-title{font-size:11px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif}
.ent-row-sub{font-size:9px;color:var(--gray-400);margin-top:1px}
.ent-status-dot{width:8px;height:8px;border-radius:50%;background:#22C55E;flex-shrink:0;box-shadow:0 0 0 2px rgba(34,197,94,.2)}
.ent-dept-row{display:flex;gap:5px;margin-top:8px;flex-wrap:wrap}
.ent-dept-chip{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.ent-dept-chip.hr{background:rgba(67,56,202,.1);color:#4338CA;border:1px solid rgba(67,56,202,.2)}
.ent-dept-chip.fin{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.ent-dept-chip.ops{background:rgba(217,119,6,.1);color:#D97706;border:1px solid rgba(217,119,6,.2)}
.ent-dept-chip.it{background:rgba(124,58,237,.1);color:#7C3AED;border:1px solid rgba(124,58,237,.2)}

/* SSO floating card */
.ent-sso{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:160px;animation:entCardIn .6s ease-out both;animation-delay:.3s}
.ent-sso-header{display:flex;align-items:center;gap:7px;margin-bottom:8px}
.ent-sso-icon{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,#4338CA,#6366F1);display:flex;align-items:center;justify-content:center}
.ent-sso-icon svg{width:13px;height:13px;color:#fff}
.ent-sso h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ent-sso-providers{display:flex;flex-direction:column;gap:4px}
.ent-provider{display:flex;align-items:center;gap:6px;padding:4px 7px;border-radius:6px;background:var(--gray-50);border:1px solid var(--gray-100)}
.ent-provider-dot{width:6px;height:6px;border-radius:50%;background:#22C55E;flex-shrink:0}
.ent-provider span{font-size:9px;font-weight:700;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ent-provider-badge{font-size:8px;font-weight:700;color:#22C55E;font-family:'Plus Jakarta Sans',sans-serif}

/* White-label floating card */
.ent-wl{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:entCardIn .6s ease-out both;animation-delay:.5s}
.ent-wl h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:7px}
.ent-wl-row{display:flex;align-items:center;gap:7px;margin-bottom:5px}
.ent-color-swatch{display:flex;gap:3px}
.ent-swatch{width:12px;height:12px;border-radius:3px}
.ent-wl-field{display:flex;align-items:center;gap:5px;padding:3px 7px;border-radius:5px;background:var(--gray-50);border:1px solid var(--gray-200);font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.ent-wl-field svg{width:9px;height:9px;color:var(--gray-400)}

/* Integration floating card */
.ent-integrations{position:absolute;bottom:30px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:entCardIn .6s ease-out both;animation-delay:.7s}
.ent-integrations h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.ent-int-item{display:flex;align-items:center;gap:6px;padding:3px 0;margin-bottom:3px}
.ent-int-dot{width:6px;height:6px;border-radius:50%;background:#22C55E;flex-shrink:0}
.ent-int-label{font-size:9px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ent-int-check{font-size:10px;color:#22C55E;font-weight:700}
</style>


<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Enterprise<br><span class="accent">Features</span></h1>
    <p class="subtitle">Seamless integration with enterprise systems while supporting flexible deployment and governance across departments.</p>
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
      <span style="color:var(--accent)">Enterprise Features</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ent-mockup">

      <!-- Main Enterprise Config Panel -->
      <div class="ent-panel">
        <div class="ent-titlebar">
          <div class="ent-dots"><span></span><span></span><span></span></div>
          <span class="ent-titlebar-text">PolicyCentral.ai - Admin Console</span>
          <span class="ent-titlebar-badge">ENTERPRISE</span>
        </div>
        <div class="ent-body">
          <div class="ent-section-label">Authentication &amp; Access</div>
          <div class="ent-row">
            <div class="ent-row-icon indigo">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <div class="ent-row-info">
              <div class="ent-row-title">Single Sign-On (SSO)</div>
              <div class="ent-row-sub">Azure AD · Okta · SAML 2.0</div>
            </div>
            <div class="ent-status-dot"></div>
          </div>
          <div class="ent-row">
            <div class="ent-row-icon violet">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="ent-row-info">
              <div class="ent-row-title">Active Directory Integration</div>
              <div class="ent-row-sub">LDAP sync · Auto provisioning</div>
            </div>
            <div class="ent-status-dot"></div>
          </div>

          <div class="ent-section-label" style="margin-top:10px">Organization Structure</div>
          <div class="ent-row">
            <div class="ent-row-icon slate">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <div class="ent-row-info">
              <div class="ent-row-title">Multiple Departments</div>
              <div class="ent-row-sub">Isolated publisher spaces</div>
            </div>
            <div class="ent-status-dot"></div>
          </div>
          <div class="ent-dept-row">
            <span class="ent-dept-chip hr">HR</span>
            <span class="ent-dept-chip fin">Finance</span>
            <span class="ent-dept-chip ops">Operations</span>
            <span class="ent-dept-chip it">IT &amp; Risk</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: SSO / AD Providers -->
      <div class="ent-sso">
        <div class="ent-sso-header">
          <div class="ent-sso-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
          </div>
          <h5>SSO Providers</h5>
        </div>
        <div class="ent-sso-providers">
          <div class="ent-provider">
            <div class="ent-provider-dot"></div>
            <span>Azure Active Directory</span>
            <span class="ent-provider-badge">Connected</span>
          </div>
          <div class="ent-provider">
            <div class="ent-provider-dot"></div>
            <span>Okta</span>
            <span class="ent-provider-badge">Connected</span>
          </div>
          <div class="ent-provider" style="border-color:rgba(99,102,241,.2);background:rgba(99,102,241,.04)">
            <div class="ent-provider-dot" style="background:#6366F1;box-shadow:0 0 0 2px rgba(99,102,241,.2)"></div>
            <span>SAML 2.0 / LDAP</span>
            <span class="ent-provider-badge" style="color:#6366F1">Ready</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: White-Label Branding -->
      <div class="ent-wl">
        <h5>White-Label Platform</h5>
        <div class="ent-wl-row">
          <div class="ent-color-swatch">
            <div class="ent-swatch" style="background:#1E40AF"></div>
            <div class="ent-swatch" style="background:#0891B2"></div>
            <div class="ent-swatch" style="background:#7C3AED"></div>
            <div class="ent-swatch" style="background:#059669"></div>
          </div>
          <div style="font-size:9px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif">Brand colors</div>
        </div>
        <div class="ent-wl-field">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          policies.yourcompany.com
        </div>
        <div class="ent-wl-row" style="margin-top:5px">
          <div style="width:28px;height:16px;border-radius:4px;background:var(--gray-200);border:1px dashed var(--gray-300);display:flex;align-items:center;justify-content:center">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:9px;height:9px;color:var(--gray-400)"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          </div>
          <div style="font-size:9px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif">Custom logo</div>
        </div>
      </div>

      <!-- Floating Card: Integrations -->
      <div class="ent-integrations">
        <h5>System Integrations</h5>
        <div class="ent-int-item">
          <div class="ent-int-dot"></div>
          <span class="ent-int-label">HRMS / SAP / Workday</span>
          <span class="ent-int-check">&#10003;</span>
        </div>
        <div class="ent-int-item">
          <div class="ent-int-dot"></div>
          <span class="ent-int-label">Intranet / SharePoint</span>
          <span class="ent-int-check">&#10003;</span>
        </div>
        <div class="ent-int-item">
          <div class="ent-int-dot"></div>
          <span class="ent-int-label">Org App Store (MDM)</span>
          <span class="ent-int-check">&#10003;</span>
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
    <h2>Built for <span style="color:var(--accent)">Complex Organizations</span></h2>
    <p>From SSO to white-labelling, integrate PolicyCentral seamlessly into your enterprise ecosystem.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: SSO & Active Directory ═══ -->
  <div class="feat-hero feat-hero-indigo reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      </div>
      <h3>Single Sign-On (SSO) &amp; Active Directory Integration</h3>
      <p>Authenticate users via Active Directory with SSO support for Azure AD, Okta, and SAML-based providers. No extra passwords, no friction. Employees access the policy portal with their existing enterprise credentials in a single click.</p>
      <span class="feature-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Zero-Friction Enterprise Login
      </span>
    </div>
    <div class="feat-hero-visual">
      <div class="ent-sso-mockup">
        <div class="ent-sso-head">
          <div class="ent-sso-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
          <span>Enterprise SSO Configuration</span>
        </div>
        <div class="ent-sso-body">
          <div class="ent-sso-providers">
            <div class="ent-sso-provider">
              <div class="ent-sso-provider-logo azure"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
              <div class="ent-sso-provider-info">
                <div class="ent-sso-provider-name">Azure Active Directory</div>
                <div class="ent-sso-provider-sub">Microsoft Entra ID · SAML 2.0</div>
              </div>
              <span class="ent-sso-status">&#10003; Connected</span>
            </div>
            <div class="ent-sso-provider">
              <div class="ent-sso-provider-logo okta"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12a4 4 0 1 0 8 0 4 4 0 0 0-8 0z"/></svg></div>
              <div class="ent-sso-provider-info">
                <div class="ent-sso-provider-name">Okta SSO</div>
                <div class="ent-sso-provider-sub">OAuth 2.0 · OpenID Connect</div>
              </div>
              <span class="ent-sso-status">&#10003; Connected</span>
            </div>
            <div class="ent-sso-provider">
              <div class="ent-sso-provider-logo saml"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
              <div class="ent-sso-provider-info">
                <div class="ent-sso-provider-name">Custom SAML Provider</div>
                <div class="ent-sso-provider-sub">SAML 2.0 · ADFS compatible</div>
              </div>
              <span class="ent-sso-status">&#10003; Connected</span>
            </div>
          </div>
          <div class="ent-sso-divider"></div>
          <div class="ent-sso-flow">
            <div class="ent-sso-step">
              <div class="ent-sso-step-dot s1"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
              <span class="ent-sso-step-label">AD Login</span>
            </div>
            <span class="ent-sso-arrow">&#8594;</span>
            <div class="ent-sso-step">
              <div class="ent-sso-step-dot s2"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
              <span class="ent-sso-step-label">SSO Token</span>
            </div>
            <span class="ent-sso-arrow">&#8594;</span>
            <div class="ent-sso-step">
              <div class="ent-sso-step-dot s3"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
              <span class="ent-sso-step-label">Verified &#10003;</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 3-CARD GRID: White-Label, Mobile Apps, HRMS Integration ═══ -->
  <div class="features-grid three-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
      <h3>White-Label Platform Deployment</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Custom Domain</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> Full Branding</span>
      </div>
      <p>Deploy PolicyCentral on your custom subdomain with full organization branding: logo, colors, and fonts. The entire platform looks and feels like your own internal tool.</p>
      <span class="feature-tag">Custom Branding</span>
    </div>
    <div class="feature-card fc-violet reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h3>Host Mobile Apps in Organization's App Store</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10H12V2z"/></svg> Android APK</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/></svg> iOS Build</span>
      </div>
      <p>Get white-label Android and iOS apps ready for your enterprise app store. APK builds provided for internal distribution and MDM deployment via Jamf or Intune.</p>
      <span class="feature-tag">Enterprise App Store</span>
    </div>
    <div class="feature-card fc-amber reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
      <h3>Integration with HRMS, Intranet &amp; Other Systems</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg> REST API</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg> Webhooks</span>
      </div>
      <p>Connect PolicyCentral with your existing enterprise stack, including HRMS, intranets, and custom apps, using open REST APIs and redirection-based integrations.</p>
      <span class="feature-tag">Open API</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Multiple Departments (reversed) ═══ -->
  <div class="feat-hero feat-hero-emerald reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <h3>Multiple Departments and Publishers</h3>
      <p>HR, IT, InfoSec, Admin, and other departments each manage their policies independently with separate publisher accounts, approval workflows, and distribution controls, all sharing a unified platform with full governance.</p>
      <span class="feature-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        Multi-Entity Governance
      </span>
    </div>
    <div class="feat-hero-visual">
      <div class="ent-dept-mockup">
        <div class="ent-dept-head">
          <div class="ent-dept-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
          <span>Department &amp; Publisher Structure</span>
        </div>
        <div class="ent-dept-body">
          <div class="ent-dept-org">
            <div class="ent-dept-root">
              <div class="ent-dept-root-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
              <div>
                <div class="ent-dept-root-name">PolicyCentral.ai Platform</div>
              </div>
            </div>
            <div class="ent-dept-children">
              <div class="ent-dept-child">
                <div class="ent-dept-child-dot" style="background:#4338CA"></div>
                <span class="ent-dept-child-name">Human Resources</span>
                <span class="ent-dept-child-count">42 Policies · 3 Publishers</span>
              </div>
              <div class="ent-dept-child">
                <div class="ent-dept-child-dot" style="background:#059669"></div>
                <span class="ent-dept-child-name">Information Technology</span>
                <span class="ent-dept-child-count">28 Policies · 2 Publishers</span>
              </div>
              <div class="ent-dept-child">
                <div class="ent-dept-child-dot" style="background:#E11D48"></div>
                <span class="ent-dept-child-name">InfoSec &amp; Compliance</span>
                <span class="ent-dept-child-count">35 Policies · 4 Publishers</span>
              </div>
              <div class="ent-dept-child">
                <div class="ent-dept-child-dot" style="background:#D97706"></div>
                <span class="ent-dept-child-name">Operations &amp; Admin</span>
                <span class="ent-dept-child-count">19 Policies · 2 Publishers</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Partners Login, WebView ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-rose reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
      <h3>Include Partners, Off-Payroll or Contract Staff</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg> OTP on Mobile</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> No AD Required</span>
      </div>
      <p>Non-AD users such as partners, contractors, and off-payroll staff can log in via mobile OTP authentication. Extend policy compliance to your entire extended workforce securely without Active Directory dependency.</p>
      <span class="feature-tag">OTP Authentication</span>
    </div>
    <div class="feature-card fc-emerald reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M2 7h20"/></svg></div>
      <h3>WebView Integration within Existing Apps</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg> Embedded UI</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg> Token Passthrough</span>
      </div>
      <p>Embed the PolicyCentral employee portal directly inside your existing enterprise mobile or web applications via WebView. No separate app download required, delivering a seamless experience within familiar tools.</p>
      <span class="feature-tag">Embedded Integration</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to Deploy at<br><span style="color:var(--accent)">Enterprise Scale</span>?</h2>
    <p>See how PolicyCentral integrates seamlessly with your enterprise infrastructure.</p>
    <div class="cta-buttons">
      <a href="https://cdn.prod.website-files.com/68efc4b526c2e63e771e121e/68f20c9b61c79f027f17c460_794813c088428a5b000f3ae90bcb8edd_PolicyCenter.co.pdf" target="_blank" class="btn btn-primary" style="padding:14px 28px;font-size:14px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
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
    <h2>Other <span style="color:var(--accent)">Features</span></h2>
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
      <h4>Employee Portal &amp; Mobile</h4>
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
    <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h4>Banking-Grade Security &amp; Compliance</h4>
      <p>Encryption, RBAC, audit logs</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
