<?php
/* Template Name: AI Search */
get_header();
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap');

.pcgpt-wrap {
  --teal:#0694A2; --teal-lt:#E0F5F7;
  --emerald:#059669; --em-lt:#D1FAE5;
  --violet:#7C3AED; --violet-lt:#EDE9FE;
  --indigo:#4338CA;
  --amber:#D97706; --amber-lt:#FEF3C7;
  --rose:#E11D48; --rose-lt:#FFE4E6;
  --grad-primary:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);
  --grad-text:linear-gradient(135deg,#0694A2,#4338CA,#7C3AED);
  --white:#FFF; --gray-50:#F9FAFB; --gray-100:#F3F4F6;
  --gray-200:#E5E7EB; --gray-300:#D1D5DB; --gray-400:#9CA3AF;
  --gray-500:#6B7280; --gray-600:#4B5563; --gray-700:#374151;
  --gray-800:#1F2937; --gray-900:#111827;
}
.pcgpt-wrap .mono{font-family:'JetBrains Mono',monospace}
.pcgpt-wrap .g-text{background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* Animations */
.pcgpt-wrap .fade-up{opacity:0;transform:translateY(16px);animation:pcgptFadeUp .6s cubic-bezier(.4,0,.2,1) forwards}
@keyframes pcgptFadeUp{to{opacity:1;transform:none}}
.pcgpt-wrap .d1{animation-delay:.05s}.pcgpt-wrap .d2{animation-delay:.15s}.pcgpt-wrap .d3{animation-delay:.25s}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
@keyframes spin{to{transform:rotate(360deg)}}

/* Hero */
.pcgpt-wrap .pcgpt-hero{padding:calc(68px + 80px) 0 0;background:#fff}
.pcgpt-wrap .pcgpt-hero-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:60px;max-width:1240px;margin:0 auto;padding:0 clamp(20px,5vw,80px);align-items:start}
.pcgpt-wrap .pcgpt-hero-content{}
.pcgpt-wrap .pcgpt-hero-sidebar{}
.pcgpt-wrap .breadcrumb{font-size:12.5px;color:var(--gray-400);display:inline-flex;gap:6px;margin-bottom:18px;font-family:'Plus Jakarta Sans',sans-serif}
.pcgpt-wrap .breadcrumb a{color:var(--teal);text-decoration:none}
.pcgpt-wrap .breadcrumb a:hover{text-decoration:underline}
.pcgpt-wrap h1.hero-hed{font-size:clamp(32px,4.2vw,54px);font-weight:900;line-height:1.12;margin-bottom:20px}
.pcgpt-wrap .hero-sub{font-size:clamp(14px,1.5vw,17px);color:var(--gray-500);font-weight:400;margin:0}
.pcgpt-wrap .hero-sub strong{color:var(--gray-700);font-weight:600}

/* Query input */
.pcgpt-wrap .query-form{max-width:100%;margin-bottom:16px}
.pcgpt-wrap .query-bar{display:flex;align-items:center;background:#fff;border:2px solid var(--gray-200);border-radius:9999px;padding:6px 6px 6px 20px;box-shadow:0 4px 24px rgba(0,0,0,.07),0 1px 4px rgba(0,0,0,.04);gap:10px;transition:border-color .2s,box-shadow .2s}
.pcgpt-wrap .query-bar:focus-within{border-color:var(--teal);box-shadow:0 0 0 4px rgba(6,148,162,.1),0 4px 24px rgba(0,0,0,.07)}
.pcgpt-wrap .query-bar-icon{flex-shrink:0;color:var(--gray-400);line-height:0}
.pcgpt-wrap .query-input{flex:1;border:none;outline:none;font-family:'Manrope',sans-serif;font-size:15px;color:var(--gray-900);background:transparent;padding:9px 0;min-width:0}
.pcgpt-wrap .query-input::placeholder{color:var(--gray-400)}
.pcgpt-wrap .query-btn{flex-shrink:0;background:var(--grad-primary);border:none;border-radius:9999px;padding:12px 24px;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;cursor:pointer;white-space:nowrap;transition:all .2s cubic-bezier(.4,0,.2,1);box-shadow:0 4px 16px rgba(6,148,162,.3);display:flex;align-items:center;gap:7px}
.pcgpt-wrap .query-btn:hover:not(:disabled){transform:translateY(-1px);box-shadow:0 6px 24px rgba(6,148,162,.4)}
.pcgpt-wrap .query-btn:disabled{opacity:.5;cursor:not-allowed;transform:none}
.pcgpt-wrap .query-btn svg{width:14px;height:14px}

/* Suggestion chips */
.pcgpt-wrap .common-queries{display:flex;align-items:center;flex-wrap:wrap;gap:8px;max-width:min(720px,100%)}
.pcgpt-wrap .cq-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);white-space:nowrap;margin-right:4px}
.pcgpt-wrap .chip{background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:9999px;padding:6px 14px;font-family:'Manrope',sans-serif;font-size:13px;font-weight:500;color:var(--gray-600);cursor:pointer;white-space:nowrap;transition:all .15s}
.pcgpt-wrap .chip:hover{background:var(--teal-lt);border-color:var(--teal);color:var(--teal)}

