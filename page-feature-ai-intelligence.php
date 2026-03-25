<?php
/* Template Name: Feature - AI Intelligence */
get_header();
?>
<style>
/* Page-specific accent color */
:root { --accent:#0694A2; --accent-dark:#0E7490; --accent-light:#F0FDFA; --accent-border:rgba(6,148,162,.15); }

/* AI Intelligence Hero Visual Mockup */
.aim-mockup{position:relative;width:100%;max-width:520px;animation:aimFloat 7s ease-in-out infinite}
@keyframes aimFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

/* AI Dashboard Card */
.aim-dashboard{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.aim-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.aim-dots{display:flex;gap:5px}
.aim-dots span{width:9px;height:9px;border-radius:50%}
.aim-dots span:nth-child(1){background:#EF4444}
.aim-dots span:nth-child(2){background:#F59E0B}
.aim-dots span:nth-child(3){background:#22C55E}
.aim-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.aim-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#7C3AED,#4338CA);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.aim-body{padding:14px 16px}
.aim-policy-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.aim-policy-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(124,58,237,.1);color:#7C3AED;border:1px solid rgba(124,58,237,.2)}
.aim-ai-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.aim-policy-title{font-size:13px;font-weight:800;color:var(--gray-900);margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif}
.aim-line{height:5px;border-radius:3px;background:var(--gray-100);margin-bottom:4px}
.aim-line:nth-child(1){width:90%}
.aim-line:nth-child(2){width:75%}
.aim-line:nth-child(3){width:83%}
.aim-divider{height:1px;background:var(--gray-100);margin:10px 0}
.aim-summary-label{font-size:9px;font-weight:700;color:#7C3AED;font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;gap:4px;margin-bottom:6px}
.aim-summary-label svg{width:10px;height:10px}
.aim-summary-box{background:linear-gradient(135deg,rgba(124,58,237,.05),rgba(67,56,202,.05));border:1px solid rgba(124,58,237,.15);border-radius:8px;padding:8px 10px}
.aim-summary-line{height:5px;border-radius:3px;background:rgba(124,58,237,.15);margin-bottom:4px}
.aim-summary-line:nth-child(1){width:95%}
.aim-summary-line:nth-child(2){width:82%}
.aim-summary-line:nth-child(3){width:68%}
.aim-lang-row{display:flex;gap:5px;margin-top:10px}
.aim-lang-chip{display:flex;align-items:center;gap:4px;padding:3px 7px;border-radius:5px;font-size:8px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(6,148,162,.08);color:#0694A2;border:1px solid rgba(6,148,162,.18)}

/* Translation Card - floating top-right */
.aim-translation{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:162px;animation:aimCardIn .6s ease-out both;animation-delay:.3s}
@keyframes aimCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.aim-trans-icon{width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#7C3AED,#4338CA);display:flex;align-items:center;justify-content:center;margin-bottom:7px}
.aim-trans-icon svg{width:14px;height:14px;color:#fff}
.aim-translation h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:5px}
.aim-lang-row-card{display:flex;flex-direction:column;gap:3px}
.aim-lang-item{display:flex;align-items:center;gap:6px;font-size:9px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-600)}
.aim-lang-flag{font-size:12px}
.aim-lang-bar{flex:1;height:4px;border-radius:2px;background:var(--gray-100)}
.aim-lang-bar-fill{height:100%;border-radius:2px;background:linear-gradient(90deg,#7C3AED,#4338CA)}
.aim-lang-count{font-size:9px;font-weight:700;color:#7C3AED;font-family:'Plus Jakarta Sans',sans-serif;margin-top:4px}

/* AI Features Card - floating bottom-left */
.aim-features{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:aimCardIn .6s ease-out both;animation-delay:.5s}
.aim-features h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.aim-feature-pills{display:flex;gap:4px;flex-wrap:wrap;max-width:190px}
.aim-fpill{display:flex;align-items:center;gap:3px;padding:4px 8px;border-radius:6px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.aim-fpill svg{width:10px;height:10px}
.aim-fp-summary{background:rgba(124,58,237,.1);color:#7C3AED;border:1px solid rgba(124,58,237,.2)}
.aim-fp-faq{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.aim-fp-quiz{background:rgba(5,150,105,.08);color:#059669;border:1px solid rgba(5,150,105,.18)}
.aim-fp-info{background:rgba(217,119,6,.08);color:#D97706;border:1px solid rgba(217,119,6,.18)}

/* GPT Chat Card - floating bottom-right */
.aim-chat{position:absolute;bottom:44px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;min-width:168px;animation:aimCardIn .6s ease-out both;animation-delay:.7s}
.aim-chat-header{display:flex;align-items:center;gap:6px;margin-bottom:7px}
.aim-chat-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#4338CA,#7C3AED);display:flex;align-items:center;justify-content:center}
.aim-chat-icon svg{width:11px;height:11px;color:#fff}
.aim-chat h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.aim-chat-bubble{border-radius:8px;padding:6px 8px;font-size:9px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;line-height:1.4;margin-bottom:4px}
.aim-bubble-q{background:var(--gray-100);color:var(--gray-700);border-radius:8px 8px 8px 2px}
.aim-bubble-a{background:linear-gradient(135deg,rgba(67,56,202,.1),rgba(124,58,237,.1));color:#4338CA;border:1px solid rgba(67,56,202,.15);border-radius:8px 8px 2px 8px}

/* ── MINI VISUAL MOCKUPS inside hero blocks ── */
/* GPT Chat Mockup */
.fv-chat{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.fv-chat-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#4338CA,#6366F1);color:#fff}
.fv-chat-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.fv-chat-head-icon svg{width:14px;height:14px;color:#fff}
.fv-chat-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-chat-body{padding:14px 16px;display:flex;flex-direction:column;gap:10px}
.fv-chat-msg{max-width:85%;padding:10px 14px;border-radius:14px;font-size:12px;line-height:1.6;font-family:'Manrope',sans-serif}
.fv-chat-user{align-self:flex-end;background:linear-gradient(135deg,#4338CA,#6366F1);color:#fff;border-bottom-right-radius:4px}
.fv-chat-ai{align-self:flex-start;background:var(--gray-50);border:1px solid var(--gray-200);color:var(--gray-700);border-bottom-left-radius:4px}
.fv-chat-ai strong{color:#4338CA;font-weight:700}
.fv-chat-input{display:flex;align-items:center;gap:8px;padding:10px 14px;border-top:1px solid var(--gray-100);margin:0 2px}
.fv-chat-input span{flex:1;font-size:11px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.fv-chat-input-btn{width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#4338CA,#6366F1);display:flex;align-items:center;justify-content:center}
.fv-chat-input-btn svg{width:12px;height:12px;color:#fff}
.fv-chat-topics{display:flex;gap:5px;flex-wrap:wrap;padding:0 16px 12px}
.fv-chat-topic{padding:4px 9px;border-radius:6px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(99,102,241,.08);color:#4338CA;border:1px solid rgba(99,102,241,.15);cursor:default}

/* Translation Mockup */
.fv-translate{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.fv-translate-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#7C3AED,#A78BFA);color:#fff}
.fv-translate-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.fv-translate-head-icon svg{width:14px;height:14px;color:#fff}
.fv-translate-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-translate-head-badge{margin-left:auto;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em}
.fv-translate-body{padding:14px 16px;display:flex;flex-direction:column;gap:8px}
.fv-lang-row{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;border:1px solid var(--gray-100);transition:all .2s var(--ease)}
.fv-lang-row:hover{border-color:rgba(124,58,237,.2);background:rgba(124,58,237,.03)}
.fv-lang-flag{font-size:18px;flex-shrink:0}
.fv-lang-info{flex:1}
.fv-lang-name{font-size:12px;font-weight:700;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-lang-text{font-size:10px;color:var(--gray-400);margin-top:1px}
.fv-lang-status{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.02em}
.fv-lang-done{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.fv-lang-prog{background:rgba(217,119,6,.08);color:#D97706;border:1px solid rgba(217,119,6,.18)}
.fv-lang-more{display:flex;align-items:center;justify-content:center;padding:8px;font-size:11px;font-weight:700;color:#7C3AED;font-family:'Plus Jakarta Sans',sans-serif;border-top:1px solid var(--gray-100);margin-top:4px}

/* CTA */
.cta-section{padding:80px 0;background:linear-gradient(135deg,#F0FDFA 0%,#ECFEFF 50%,#F0FDFA 100%);border-top:1px solid var(--accent-border);border-bottom:1px solid var(--accent-border)}
@media(max-width:1024px){
  .aim-mockup{max-width:420px;margin:0 auto}
  .aim-translation{right:-8px;top:-8px}
  .aim-chat{right:-10px;bottom:36px}
  .aim-features{left:-8px}
  .fv-chat,.fv-translate{max-width:100%}
}
@media(max-width:640px){
  .aim-mockup{max-width:340px}
  .aim-translation{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .aim-chat{position:relative;bottom:0;right:0;margin-top:10px}
  .aim-features{position:relative;left:0;bottom:0;margin-top:10px}
  .cta-section{padding:56px 0}
}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>AI-Powered Policy<br><span class="accent">Intelligence</span></h1>
    <p class="subtitle">Leverage Generative AI to simplify policy communication, improve comprehension, and enhance employee engagement across your organization.</p>
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
      <span style="color:var(--accent)">AI-Powered Policy Intelligence</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="aim-mockup">
      <!-- Main AI Dashboard Card -->
      <div class="aim-dashboard">
        <div class="aim-titlebar">
          <div class="aim-dots"><span></span><span></span><span></span></div>
          <span class="aim-titlebar-text">AI Intelligence Dashboard</span>
          <span class="aim-titlebar-badge">✦ AI Active</span>
        </div>
        <div class="aim-body">
          <div class="aim-policy-header">
            <span class="aim-policy-tag">Leave Policy 2025</span>
            <span class="aim-ai-badge">✦ AI Enhanced</span>
          </div>
          <div class="aim-policy-title">Employee Leave &amp; Absence Policy</div>
          <div class="aim-line"></div>
          <div class="aim-line"></div>
          <div class="aim-line"></div>
          <div class="aim-divider"></div>
          <div class="aim-summary-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            AI-Generated Summary
          </div>
          <div class="aim-summary-box">
            <div class="aim-summary-line"></div>
            <div class="aim-summary-line"></div>
            <div class="aim-summary-line"></div>
          </div>
          <div class="aim-lang-row">
            <span class="aim-lang-chip">🇮🇳 Hindi</span>
            <span class="aim-lang-chip">🇮🇳 Tamil</span>
            <span class="aim-lang-chip">🌐 +8</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: Translation -->
      <div class="aim-translation">
        <div class="aim-trans-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 8l6 6"/><path d="M4 14l6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="M22 22l-5-10-5 10"/><path d="M14 18h6"/></svg>
        </div>
        <h5>10 Languages</h5>
        <div class="aim-lang-row-card">
          <div class="aim-lang-item"><span class="aim-lang-flag">🇮🇳</span>Hindi<div class="aim-lang-bar"><div class="aim-lang-bar-fill" style="width:90%"></div></div></div>
          <div class="aim-lang-item"><span class="aim-lang-flag">🇮🇳</span>Tamil<div class="aim-lang-bar"><div class="aim-lang-bar-fill" style="width:78%"></div></div></div>
          <div class="aim-lang-item"><span class="aim-lang-flag">🇮🇳</span>Telugu<div class="aim-lang-bar"><div class="aim-lang-bar-fill" style="width:65%"></div></div></div>
        </div>
        <div class="aim-lang-count">✦ Auto-translated</div>
      </div>

      <!-- Floating Card: AI Features -->
      <div class="aim-features">
        <h5>AI-Generated Assets</h5>
        <div class="aim-feature-pills">
          <span class="aim-fpill aim-fp-summary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>Summary</span>
          <span class="aim-fpill aim-fp-faq"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>FAQ</span>
          <span class="aim-fpill aim-fp-quiz"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Quiz</span>
          <span class="aim-fpill aim-fp-info"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>Infographic</span>
        </div>
      </div>

      <!-- Floating Card: GPT Chat -->
      <div class="aim-chat">
        <div class="aim-chat-header">
          <div class="aim-chat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </div>
          <h5>GPT Policy Chat</h5>
        </div>
        <div class="aim-chat-bubble aim-bubble-q">How many leaves do I get?</div>
        <div class="aim-chat-bubble aim-bubble-a">You are entitled to 18 annual leaves + 12 casual leaves per year...</div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- FEATURES GRID -->
<section class="features-section">
<div class="container">
  <div class="section-header reveal">
    <h2>Intelligent Features That<br><span class="g-text">Transform Policy Management</span></h2>
    <p>Powered by AWS AI services, these features automate and enhance every aspect of policy communication.</p>
  </div>
  <!-- ═══ HERO FEATURE: GPT for Policy Documents ═══ -->
  <div class="feat-hero feat-hero-indigo reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
      <h3>GPT for Policy Documents</h3>
      <p>An intelligent chatbot that lets employees search and ask questions about policies specific to them. Powered by conversational AI, it provides instant, contextual answers from relevant policy documents.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock + Lex</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-chat">
        <div class="fv-chat-head">
          <div class="fv-chat-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
          <span>PolicyCentral AI Assistant</span>
        </div>
        <div class="fv-chat-body">
          <div class="fv-chat-msg fv-chat-user">How many casual leaves do I get per year?</div>
          <div class="fv-chat-msg fv-chat-ai">Based on the <strong>Leave & Absence Policy v3.2</strong>, you are entitled to <strong>12 casual leaves</strong> per calendar year. Unused leaves cannot be carried forward.</div>
          <div class="fv-chat-msg fv-chat-user">Can I club them with earned leaves?</div>
          <div class="fv-chat-msg fv-chat-ai">Yes, casual leaves can be clubbed with earned leaves with <strong>prior manager approval</strong>. However, the total consecutive leave period cannot exceed <strong>5 working days</strong>.</div>
        </div>
        <div class="fv-chat-topics">
          <span class="fv-chat-topic">Leave Policy</span>
          <span class="fv-chat-topic">Travel Rules</span>
          <span class="fv-chat-topic">Code of Conduct</span>
          <span class="fv-chat-topic">Benefits</span>
        </div>
        <div class="fv-chat-input">
          <span>Ask about any policy...</span>
          <div class="fv-chat-input-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Core AI Features ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>AI-Generated Policy Summaries</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/></svg> Key Points</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> 80% Shorter</span>
      </div>
      <p>Automatically summarize lengthy policy documents into clear, concise highlights. Help employees quickly understand key points without reading entire documents.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <h3>Automatic FAQ Generation</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/></svg> Auto Q&A</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Editable</span>
      </div>
      <p>Generate comprehensive FAQs directly from policy documents using AI. Publishers can review and edit generated questions before publishing.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock</span>
    </div>
    <div class="feature-card fc-emerald reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
      <h3>AI-Generated Policy Quizzes</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/></svg> MCQs</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> Scored</span>
      </div>
      <p>Automatically create multiple-choice quizzes from policy content to test employee understanding. Ensure comprehension, not just acknowledgement.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock</span>
      <span class="dev-badge">In Development</span>
    </div>
    <div class="feature-card fc-rose reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
      <h3>Policy Content Improvisation</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Readability</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg> Suggestions</span>
      </div>
      <p>Analyze existing policies and receive AI-powered suggestions to enhance structure, clarity, and language. Improve readability and consistency.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE: Multi-Language Translation (reversed) ═══ -->
  <div class="feat-hero feat-hero-violet reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Multi-Language Policy Translation</h3>
      <p>Translate policies into 10 Indian languages including Hindi, Marathi, Punjabi, Gujarati, Tamil, Telugu, Malayalam, Kannada, Bengali, and Urdu. Ensure every employee reads policies in their preferred language for maximum comprehension.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> AWS Translate</span>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-translate">
        <div class="fv-translate-head">
          <div class="fv-translate-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
          <span>Policy Translation</span>
          <span class="fv-translate-head-badge">10 Languages</span>
        </div>
        <div class="fv-translate-body">
          <div class="fv-lang-row">
            <span class="fv-lang-flag">🇮🇳</span>
            <div class="fv-lang-info"><div class="fv-lang-name">Hindi</div><div class="fv-lang-text">कर्मचारी आचार संहिता नीति</div></div>
            <span class="fv-lang-status fv-lang-done">Ready</span>
          </div>
          <div class="fv-lang-row">
            <span class="fv-lang-flag">🇮🇳</span>
            <div class="fv-lang-info"><div class="fv-lang-name">Tamil</div><div class="fv-lang-text">ஊழியர் நடத்தை கொள்கை</div></div>
            <span class="fv-lang-status fv-lang-done">Ready</span>
          </div>
          <div class="fv-lang-row">
            <span class="fv-lang-flag">🇮🇳</span>
            <div class="fv-lang-info"><div class="fv-lang-name">Bengali</div><div class="fv-lang-text">কর্মচারী আচরণবিধি নীতি</div></div>
            <span class="fv-lang-status fv-lang-done">Ready</span>
          </div>
          <div class="fv-lang-row">
            <span class="fv-lang-flag">🇮🇳</span>
            <div class="fv-lang-info"><div class="fv-lang-name">Marathi</div><div class="fv-lang-text">कर्मचारी आचारसंहिता धोरण</div></div>
            <span class="fv-lang-status fv-lang-prog">Translating...</span>
          </div>
          <div class="fv-lang-more">+ 6 more languages available</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Audio & Infographics ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-violet reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div>
      <h3>Audio Version of Policies</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg> 60+ Voices</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> On-the-Go</span>
      </div>
      <p>Convert policy text into natural-sounding audio with 60+ voice options. Employees can listen to policies during commutes or at their convenience, improving accessibility and engagement across the workforce.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Polly</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
      <h3>AI-Generated Infographics and Visuals</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/></svg> Infographics</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Flowcharts</span>
      </div>
      <p>Convert complex policy sections into visual infographics, flowcharts, and diagrams automatically. Visual representations make policies easier to understand and remember, improving compliance across diverse teams.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Amazon Bedrock</span>
    </div>
  </div>
</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to see AI-powered<br>policy management <span class="g-text">in action</span>?</h2>
    <p>Schedule a personalized demo to explore how our AI features can transform policy communication across your organization.</p>
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
    <a href="<?php echo esc_url(home_url(\'/feature/content-management/\')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h4>Policy Creation &amp; Content Management</h4>
      <p>Author, version, organize policies</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/publisher-controls/\')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h4>Publisher Controls &amp; Workflow</h4>
      <p>Approvals, publishing, workflows</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/distribution-targeting/\')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/employee-portal/\')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal &amp; Mobile</h4>
      <p>Mobile app, multi-language access</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/employee-interaction/\')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h4>Employee Interaction &amp; Acknowledgement</h4>
      <p>Read receipts, e-sign, quizzes</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/tracking-reporting/\')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h4>Tracking, Analytics &amp; Reporting</h4>
      <p>Dashboards, compliance reports</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/enterprise/\')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      <h4>Enterprise Features</h4>
      <p>AD, SSO, white-label, multi-entity</p>
    </a>
    <a href="<?php echo esc_url(home_url(\'/feature/security-compliance/\')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h4>Security &amp; Compliance</h4>
      <p>Encryption, RBAC, audit logs</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
