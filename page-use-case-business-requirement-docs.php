<?php
/* Template Name: Use Case - Business Requirement Docs */
get_header();
?>
<style>
/* Page-specific accent, slate/rose (engineering/spec gravitas) */
:root { --accent:#475569; --accent-dark:#334155; --accent-light:#F1F5F9; --accent-border:rgba(71,85,105,.2); }

.br-mockup{position:relative;width:100%;max-width:520px;animation:brFloat 7s ease-in-out infinite}
@keyframes brFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes brCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.br-card{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.br-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.br-dots{display:flex;gap:5px}.br-dots span{width:9px;height:9px;border-radius:50%}
.br-dots span:nth-child(1){background:#EF4444}.br-dots span:nth-child(2){background:#F59E0B}.br-dots span:nth-child(3){background:#22C55E}
.br-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.br-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#475569,#334155);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.br-body{padding:16px}
.br-doc-head{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.br-doc-tag{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.br-doc-ver{padding:3px 8px;border-radius:5px;background:rgba(124,58,237,.1);color:#5B21B6;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid rgba(124,58,237,.2);margin-left:auto}
.br-doc-title{font-size:14px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px;line-height:1.3}
.br-doc-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

.br-diagram{background:var(--gray-50);border:1px solid var(--gray-200);border-radius:10px;padding:10px;margin-bottom:10px}
.br-diag-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--gray-500);letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}
.br-diag-flow{display:flex;align-items:center;gap:5px}
.br-diag-node{padding:5px 9px;border-radius:6px;background:#fff;border:1.5px solid var(--accent-border);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;color:var(--accent-dark)}
.br-diag-node.hi{background:var(--accent-light);border-color:var(--accent)}
.br-diag-arrow{color:var(--accent);font-weight:800;font-size:11px}

.br-comments-inline{background:#fff;border:1px solid var(--gray-100);border-radius:10px;padding:10px 12px;margin-bottom:10px}
.br-c-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--gray-500);letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between}
.br-c-badge{padding:2px 6px;border-radius:4px;background:rgba(217,119,6,.1);color:#B45309;font-size:8.5px;font-weight:800;border:1px solid rgba(217,119,6,.2)}
.br-c-item{display:flex;align-items:flex-start;gap:7px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif}
.br-c-av{width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:8px;font-weight:800;flex-shrink:0}
.br-c-av.a{background:linear-gradient(135deg,#475569,#334155)}
.br-c-av.b{background:linear-gradient(135deg,#D97706,#B45309)}
.br-c-av.c{background:linear-gradient(135deg,#059669,#047857)}
.br-c-text{font-size:10px;color:var(--gray-700);font-weight:600;line-height:1.35}
.br-c-text strong{font-weight:800;color:var(--gray-900)}

.br-shifts-row{display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-radius:10px;background:var(--accent-light);border:1px solid var(--accent-border);font-family:'Plus Jakarta Sans',sans-serif}
.br-shifts-label{font-size:9.5px;font-weight:800;color:var(--accent-dark);letter-spacing:.04em;text-transform:uppercase}
.br-shifts-stack{display:flex;gap:-6px}
.br-shift-av{width:22px;height:22px;border-radius:50%;border:2px solid #fff;display:flex;align-items:center;justify-content:center;color:#fff;font-size:8.5px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;margin-left:-6px}
.br-shift-av:first-child{margin-left:0}
.br-shift-av.s1{background:linear-gradient(135deg,#475569,#334155)}
.br-shift-av.s2{background:linear-gradient(135deg,#D97706,#B45309)}
.br-shift-av.s3{background:linear-gradient(135deg,#059669,#047857)}
.br-shift-av.s4{background:linear-gradient(135deg,#4338CA,#6366F1)}
.br-shift-av.s5{background:linear-gradient(135deg,#E11D48,#BE123C)}

.br-float-diff{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.15);padding:11px 13px;min-width:182px;animation:brCardIn .6s ease-out both;animation-delay:.3s}
.br-diff-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.br-diff-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#475569,#334155);display:flex;align-items:center;justify-content:center}
.br-diff-icon svg{width:11px;height:11px;color:#fff}
.br-diff-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.br-diff-row{display:flex;align-items:center;gap:7px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px}
.br-diff-mark{width:14px;height:14px;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:8.5px;font-weight:800;flex-shrink:0}
.br-diff-mark.add{background:rgba(5,150,105,.15);color:#047857}
.br-diff-mark.rm{background:rgba(225,29,72,.12);color:#BE123C}
.br-diff-mark.mod{background:rgba(217,119,6,.12);color:#B45309}

.br-float-async{position:absolute;bottom:-18px;left:-18px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.15);padding:11px 13px;min-width:200px;animation:brCardIn .6s ease-out both;animation-delay:.55s}
.br-async-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.br-async-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#475569,#334155);display:flex;align-items:center;justify-content:center}
.br-async-icon svg{width:11px;height:11px;color:#fff}
.br-async-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.br-async-row{display:flex;align-items:center;gap:6px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-600);font-weight:600}
.br-async-flag{font-size:11px}
.br-async-time{margin-left:auto;font-weight:800;color:var(--gray-900);font-size:9px}

/* Shared sections */
.uc-scene{padding:88px 0;background:#fff}
.uc-scene-inner{max-width:820px;margin:0 auto;text-align:center}
.uc-scene h2{margin-bottom:20px}
.uc-scene p{font-size:17px;color:var(--gray-500);line-height:1.8;margin-bottom:16px}
.uc-scene p:last-child{margin-bottom:0}
.uc-vignette{padding:80px 0;background:linear-gradient(180deg,#F9FAFB 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.uc-vignette-card{max-width:960px;margin:0 auto;display:grid;grid-template-columns:200px 1fr;gap:40px;padding:40px 44px;border-radius:20px;background:#fff;border:1px solid var(--gray-200);box-shadow:var(--shadow-md);position:relative}
.uc-vignette-card::before{content:"";position:absolute;left:0;top:32px;bottom:32px;width:4px;border-radius:0 4px 4px 0;background:linear-gradient(180deg,var(--accent),var(--accent-dark))}
.uc-vignette-side{display:flex;flex-direction:column;gap:8px}
.uc-vignette-kicker{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--accent-dark)}
.uc-vignette-side h3{font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:800;color:var(--gray-900);line-height:1.2;letter-spacing:-.01em}
.uc-vignette-content{font-family:'Manrope',sans-serif;color:var(--gray-600);line-height:1.85;font-size:16px}
.uc-vignette-content p{margin-bottom:16px}
.uc-vignette-content p:last-child{margin-bottom:0}
.uc-vignette-content strong{color:var(--gray-900);font-weight:700}

.uc-caps{padding:100px 0;background:#fff}
.uc-caps .section-header{margin-bottom:56px}
.uc-cap-link{display:inline-flex;align-items:center;gap:6px;margin-top:10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:700;color:var(--accent-dark);border-bottom:1.5px solid transparent;padding-bottom:2px;transition:all .2s var(--ease);align-self:flex-start}
.uc-cap-link:hover{border-bottom-color:var(--accent-dark)}
.uc-cap-link svg{width:13px;height:13px;transition:transform .2s var(--spring)}
.uc-cap-link:hover svg{transform:translateX(3px)}
.feat-hero-uc{background:#fff;border-color:var(--gray-200)}
.feat-hero-uc:hover{border-color:var(--accent-border)}
.feat-hero-uc .feat-hero-icon{background:linear-gradient(135deg,var(--accent),var(--accent-dark))}
.feat-hero-uc h2,.feat-hero-uc h3{color:var(--gray-900)}
.feat-hero-uc-soft{background:var(--gray-50);border-color:var(--gray-200)}

/* Cap visuals */
.fv-docx{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-d-upload{border:2px dashed var(--gray-200);border-radius:12px;padding:18px;text-align:center;background:var(--gray-50);margin-bottom:10px}
.fv-d-upload svg{width:28px;height:28px;color:var(--accent);margin:0 auto 8px}
.fv-d-upload-t{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-d-upload-s{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600;margin-top:2px}
.fv-d-chips{display:flex;gap:5px;flex-wrap:wrap;justify-content:center}
.fv-d-chip{padding:3px 8px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:700;border:1px solid var(--accent-border)}

.fv-diag{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-di-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-di-diagram{position:relative;padding:18px 10px;background:var(--gray-50);border-radius:10px;border:1px solid var(--gray-200);margin-bottom:10px}
.fv-di-row{display:flex;justify-content:space-around;align-items:center;gap:8px;margin-bottom:8px;position:relative}
.fv-di-row:last-child{margin-bottom:0}
.fv-di-box{padding:6px 10px;border-radius:7px;background:#fff;border:1.5px solid var(--accent-border);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;color:var(--accent-dark)}
.fv-di-box.hi{background:var(--accent-light);border-color:var(--accent);box-shadow:0 0 0 3px rgba(71,85,105,.08)}
.fv-di-atts{display:flex;gap:5px;flex-wrap:wrap}
.fv-di-att{padding:3px 8px;border-radius:5px;background:var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:700;color:var(--gray-600);display:inline-flex;align-items:center;gap:4px}
.fv-di-att svg{width:9px;height:9px}

.fv-ver{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-ver-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px;display:flex;align-items:center;justify-content:space-between}
.fv-ver-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-ver-row{display:flex;align-items:flex-start;gap:10px;padding:8px 10px;border-radius:9px;margin-bottom:4px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ver-row.live{background:var(--accent-light);border-color:var(--accent-border)}
.fv-ver-num{padding:3px 7px;border-radius:5px;background:#fff;border:1px solid var(--gray-200);font-size:9.5px;font-weight:800;color:var(--gray-600);flex-shrink:0}
.fv-ver-row.live .fv-ver-num{background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;border-color:transparent}
.fv-ver-body{flex:1}
.fv-ver-summary{font-size:10.5px;font-weight:700;color:var(--gray-800);line-height:1.4}
.fv-ver-meta{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:2px}

.fv-async{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-a-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-a-row{display:flex;align-items:center;gap:10px;padding:7px 10px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-a-geo{font-size:14px}
.fv-a-body{flex:1}
.fv-a-team{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-a-shift{font-size:9.5px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-a-count{padding:2px 7px;border-radius:5px;font-size:9.5px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}

.uc-scenarios{padding:100px 0;background:linear-gradient(180deg,#F9FAFB 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.uc-sc-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;max-width:1100px;margin:0 auto}
.uc-sc{padding:28px;border-radius:16px;background:#fff;border:1px solid var(--gray-200);transition:all .25s var(--ease)}
.uc-sc:hover{border-color:var(--accent-border);transform:translateY(-3px);box-shadow:var(--shadow-lg)}
.uc-sc-icon{width:44px;height:44px;border-radius:11px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;margin-bottom:14px}
.uc-sc-icon svg{width:19px;height:19px;color:#fff}
.uc-sc h3{font-size:17px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px;line-height:1.3}
.uc-sc p{font-size:14px;color:var(--gray-500);line-height:1.65}
.uc-sc-answer{margin-top:12px;padding-top:12px;border-top:1px solid var(--gray-100);font-size:12.5px;color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;display:flex;align-items:flex-start;gap:7px}
.uc-sc-answer svg{width:14px;height:14px;flex-shrink:0;margin-top:2px;color:var(--accent)}
.uc-changes{padding:100px 0;background:#fff}
.uc-ch-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:1100px;margin:0 auto}
.uc-ch{padding:32px 28px;border-radius:16px;border:1px solid var(--gray-200);background:#fff;text-align:center;transition:all .25s var(--ease)}
.uc-ch:hover{border-color:var(--accent-border);box-shadow:var(--shadow-md);transform:translateY(-3px)}
.uc-ch-num{display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;margin-bottom:16px}
.uc-ch h3{font-size:16px;font-weight:800;color:var(--gray-900);margin-bottom:10px;line-height:1.35}
.uc-ch p{font-size:13.5px;color:var(--gray-600);line-height:1.65}
.uc-ch p strong{color:var(--accent-dark);font-weight:800}
.uc-cta{padding:100px 0;background:#fff;border-top:1px solid var(--gray-100)}

@media(max-width:1024px){
  .br-mockup{max-width:420px;margin:0 auto}
  .br-float-diff{right:-8px;top:-8px}
  .br-float-async{left:-8px;bottom:-10px}
  .fv-docx,.fv-diag,.fv-ver,.fv-async{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){.br-mockup{max-width:340px}.br-float-diff,.br-float-async{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}}

/* Capability 5: 4D Search across specs */
.fv-br-search{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-bs-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px}
.fv-bs-input{display:flex;align-items:center;gap:8px;padding:9px 12px;border:1.5px solid var(--accent-border);border-radius:9px;margin-bottom:10px;background:var(--accent-light)}
.fv-bs-input svg{width:13px;height:13px;color:var(--accent);flex-shrink:0}
.fv-bs-q{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;color:var(--gray-900)}
.fv-bs-res{padding:9px 11px;border-radius:8px;background:var(--gray-50);margin-bottom:5px;border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-bs-res-head{display:flex;align-items:center;justify-content:space-between;gap:6px;margin-bottom:3px}
.fv-bs-res-title{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-bs-res-scope{font-size:8.5px;font-weight:800;color:var(--accent-dark);padding:2px 6px;border-radius:4px;background:var(--accent-light);letter-spacing:.04em;text-transform:uppercase;white-space:nowrap}
.fv-bs-res-sub{font-size:10px;color:var(--gray-500);line-height:1.35}

/* Capability 6: AI summaries for onboarding */
.fv-br-ai{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-ba-header{display:flex;align-items:center;gap:8px;margin-bottom:12px}
.fv-ba-badge{padding:3px 8px;border-radius:5px;background:linear-gradient(135deg,#7C3AED,#4338CA);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.04em;white-space:nowrap}
.fv-ba-title{font-size:10.5px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.fv-ba-summary-box{background:linear-gradient(180deg,rgba(124,58,237,.06) 0%,transparent 100%);border:1px solid rgba(124,58,237,.15);border-radius:10px;padding:11px 12px;margin-bottom:10px}
.fv-ba-summary-label{font-size:9px;font-weight:800;color:#5B21B6;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px}
.fv-ba-summary-item{display:flex;gap:8px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px;color:var(--gray-700);font-weight:600;line-height:1.4}
.fv-ba-summary-item::before{content:"\25CF";color:#7C3AED;font-weight:800;font-size:8px;flex-shrink:0;margin-top:5px}
.fv-ba-onboard{padding:10px 12px;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;gap:10px}
.fv-ba-onboard-icon{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-ba-onboard-icon svg{width:14px;height:14px}
.fv-ba-onboard-text{flex:1}
.fv-ba-onboard-title{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-ba-onboard-sub{font-size:9.5px;color:var(--gray-500);font-weight:600;margin-top:1px}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content">
    <h1>Specs, BRDs, and <br>technical handoffs, <span class="accent">async across shifts.</span></h1>
    <p class="subtitle">Business Requirement Documents, project specs, architecture notes, and technical guidelines, written once, handed across time zones without losing the thread. Built for Engineering, Product, Architecture, and Tech Leadership in distributed delivery organisations.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Business Req. Docs</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="br-mockup">
      <div class="br-card">
        <div class="br-titlebar">
          <div class="br-dots"><span></span><span></span><span></span></div>
          <span class="br-titlebar-text">Project Spec, review</span>
          <span class="br-titlebar-badge">IN REVIEW</span>
        </div>
        <div class="br-body">
          <div class="br-doc-head">
            <span class="br-doc-tag">&#x1F4D0; BRD &middot; PROJ-341</span>
            <span class="br-doc-ver">v2.1</span>
          </div>
          <div class="br-doc-title">Payment gateway migration, Phase 2 scope</div>
          <div class="br-doc-meta">Last edit: 8 min ago &middot; Owner: Platform Eng</div>

          <div class="br-diagram">
            <div class="br-diag-label">&#x1F517; Architecture (embedded)</div>
            <div class="br-diag-flow">
              <div class="br-diag-node">Client</div>
              <span class="br-diag-arrow">&rsaquo;</span>
              <div class="br-diag-node hi">Gateway v2</div>
              <span class="br-diag-arrow">&rsaquo;</span>
              <div class="br-diag-node">Ledger</div>
              <span class="br-diag-arrow">&rsaquo;</span>
              <div class="br-diag-node">Bank API</div>
            </div>
          </div>

          <div class="br-comments-inline">
            <div class="br-c-label">&#x1F4AC; Comments on this spec <span class="br-c-badge">7 OPEN</span></div>
            <div class="br-c-item"><div class="br-c-av a">KR</div><div class="br-c-text"><strong>Arch:</strong> Need idempotency guarantee on retry path, section 3.2</div></div>
            <div class="br-c-item"><div class="br-c-av b">SN</div><div class="br-c-text"><strong>QA:</strong> Rollback SOP missing for Phase 2 failure mode</div></div>
            <div class="br-c-item"><div class="br-c-av c">MH</div><div class="br-c-text"><strong>SecOps:</strong> Tokenisation approach approved, thread closed</div></div>
          </div>

          <div class="br-shifts-row">
            <div><div class="br-shifts-label">Reviewers across shifts</div></div>
            <div class="br-shifts-stack">
              <div class="br-shift-av s1">IN</div>
              <div class="br-shift-av s2">US</div>
              <div class="br-shift-av s3">PL</div>
              <div class="br-shift-av s4">SG</div>
              <div class="br-shift-av s5">+8</div>
            </div>
          </div>
        </div>
      </div>

      <div class="br-float-diff">
        <div class="br-diff-head"><div class="br-diff-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><span class="br-diff-title">v2.0 &rarr; v2.1</span></div>
        <div class="br-diff-row"><span class="br-diff-mark add">+</span>Idempotent retry in sec 3.2</div>
        <div class="br-diff-row"><span class="br-diff-mark mod">~</span>Rollback plan in Phase 2</div>
        <div class="br-diff-row"><span class="br-diff-mark rm">&minus;</span>Token-gen in request body</div>
      </div>
      <div class="br-float-async">
        <div class="br-async-head"><div class="br-async-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><span class="br-async-title">Async reviews</span></div>
        <div class="br-async-row"><span class="br-async-flag">&#x1F1EE;&#x1F1F3;</span>India Arch<span class="br-async-time">Mar 28</span></div>
        <div class="br-async-row"><span class="br-async-flag">&#x1F1FA;&#x1F1F8;</span>US Product<span class="br-async-time">Mar 29</span></div>
        <div class="br-async-row"><span class="br-async-flag">&#x1F1F5;&#x1F1F1;</span>Poland QA<span class="br-async-time">Mar 29</span></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>The spec is in <span class="g-text">three people's heads</span> and a forgotten Confluence page.</h2>
    <p>The product manager has the latest thinking in a doc in their drafts. The tech lead is half a version ahead in a branch. QA is reviewing something from two weeks ago. The offshore team didn't see the architecture note because it went out at 3 AM their time. A week later, a release has gone out missing a core requirement that everyone thought was scoped.</p>
    <p>Business Requirement Docs on PolicyCentral.ai do the unromantic work of making sure the current spec is the only spec in circulation, with every reviewer signed off, every comment tracked, and handoffs across time zones that don't lose the plot.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">In a global IT services organisation</span>
      <h3>Shift teams, multiple geographies, one source of truth.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A global IT services company runs delivery centres in India, the US, Europe, and South East Asia. Engineering teams cover 24-hour shifts on customer programmes. Requirements get authored in one time zone and need to be read, reviewed, clarified, and committed to in another, often in the next four hours before the handover call.</p>
      <p><strong>The failure mode isn't bad engineers. It's bad handoffs.</strong> A BRD emailed at the end of the IST day sits in inboxes until US morning; an architecture change discussed on a Slack thread is invisible to the QA team in Poland; a spec update happens in a shared drive and the offshore PM never gets the notification.</p>
      <p>A single platform that carries the current BRD, shows exactly what changed between versions, threads comments inside the spec, and proves who reviewed what, that's what BRDs on PolicyCentral.ai look like.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Six capabilities that play a critical role<br>in <span class="g-text">async specification work.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h3>1. Word-style editor + .docx upload.</h3>
      <p>Authors write BRDs in the familiar Word-style editor, or upload an existing .docx and have it auto-converted to structured, responsive web content. No format breaks. No "Table didn't render." No Markdown religion. The spec lives where your delivery organisation can actually work on it.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-docx">
        <div class="fv-d-upload">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          <div class="fv-d-upload-t">BRD_PaymentGW_v2.1.docx</div>
          <div class="fv-d-upload-s">Uploaded &middot; auto-converted to web</div>
        </div>
        <div class="fv-d-chips">
          <span class="fv-d-chip">Headings preserved</span>
          <span class="fv-d-chip">Tables responsive</span>
          <span class="fv-d-chip">Images embedded</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
      <h3>2. Rich media in-line, diagrams that live with the spec.</h3>
      <p>Architecture diagrams embedded next to the text that describes them. Loom walkthroughs of a complex flow. Screenshots with annotations. Secure video of the tech-lead's whiteboard session. The visual artefacts travel with the words, not as attachments on a separate shared drive.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-diag">
        <div class="fv-di-title">PROJ-341, Payment flow</div>
        <div class="fv-di-diagram">
          <div class="fv-di-row"><div class="fv-di-box">Client SDK</div><div class="fv-di-box hi">Gateway v2</div><div class="fv-di-box">Ledger</div><div class="fv-di-box">Bank API</div></div>
          <div class="fv-di-row"><div class="fv-di-box" style="font-size:8.5px;opacity:.7">+ idempotency key on retry (v2.1)</div></div>
        </div>
        <div class="fv-di-atts">
          <span class="fv-di-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>Walkthrough 6:42</span>
          <span class="fv-di-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>Sequence diagram</span>
          <span class="fv-di-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>Appendix A.pdf</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>3. Version control, built for iteration.</h3>
      <p>A spec can move from v1.0 to v2.3 inside a sprint. Every version preserved. What changed is visible as a diff. Reviewers see the delta since their last sign-off, not the whole doc from scratch. No "can you re-send me the latest version" ever again.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Version Control <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-ver">
        <div class="fv-ver-title">PROJ-341 history <span class="fv-ver-badge">LIVE v2.1</span></div>
        <div class="fv-ver-row live"><span class="fv-ver-num">2.1</span><div class="fv-ver-body"><div class="fv-ver-summary">Idempotency, rollback plan, token-gen moved to header</div><div class="fv-ver-meta">Mar 28 &middot; Platform Eng</div></div></div>
        <div class="fv-ver-row"><span class="fv-ver-num">2.0</span><div class="fv-ver-body"><div class="fv-ver-summary">Phase 2 scope, initial draft after Arch review</div><div class="fv-ver-meta">Mar 22 &middot; Platform Eng</div></div></div>
        <div class="fv-ver-row"><span class="fv-ver-num">1.3</span><div class="fv-ver-body"><div class="fv-ver-summary">Phase 1 sign-off &middot; locked for dev</div><div class="fv-ver-meta">Mar 04 &middot; Architecture</div></div></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
      <h3>4. Threaded comments and cross-shift targeting.</h3>
      <p>Reviewers leave comments inline on the spec, threaded, resolvable, attributable. Target the spec to the reviewers that matter: Arch in Bangalore, QA in Poland, Product in Austin. Everyone sees what's pending and what's closed. No separate Slack channel for the questions.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Interaction &amp; Comments <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-async">
        <div class="fv-a-title">PROJ-341, Review targeting</div>
        <div class="fv-a-row"><span class="fv-a-geo">&#x1F1EE;&#x1F1F3;</span><div class="fv-a-body"><div class="fv-a-team">Architecture</div><div class="fv-a-shift">Bangalore &middot; IST</div></div><span class="fv-a-count">3 reviewers</span></div>
        <div class="fv-a-row"><span class="fv-a-geo">&#x1F1FA;&#x1F1F8;</span><div class="fv-a-body"><div class="fv-a-team">Product</div><div class="fv-a-shift">Austin &middot; CST</div></div><span class="fv-a-count">2 reviewers</span></div>
        <div class="fv-a-row"><span class="fv-a-geo">&#x1F1F5;&#x1F1F1;</span><div class="fv-a-body"><div class="fv-a-team">QA &amp; SecOps</div><div class="fv-a-shift">Kraków &middot; CET</div></div><span class="fv-a-count">4 reviewers</span></div>
        <div class="fv-a-row"><span class="fv-a-geo">&#x1F1F8;&#x1F1EC;</span><div class="fv-a-body"><div class="fv-a-team">Platform Eng</div><div class="fv-a-shift">Singapore &middot; SGT</div></div><span class="fv-a-count">2 reviewers</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>5. 4D Intelligent Search, answers without a handover call.</h3>
      <p>Search across spec titles, body, attached files, and the content inside those files. "Where is the idempotency key defined?" returns the exact section from BRD-337, plus the architecture decision log thread, plus the QA test case that covers it. An engineer in Austin finds the answer at 10 AM Central without pinging the architect in Bangalore at 3 AM.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore 4D Intelligent Search <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-br-search">
        <div class="fv-bs-title">Advanced Spec Search</div>
        <div class="fv-bs-input">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span class="fv-bs-q">idempotency key retry</span>
        </div>
        <div class="fv-bs-res">
          <div class="fv-bs-res-head"><span class="fv-bs-res-title">BRD-337 Payment Gateway</span><span class="fv-bs-res-scope">Body</span></div>
          <div class="fv-bs-res-sub">"...retry must carry the idempotency key as header in section 3.2..."</div>
        </div>
        <div class="fv-bs-res">
          <div class="fv-bs-res-head"><span class="fv-bs-res-title">Arch Decision Log</span><span class="fv-bs-res-scope">In-file</span></div>
          <div class="fv-bs-res-sub">"Token-gen in header, approved Mar 12..."</div>
        </div>
        <div class="fv-bs-res">
          <div class="fv-bs-res-head"><span class="fv-bs-res-title">QA Test Matrix</span><span class="fv-bs-res-scope">Attachment</span></div>
          <div class="fv-bs-res-sub">"TC-044: duplicate request with same key..."</div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>6. AI summaries that shrink new-joiner onboarding.</h3>
      <p>A new engineer joins a programme in the middle of sprint 7. Auto-generated summaries of every BRD, the goals, the decisions, the constraints, the open questions, get them productive in an hour instead of a week of scattered reading. The same AI stack that powers PolicyGPT, applied to specifications.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Gen AI Intelligence <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-br-ai">
        <div class="fv-ba-header">
          <span class="fv-ba-badge">&#x2728; AI SUMMARY</span>
          <span class="fv-ba-title">BRD-337 Payment Gateway v2.1</span>
        </div>
        <div class="fv-ba-summary-box">
          <div class="fv-ba-summary-label">Decisions in one glance</div>
          <div class="fv-ba-summary-item">Idempotency key required on all retry calls</div>
          <div class="fv-ba-summary-item">Token generation moved to request header (v2.1)</div>
          <div class="fv-ba-summary-item">Rollback plan via feature flag in Phase 2</div>
          <div class="fv-ba-summary-item">SecOps tokenisation approved Mar 12</div>
        </div>
        <div class="fv-ba-onboard">
          <div class="fv-ba-onboard-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
          <div class="fv-ba-onboard-text">
            <div class="fv-ba-onboard-title">Ideal for new joiners</div>
            <div class="fv-ba-onboard-sub">An hour of reading. A week saved on shadowing.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real handoffs. <span class="g-text">Actually handed off.</span></h2>
    <p>Five situations a distributed delivery team will recognise from the last sprint.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <h3>End-of-day spec handover</h3>
      <p>A tech lead in Bangalore finishes v2.1 at 8 PM IST. Publishes with a short changelog. The Austin and Kraków teams wake up to the current version, the diff since v2.0, and a two-line summary of what's changed, not a 3 AM email.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version diff &rarr; Cross-shift targeting &rarr; Async review</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
      <h3>The QA question that used to loop for a day</h3>
      <p>QA in Poland hits an edge case in the spec at 9 AM their time. Drops a comment threaded on section 3.2. The Bangalore team replies during their morning; Austin sees the resolved thread when they log in. Three zones, one conversation, no dropped context.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Threaded inline comments &rarr; Resolvable &rarr; Visible to all</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h3>Upload the Word doc you've already written</h3>
      <p>Product has a BRD in Word. Upload, auto-convert, review, publish, no re-authoring in a different tool. Tables preserved, headings preserved, images embedded. The spec is live on the platform the same day.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>.docx upload &rarr; auto HTML conversion</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>"What version did we commit to in the SOW?"</h3>
      <p>A customer escalation six weeks after a delivery. The Delivery Lead pulls up the BRD, clicks to v1.3, sees the signatories and timestamps from the Phase 1 sign-off. Argument over, facts win.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version history &rarr; Sign-off trail &rarr; Immutable</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>A new engineer joins a programme mid-sprint</h3>
      <p>Evergreen targeting pushes them the current BRD, Architecture doc, decision log, and rollback plan on day one. Search across the project docs surfaces the answer to "what does the idempotency key look like in practice?" without a single handover call.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Evergreen inclusion &rarr; 4D Search &rarr; Self-serve onboarding</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "which version is the latest?" <br>to <span class="g-text">"the platform knows."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Handover quality</h3>
      <p>From <strong>3 AM email attachments</strong> to <strong>async sign-offs with visible diffs</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Spec conversations</h3>
      <p>From <strong>scattered Slack threads</strong> to <strong>inline threaded comments</strong> tied to the section.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Onboarding an engineer</h3>
      <p>From <strong>shared-drive scavenger hunt</strong> to <strong>day-one access to the current, approved spec</strong>.</p>
    </div>
  </div>
</div>
</section>

<!-- LIVE CUSTOMERS -->
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

<!-- CTA -->
<section class="uc-cta">
<div class="container">
  <div class="cta-inner reveal" style="text-align:center;max-width:720px;margin:0 auto">
    <h2>Ready to stop losing the thread <span class="g-text">between shifts?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a BRD or spec from a programme you're running. In 20 minutes we'll show you what the upload, version diff, threaded reviews, and cross-shift targeting would look like on your next handover.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
