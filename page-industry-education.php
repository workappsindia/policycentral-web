<?php
/* Template Name: Industry - Education */
get_header();
?>
<style>
/* Page-specific accent, violet/indigo (knowledge + education) */
:root { --accent:#7C3AED; --accent-dark:#6D28D9; --accent-light:#F5F3FF; --accent-border:rgba(124,58,237,.20); }

/* ── HERO VISUAL: Store Operations Console ── */
.ro-mockup{position:relative;width:100%;max-width:520px;animation:roFloat 7s ease-in-out infinite}
@keyframes roFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes roCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.ro-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.ro-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.ro-dots{display:flex;gap:5px}
.ro-dots span{width:9px;height:9px;border-radius:50%}
.ro-dots span:nth-child(1){background:#EF4444}
.ro-dots span:nth-child(2){background:#F59E0B}
.ro-dots span:nth-child(3){background:#22C55E}
.ro-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.ro-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.ro-body{padding:16px}
.ro-pin-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.ro-pin-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.ro-pin-priority{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(217,119,6,.1);color:#B45309;border:1px solid rgba(217,119,6,.2)}
.ro-pin-title{font-size:14px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.ro-pin-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

.ro-section-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}

.ro-state-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.ro-state{flex:1.1;font-size:10.5px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:6px}
.ro-state-flag{font-size:12px}
.ro-state-stores{font-size:9px;color:var(--gray-500);font-weight:600}
.ro-state-bar{flex:1.4;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.ro-state-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.ro-state-pct{font-size:10px;font-weight:800;color:var(--accent-dark);min-width:34px;text-align:right}

.ro-divider{height:1px;background:var(--gray-100);margin:12px 0}

.ro-design{padding:10px 12px;border-radius:10px;background:linear-gradient(135deg,var(--accent-light) 0%,#FFFAF5 100%);border:1px solid var(--accent-border);display:flex;align-items:center;gap:10px}
.ro-design-icon{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:14px}
.ro-design-body{flex:1;min-width:0;font-family:'Plus Jakarta Sans',sans-serif}
.ro-design-name{font-size:11px;font-weight:800;color:var(--gray-900);line-height:1.3}
.ro-design-meta{font-size:9.5px;color:var(--gray-500);font-weight:600;margin-top:1px}

.ro-float-bench{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:180px;animation:roCardIn .6s ease-out both;animation-delay:.3s}
.ro-float-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.ro-float-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.ro-float-icon svg{width:11px;height:11px;color:#fff}
.ro-float-head h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.ro-bench-row{display:flex;justify-content:space-between;align-items:center;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-700);font-weight:700}
.ro-bench-row strong{color:var(--accent-dark);font-weight:800}

.ro-float-vendor{position:absolute;bottom:-18px;left:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:200px;animation:roCardIn .6s ease-out both;animation-delay:.55s}
.ro-vendor-row{display:flex;align-items:center;gap:8px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px}
.ro-vendor-dot{width:8px;height:8px;border-radius:50%;background:#059669;flex-shrink:0;box-shadow:0 0 0 2px rgba(5,150,105,.2)}
.ro-vendor-dot.pending{background:var(--gray-300);box-shadow:none}
.ro-vendor-name{flex:1;font-weight:700;color:var(--gray-800)}
.ro-vendor-stat{color:var(--gray-500);font-weight:600}

/* Shared section styles */
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

/* Capability 1: Audience targeting */
.fv-roaud{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-roa-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-roa-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.fv-roa-chips{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:10px}
.fv-roa-chip{padding:4px 9px;border-radius:5px;background:var(--gray-100);color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;border:1px solid var(--gray-200)}
.fv-roa-chip.on{background:var(--accent-light);color:var(--accent-dark);border-color:var(--accent-border)}
.fv-roa-count{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--gray-500);padding:8px 0;border-top:1px solid var(--gray-100);margin-top:6px;display:flex;justify-content:space-between;font-weight:600}
.fv-roa-count strong{color:var(--accent-dark);font-weight:800}

/* Capability 2: Regional languages */
.fv-rolang{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rol-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px;display:flex;justify-content:space-between;align-items:center}
.fv-rol-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-rol-row{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:9px;margin-bottom:4px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-rol-flag{font-size:15px}
.fv-rol-body{flex:1;min-width:0}
.fv-rol-name{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-rol-sample{font-size:9.5px;color:var(--gray-500);margin-top:1px;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fv-rol-done{padding:2px 7px;border-radius:5px;font-size:8.5px;font-weight:800;background:rgba(5,150,105,.1);color:#047857;border:1px solid rgba(5,150,105,.2);letter-spacing:.02em}

/* Capability 3: Vendor portal */
.fv-rovendor{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rv-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-rv-group{padding:10px 12px;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:6px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-rv-group.on{background:linear-gradient(135deg,var(--accent-light) 0%,#FFFAF5 100%);border-color:var(--accent-border)}
.fv-rv-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.fv-rv-name{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-rv-tag{font-size:9px;font-weight:800;padding:2px 7px;border-radius:5px;background:#fff;color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-rv-docs{font-size:9.5px;color:var(--gray-500);font-weight:600;line-height:1.45}
.fv-rv-docs strong{color:var(--gray-800);font-weight:800}

/* Capability 4: SOP flowchart */
.fv-rosop{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-rs-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;justify-content:space-between}
.fv-rs-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-rs-step{display:flex;align-items:center;gap:10px;padding:9px 11px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-rs-step.done{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.fv-rs-step.escalate{background:linear-gradient(135deg,rgba(225,29,72,.05),rgba(190,18,60,.05));border-color:rgba(225,29,72,.18)}
.fv-rs-icon{width:22px;height:22px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:var(--gray-200);color:var(--gray-500)}
.fv-rs-step.done .fv-rs-icon{background:#059669;color:#fff}
.fv-rs-step.escalate .fv-rs-icon{background:var(--accent);color:#fff}
.fv-rs-icon svg{width:11px;height:11px}
.fv-rs-text{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800)}
.fv-rs-sub{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:1px}

/* Capability 5: Design release */
.fv-rodesign{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rd-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center}
.fv-rd-pill{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;letter-spacing:.04em}
.fv-rd-card{padding:12px 14px;border-radius:11px;background:linear-gradient(135deg,var(--accent-light) 0%,#FFFAF5 100%);border:1px solid var(--accent-border);margin-bottom:10px}
.fv-rd-name{font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:800;color:var(--accent-dark);margin-bottom:3px}
.fv-rd-sku{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-600);font-weight:700}
.fv-rd-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:10px}
.fv-rd-cell{padding:6px 10px;border-radius:7px;background:#fff;border:1px solid var(--accent-border);font-family:'Plus Jakarta Sans',sans-serif}
.fv-rd-cell-l{font-size:9px;color:var(--gray-500);font-weight:800;letter-spacing:.06em;text-transform:uppercase;margin-bottom:2px}
.fv-rd-cell-v{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-rd-foot{padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600;display:flex;justify-content:space-between}
.fv-rd-foot strong{color:var(--accent-dark);font-weight:800}

/* Capability 6: Audit cube */
.fv-roaudit{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rau-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-rau-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-rau-export{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-rau-filter{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:12px}
.fv-rau-fchip{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;padding:4px 9px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-rau-row{display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px}
.fv-rau-row:first-of-type{border-top:none}
.fv-rau-name{color:var(--gray-800);font-weight:700}
.fv-rau-val{color:var(--accent-dark);font-weight:800}

/* Scenarios + changes + CTA (shared) */
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
  .ro-mockup{max-width:420px;margin:0 auto}
  .ro-float-bench{right:-8px;top:-8px}
  .ro-float-vendor{left:-8px;bottom:-10px}
  .fv-roaud,.fv-rolang,.fv-rovendor,.fv-rosop,.fv-rodesign,.fv-roaudit{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .ro-mockup{max-width:340px}
  .ro-float-bench,.ro-float-vendor{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}
}

/* ── ALSO INCLUDED ── */
.uc-also{margin-top:24px}
.uc-also-intro{text-align:center;max-width:none;margin:0 auto 28px;font-size:15px;color:var(--gray-800);line-height:1.7;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.uc-also-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;max-width:1100px;margin:0 auto}
.uc-also-card{display:block;background:#fff;border:1px solid var(--gray-200);border-radius:14px;padding:22px 20px;transition:all .25s var(--ease);text-decoration:none;color:inherit}
.uc-also-card:hover{border-color:var(--accent-border);box-shadow:var(--shadow-md);transform:translateY(-2px)}
.uc-also-icon{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.uc-also-icon svg{width:17px;height:17px;color:#fff}
.uc-also-card h3{font-family:'Plus Jakarta Sans',sans-serif;font-size:14.5px;font-weight:800;color:var(--gray-900);margin-bottom:6px;line-height:1.35;display:flex;align-items:flex-start;justify-content:space-between;gap:8px}
.uc-also-arrow{flex-shrink:0;width:14px;height:14px;color:var(--gray-400);transition:all .2s var(--spring);margin-top:3px}
.uc-also-card:hover .uc-also-arrow{color:var(--accent);transform:translateX(3px)}
.uc-also-card p{font-size:12.5px;color:var(--gray-600);line-height:1.6}
@media(max-width:900px){.uc-also-grid{grid-template-columns:repeat(2,1fr)}.uc-also-intro{white-space:normal;font-size:14px}}
@media(max-width:560px){.uc-also-grid{grid-template-columns:1fr}}
</style>


<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content">
    <h1>Every course, university and fee.<br><span class="accent">Current, and answerable.</span></h1>
    <p class="subtitle">University profiles, course catalogues, fee structures and eligibility criteria in one living, searchable library, always current and answerable in plain language. Built for admissions, counselling and student-services teams.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url("/download/presentation/")); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="<?php echo esc_url(home_url("/policygpt/")); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
      <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/industries/')); ?>">Industries</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Education</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ro-mockup">
      <div class="ro-dash">
        <div class="ro-titlebar">
          <div class="ro-dots"><span></span><span></span><span></span></div>
          <span class="ro-titlebar-text">Knowledge Library</span>
          <span class="ro-titlebar-badge">ALWAYS CURRENT</span>
        </div>
        <div class="ro-body">
          <div class="ro-pin-head">
            <span class="ro-pin-tag">&#x1F393; University profile</span>
            <span class="ro-pin-priority">UPDATED TODAY</span>
          </div>
          <div class="ro-pin-title">Amber University &middot; B.Tech Computer Science</div>
          <div class="ro-pin-meta">Intake 2026 &middot; Fee &amp; eligibility verified 12 Aug 2026</div>

          <div class="ro-section-label">Freshness by document set</div>
          <div class="ro-state-row"><span class="ro-state">Fee structure <span class="ro-state-stores">&middot; 2026</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:100%"></div></div><span class="ro-state-pct">Live</span></div>
          <div class="ro-state-row"><span class="ro-state">Eligibility &amp; cut-offs <span class="ro-state-stores">&middot; 2026</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:100%"></div></div><span class="ro-state-pct">Live</span></div>
          <div class="ro-state-row"><span class="ro-state">Scholarships <span class="ro-state-stores">&middot; review</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:64%"></div></div><span class="ro-state-pct">Due</span></div>
          <div class="ro-state-row"><span class="ro-state">Placement report <span class="ro-state-stores">&middot; 2025</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:100%"></div></div><span class="ro-state-pct">Live</span></div>

          <div class="ro-divider"></div>

          <div class="ro-design">
            <div class="ro-design-icon">&#x1F4AC;</div>
            <div class="ro-design-body">
              <div class="ro-design-name">"What is the 2026 first-year fee for CS?"</div>
              <div class="ro-design-meta">Answered from Fee Structure 2026 &middot; source cited &middot; 2 sec</div>
            </div>
          </div>
        </div>
      </div>

      <div class="ro-float-bench">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/></svg></div>
          <h3>Update trail</h3>
        </div>
        <div class="ro-bench-row"><span>Fee 2026</span><strong>Verified</strong></div>
        <div class="ro-bench-row"><span>Eligibility</span><strong>Verified</strong></div>
        <div class="ro-bench-row"><span>Scholarships</span><strong>Review</strong></div>
      </div>

      <div class="ro-float-vendor">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
          <h3>Counsellor access</h3>
        </div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Engineering desk</span><span class="ro-vendor-stat">Live</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Study-abroad desk</span><span class="ro-vendor-stat">Live</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot pending"></span><span class="ro-vendor-name">New joiner</span><span class="ro-vendor-stat">Pending</span></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>When the fee sheet a counsellor quotes is <span class="g-text">two years out of date.</span></h2>
    <p>A student asks about the 2026 fee for a course. The counsellor opens a folder full of PDFs, a brochure from last year, an email with a revised fee, a spreadsheet someone maintained and then stopped. Which number is right? Nobody is sure. Multiply that across hundreds of universities, thousands of courses, and a team of counsellors, and the single most important thing you sell, accurate guidance, rests on documents that quietly went stale.</p>
    <p>PolicyCentral.ai turns that scattered, ageing pile into one living library: every university, course, fee and eligibility rule in a single place, version-controlled, flagged for review before it expires, and answerable in plain language by any counsellor or student who asks.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a student admissions &amp; counselling firm</span>
      <h3>Hundreds of universities. Thousands of courses. One current answer.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>An admissions-services firm that matches students, by marks, skills and aptitude, to the right universities and courses. Its value is the depth of what it knows: fee structures, eligibility criteria, scholarships, intake calendars, placement records, across hundreds of institutions in India and abroad.</p>
      <p><strong>But that knowledge lives in brochures, PDFs, spreadsheets and inboxes, and most of it is dead: last year's fee, a superseded cut-off, a scholarship that no longer exists.</strong> A counsellor cannot tell, at a glance, whether the document in front of them is current, and a wrong number to a student is a trust problem, not a typo.</p>
      <p>That is what this looks like on PolicyCentral.ai. Every institution's documents live in one library, each with an owner, a verified date, and a review reminder. A counsellor asks a plain question and gets the current answer with its source cited. The student self-serves the same truth on their phone.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>From a dead document pile<br>to a <span class="g-text">living knowledge base.</span></h2>
  </div>

  <!-- 1. One living library -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
      <h3>One library, not fifty folders.</h3>
      <p>Every university, course, fee sheet, eligibility rule and scholarship in a single structured library, organised the way your counsellors think, by institution, country, stream and intake. No more hunting through shared drives, brochures and inboxes for the version that happens to be right. One place, one structure, one search.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rovendor">
        <div class="fv-rv-title">Knowledge library</div>
        <div class="fv-rv-group on">
          <div class="fv-rv-head"><span class="fv-rv-name">Amber University</span><span class="fv-rv-tag">42 courses</span></div>
          <div class="fv-rv-docs"><strong>Holds:</strong> Fees, eligibility, scholarships, placements, intake</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">Northline Institute</span><span class="fv-rv-tag">28 courses</span></div>
          <div class="fv-rv-docs"><strong>Holds:</strong> Fees, eligibility, hostel &amp; visa notes</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">Study abroad &middot; UK</span><span class="fv-rv-tag">63 courses</span></div>
          <div class="fv-rv-docs"><strong>Holds:</strong> Tuition, IELTS bands, intake calendar</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Ask in plain language -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>Ask a plain question, get a cited answer.</h3>
      <p>PolicyGPT answers from your own library, in plain language, with the source document and its date cited. "What is the 2026 first-year fee for Computer Science at Amber?" returns the current number and where it came from, in seconds. A new counsellor is productive on day one, without three months of learning where everything is buried.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore AI &amp; PolicyGPT <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rosop">
        <div class="fv-rs-title">PolicyGPT <span class="fv-rs-badge">CITED</span></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Q: 2026 first-year fee, CS at Amber?</div><div class="fv-rs-sub">Asked by Engineering desk</div></div></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">A: INR 2.4 lakh per year</div><div class="fv-rs-sub">Source: Fee Structure 2026 &middot; verified 12 Aug</div></div></div>
        <div class="fv-rs-step escalate"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v6m0 0l3-3m-3 3L9 5"/><rect x="3" y="8" width="18" height="13" rx="2"/></svg></div><div><div class="fv-rs-text">Scholarship note flagged for review</div><div class="fv-rs-sub">2025 doc &middot; ask owner to confirm</div></div></div>
      </div>
    </div>
  </div>

  <!-- 3. Always current -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="15" y2="15"/></svg></div>
      <h3>Nothing goes stale in the dark.</h3>
      <p>Every document has an owner, a verified date and a review reminder. When a fee sheet is approaching its expiry, or a university publishes a new intake, the owner is prompted to update it, and the old version is superseded, not left lying around to be quoted by mistake. "Current" stops being a hope and becomes a status you can see.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rodesign">
        <div class="fv-rd-title">Document status <span class="fv-rd-pill">TRACKED</span></div>
        <div class="fv-rd-card">
          <div class="fv-rd-name">Fee Structure &middot; Amber University</div>
          <div class="fv-rd-sku">Owner: Priya N &middot; verified 12 Aug 2026</div>
          <div class="fv-rd-grid">
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Status</div><div class="fv-rd-cell-v">Live</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Next review</div><div class="fv-rd-cell-v">Jan 2027</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Version</div><div class="fv-rd-cell-v">2026.1</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Supersedes</div><div class="fv-rd-cell-v">2025.2</div></div>
          </div>
        </div>
        <div class="fv-rd-foot"><span>Superseded versions archived</span><strong>2024, 2025</strong></div>
      </div>
    </div>
  </div>

  <!-- 4. Right counsellor, right access -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h3>The right desk sees the right shelf.</h3>
      <p>The engineering desk, the study-abroad team, the management-courses counsellors, each sees the institutions and documents that matter to them, without wading through the rest. New joiners get access by role on day one, and a fee revision or a fresh intake circular reaches exactly the counsellors who need it, with acknowledgement on record.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaud">
        <div class="fv-roa-title">Access by desk</div>
        <div class="fv-roa-label">Counselling desks</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Engineering</span>
          <span class="fv-roa-chip on">Study abroad</span>
          <span class="fv-roa-chip on">Management</span>
          <span class="fv-roa-chip">Medical</span>
        </div>
        <div class="fv-roa-label">Shared with</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Counsellors</span>
          <span class="fv-roa-chip on">Team leads</span>
          <span class="fv-roa-chip">Students</span>
        </div>
        <div class="fv-roa-count"><span>Reach</span><strong>38 counsellors &middot; 6 desks</strong></div>
      </div>
    </div>
  </div>

  <!-- 5. Multi-language + mobile for students -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Students self-serve, in their language, on their phone.</h3>
      <p>Course pages, fee summaries and eligibility explainers a student can read on their own phone, in the language they and their parents are comfortable with, with summaries and audio for the parts that matter. Fewer repeat calls to the counsellor, a better-informed student, and a family that trusts the guidance because they can see it for themselves.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore Portal &amp; Mobile App <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rolang">
        <div class="fv-rol-title">Student-ready languages <span class="fv-rol-badge">AUTO</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F310;</span><div class="fv-rol-body"><div class="fv-rol-name">English</div><div class="fv-rol-sample">Course &amp; fee summary</div></div><span class="fv-rol-done">READY</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Hindi</div><div class="fv-rol-sample">Course &amp; fee summary</div></div><span class="fv-rol-done">READY</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Marathi</div><div class="fv-rol-sample">Course &amp; fee summary</div></div><span class="fv-rol-done">READY</span></div>
      </div>
    </div>
  </div>

  <!-- 6. Usage & gaps analytics -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>See what students ask, and what you are missing.</h3>
      <p>Which courses counsellors search most, which questions PolicyGPT could not answer, which documents are overdue for review, all on one dashboard. The gaps in your knowledge base stop being invisible: you can see the university that needs a fresh fee sheet and the question your library cannot yet answer, and close them before a student notices.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaudit">
        <div class="fv-rau-head">
          <div class="fv-rau-title">Library insights &middot; this month</div>
          <span class="fv-rau-export">EXPORT &darr;</span>
        </div>
        <div class="fv-rau-filter">
          <span class="fv-rau-fchip">Top searches</span>
          <span class="fv-rau-fchip">Gaps</span>
        </div>
        <div class="fv-rau-row"><span class="fv-rau-name">Questions answered</span><span class="fv-rau-val">3,412</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Cited from library</span><span class="fv-rau-val">97%</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Unanswered, flagged</span><span class="fv-rau-val">42</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Docs overdue review</span><span class="fv-rau-val">11</span></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">The quieter capabilities admissions and counselling teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <h3>Instant summaries <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>A one-paragraph summary of any course or university page, so a counsellor briefs a family in a minute, not ten.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
        <h3>Branded student app <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Your brand, on iOS and Android, so students carry the current course and fee library in their pocket.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Intake calendar <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Application deadlines and intake windows per university, so no counsellor misses a closing date for a student.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        <h3>Update notifications <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>When a fee or eligibility rule changes, the counsellors who use it are notified, so nobody quotes yesterday's number.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
        <h3>Student questions captured <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Questions students ask most feed straight back into what the library should cover next.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>Role-based access &amp; audit <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Who can see and edit what is controlled by role, with an audit trail of every change to a fee or eligibility record.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real counsellors.</span></h2>
    <p>Five situations a student-counselling team faces every intake season.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>"What's the 2026 fee for this course?"</h3>
      <p>A student asks mid-session. The counsellor asks PolicyGPT and reads back the current fee with its source, instead of digging through folders and hoping the PDF on top is the latest one.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Ask in plain language &rarr; Cited answer</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/></svg></div>
      <h3>A university revises its fee structure</h3>
      <p>The document owner updates the fee sheet once. The new version supersedes the old, every counsellor who uses it is notified, and the outdated number stops being quotable anywhere in the firm.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version control &rarr; Supersede &rarr; Notify</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
      <h3>A new counsellor starts on Monday</h3>
      <p>Instead of months learning where everything is, they get role-based access to their desk's library and ask PolicyGPT anything. They are giving accurate guidance in their first week.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Role access &rarr; Ask the library &rarr; Productive fast</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
      <h3>A parent wants it in writing, in Hindi</h3>
      <p>The student opens the course and fee summary on their phone, in Hindi, and shares it with a parent. The family sees the same current truth the counsellor does, and trusts the advice more for it.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Translation &rarr; Mobile self-serve</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>The head of counselling asks "where are our gaps?"</h3>
      <p>One dashboard shows the questions the library could not answer, the documents overdue for review, and the universities students ask about most. The team fixes what is missing before it costs a conversion.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Usage analytics &rarr; Gap list &rarr; Close it</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "is this the latest?" <br>to <span class="g-text">"current, cited, and on every phone."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Your knowledge</h3>
      <p>From <strong>dead PDFs across folders and inboxes</strong> to <strong>one living, searchable library</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Counsellor answers</h3>
      <p>From <strong>"let me check and call you back"</strong> to <strong>a cited answer in seconds</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Student trust</h3>
      <p>From <strong>a number that might be old</strong> to <strong>the current truth, on the student's own phone</strong>.</p>
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
    <h2>Ready to turn your document pile <span class="g-text">into a living library?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a handful of your university and fee documents. In 30 minutes we'll show you the searchable library, a counsellor asking a plain question, and the student view on a phone.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/industries/')); ?>" class="btn btn-outline">Explore other industries <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
