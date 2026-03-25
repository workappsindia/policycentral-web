<?php
/* Template Name: Feature - Content Management */
get_header();
?>
<style>
/* Page-specific accent color */
:root { --accent:#0694A2; --accent-dark:#0E7490; --accent-light:#F0FDFA; --accent-border:rgba(6,148,162,.15); }

/* Hero Visual Mockup */
.hero-mockup{position:relative;width:100%;max-width:520px;animation:mockFloat 7s ease-in-out infinite}
@keyframes mockFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

/* Editor Card */
.hm-editor{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.hm-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.hm-dots{display:flex;gap:5px}
.hm-dots span{width:9px;height:9px;border-radius:50%}
.hm-dots span:nth-child(1){background:#EF4444}
.hm-dots span:nth-child(2){background:#F59E0B}
.hm-dots span:nth-child(3){background:#22C55E}
.hm-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.hm-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#0694A2,#0E7490);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.hm-toolbar{display:flex;align-items:center;gap:3px;padding:7px 14px;border-bottom:1px solid var(--gray-100);flex-wrap:wrap}
.hm-tool{width:26px;height:22px;border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--gray-400);font-size:11px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;cursor:default;transition:all .15s}
.hm-tool:hover{background:var(--gray-100);color:var(--gray-600)}
.hm-tool-sep{width:1px;height:16px;background:var(--gray-200);margin:0 3px}
.hm-tool svg{width:13px;height:13px}
.hm-body{padding:16px 18px}
.hm-body-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px}
.hm-tag-blue{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.hm-tag-amber{background:rgba(217,119,6,.08);color:#D97706;border:1px solid rgba(217,119,6,.18)}
.hm-tag-violet{background:rgba(124,58,237,.08);color:#7C3AED;border:1px solid rgba(124,58,237,.18)}
.hm-body h4{font-size:14px;font-weight:800;color:var(--gray-900);margin-bottom:6px;font-family:'Plus Jakarta Sans',sans-serif}
.hm-body-line{height:6px;border-radius:3px;background:var(--gray-100);margin-bottom:5px}
.hm-body-line:nth-child(3){width:92%}
.hm-body-line:nth-child(4){width:78%}
.hm-body-line:nth-child(5){width:85%}
.hm-body-line:nth-child(6){width:60%}
.hm-media-row{display:flex;gap:8px;margin-top:12px}
.hm-media-thumb{flex:1;height:48px;border-radius:8px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
.hm-media-thumb svg{width:16px;height:16px;color:#fff;position:relative;z-index:1}
.hm-media-thumb.img-thumb{background:linear-gradient(135deg,#06b6d4,#0891b2)}
.hm-media-thumb.vid-thumb{background:linear-gradient(135deg,#7C3AED,#a78bfa)}
.hm-media-thumb.yt-thumb{background:linear-gradient(135deg,#EF4444,#f87171)}
.hm-media-thumb.audio-thumb{background:linear-gradient(135deg,#059669,#34d399)}
.hm-media-label{font-size:8px;font-weight:700;color:#fff;position:absolute;bottom:4px;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.02em}

/* Upload Card - floating */
.hm-upload{position:absolute;top:-12px;right:-18px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:155px;animation:cardSlideIn .6s ease-out both;animation-delay:.3s}
@keyframes cardSlideIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.hm-upload-icon{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#3B82F6,#2563EB);display:flex;align-items:center;justify-content:center;margin-bottom:8px}
.hm-upload-icon svg{width:15px;height:15px;color:#fff}
.hm-upload h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px}
.hm-upload-flow{display:flex;align-items:center;gap:5px;font-size:9px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif}
.hm-upload-chip{padding:3px 7px;border-radius:4px;font-weight:700}
.hm-upload-chip.docx{background:rgba(59,130,246,.1);color:#2563EB;border:1px solid rgba(59,130,246,.2)}
.hm-upload-chip.html{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.hm-upload-arrow{color:var(--gray-400);font-size:11px}

/* Format Card - floating */
.hm-formats{position:absolute;bottom:-16px;left:-14px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:cardSlideIn .6s ease-out both;animation-delay:.5s}
.hm-formats h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.hm-format-row{display:flex;gap:5px}
.hm-format-pill{display:flex;align-items:center;gap:4px;padding:4px 8px;border-radius:6px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.hm-format-pill svg{width:11px;height:11px}
.hm-fmt-web{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.hm-fmt-pdf{background:rgba(239,68,68,.08);color:#EF4444;border:1px solid rgba(239,68,68,.18)}
.hm-fmt-vid{background:rgba(124,58,237,.08);color:#7C3AED;border:1px solid rgba(124,58,237,.18)}
.hm-fmt-audio{background:rgba(5,150,105,.08);color:#059669;border:1px solid rgba(5,150,105,.18)}

/* Responsive Card - floating */
.hm-responsive{position:absolute;bottom:50px;right:-24px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:cardSlideIn .6s ease-out both;animation-delay:.7s}
.hm-responsive h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.hm-device-row{display:flex;align-items:center;gap:8px}
.hm-device{display:flex;flex-direction:column;align-items:center;gap:3px}
.hm-device-icon{width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center}
.hm-device-icon svg{width:13px;height:13px;color:#fff}
.hm-device-icon.desk{background:linear-gradient(135deg,#0694A2,#0E7490)}
.hm-device-icon.tab{background:linear-gradient(135deg,#6366F1,#4F46E5)}
.hm-device-icon.mob{background:linear-gradient(135deg,#059669,#047857)}
.hm-device span{font-size:8px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}

/* ── MINI VISUAL MOCKUPS inside hero blocks ── */
/* Editor Mockup (cm-editor) */
.cm-editor{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.cm-editor-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:linear-gradient(135deg,#0694A2,#0E7490)}
.cm-editor-dots{display:flex;gap:5px}
.cm-editor-dots span{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.35)}
.cm-editor-title{font-size:11px;font-weight:700;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.cm-editor-badge{padding:3px 9px;border-radius:6px;background:rgba(255,255,255,.2);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.cm-toolbar{display:flex;gap:3px;padding:8px 12px;border-bottom:1px solid var(--gray-100);flex-wrap:wrap;align-items:center}
.cm-tb-btn{width:24px;height:24px;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-600);cursor:default;background:transparent;transition:background .15s}
.cm-tb-btn:hover{background:var(--gray-100)}
.cm-tb-btn svg{width:11px;height:11px}
.cm-tb-sep{width:1px;height:18px;background:var(--gray-200);margin:0 3px}
.cm-body{padding:14px 16px}
.cm-h1{height:9px;border-radius:3px;background:var(--gray-800);width:65%;margin-bottom:10px}
.cm-h2{height:7px;border-radius:3px;background:var(--gray-600);width:45%;margin-bottom:8px}
.cm-line{height:5px;border-radius:3px;background:var(--gray-200);margin-bottom:4px}
.cm-line.w90{width:90%}.cm-line.w75{width:75%}.cm-line.w82{width:82%}.cm-line.w60{width:60%}
.cm-highlight{height:5px;border-radius:3px;background:rgba(6,148,162,.2);margin-bottom:4px;width:88%}
.cm-divider{height:1px;background:var(--gray-100);margin:10px 0}
.cm-list-item{display:flex;align-items:center;gap:6px;margin-bottom:4px}
.cm-bullet{width:5px;height:5px;border-radius:50%;background:#0694A2;flex-shrink:0}
.cm-list-line{height:5px;border-radius:3px;background:var(--gray-200);flex:1}
.cm-cursor{display:inline-block;width:2px;height:10px;background:#0694A2;margin-left:2px;animation:cmBlink 1.1s step-end infinite;vertical-align:middle}
@keyframes cmBlink{0%,100%{opacity:1}50%{opacity:0}}

/* Article Mockup (cm-article) */
.cm-article{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.cm-article-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#7C3AED,#A78BFA);color:#fff}
.cm-article-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.cm-article-head-icon svg{width:14px;height:14px;color:#fff}
.cm-article-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.cm-article-head-badge{margin-left:auto;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em}
.cm-article-body{padding:14px 16px}
.cm-article-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(124,58,237,.1);color:#7C3AED;border:1px solid rgba(124,58,237,.2);margin-bottom:8px}
.cm-article-title{font-size:13px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px;line-height:1.3}
.cm-article-line{height:5px;border-radius:3px;background:var(--gray-200);margin-bottom:4px}
.cm-article-line.w92{width:92%}.cm-article-line.w78{width:78%}.cm-article-line.w85{width:85%}
.cm-device-row{display:flex;gap:8px;margin-top:12px;align-items:flex-end}
.cm-device{display:flex;flex-direction:column;align-items:center;gap:4px}
.cm-device-frame{border:2px solid var(--gray-300);border-radius:5px;background:var(--gray-50);display:flex;align-items:center;justify-content:center}
.cm-device-desktop{width:56px;height:36px;border-radius:5px}
.cm-device-tablet{width:36px;height:48px;border-radius:5px}
.cm-device-phone{width:22px;height:38px;border-radius:8px;border-width:2px}
.cm-device-screen{width:calc(100% - 6px);height:calc(100% - 8px);background:#fff;border-radius:2px;display:flex;flex-direction:column;gap:2px;padding:3px}
.cm-device-sline{height:2px;border-radius:1px;background:rgba(124,58,237,.2)}
.cm-device-label{font-size:8px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-400)}
.cm-device-active .cm-device-frame{border-color:#7C3AED}
.cm-device-active .cm-device-label{color:#7C3AED}
.cm-device-active .cm-device-sline{background:rgba(124,58,237,.4)}

/* CTA */
.cta-section{padding:80px 0;background:linear-gradient(135deg,#F0FDFA 0%,#ECFEFF 50%,#F0FDFA 100%);border-top:1px solid var(--accent-border);border-bottom:1px solid var(--accent-border)}
@media(max-width:1024px){
  .hero-mockup{max-width:420px;margin:0 auto}
  .hm-upload{right:-8px;top:-8px}
  .hm-responsive{right:-10px;bottom:40px}
  .hm-formats{left:-8px}
  .cm-editor,.cm-article{max-width:100%}
}
@media(max-width:640px){
  .hero-mockup{max-width:340px}
  .hm-upload{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .hm-responsive{position:relative;bottom:0;right:0;margin-top:10px}
  .hm-formats{position:relative;left:0;bottom:0;margin-top:10px}
  .cta-section{padding:56px 0}
}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Policy Creation &amp;<br><span class="accent">Content Management</span></h1>
    <p class="subtitle">Create, enrich, and publish policies in multiple formats with a flexible and intuitive authoring experience designed for modern enterprises.</p>
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
      <span style="color:var(--accent)">Content Management</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="hero-mockup">
      <!-- Main Editor Card -->
      <div class="hm-editor">
        <div class="hm-titlebar">
          <div class="hm-dots"><span></span><span></span><span></span></div>
          <span class="hm-titlebar-text">PolicyCentral.ai</span>
          <span class="hm-titlebar-badge">WYSIWYG Editor</span>
        </div>
        <div class="hm-toolbar">
          <span class="hm-tool" style="font-weight:900">B</span>
          <span class="hm-tool" style="font-style:italic">I</span>
          <span class="hm-tool" style="text-decoration:underline">U</span>
          <span class="hm-tool-sep"></span>
          <span class="hm-tool"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></span>
          <span class="hm-tool"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
          <span class="hm-tool"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></span>
          <span class="hm-tool-sep"></span>
          <span class="hm-tool" style="font-size:10px">H1</span>
          <span class="hm-tool" style="font-size:10px">H2</span>
          <span class="hm-tool"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></span>
          <span class="hm-tool"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></span>
        </div>
        <div class="hm-body">
          <div style="display:flex;gap:6px;margin-bottom:10px">
            <span class="hm-body-tag hm-tag-blue">Compliance</span>
            <span class="hm-body-tag hm-tag-amber">HR Policy</span>
            <span class="hm-body-tag hm-tag-violet">All Employees</span>
          </div>
          <h4>Employee Code of Conduct Policy</h4>
          <div class="hm-body-line"></div>
          <div class="hm-body-line"></div>
          <div class="hm-body-line"></div>
          <div class="hm-body-line"></div>
          <div class="hm-media-row">
            <div class="hm-media-thumb img-thumb">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              <span class="hm-media-label">Image</span>
            </div>
            <div class="hm-media-thumb vid-thumb">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <span class="hm-media-label">Video</span>
            </div>
            <div class="hm-media-thumb yt-thumb">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.488 3.45.029 5.804 0 12c.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0C23.512 20.55 23.971 18.196 24 12c-.029-6.185-.484-8.549-4.385-8.816zM9 16V8l8 4-8 4z"/></svg>
              <span class="hm-media-label">YouTube</span>
            </div>
            <div class="hm-media-thumb audio-thumb">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
              <span class="hm-media-label">Audio</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Word Upload -->
      <div class="hm-upload">
        <div class="hm-upload-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        </div>
        <h5>Word Upload</h5>
        <div class="hm-upload-flow">
          <span class="hm-upload-chip docx">.docx</span>
          <span class="hm-upload-arrow">→</span>
          <span class="hm-upload-chip html">HTML</span>
          <span style="color:#22C55E;font-size:11px">✓</span>
        </div>
      </div>

      <!-- Floating Card: Multi-format -->
      <div class="hm-formats">
        <h5>Multi-Format Support</h5>
        <div class="hm-format-row">
          <span class="hm-format-pill hm-fmt-web"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg> Web</span>
          <span class="hm-format-pill hm-fmt-pdf"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF</span>
          <span class="hm-format-pill hm-fmt-vid"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg> Video</span>
          <span class="hm-format-pill hm-fmt-audio"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/></svg> Audio</span>
        </div>
      </div>

      <!-- Floating Card: Responsive Viewing -->
      <div class="hm-responsive">
        <h5>Responsive Viewing</h5>
        <div class="hm-device-row">
          <div class="hm-device">
            <div class="hm-device-icon desk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
            <span>Desktop</span>
          </div>
          <div class="hm-device">
            <div class="hm-device-icon tab"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
            <span>Tablet</span>
          </div>
          <div class="hm-device">
            <div class="hm-device-icon mob"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
            <span>Mobile</span>
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
    <h2>Everything You Need to<br><span class="g-text">Create Great Policies</span></h2>
    <p>A complete content management toolkit built specifically for policy authoring and publishing workflows.</p>
  </div>

  <!-- ═══ HERO FEATURE 1: Word-Style Editor ═══ -->
  <div class="feat-hero feat-hero-teal reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h3>Word-Style Editor</h3>
      <p>A familiar document-writing interface with full support for headings, fonts, lists, tables, and formatting. Policy creators can author content with the same ease as traditional word processors, eliminating the learning curve entirely.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> WYSIWYG Editor</span>
    </div>
    <div class="feat-hero-visual">
      <div class="cm-editor">
        <div class="cm-editor-titlebar">
          <div class="cm-editor-dots"><span></span><span></span><span></span></div>
          <span class="cm-editor-title">Policy Editor</span>
          <span class="cm-editor-badge">✦ Auto-Save</span>
        </div>
        <div class="cm-toolbar">
          <span class="cm-tb-btn" style="font-weight:900">B</span>
          <span class="cm-tb-btn" style="font-style:italic">I</span>
          <span class="cm-tb-btn" style="text-decoration:underline">U</span>
          <span class="cm-tb-sep"></span>
          <span class="cm-tb-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></span>
          <span class="cm-tb-sep"></span>
          <span class="cm-tb-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
          <span class="cm-tb-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></span>
          <span class="cm-tb-sep"></span>
          <span class="cm-tb-btn" style="font-size:9px;font-weight:800;color:#0694A2">H1</span>
          <span class="cm-tb-btn" style="font-size:9px;font-weight:800">H2</span>
        </div>
        <div class="cm-body">
          <div class="cm-h1"></div>
          <div class="cm-h2" style="margin-top:6px"></div>
          <div style="height:8px"></div>
          <div class="cm-line w90"></div>
          <div class="cm-line w82"></div>
          <div class="cm-highlight"></div>
          <div class="cm-line w75"></div>
          <div class="cm-divider"></div>
          <div class="cm-list-item"><div class="cm-bullet"></div><div class="cm-list-line" style="width:80%"></div></div>
          <div class="cm-list-item"><div class="cm-bullet"></div><div class="cm-list-line" style="width:65%"></div></div>
          <div class="cm-list-item"><div class="cm-bullet"></div><div class="cm-list-line" style="width:72%"></div><span class="cm-cursor"></span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Core Content Features ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-amber reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
      <h3>Rich Media Support</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg> Video</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/></svg> Images</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/></svg> Audio</span>
      </div>
      <p>Embed images, videos, YouTube content, audio clips, and GIFs directly into policies via the HTML editor. Make policies engaging with multimedia elements that enhance understanding.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg> Multimedia</span>
    </div>
    <div class="feature-card fc-emerald reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Direct Word Document Upload</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/></svg> .docx</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Auto-Convert</span>
      </div>
      <p>Upload existing .docx files and have them automatically converted to structured HTML content. Migrate your policy library without manual re-creation, saving significant time and effort.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg> Auto-Convert</span>
    </div>
    <div class="feature-card fc-rose reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <h3>Built-in PDF Document Viewer</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg> Inline PDF</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Secure</span>
      </div>
      <p>An integrated PDF viewer with responsive layout lets employees read PDF-format policies directly within the platform. No external software required for a seamless viewing experience.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF Reader</span>
    </div>
    <div class="feature-card fc-indigo reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg></div>
      <h3>No Restrictions on Content Size</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg> Unlimited</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg> No Caps</span>
      </div>
      <p>There are no limits on policy length, attachments, images, or embedded media. Create comprehensive documents of any size without worrying about platform constraints or storage caps.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg> Unlimited</span>
    </div>
  </div>

  <!-- ═══ HERO FEATURE 2: Web Article-Style Viewing (reversed) ═══ -->
  <div class="feat-hero feat-hero-violet reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h3>Web Article-Style Viewing</h3>
      <p>Policies are displayed in a clean, responsive web article format that looks beautiful across all devices. Employees enjoy a modern, distraction-free reading experience whether on desktop, tablet, or mobile, with no app installation needed.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg> Responsive Layout</span>
    </div>
    <div class="feat-hero-visual">
      <div class="cm-article">
        <div class="cm-article-head">
          <div class="cm-article-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
          <span>Policy Viewer</span>
          <span class="cm-article-head-badge">Responsive</span>
        </div>
        <div class="cm-article-body">
          <span class="cm-article-tag">Leave Policy 2025</span>
          <div class="cm-article-title">Employee Leave &amp; Absence Policy</div>
          <div class="cm-article-line w92"></div>
          <div class="cm-article-line w85"></div>
          <div class="cm-article-line w78"></div>
          <div class="cm-device-row">
            <div class="cm-device cm-device-active">
              <div class="cm-device-frame cm-device-desktop">
                <div class="cm-device-screen">
                  <div class="cm-device-sline" style="width:90%"></div>
                  <div class="cm-device-sline" style="width:70%"></div>
                  <div class="cm-device-sline" style="width:80%"></div>
                </div>
              </div>
              <span class="cm-device-label">Desktop</span>
            </div>
            <div class="cm-device">
              <div class="cm-device-frame cm-device-tablet">
                <div class="cm-device-screen">
                  <div class="cm-device-sline" style="width:88%"></div>
                  <div class="cm-device-sline" style="width:72%"></div>
                  <div class="cm-device-sline" style="width:80%"></div>
                </div>
              </div>
              <span class="cm-device-label">Tablet</span>
            </div>
            <div class="cm-device">
              <div class="cm-device-frame cm-device-phone">
                <div class="cm-device-screen">
                  <div class="cm-device-sline"></div>
                  <div class="cm-device-sline" style="width:80%"></div>
                  <div class="cm-device-sline" style="width:90%"></div>
                </div>
              </div>
              <span class="cm-device-label">Mobile</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Secure Hosting ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-violet reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></div>
      <h3>Secure Video Hosting</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Private Repo</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg> HD Streaming</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Auth-Only</span>
      </div>
      <p>Host training videos and policy explainers in a private, secure video repository. Videos are not publicly accessible and are streamed only to authorized employees within your organization. No external hosting dependency.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Private &amp; Secure</span>
    </div>
    <div class="feature-card fc-teal reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div>
      <h3>Secure Audio File Hosting</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/></svg> MP3 / WAV</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Encrypted</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> On-Demand</span>
      </div>
      <p>Host multiple audio formats for policy explanations, training modules, and announcements. Audio files are securely stored and streamed on-demand only to authorized personnel within the platform, with no public access.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> Multiple Formats</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to streamline your<br>policy <span class="g-text">content creation</span>?</h2>
    <p>See how our content management tools simplify authoring, enrich policies with multimedia, and ensure a great reading experience.</p>
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
    <a href="<?php echo esc_url(home_url(\'/feature/ai-intelligence/\')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h4>AI-Powered Policy Intelligence</h4>
      <p>Smart search, summaries, chatbot</p>
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