/* Body area below hero */
.pcgpt-wrap .pcgpt-body{max-width:760px;padding:20px clamp(20px,5vw,80px) 60px}

/* Empty state */
.pcgpt-wrap .empty-state{padding:48px 0;display:flex;flex-direction:column;align-items:flex-start;gap:20px}
.pcgpt-wrap .empty-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--gray-400)}
.pcgpt-wrap .log-item{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid var(--gray-100)}
.pcgpt-wrap .log-item:last-child{border:none}
.pcgpt-wrap .log-icon{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.pcgpt-wrap .log-icon svg{width:13px;height:13px}
.pcgpt-wrap .log-text{flex:1}
.pcgpt-wrap .log-main{font-size:13px;font-weight:600;color:var(--gray-700)}
.pcgpt-wrap .log-time{font-size:11px;color:var(--gray-400);font-family:'JetBrains Mono',monospace;margin-top:2px}
.pcgpt-wrap .log-badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:10px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}

/* Q&A pairs */
.pcgpt-wrap .q-pair{margin-bottom:28px;padding-bottom:28px;border-bottom:1px solid var(--gray-100);animation:pcgptFadeUp .3s ease both}
.pcgpt-wrap .q-pair:last-child{border:none}
.pcgpt-wrap .query-pill{display:flex;justify-content:flex-end;margin-bottom:14px}
.pcgpt-wrap .query-bubble{background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:18px 18px 4px 18px;padding:12px 18px;max-width:78%;font-size:14px;color:var(--gray-800);line-height:1.6;font-weight:500}
.pcgpt-wrap .answer-wrap{display:flex;gap:12px;align-items:flex-start}
.pcgpt-wrap .answer-icon{width:32px;height:32px;border-radius:9px;background:var(--grad-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px}
.pcgpt-wrap .answer-icon svg{width:14px;height:14px;color:#fff}
.pcgpt-wrap .answer-body{flex:1;min-width:0}
.pcgpt-wrap .answer-meta{display:flex;align-items:center;gap:8px;margin-bottom:6px}
.pcgpt-wrap .answer-from{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--teal);text-transform:uppercase;letter-spacing:.08em}
.pcgpt-wrap .answer-ref{font-family:'JetBrains Mono',monospace;font-size:10px;color:var(--gray-400)}
.pcgpt-wrap .answer-bubble{background:#fff;border:1.5px solid var(--gray-200);border-radius:4px 18px 18px 18px;padding:16px 20px;box-shadow:0 2px 8px rgba(0,0,0,.05);font-size:14px;line-height:1.75;color:var(--gray-700)}
.pcgpt-wrap .answer-bubble p{margin:0 0 10px}
.pcgpt-wrap .answer-bubble p:last-child{margin:0}
.pcgpt-wrap .answer-bubble strong{color:var(--gray-800);font-weight:700}
.pcgpt-wrap .answer-bubble ul,.pcgpt-wrap .answer-bubble ol{padding-left:20px;margin:8px 0}
.pcgpt-wrap .answer-bubble li{margin:4px 0}
.pcgpt-wrap .answer-bubble code{background:var(--gray-100);border:1px solid var(--gray-200);padding:1px 6px;border-radius:4px;font-family:'JetBrains Mono',monospace;font-size:12px}
.pcgpt-wrap .answer-filed{display:flex;align-items:center;gap:5px;margin-top:8px;font-size:10px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--gray-400)}
.pcgpt-wrap .answer-filed svg{width:10px;height:10px;color:var(--emerald)}

/* Typing */
.pcgpt-wrap .typing{display:flex;gap:5px;align-items:center;padding:4px 0}
.pcgpt-wrap .typing-dot{width:8px;height:8px;background:var(--gray-300);border-radius:50%;animation:tdot 1.2s infinite}
.pcgpt-wrap .typing-dot:nth-child(2){animation-delay:.2s}
.pcgpt-wrap .typing-dot:nth-child(3){animation-delay:.4s}
@keyframes tdot{0%,80%,100%{transform:translateY(0);background:var(--gray-300)}40%{transform:translateY(-6px);background:var(--teal)}}
.pcgpt-wrap .cursor{display:inline-block;width:2px;height:14px;background:var(--teal);margin-left:1px;vertical-align:middle;animation:blink .8s infinite}

/* Dashboard card */
.pcgpt-wrap .dashboard-card{background:#fff;border:1.5px solid var(--gray-200);border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.08),0 6px 20px rgba(0,0,0,.04);overflow:hidden;position:sticky;top:100px}
.pcgpt-wrap .dc-topbar{display:flex;align-items:center;gap:7px;padding:11px 16px;background:var(--gray-50);border-bottom:1px solid var(--gray-200)}
.pcgpt-wrap .dc-dot{width:10px;height:10px;border-radius:50%}
.pcgpt-wrap .dc-url{flex:1;max-width:240px;margin:0 auto;background:#fff;border:1px solid var(--gray-200);border-radius:6px;padding:3px 10px;font-size:11px;color:var(--gray-400);text-align:center;font-family:'JetBrains Mono',monospace;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}
.pcgpt-wrap .dc-body{padding:18px}
.pcgpt-wrap .dc-section-label{font-size:9.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);margin-bottom:10px;font-family:'Plus Jakarta Sans',sans-serif}
.pcgpt-wrap .dc-div{height:1px;background:var(--gray-100);margin:14px 0}
.pcgpt-wrap .query-status-box{border-radius:12px;padding:14px 16px;display:flex;align-items:center;gap:12px;margin-bottom:16px;border:1.5px solid;transition:all .4s}
.pcgpt-wrap .qs-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pcgpt-wrap .qs-icon svg{width:16px;height:16px;color:#fff}
.pcgpt-wrap .qs-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;letter-spacing:.06em;text-transform:uppercase}
.pcgpt-wrap .qs-sub{font-size:11px;margin-top:2px;font-family:'JetBrains Mono',monospace}
.pcgpt-wrap .stat-grid{display:grid;grid-template-columns:1fr 1fr;gap:9px;margin-bottom:14px}
.pcgpt-wrap .stat-box{background:var(--gray-50);border:1px solid var(--gray-200);border-radius:10px;padding:12px 13px}
.pcgpt-wrap .stat-val{font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:900;line-height:1;margin-bottom:3px}
.pcgpt-wrap .stat-lbl{font-size:10px;color:var(--gray-400);font-weight:500}
.pcgpt-wrap .stat-box.ok .stat-val{color:var(--emerald)}
.pcgpt-wrap .stat-box.teal .stat-val{color:var(--teal)}
.pcgpt-wrap .stat-box.purple .stat-val{background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.pcgpt-wrap .stat-box.gray .stat-val{color:var(--gray-600)}
.pcgpt-wrap .kb-row{margin-bottom:14px}
.pcgpt-wrap .kb-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.pcgpt-wrap .kb-label{font-size:12px;font-weight:600;color:var(--gray-700)}
.pcgpt-wrap .kb-pct{font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:700;color:var(--emerald)}
.pcgpt-wrap .kb-track{height:7px;border-radius:4px;background:var(--gray-200);overflow:hidden}
.pcgpt-wrap .kb-fill{height:100%;border-radius:4px;background:linear-gradient(90deg,#0694A2,#4338CA);transition:width 1.5s cubic-bezier(.4,0,.2,1)}
.pcgpt-wrap .checklist{display:flex;flex-direction:column;gap:6px;margin-bottom:14px}
.pcgpt-wrap .check-row{display:flex;align-items:center;justify-content:space-between;padding:7px 11px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-200)}
.pcgpt-wrap .check-name{font-size:11.5px;font-weight:600;color:var(--gray-700)}
.pcgpt-wrap .check-badge{font-size:10px;font-weight:700;padding:2px 9px;border-radius:20px;font-family:'Plus Jakarta Sans',sans-serif}
.pcgpt-wrap .badge-ok{background:var(--em-lt);color:var(--emerald)}
.pcgpt-wrap .ai-box{border-radius:10px;padding:11px 13px;background:linear-gradient(135deg,rgba(6,148,162,.04),rgba(67,56,202,.04));border:1px solid rgba(6,148,162,.15);display:flex;align-items:flex-start;gap:10px}
.pcgpt-wrap .ai-icon{width:26px;height:26px;border-radius:7px;background:var(--grad-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.pcgpt-wrap .ai-icon svg{width:12px;height:12px;color:#fff}
.pcgpt-wrap .ai-tag{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:var(--teal);margin-bottom:3px;text-transform:uppercase;letter-spacing:.06em}
.pcgpt-wrap .ai-text{font-size:11px;color:var(--gray-600);line-height:1.5}
.pcgpt-wrap .ai-text span{color:var(--gray-400)}
.pcgpt-wrap .reminder-box{border-radius:10px;padding:12px 14px;background:linear-gradient(135deg,rgba(6,148,162,.04),rgba(67,56,202,.04));border:1px solid rgba(6,148,162,.15);display:flex;align-items:center;gap:12px;margin-bottom:14px}
.pcgpt-wrap .rb-icon{width:30px;height:30px;border-radius:8px;background:var(--grad-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pcgpt-wrap .rb-icon svg{width:13px;height:13px;color:#fff}
.pcgpt-wrap .rb-count{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:900;color:var(--teal);line-height:1}
.pcgpt-wrap .rb-label{font-size:11px;font-weight:600;color:var(--gray-600)}
.pcgpt-wrap .rb-note{font-size:10px;color:var(--gray-400);margin-top:1px}

/* Sticky bottom bar */
.pcgpt-sticky-bar{display:none;position:fixed;bottom:0;left:0;right:0;background:rgba(255,255,255,0.96);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border-top:1.5px solid var(--gray-200);padding:12px clamp(16px,4vw,80px);z-index:200;box-shadow:0 -4px 24px rgba(0,0,0,.07)}
.pcgpt-sticky-bar.visible{display:block}
.pcgpt-wrap .sticky-inner{max-width:1240px;margin:0 auto;display:flex;align-items:center;gap:10px}
.pcgpt-wrap .sticky-query-bar{flex:1;display:flex;align-items:center;background:#fff;border:2px solid var(--gray-200);border-radius:9999px;padding:5px 5px 5px 18px;box-shadow:0 2px 12px rgba(0,0,0,.06);gap:8px;transition:border-color .2s,box-shadow .2s}
.pcgpt-wrap .sticky-query-bar:focus-within{border-color:var(--teal);box-shadow:0 0 0 3px rgba(6,148,162,.1)}
.pcgpt-wrap .sticky-input{flex:1;border:none;outline:none;font-family:"Manrope",sans-serif;font-size:14px;color:var(--gray-900);background:transparent;padding:7px 0;min-width:0}
.pcgpt-wrap .sticky-input::placeholder{color:var(--gray-400)}
.pcgpt-wrap .sticky-send{flex-shrink:0;background:var(--grad-primary);border:none;border-radius:9999px;padding:10px 20px;color:#fff;font-family:"Plus Jakarta Sans",sans-serif;font-size:13px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:6px;box-shadow:0 3px 12px rgba(6,148,162,.3);transition:all .2s}
.pcgpt-wrap .sticky-send:hover:not(:disabled){transform:translateY(-1px);box-shadow:0 5px 18px rgba(6,148,162,.4)}
.pcgpt-wrap .sticky-send:disabled{opacity:.45;cursor:not-allowed;transform:none}
.pcgpt-wrap .sticky-send svg{width:13px;height:13px}
.pcgpt-wrap .share-btn{flex-shrink:0;display:flex;align-items:center;gap:6px;background:#fff;border:1.5px solid var(--gray-200);border-radius:9999px;padding:10px 16px;font-family:"Plus Jakarta Sans",sans-serif;font-size:12px;font-weight:700;color:var(--gray-600);cursor:pointer;white-space:nowrap;transition:all .15s;position:relative}
.pcgpt-wrap .share-btn svg{width:13px;height:13px}
.pcgpt-wrap .share-btn:hover{background:var(--gray-50);border-color:var(--gray-300);color:var(--gray-800)}
.pcgpt-wrap .share-dropdown{display:none;position:absolute;bottom:calc(100% + 8px);right:0;background:#fff;border:1.5px solid var(--gray-200);border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,.12);overflow:hidden;min-width:200px;z-index:300}
.pcgpt-wrap .share-dropdown.open{display:block}
.pcgpt-wrap .share-option{display:flex;align-items:center;gap:10px;padding:11px 16px;font-family:"Manrope",sans-serif;font-size:13px;font-weight:500;color:var(--gray-700);cursor:pointer;border:none;background:none;width:100%;text-align:left;transition:background .15s}
.pcgpt-wrap .share-option:hover{background:var(--gray-50)}
.pcgpt-wrap .share-option svg{width:15px;height:15px;flex-shrink:0}
.pcgpt-wrap .share-option .sopt-label{font-weight:600}
.pcgpt-wrap .share-option .sopt-sub{font-size:11px;color:var(--gray-400);display:block}
body.has-sticky{padding-bottom:68px}

/* Responsive */
@media(max-width:960px){
  .pcgpt-wrap .pcgpt-hero-grid{grid-template-columns:1fr;gap:32px}
  .pcgpt-wrap .pcgpt-hero{padding:calc(68px + 40px) 0 36px}
  .pcgpt-wrap .dashboard-card{position:static;max-width:560px}
  .pcgpt-wrap .pcgpt-body{max-width:100%;padding:32px 28px 52px}
  .pcgpt-wrap .stat-grid{grid-template-columns:repeat(4,1fr)}
}
@media(max-width:680px){
  .pcgpt-wrap .pcgpt-hero{padding:calc(68px + 28px) 0 28px}
  .pcgpt-wrap .pcgpt-hero-grid{gap:24px;padding:0 20px}
  .pcgpt-wrap h1.hero-hed{font-size:clamp(20px,5.5vw,30px)}
  .pcgpt-wrap .hero-sub{font-size:13px}
  .pcgpt-wrap .query-bar{padding:5px 5px 5px 16px}
  .pcgpt-wrap .query-input{font-size:14px}
  .pcgpt-wrap .query-btn .btn-label{display:none}
  .pcgpt-wrap .query-btn{padding:10px 14px;min-width:42px;justify-content:center}
  .pcgpt-wrap .common-queries{gap:6px;margin-top:2px}
  .pcgpt-wrap .cq-label{display:none}
  .pcgpt-wrap .chip{font-size:12px;padding:5px 12px}
  .pcgpt-wrap .pcgpt-body{padding:24px 20px 48px}
  .pcgpt-wrap .empty-state{padding:20px 0}
  .pcgpt-wrap .query-bubble{max-width:88%;font-size:13px}
  .pcgpt-wrap .answer-bubble{font-size:13px;padding:13px 15px}
  .pcgpt-wrap .answer-wrap{gap:9px}
  .pcgpt-wrap .answer-icon{width:28px;height:28px;border-radius:8px;margin-top:1px}
  .pcgpt-wrap .answer-icon svg{width:12px;height:12px}
  .pcgpt-wrap .dashboard-card{max-width:100%}
  .pcgpt-wrap .stat-grid{grid-template-columns:1fr 1fr}
  .pcgpt-wrap .sticky-send .btn-label{display:none}
  .pcgpt-wrap .sticky-send{padding:10px 13px}
  .pcgpt-wrap .share-btn .share-label{display:none}
  .pcgpt-wrap .share-btn{padding:10px 12px}
  .pcgpt-sticky-bar{padding:10px 16px}
}
@media(max-width:480px){
  .pcgpt-wrap .pcgpt-hero{padding:calc(68px + 20px) 0 20px}
  .pcgpt-wrap .pcgpt-hero-grid{padding:0 16px}
  .pcgpt-wrap h1.hero-hed br{display:none}
  .pcgpt-wrap h1.hero-hed{font-size:clamp(18px,6vw,26px)}
  .pcgpt-wrap .query-bar{padding:4px 4px 4px 14px;gap:6px}
  .pcgpt-wrap .query-input{font-size:14px;padding:8px 0}
  .pcgpt-wrap .query-input::placeholder{font-size:13px}
  .pcgpt-wrap .common-queries{gap:5px}
  .pcgpt-wrap .chip{font-size:11.5px;padding:5px 11px}
  .pcgpt-wrap .pcgpt-body{padding:20px 16px 40px}
  .pcgpt-wrap .empty-title{font-size:11px}
  .pcgpt-wrap .log-item{gap:9px;padding:9px 0}
  .pcgpt-wrap .log-icon{width:26px;height:26px;border-radius:7px}
  .pcgpt-wrap .log-main{font-size:12px}
  .pcgpt-wrap .log-time{font-size:10px}
  .pcgpt-wrap .query-bubble{max-width:92%;padding:10px 14px;font-size:13px}
  .pcgpt-wrap .q-pair{margin-bottom:20px;padding-bottom:20px}
  .pcgpt-wrap .answer-bubble{padding:12px 14px;font-size:13px;line-height:1.7}
  .pcgpt-wrap .answer-from{font-size:9.5px}
  .pcgpt-wrap .answer-ref{font-size:9.5px}
  .pcgpt-wrap .answer-filed{font-size:9px}
  .pcgpt-wrap .dc-body{padding:14px}
  .pcgpt-wrap .dc-section-label{font-size:9px}
  .pcgpt-wrap .stat-grid{gap:7px}
  .pcgpt-wrap .stat-val{font-size:18px}
  .pcgpt-wrap .stat-lbl{font-size:9px}
  .pcgpt-wrap .query-status-box{padding:11px 12px;gap:10px}
  .pcgpt-wrap .qs-label{font-size:10.5px}
  .pcgpt-wrap .ai-text{font-size:10.5px}
  .pcgpt-wrap .reminder-box{padding:10px 12px}
  .pcgpt-wrap .rb-count{font-size:15px}
  .pcgpt-wrap .rb-label{font-size:10px}
  .pcgpt-wrap .checklist{gap:4px}
  .pcgpt-wrap .check-row{padding:6px 9px}
  .pcgpt-wrap .check-name{font-size:10px}
  .pcgpt-wrap .check-badge{font-size:9px;padding:2px 7px}
  .pcgpt-wrap .breadcrumb{font-size:11px;margin-bottom:12px}
}
@media(max-width:360px){
  .pcgpt-wrap .pcgpt-hero{padding:calc(68px + 16px) 0 16px}
  .pcgpt-wrap .pcgpt-hero-grid{padding:0 14px}
  .pcgpt-wrap .pcgpt-body{padding:16px 14px 36px}
  .pcgpt-wrap .stat-grid{grid-template-columns:1fr 1fr;gap:6px}
  .pcgpt-wrap .chip{font-size:11px;padding:4px 10px}
}
</style>

<div class="pcgpt-wrap">

<!-- HERO -->
<section class="pcgpt-hero">
  <div class="pcgpt-hero-grid container">

    <!-- LEFT: Hero content -->
    <div class="pcgpt-hero-content">
      <div class="breadcrumb fade-up">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span>&gt;</span>
        <a href="<?php echo esc_url(home_url('/search/')); ?>">Search</a>
      </div>
      <h1 class="hero-hed fade-up d1">
        Search everything on <span class="g-text">PolicyCentral.ai</span>
      </h1>
      <p class="hero-sub fade-up d2">Submit a query. Get an instant answer. <strong>No reading required.</strong></p>

      <!-- Search bar (inside hero left column) -->
      <div class="query-form fade-up d2" style="margin-top:36px;">
        <div class="query-bar">
          <span class="query-bar-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
          </span>
          <input type="text" class="query-input" id="queryInput"
            placeholder="Submit a query about features, compliance, security, pricing..."
            autocomplete="off" />
          <button class="query-btn" id="sendBtn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            <span class="btn-label">Submit Query</span>
          </button>
        </div>
      </div>

      <div class="common-queries fade-up d3">
        <span class="cq-label">Common Queries</span>
        <button class="chip">RBI BFSI compliant?</button>
        <button class="chip">How does PolicyGPT work?</button>
        <button class="chip">Host on our own AWS?</button>
        <button class="chip">White-label mobile app?</button>
        <button class="chip">Employee targeting?</button>
        <button class="chip">Security certifications?</button>
        <button class="chip">Pricing model?</button>
      </div>

      <div id="emptyState" class="empty-state">
        <div class="empty-title">Query Log — Ref: QRY-PENDING-0001</div>
        <div class="log-item">
          <div class="log-icon" style="background:var(--em-lt)">
            <svg viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="log-text">
            <div class="log-main">PolicyGPT has indexed all features, use cases &amp; FAQ's loaded.</div>
            <div class="log-time">System &middot; Just now &middot; Ref: IDX-247</div>
          </div>
          <span class="log-badge" style="background:var(--em-lt);color:var(--emerald)">Ready</span>
        </div>
        <div class="log-item">
          <div class="log-icon" style="background:var(--em-lt)">
            <svg viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="log-text">
            <div class="log-main">Industry challenges understood, key deployment and integrations requirement understood.</div>
            <div class="log-time">System &middot; Just now &middot; Ref: FAQ-10</div>
          </div>
          <span class="log-badge" style="background:var(--em-lt);color:var(--emerald)">Indexed</span>
        </div>
        <div class="log-item">
          <div class="log-icon" style="background:var(--amber-lt)">
            <svg viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2.5"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
          </div>
          <div class="log-text">
            <div class="log-main">Awaiting query submission. Engine is very patient.</div>
            <div class="log-time">Status &middot; Ongoing &middot; Ref: AWAIT-&infin;</div>
          </div>
          <span class="log-badge" style="background:var(--amber-lt);color:var(--amber)">Pending</span>
        </div>
      </div>
    </div>

    <!-- RIGHT: Dashboard card (sticky) -->
    <div class="pcgpt-hero-sidebar">
      <div class="dashboard-card fade-up d3">
        <div class="dc-topbar">
          <div class="dc-dot" style="background:#FF5F57"></div>
          <div class="dc-dot" style="background:#FEBC2E"></div>
          <div class="dc-dot" style="background:#28C840"></div>
          <div class="dc-url" id="dcUrl">policycentral.ai/search</div>
        </div>
        <div class="dc-body">
          <div class="dc-section-label">Query Status</div>
          <div class="query-status-box" id="queryStatusBox" style="background:#F9FAFB;border-color:var(--gray-200)">
            <div class="qs-icon" id="qsIcon" style="background:var(--gray-300)">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
              <div class="qs-label" id="qsLabel" style="color:var(--gray-500)">AWAITING QUERY</div>
              <div class="qs-sub" id="qsSub" style="color:var(--gray-400)">Submit something. Anything.</div>
            </div>
          </div>
          <div class="stat-grid">
            <div class="stat-box teal"><div class="stat-val" id="resolvedCount">0</div><div class="stat-lbl">Resolved This Session</div></div>
            <div class="stat-box gray"><div class="stat-val">247</div><div class="stat-lbl">Policies Indexed</div></div>
            <div class="stat-box ok"><div class="stat-val">1.8s</div><div class="stat-lbl">Avg Response Time</div></div>
            <div class="stat-box purple"><div class="stat-val">99.2%</div><div class="stat-lbl">Accuracy Rate*</div></div>
          </div>
          <div class="dc-div"></div>
          <div class="dc-section-label">Knowledge Base</div>
          <div class="kb-row">
            <div class="kb-header"><span class="kb-label">Policy Comprehension</span><span class="kb-pct">100%</span></div>
            <div class="kb-track"><div class="kb-fill" id="kbFill" style="width:0%"></div></div>
          </div>
          <div class="checklist">
            <div class="check-row"><span class="check-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;vertical-align:middle;margin-right:5px"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6m-6 4h6m-6 4h4"/></svg>Features</span><span class="check-badge badge-ok">&#10003; Loaded</span></div>
            <div class="check-row"><span class="check-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;vertical-align:middle;margin-right:5px"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"/></svg>FAQs</span><span class="check-badge badge-ok">&#10003; Loaded</span></div>
            <div class="check-row"><span class="check-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;vertical-align:middle;margin-right:5px"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>RBI / ISO / SOC 2</span><span class="check-badge badge-ok">&#10003; Loaded</span></div>
            <div class="check-row"><span class="check-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;vertical-align:middle;margin-right:5px"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>Pricing Models</span><span class="check-badge badge-ok">&#10003; Loaded</span></div>
            <div class="check-row"><span class="check-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;vertical-align:middle;margin-right:5px"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>CTO, CFO, HR, Branch Head Queries</span><span class="check-badge badge-ok">&#10003; Loaded</span></div>
          </div>
          <div class="dc-div"></div>
          <div class="dc-section-label">AI Reviewer — PolicyGPT</div>
          <div class="reminder-box">
            <div class="rb-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
            <div>
              <div class="rb-count">Online</div>
              <div class="rb-label">PolicyGPT is ready</div>
              <div class="rb-note">Powered by AWS Bedrock &middot; <span class="mono" style="font-size:10px">claude-sonnet</span></div>
            </div>
          </div>
          <div class="ai-box">
            <div class="ai-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div>
              <div class="ai-tag">PolicyGPT says</div>
              <div class="ai-text" id="botQuip">"I've personally memorized all 247 policies.<br><span>Ask me anything. I'll answer.<br>I have nowhere else to be."</span></div>
            </div>
          </div>
          <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--gray-100)">
            <div style="font-size:10px;color:var(--gray-400);line-height:1.5">*Self-reported. Audited by nobody.<br>Still confused? &nbsp;<a href="https://wa.me/919890988498" target="_blank" style="color:var(--teal);font-weight:700;text-decoration:none">Escalate to Kaizad &rarr;</a></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- BODY: Conversation -->
<div class="pcgpt-body">

  <div id="conversation"></div>

</div>

<!-- STICKY BOTTOM BAR -->
<div class="pcgpt-sticky-bar" id="stickyBar">
  <div class="sticky-inner">
    <div class="sticky-query-bar">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" class="sticky-input" id="stickyInput" placeholder="Ask another question..." autocomplete="off" />
      <button class="sticky-send" id="stickySendBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        <span class="btn-label">Submit Query</span>
      </button>
    </div>
    <button class="share-btn" id="shareBtn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
      <span class="share-label">Share</span>
    </button>
    <div class="share-dropdown" id="shareDropdown">
      <button class="share-option" data-type="whatsapp">
        <svg viewBox="0 0 24 24" fill="#25D366" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        <div><div class="sopt-label">Share on WhatsApp</div><div class="sopt-sub">Send this conversation</div></div>
      </button>
      <button class="share-option" data-type="email">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <div><div class="sopt-label">Share via Email</div><div class="sopt-sub">Open in mail client</div></div>
      </button>
    </div>
  </div>
</div>

</div>

<?php get_footer(); ?>
