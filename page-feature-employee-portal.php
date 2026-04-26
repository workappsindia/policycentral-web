<?php
/* Template Name: Feature - Employee Portal */
get_header();
?>
<style>
/* Page-specific accent color */
:root { --accent:#6D28D9; --accent-dark:#5B21B6; --accent-light:#F5F3FF; --accent-border:rgba(109,40,217,.15); }

/* Hero Visual Mockup - Employee Portal */
.ep-mockup{position:relative;width:100%;max-width:520px;animation:epFloat 7s ease-in-out infinite}
@keyframes epFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

/* Main Portal Card */
.ep-portal{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.ep-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.ep-dots{display:flex;gap:5px}
.ep-dots span{width:9px;height:9px;border-radius:50%}
.ep-dots span:nth-child(1){background:#EF4444}
.ep-dots span:nth-child(2){background:#F59E0B}
.ep-dots span:nth-child(3){background:#22C55E}
.ep-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.ep-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#7C3AED,#5B21B6);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.ep-sidebar-wrap{display:flex;gap:0}
.ep-sidebar{width:110px;flex-shrink:0;border-right:1px solid var(--gray-100);padding:10px 8px;background:var(--gray-50)}
.ep-sidebar-user{display:flex;align-items:center;gap:6px;margin-bottom:10px;padding-bottom:8px;border-bottom:1px solid var(--gray-100)}
.ep-avatar{width:22px;height:22px;border-radius:50%;background:linear-gradient(135deg,#7C3AED,#5B21B6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0}
.ep-username{font-size:9px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.ep-nav-item{display:flex;align-items:center;gap:5px;padding:5px 7px;border-radius:6px;font-size:9px;font-weight:600;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:2px;cursor:default}
.ep-nav-item.active{background:rgba(124,58,237,.08);color:#7C3AED;font-weight:800}
.ep-nav-item svg{width:11px;height:11px;flex-shrink:0}
.ep-main{flex:1;padding:10px 12px;overflow:hidden}
.ep-folder-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.ep-folder-title{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ep-view-btns{display:flex;gap:3px}
.ep-view-btn{width:18px;height:18px;border-radius:4px;display:flex;align-items:center;justify-content:center;background:var(--gray-100)}
.ep-view-btn svg{width:9px;height:9px;color:var(--gray-400)}
.ep-view-btn.active{background:rgba(124,58,237,.1)}
.ep-view-btn.active svg{color:#7C3AED}
.ep-folder-list{display:flex;flex-direction:column;gap:4px}
.ep-folder-row{display:flex;align-items:center;gap:7px;padding:6px 8px;border-radius:7px;background:#fff;border:1px solid var(--gray-100)}
.ep-folder-icon{width:20px;height:20px;border-radius:5px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ep-folder-icon svg{width:10px;height:10px;color:#fff}
.ep-fi-hr{background:linear-gradient(135deg,#7C3AED,#5B21B6)}
.ep-fi-comp{background:linear-gradient(135deg,#0694A2,#0E7490)}
.ep-fi-it{background:linear-gradient(135deg,#D97706,#B45309)}
.ep-folder-name{font-size:9px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ep-folder-count{font-size:8px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}

/* Floating Card: Mobile App */
.ep-mobile{position:absolute;top:-16px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;animation:epCardIn .6s ease-out both;animation-delay:.3s}
@keyframes epCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.ep-mobile-hd{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.ep-mobile-icon{width:24px;height:24px;border-radius:7px;background:linear-gradient(135deg,#7C3AED,#5B21B6);display:flex;align-items:center;justify-content:center}
.ep-mobile-icon svg{width:12px;height:12px;color:#fff}
.ep-mobile h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ep-phone{width:44px;height:72px;border-radius:9px;background:linear-gradient(160deg,#1E1B4B,#312E81);border:2px solid #4338CA;margin:0 auto;position:relative;overflow:hidden;display:flex;flex-direction:column;padding:5px 4px}
.ep-phone-notch{width:14px;height:4px;border-radius:2px;background:#4338CA;margin:0 auto 4px}
.ep-phone-content{display:flex;flex-direction:column;gap:3px}
.ep-phone-bar{height:4px;border-radius:2px;background:rgba(124,58,237,.5)}
.ep-phone-bar:nth-child(2){width:75%}
.ep-phone-bar:nth-child(3){width:55%}
.ep-phone-bar:nth-child(4){width:85%}
.ep-phone-mini-btn{margin-top:4px;height:8px;border-radius:2px;background:linear-gradient(90deg,#7C3AED,#5B21B6)}
.ep-mobile-label{font-size:8px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;text-align:center;margin-top:6px}

/* Floating Card: Search */
.ep-search{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:160px;animation:epCardIn .6s ease-out both;animation-delay:.5s}
.ep-search-hd{display:flex;align-items:center;gap:6px;margin-bottom:7px}
.ep-search-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#0694A2,#0E7490);display:flex;align-items:center;justify-content:center}
.ep-search-icon svg{width:11px;height:11px;color:#fff}
.ep-search h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ep-search-bar{display:flex;align-items:center;gap:5px;padding:5px 8px;background:var(--gray-50);border-radius:6px;border:1px solid var(--gray-200);margin-bottom:6px}
.ep-search-bar svg{width:9px;height:9px;color:var(--gray-400);flex-shrink:0}
.ep-search-text{font-size:8px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.ep-search-results{display:flex;flex-direction:column;gap:3px}
.ep-search-result{padding:4px 6px;border-radius:5px;background:var(--gray-50);border:1px solid var(--gray-100)}
.ep-search-result-name{font-size:8px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.ep-search-result-meta{font-size:7px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}

/* Floating Card: Dashboard */
.ep-dash{position:absolute;bottom:44px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:148px;animation:epCardIn .6s ease-out both;animation-delay:.7s}
.ep-dash-hd{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.ep-dash-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#7C3AED,#5B21B6);display:flex;align-items:center;justify-content:center}
.ep-dash-icon svg{width:11px;height:11px;color:#fff}
.ep-dash h3{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ep-dash-stats{display:flex;flex-direction:column;gap:4px}
.ep-dash-stat{display:flex;align-items:center;justify-content:space-between;padding:4px 7px;border-radius:6px;background:var(--gray-50);border:1px solid var(--gray-100)}
.ep-dash-stat-label{font-size:8px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.ep-dash-stat-val{font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.ep-stat-unread{color:#EF4444}
.ep-stat-pending{color:#D97706}
.ep-stat-done{color:#059669}

/* ── EP HERO MOCKUPS ── */
/* Phone mockup (Hero 1: Mobile App) */
.ep-feat-phone{background:#fff;border-radius:28px;border:8px solid var(--gray-800);box-shadow:0 24px 64px rgba(0,0,0,.18),0 8px 24px rgba(0,0,0,.1);overflow:hidden;width:180px;position:relative;z-index:2}
.ep-feat-phone-notch{height:20px;background:var(--gray-800);display:flex;align-items:center;justify-content:center}
.ep-feat-phone-notch span{width:50px;height:6px;background:var(--gray-700);border-radius:3px}
.ep-feat-phone-screen{background:linear-gradient(160deg,#F5F3FF,#EDE9FE);padding:10px 8px}
.ep-feat-phone-header{display:flex;align-items:center;gap:6px;padding:6px 8px;background:linear-gradient(135deg,#7C3AED,#A78BFA);border-radius:8px;margin-bottom:8px}
.ep-feat-phone-logo{width:18px;height:18px;border-radius:5px;background:rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center}
.ep-feat-phone-logo svg{width:10px;height:10px;color:#fff}
.ep-feat-phone-title{font-size:9px;font-weight:800;color:#fff;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-phone-notif{display:flex;align-items:center;gap:5px;background:#fff;border-radius:6px;padding:5px 7px;margin-bottom:6px;border:1px solid var(--gray-100)}
.ep-feat-phone-notif-dot{width:6px;height:6px;border-radius:50%;background:#7C3AED;flex-shrink:0}
.ep-feat-phone-notif-text{font-size:8px;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;flex:1}
.ep-feat-phone-notif-badge{padding:2px 5px;border-radius:4px;background:rgba(124,58,237,.1);color:#7C3AED;font-size:7px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-phone-policy{background:#fff;border-radius:6px;padding:7px 8px;margin-bottom:5px;border:1px solid var(--gray-100)}
.ep-feat-phone-policy-tag{font-size:7px;font-weight:700;color:#7C3AED;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.ep-feat-phone-policy-title{height:6px;border-radius:3px;background:var(--gray-200);margin-bottom:3px;width:85%}
.ep-feat-phone-policy-sub{height:5px;border-radius:2px;background:var(--gray-100);width:65%}
.ep-feat-phone-policy-unread{width:8px;height:8px;border-radius:50%;background:#7C3AED;position:absolute;right:8px;top:8px}
.ep-feat-phone-bottom{display:flex;justify-content:space-around;padding:7px 4px;background:#fff;border-top:1px solid var(--gray-100)}
.ep-feat-phone-tab{display:flex;flex-direction:column;align-items:center;gap:2px}
.ep-feat-phone-tab svg{width:12px;height:12px;color:var(--gray-400)}
.ep-feat-phone-tab.active svg{color:#7C3AED}
.ep-feat-phone-tab span{font-size:6px;font-weight:700;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-phone-tab.active span{color:#7C3AED}
/* Floating cards around phone */
.ep-feat-notif-card{position:absolute;top:-10px;right:-20px;z-index:3;background:#fff;border-radius:10px;border:1px solid var(--gray-200);box-shadow:0 8px 28px rgba(0,0,0,.10);padding:8px 11px;min-width:140px;animation:epCardIn .6s ease-out both;animation-delay:.3s}
@keyframes epCardIn{from{opacity:0;transform:translateY(8px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.ep-feat-notif-title{font-size:9px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:5px;display:flex;align-items:center;gap:4px}
.ep-feat-notif-title svg{width:10px;height:10px;color:#7C3AED}
.ep-feat-notif-row{display:flex;align-items:center;gap:5px;margin-bottom:3px}
.ep-feat-notif-dot{width:5px;height:5px;border-radius:50%;flex-shrink:0}
.ep-feat-notif-text{font-size:8px;font-weight:600;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-badge-card{position:absolute;bottom:-10px;left:-16px;z-index:3;background:#fff;border-radius:10px;border:1px solid var(--gray-200);box-shadow:0 8px 28px rgba(0,0,0,.10);padding:8px 11px;animation:epCardIn .6s ease-out both;animation-delay:.5s}
.ep-feat-badge-title{font-size:9px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:5px}
.ep-feat-badge-row{display:flex;align-items:center;gap:6px;margin-bottom:3px}
.ep-feat-badge-label{font-size:8px;font-weight:600;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;min-width:44px}
.ep-feat-badge-pill{padding:2px 7px;border-radius:5px;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-badge-violet{background:rgba(124,58,237,.1);color:#7C3AED;border:1px solid rgba(124,58,237,.2)}
.ep-feat-badge-green{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}

/* Dashboard mockup (Hero 2: Personalized Dashboard) */
.ep-feat-dash{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.ep-feat-dash-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#4338CA,#6366F1);color:#fff}
.ep-feat-dash-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.ep-feat-dash-head-icon svg{width:14px;height:14px;color:#fff}
.ep-feat-dash-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ep-feat-dash-head-name{font-size:10px;opacity:.8;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-dash-body{padding:14px 16px}
.ep-feat-dash-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:12px}
.ep-feat-dash-stat{background:var(--gray-50);border:1px solid var(--gray-100);border-radius:8px;padding:8px 10px;text-align:center}
.ep-feat-dash-stat-num{font-size:18px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-dash-stat-label{font-size:8px;font-weight:600;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px}
.ep-feat-dash-stat.unread .ep-feat-dash-stat-num{color:#7C3AED}
.ep-feat-dash-stat.pending .ep-feat-dash-stat-num{color:#D97706}
.ep-feat-dash-stat.done .ep-feat-dash-stat-num{color:#059669}
.ep-feat-dash-section-label{font-size:9px;font-weight:700;color:#4338CA;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px;display:flex;align-items:center;gap:4px}
.ep-feat-dash-section-label svg{width:10px;height:10px}
.ep-feat-dash-item{display:flex;align-items:center;gap:8px;padding:7px 10px;border-radius:8px;border:1px solid var(--gray-100);margin-bottom:5px}
.ep-feat-dash-item-icon{width:22px;height:22px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ep-feat-dash-item-icon svg{width:11px;height:11px;color:#fff}
.ep-feat-dash-item-text{font-size:10px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ep-feat-dash-item-badge{padding:2px 7px;border-radius:5px;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-dash-item-badge.urgent{background:rgba(225,29,72,.1);color:#E11D48;border:1px solid rgba(225,29,72,.2)}
.ep-feat-dash-item-badge.new{background:rgba(99,102,241,.1);color:#4338CA;border:1px solid rgba(99,102,241,.2)}

/* Scroll mockup (Hero 3: Long-Scroll Content Experience) */
.ep-feat-scroll{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.ep-feat-scroll-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#0694A2,#0E7490);color:#fff}
.ep-feat-scroll-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.ep-feat-scroll-head-icon svg{width:14px;height:14px;color:#fff}
.ep-feat-scroll-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.ep-feat-scroll-progress{height:3px;background:rgba(255,255,255,.3)}
.ep-feat-scroll-progress-fill{height:100%;background:#fff;border-radius:0 2px 2px 0;width:42%}
.ep-feat-scroll-body{padding:14px 16px}
.ep-feat-scroll-title{font-size:13px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.ep-feat-scroll-line{height:5px;border-radius:3px;background:var(--gray-100);margin-bottom:4px}
.ep-feat-scroll-divider{height:1px;background:var(--gray-100);margin:10px 0}
.ep-feat-scroll-section-head{font-size:10px;font-weight:800;color:#0694A2;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.ep-feat-scroll-indicator{display:flex;align-items:center;gap:8px;padding:6px 10px;background:rgba(6,148,162,.05);border:1px solid rgba(6,148,162,.15);border-radius:8px;margin-bottom:8px}
.ep-feat-scroll-indicator svg{width:12px;height:12px;color:#0694A2;flex-shrink:0}
.ep-feat-scroll-indicator span{font-size:9px;font-weight:700;color:#0694A2;font-family:'Plus Jakarta Sans',sans-serif}
.ep-feat-scroll-tabs{display:flex;gap:4px;margin-top:10px;padding-top:10px;border-top:1px solid var(--gray-100)}
.ep-feat-scroll-tab{padding:4px 9px;border-radius:6px;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;cursor:default}
.ep-feat-scroll-tab.active{background:rgba(6,148,162,.1);color:#0694A2;border:1px solid rgba(6,148,162,.2)}
.ep-feat-scroll-tab.inactive{background:var(--gray-50);color:var(--gray-400);border:1px solid var(--gray-100)}

/* CTA */
.cta-section{padding:80px 0;background:linear-gradient(135deg,#F5F3FF 0%,#EDE9FE 50%,#F5F3FF 100%);border-top:1px solid var(--accent-border);border-bottom:1px solid var(--accent-border)}
@media(max-width:1024px){
  .ep-mockup{max-width:420px;margin:0 auto}
  .ep-mobile{right:-8px;top:-8px}
  .ep-dash{right:-10px;bottom:38px}
  .ep-search{left:-8px}
  .ep-feat-scroll,.ep-feat-dash{max-width:100%}
}
@media(max-width:640px){
  .ep-mockup{max-width:340px}
  .ep-mobile{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .ep-dash{position:relative;bottom:0;right:0;margin-top:10px}
  .ep-search{position:relative;left:0;bottom:0;margin-top:10px}
  .cta-section{padding:56px 0}
}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Employee Portal &amp;<br><span class="accent">Mobile App</span></h1>
    <p class="subtitle">Seamless web and mobile experience for employees to access, read, and interact with organizational policies.</p>
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
      <span style="color:var(--accent)">Employee Portal</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ep-mockup">

      <!-- Main Portal Card -->
      <div class="ep-portal">
        <div class="ep-titlebar">
          <div class="ep-dots"><span></span><span></span><span></span></div>
          <span class="ep-titlebar-text">PolicyCentral.ai - My Portal</span>
          <span class="ep-titlebar-badge">Employee Portal</span>
        </div>
        <div class="ep-sidebar-wrap">
          <!-- Sidebar nav -->
          <div class="ep-sidebar">
            <div class="ep-sidebar-user">
              <div class="ep-avatar">RP</div>
              <span class="ep-username">Riya Patel</span>
            </div>
            <div class="ep-nav-item active">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              My Policies
            </div>
            <div class="ep-nav-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              Search
            </div>
            <div class="ep-nav-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
              Folders
            </div>
            <div class="ep-nav-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Pending
            </div>
          </div>
          <!-- Main content -->
          <div class="ep-main">
            <div class="ep-folder-hd">
              <span class="ep-folder-title">Policy Library</span>
              <div class="ep-view-btns">
                <div class="ep-view-btn active">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                </div>
                <div class="ep-view-btn">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </div>
              </div>
            </div>
            <div class="ep-folder-list">
              <div class="ep-folder-row">
                <div class="ep-folder-icon ep-fi-hr">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <span class="ep-folder-name">HR &amp; People Policies</span>
                <span class="ep-folder-count">24 docs</span>
              </div>
              <div class="ep-folder-row">
                <div class="ep-folder-icon ep-fi-comp">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <span class="ep-folder-name">Compliance &amp; Risk</span>
                <span class="ep-folder-count">18 docs</span>
              </div>
              <div class="ep-folder-row">
                <div class="ep-folder-icon ep-fi-it">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                </div>
                <span class="ep-folder-name">IT &amp; Security</span>
                <span class="ep-folder-count">11 docs</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Mobile App -->
      <div class="ep-mobile">
        <div class="ep-mobile-hd">
          <div class="ep-mobile-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg>
          </div>
          <h3>Mobile App</h3>
        </div>
        <div class="ep-phone">
          <div class="ep-phone-notch"></div>
          <div class="ep-phone-content">
            <div class="ep-phone-bar"></div>
            <div class="ep-phone-bar"></div>
            <div class="ep-phone-bar"></div>
            <div class="ep-phone-mini-btn"></div>
          </div>
        </div>
        <div class="ep-mobile-label">iOS &amp; Android</div>
      </div>

      <!-- Floating Card: Search -->
      <div class="ep-search">
        <div class="ep-search-hd">
          <div class="ep-search-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </div>
          <h3>Policy Search</h3>
        </div>
        <div class="ep-search-bar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span class="ep-search-text">leave policy...</span>
        </div>
        <div class="ep-search-results">
          <div class="ep-search-result">
            <div class="ep-search-result-name">Annual Leave Policy</div>
            <div class="ep-search-result-meta">HR · Updated Jan 2026</div>
          </div>
          <div class="ep-search-result">
            <div class="ep-search-result-name">Maternity Leave Policy</div>
            <div class="ep-search-result-meta">HR · v3.0</div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Dashboard -->
      <div class="ep-dash">
        <div class="ep-dash-hd">
          <div class="ep-dash-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          </div>
          <h3>My Dashboard</h3>
        </div>
        <div class="ep-dash-stats">
          <div class="ep-dash-stat">
            <span class="ep-dash-stat-label">Unread Policies</span>
            <span class="ep-dash-stat-val ep-stat-unread">3</span>
          </div>
          <div class="ep-dash-stat">
            <span class="ep-dash-stat-label">Pending Signatures</span>
            <span class="ep-dash-stat-val ep-stat-pending">2</span>
          </div>
          <div class="ep-dash-stat">
            <span class="ep-dash-stat-label">Acknowledged</span>
            <span class="ep-dash-stat-val ep-stat-done">47</span>
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
    <h2>A Complete <span class="g-text">Employee Policy Experience</span></h2>
    <p>19 purpose-built features for how employees discover, read, and engage with policies.</p>
  </div>

  <!-- ═══ HERO BLOCK 1: Dedicated Mobile Application (violet) ═══ -->
  <div class="feat-hero feat-hero-violet reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h3>Dedicated Mobile Application</h3>
      <p>White-label mobile app for Android and iOS. Company-branded experience with push notifications and native performance for on-the-go policy engagement. Employees get instant alerts the moment a new policy is published.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/></svg> Android &amp; iOS · White-Label</span>
    </div>
    <div class="feat-hero-visual">
      <!-- Phone mockup -->
      <div style="position:relative;display:flex;align-items:center;justify-content:center;width:100%;min-height:300px">
        <div class="ep-feat-phone">
          <div class="ep-feat-phone-notch"><span></span></div>
          <div class="ep-feat-phone-screen">
            <div class="ep-feat-phone-header">
              <div class="ep-feat-phone-logo"><svg viewBox="0 2 25 31" fill="none"><path d="M0.979492 20.7623V4.52147C0.979492 3.82771 1.5419 3.2653 2.23565 3.2653H16.9556C17.2832 3.2653 17.5979 3.39332 17.8325 3.62205L23.3682 9.01934C23.6107 9.25576 23.7474 9.58008 23.7474 9.91875V20.8516C23.5953 26.6316 15.8794 31.0856 12.7322 31.9296C12.5425 31.9805 12.3401 31.9741 12.1508 31.9216C4.28629 29.7409 1.44897 23.8644 0.992375 20.9377C0.983212 20.879 0.979492 20.8217 0.979492 20.7623Z" fill="rgba(255,255,255,.9)"/></svg></div>
              <div class="ep-feat-phone-title">PolicyCentral</div>
            </div>
            <div class="ep-feat-phone-notif">
              <div class="ep-feat-phone-notif-dot"></div>
              <div class="ep-feat-phone-notif-text">2 new policies</div>
              <div class="ep-feat-phone-notif-badge">New</div>
            </div>
            <div style="position:relative">
              <div class="ep-feat-phone-policy">
                <div class="ep-feat-phone-policy-tag">HR · Leave Policy</div>
                <div class="ep-feat-phone-policy-title"></div>
                <div class="ep-feat-phone-policy-sub"></div>
              </div>
            </div>
            <div style="position:relative">
              <div class="ep-feat-phone-policy">
                <div class="ep-feat-phone-policy-tag">Legal · Code of Conduct</div>
                <div class="ep-feat-phone-policy-title"></div>
                <div class="ep-feat-phone-policy-sub"></div>
              </div>
            </div>
            <div style="position:relative">
              <div class="ep-feat-phone-policy">
                <div class="ep-feat-phone-policy-tag">IT · Security Policy</div>
                <div class="ep-feat-phone-policy-title"></div>
                <div class="ep-feat-phone-policy-sub"></div>
              </div>
            </div>
            <div class="ep-feat-phone-bottom">
              <div class="ep-feat-phone-tab active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                <span>Home</span>
              </div>
              <div class="ep-feat-phone-tab">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                <span>Folders</span>
              </div>
              <div class="ep-feat-phone-tab">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <span>Search</span>
              </div>
              <div class="ep-feat-phone-tab">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span>Profile</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Floating: Push Notification -->
        <div class="ep-feat-notif-card">
          <div class="ep-feat-notif-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            Push Notifications
          </div>
          <div class="ep-feat-notif-row"><div class="ep-feat-notif-dot" style="background:#7C3AED"></div><div class="ep-feat-notif-text">Leave Policy updated</div></div>
          <div class="ep-feat-notif-row"><div class="ep-feat-notif-dot" style="background:#059669"></div><div class="ep-feat-notif-text">Sign by Friday</div></div>
          <div class="ep-feat-notif-row"><div class="ep-feat-notif-dot" style="background:#D97706"></div><div class="ep-feat-notif-text">3 unread policies</div></div>
        </div>
        <!-- Floating: Platform badges -->
        <div class="ep-feat-badge-card">
          <div class="ep-feat-badge-title">Platforms</div>
          <div class="ep-feat-badge-row"><div class="ep-feat-badge-label">Android</div><div class="ep-feat-badge-pill ep-feat-badge-violet">White-Label</div></div>
          <div class="ep-feat-badge-row"><div class="ep-feat-badge-label">iOS</div><div class="ep-feat-badge-pill ep-feat-badge-green">White-Label</div></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Viewing & Navigation ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Web-Based Policy Viewing</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg> No PDF</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Responsive</span>
      </div>
      <p>Policies display as clean, scrollable web pages, with no PDF downloads needed. Optimized for readability with responsive formatting that works across all screen sizes.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> All Devices</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></div>
      <h3>Structured Policy Folders</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg> By Dept</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> By Sender</span>
      </div>
      <p>Policies organized by department, use case, and importance level. Intuitive folder structure helps employees quickly navigate to policies most relevant to their role.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg> Organized</span>
    </div>
    <div class="feature-card fc-emerald reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>Chronological Policy Listing</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Latest First</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/></svg> Date Stamps</span>
      </div>
      <p>Policies listed with the most recent first, so employees always see the latest updates at the top. Clear date stamps and version indicators for transparency.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Always Current</span>
    </div>
    <div class="feature-card fc-rose reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></div>
      <h3>Unique URL for Every Policy</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07"/></svg> Shareable</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg> Bookmarkable</span>
      </div>
      <p>Each policy has its own human-readable URL with the policy name embedded. Easy to share via email, chat, or bookmarks for quick reference and direct access.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07"/></svg> Deep Links</span>
    </div>
  </div>

  <!-- ═══ HERO BLOCK 2: Personalized Dashboard (indigo, reversed) ═══ -->
  <div class="feat-hero feat-hero-indigo reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
      <h3>Personalized Employee Dashboard</h3>
      <p>A personal hub showing unread count, pending actions, compliance score, and today's priorities. Every employee sees exactly what they need, including signed, pending, and unread policies, the moment they log in.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> Personal Hub · Real-Time</span>
    </div>
    <div class="feat-hero-visual">
      <div class="ep-feat-dash">
        <div class="ep-feat-dash-head">
          <div class="ep-feat-dash-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
          <span>My Policy Dashboard</span>
          <span class="ep-feat-dash-head-name">Priya S.</span>
        </div>
        <div class="ep-feat-dash-body">
          <div class="ep-feat-dash-stats">
            <div class="ep-feat-dash-stat unread">
              <div class="ep-feat-dash-stat-num">7</div>
              <div class="ep-feat-dash-stat-label">Unread</div>
            </div>
            <div class="ep-feat-dash-stat pending">
              <div class="ep-feat-dash-stat-num">3</div>
              <div class="ep-feat-dash-stat-label">Pending</div>
            </div>
            <div class="ep-feat-dash-stat done">
              <div class="ep-feat-dash-stat-num">42</div>
              <div class="ep-feat-dash-stat-label">Signed</div>
            </div>
          </div>
          <div class="ep-feat-dash-section-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Action Required
          </div>
          <div class="ep-feat-dash-item">
            <div class="ep-feat-dash-item-icon" style="background:linear-gradient(135deg,#E11D48,#BE123C)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg></div>
            <div class="ep-feat-dash-item-text">Code of Conduct 2025</div>
            <div class="ep-feat-dash-item-badge urgent">Sign Now</div>
          </div>
          <div class="ep-feat-dash-item">
            <div class="ep-feat-dash-item-icon" style="background:linear-gradient(135deg,#4338CA,#6366F1)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
            <div class="ep-feat-dash-item-text">Remote Work Guidelines</div>
            <div class="ep-feat-dash-item-badge new">New</div>
          </div>
          <div class="ep-feat-dash-item">
            <div class="ep-feat-dash-item-icon" style="background:linear-gradient(135deg,#059669,#047857)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/></svg></div>
            <div class="ep-feat-dash-item-text">Travel &amp; Expense Policy</div>
            <div class="ep-feat-dash-item-badge new">Updated</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Search, Calendar, Folders, Organization ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-indigo reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>Advanced Policy Search</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Full-Text</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg> In Files</span>
      </div>
      <p>Google-style search across policy titles, body content, and inside attached files. Full-text search ensures employees can find exactly what they need instantly.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Instant Results</span>
    </div>
    <div class="feature-card fc-teal reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
      <h3>Content Organized by Tabs</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/></svg> Video</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/></svg> Audio</span>
      </div>
      <p>Video, Audio, Files, and Calendar tabs within each policy for organized multimedia access. All supplementary materials are just one click away.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> Tabbed Layout</span>
    </div>
    <div class="feature-card fc-violet reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
      <h3>Calendar View for Policy Events</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/></svg> Deadlines</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> Expiry</span>
      </div>
      <p>Expiry dates, signing deadlines, and policy events displayed in a calendar view. Never miss a compliance deadline with visual timeline tracking.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/></svg> Visual Timeline</span>
    </div>
    <div class="feature-card fc-amber reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
      <h3>Sender-Based Policy Folders</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> By HR</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> By Legal</span>
      </div>
      <p>Policies organized by the publisher or sender for easy reference. Quickly find all communications from HR, Legal, Compliance, or any specific department.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> By Sender</span>
    </div>
  </div>

  <!-- ═══ HERO BLOCK 3: Long-Scroll Content Experience (teal) ═══ -->
  <div class="feat-hero feat-hero-teal reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg></div>
      <h3>Long-Scroll Content Experience</h3>
      <p>Continuous scrolling layout lets employees browse and discover policies naturally. No pagination barriers, just effortless exploration with a real-time progress indicator so employees always know how far they've read.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/></svg> Progress Tracking · Infinite Scroll</span>
    </div>
    <div class="feat-hero-visual">
      <div class="ep-feat-scroll">
        <div class="ep-feat-scroll-head">
          <div class="ep-feat-scroll-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
          <span>Employee Leave &amp; Absence Policy</span>
        </div>
        <div class="ep-feat-scroll-progress"><div class="ep-feat-scroll-progress-fill"></div></div>
        <div class="ep-feat-scroll-body">
          <div class="ep-feat-scroll-indicator">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
            <span>42% read - keep scrolling</span>
          </div>
          <div class="ep-feat-scroll-title">Section 3: Types of Leave</div>
          <div class="ep-feat-scroll-line" style="width:90%"></div>
          <div class="ep-feat-scroll-line" style="width:78%"></div>
          <div class="ep-feat-scroll-line" style="width:85%"></div>
          <div class="ep-feat-scroll-divider"></div>
          <div class="ep-feat-scroll-section-head">Section 4: Approval Process</div>
          <div class="ep-feat-scroll-line" style="width:92%"></div>
          <div class="ep-feat-scroll-line" style="width:70%"></div>
          <div class="ep-feat-scroll-line" style="width:80%"></div>
          <div class="ep-feat-scroll-tabs">
            <div class="ep-feat-scroll-tab active">Content</div>
            <div class="ep-feat-scroll-tab inactive">Video</div>
            <div class="ep-feat-scroll-tab inactive">Audio</div>
            <div class="ep-feat-scroll-tab inactive">Files</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Views, Previews, Counts, Unread ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-violet reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></div>
      <h3>List and Tile View Options</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/></svg> List</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/></svg> Tile</span>
      </div>
      <p>Switch between list view for detailed scanning and tile view for visual browsing. Employees choose the format that works best for their workflow.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/></svg> Dual View</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Content Snippets for Quick Preview</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/></svg> % Read</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg> Sign Status</span>
      </div>
      <p>Text previews, thumbnails, read percentage, and signature status visible at a glance. Employees can triage policies without opening each one individually.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg> Quick Preview</span>
    </div>
    <div class="feature-card fc-emerald reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></div>
      <h3>Top Deck Highlights</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Pinned</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/></svg> Up to 5</span>
      </div>
      <p>Up to 5 critical policies displayed in a scrollable banner at the top of the portal. Ensures the most important communications get maximum visibility.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Featured</span>
    </div>
    <div class="feature-card fc-rose reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>Star Important Policies</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Starred</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg> Own Folder</span>
      </div>
      <p>Employees can star critical policies and access them in a dedicated folder. Personal bookmarking system for quick reference to frequently needed policies.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Bookmarks</span>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Unread Count, View All Unread, Response Pending, Zoom Images ═══ -->
  <div class="features-grid four-col">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></div>
      <h3>Unread Policy Count per Folder</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg> Badge Counts</span>
      </div>
      <p>Badge counts on each folder show how many policies remain unread, giving employees an instant snapshot of what needs their attention.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg> Stay Current</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <h3>View All Unread Policies</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/></svg> Consolidated</span>
      </div>
      <p>One-click access to see all unread policies across every folder in a single consolidated view, the fastest way to catch up.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/></svg> Quick Access</span>
    </div>
    <div class="feature-card fc-rose reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Response Pending View</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Pending Actions</span>
      </div>
      <p>Dedicated view showing all policies awaiting your action, including signing, acknowledgement, or response, so nothing falls through the cracks.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Action Required</span>
    </div>
    <div class="feature-card fc-indigo reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg></div>
      <h3>Zoom and View Images</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> Image Zoom</span>
      </div>
      <p>Full image viewer with zoom, rotate, and download so every visual detail inside a policy is crystal clear on any device.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Visual Clarity</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Empower Your Employees with a Modern <span class="g-text">Policy Portal</span></h2>
    <p>Give your workforce a seamless, mobile-first policy experience they will actually use.</p>
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
    <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
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
