<?php
/* Template Name: Use Case - Retail Operations */
get_header();
?>
<style>
/* Page-specific accent, rose/crimson (warmth + premium retail) */
:root { --accent:#E11D48; --accent-dark:#BE123C; --accent-light:#FFF1F2; --accent-border:rgba(225,29,72,.18); }

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
.ro-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#E11D48,#BE123C);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

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
    <h1>From the goldsmith's bench <br>to <span class="accent">every store window.</span></h1>
    <p class="subtitle">Design catalogues, hallmarking SOPs, KYC rules for high-value sales, festival pricing, vendor advisories, delivered to every store, the bench team, and partner suppliers, in the right language, with acknowledgement from every store manager. Built for Retail Operations, Merchandising, Store Excellence, and Compliance teams at multi-store specialty retailers.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Retail Operations</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ro-mockup">
      <div class="ro-dash">
        <div class="ro-titlebar">
          <div class="ro-dots"><span></span><span></span><span></span></div>
          <span class="ro-titlebar-text">Store Operations Console</span>
          <span class="ro-titlebar-badge">LIVE TODAY</span>
        </div>
        <div class="ro-body">
          <div class="ro-pin-head">
            <span class="ro-pin-tag">&#x1F4CC; Pinned for stores</span>
            <span class="ro-pin-priority">EFFECTIVE TODAY</span>
          </div>
          <div class="ro-pin-title">Akshaya Tritiya pricing protocol &middot; South region</div>
          <div class="ro-pin-meta">Audience: 78 stores across TN, KL, KA, AP/TG &middot; Effective Apr 22, 6:00 AM</div>

          <div class="ro-section-label">Acknowledgement by state</div>
          <div class="ro-state-row"><span class="ro-state"><span class="ro-state-flag">&#x1F1EE;&#x1F1F3;</span>Tamil Nadu <span class="ro-state-stores">&middot; 24</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:96%"></div></div><span class="ro-state-pct">96%</span></div>
          <div class="ro-state-row"><span class="ro-state"><span class="ro-state-flag">&#x1F1EE;&#x1F1F3;</span>Kerala <span class="ro-state-stores">&middot; 18</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:91%"></div></div><span class="ro-state-pct">91%</span></div>
          <div class="ro-state-row"><span class="ro-state"><span class="ro-state-flag">&#x1F1EE;&#x1F1F3;</span>Karnataka <span class="ro-state-stores">&middot; 21</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:88%"></div></div><span class="ro-state-pct">88%</span></div>
          <div class="ro-state-row"><span class="ro-state"><span class="ro-state-flag">&#x1F1EE;&#x1F1F3;</span>AP &amp; Telangana <span class="ro-state-stores">&middot; 15</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:82%"></div></div><span class="ro-state-pct">82%</span></div>

          <div class="ro-divider"></div>

          <div class="ro-design">
            <div class="ro-design-icon">&#x1F48E;</div>
            <div class="ro-design-body">
              <div class="ro-design-name">New release &middot; Anantha Bridal Collection</div>
              <div class="ro-design-meta">Live for 78 stores &middot; Karigar spec pushed to bench &middot; pricing tiers attached</div>
            </div>
          </div>
        </div>
      </div>

      <div class="ro-float-bench">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
          <h3>Bench team</h3>
        </div>
        <div class="ro-bench-row"><span>Hallmarking SOP v3.2</span><strong>41/42</strong></div>
        <div class="ro-bench-row"><span>Karigar spec, new</span><strong>38/42</strong></div>
        <div class="ro-bench-row"><span>BIS revision note</span><strong>42/42</strong></div>
      </div>

      <div class="ro-float-vendor">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
          <h3>Vendor consortium</h3>
        </div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Mysuru Karigar group</span><span class="ro-vendor-stat">12/14</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Coimbatore casting unit</span><span class="ro-vendor-stat">8/9</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot pending"></span><span class="ro-vendor-name">Gem supplier &middot; SJP</span><span class="ro-vendor-stat">2/3</span></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>When 80 store managers and 40 karigars need <span class="g-text">the same story today.</span></h2>
    <p>A new collection drops on Friday, but the hallmarking certificate format changed last week. A festival pricing rule applies to the Tamil Nadu stores but not Kerala. A regulatory advisory on high-value cash KYC needs to reach every store manager before opening today. And the manufacturing partners, the goldsmiths, the gem suppliers, the casting unit, have to align on the same design specs the merchandiser signed off last night.</p>
    <p>A jewellery business runs on trust, craft, and tight margins. Retail Operations on PolicyCentral.ai gives store managers, the bench, and partner suppliers one source of truth, one acknowledgement trail, one platform, without the WhatsApp chaos.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a south India jewellery chain</span>
      <h3>Eighty retail stores. Forty partner karigars. One source of truth.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A jewellery business headquartered in Tamil Nadu or Karnataka with seventy to eighty showrooms across the four southern states, a central manufacturing plant, and a network of partner goldsmiths and gem houses. Every week, dozens of communications need to land precisely: a new design release with pricing, a regulatory KYC advisory for cash transactions over a defined threshold, a hallmarking SOP update from BIS, a festival promo limited to the Karnataka stores, a vendor circular to the casting unit about a quality issue.</p>
      <p><strong>WhatsApp groups carry too much noise and zero proof. Email is invisible on the showroom floor. The store manager in Madurai cannot be expected to scroll through fifty messages to find today's pricing chart.</strong> Retail Operations needs precision targeting, by store, by region, by partner, with acknowledgement and a record an auditor can read.</p>
      <p>That's what Retail Operations on PolicyCentral.ai looks like. The store manager opens the app on their phone, sees today's update pinned, acknowledges it, and the regional ops head sees the green tick light up on the dashboard.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">retail operations.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <h3>Store-level targeting, partner-level distribution.</h3>
      <p>Push a circular to every Tamil Nadu store, or to the bridal showroom in Coimbatore, or to the fourteen partner karigars in the Mysuru consortium. AD- or HRMS-synced audience lists update automatically when a store opens, when a partner joins, when a manager transfers. The targeting stays accurate without manual upkeep.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaud">
        <div class="fv-roa-title">Audience, Akshaya Tritiya protocol</div>
        <div class="fv-roa-label">States</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Tamil Nadu</span>
          <span class="fv-roa-chip on">Kerala</span>
          <span class="fv-roa-chip on">Karnataka</span>
          <span class="fv-roa-chip on">AP &amp; TG</span>
          <span class="fv-roa-chip">Maharashtra</span>
        </div>
        <div class="fv-roa-label">Store format</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Flagship</span>
          <span class="fv-roa-chip on">Bridal</span>
          <span class="fv-roa-chip on">High-street</span>
          <span class="fv-roa-chip">Franchise</span>
        </div>
        <div class="fv-roa-label">Role</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Store Manager</span>
          <span class="fv-roa-chip on">Floor Sales</span>
          <span class="fv-roa-chip on">Cashier</span>
        </div>
        <div class="fv-roa-count"><span>Matches</span><strong>78 stores &middot; 1,142 staff</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Tamil, Malayalam, Kannada, Telugu, at the showroom counter.</h3>
      <p>A new hallmarking SOP auto-translated into the regional language each store reads first. A festival pricing chart in Tamil for Chennai, in Kannada for Bengaluru. A vendor circular in the language the karigar uses. Comprehension up, mis-pricing down, the showroom staff stop translating in their head and start serving the customer in front of them.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Translation <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rolang">
        <div class="fv-rol-title">Languages auto-prepared <span class="fv-rol-badge">4 SOUTH</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Tamil</div><div class="fv-rol-sample">அக்ஷய திருதியை விலை நிர்ணய நெறிமுறை</div></div><span class="fv-rol-done">READY</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Malayalam</div><div class="fv-rol-sample">അക്ഷയ തൃതീയ വില സംബന്ധിച്ച പ്രോട്ടോക്കോൾ</div></div><span class="fv-rol-done">READY</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Kannada</div><div class="fv-rol-sample">ಅಕ್ಷಯ ತೃತೀಯಾ ಬೆಲೆ ಪ್ರೋಟೋಕಾಲ್</div></div><span class="fv-rol-done">READY</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-rol-body"><div class="fv-rol-name">Telugu</div><div class="fv-rol-sample">అక్షయ తృతీయ ధర ప్రోటోకాల్</div></div><span class="fv-rol-done">READY</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg></div>
      <h3>Vendor and partner circulars, on the same platform.</h3>
      <p>The karigar workshop, the gem supplier, the casting unit, the logistics partner, all onboarded as external groups with bounded access to just the documents that concern them. A vendor advisory on a quality issue, the karigar consortium's design brief, the supplier code of conduct, all delivered, all acknowledged, all logged, without giving anyone visibility into what they shouldn't see.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Partner Distribution <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rovendor">
        <div class="fv-rv-title">External partner groups</div>
        <div class="fv-rv-group on">
          <div class="fv-rv-head"><span class="fv-rv-name">Mysuru Karigar Consortium</span><span class="fv-rv-tag">14 members</span></div>
          <div class="fv-rv-docs"><strong>Visible:</strong> Design briefs, hallmarking spec, payout schedule</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">Coimbatore Casting Unit</span><span class="fv-rv-tag">9 staff</span></div>
          <div class="fv-rv-docs"><strong>Visible:</strong> Casting SOP, quality advisories, dispatch calendar</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">Gem supplier &middot; SJP</span><span class="fv-rv-tag">3 contacts</span></div>
          <div class="fv-rv-docs"><strong>Visible:</strong> Code of conduct, certification requirements</div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>The high-value sale, the right SOP in hand.</h3>
      <p>A high-value cash sale walks in at 3 PM. The salesperson opens the KYC SOP on their counter terminal, follows the visual flowchart for the threshold, ticks off the steps, and reaches the manager-approval step. The escalation route is one tap away. The customer never sees the staff hunt for the right form.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore SOPs &amp; Quizzes <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rosop">
        <div class="fv-rs-title">High-value KYC SOP <span class="fv-rs-badge">v3.2 LIVE</span></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Capture customer photo ID</div><div class="fv-rs-sub">Aadhaar masked, PAN scanned</div></div></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Source-of-funds declaration</div><div class="fv-rs-sub">Captured &middot; signed</div></div></div>
        <div class="fv-rs-step escalate"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><div><div class="fv-rs-text">Manager approval required</div><div class="fv-rs-sub">Threshold breach &middot; one-tap escalate</div></div></div>
        <div class="fv-rs-step"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg></div><div><div class="fv-rs-text">CTR filing trigger</div><div class="fv-rs-sub">Pending after manager sign</div></div></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
      <h3>Design and pricing changes, live in ten minutes.</h3>
      <p>Merchandising pushes a new collection note: design specs, pricing tiers, region exclusivity, making-charge bands, SKU codes, the bench-team manufacturing spec. Every store manager sees the update on the next dashboard refresh; the bench team gets the spec in their queue. No more "the price chart from yesterday or today?" confusion at the counter.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rodesign">
        <div class="fv-rd-title">New release, today <span class="fv-rd-pill">LIVE 10:42 AM</span></div>
        <div class="fv-rd-card">
          <div class="fv-rd-name">Anantha Bridal Collection</div>
          <div class="fv-rd-sku">SKU prefix ABC-2026 &middot; 14 designs &middot; 22K</div>
          <div class="fv-rd-grid">
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Stores</div><div class="fv-rd-cell-v">78 live</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Bench spec</div><div class="fv-rd-cell-v">In queue</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Pricing tiers</div><div class="fv-rd-cell-v">4 bands</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Making charge</div><div class="fv-rd-cell-v">12&ndash;18%</div></div>
          </div>
        </div>
        <div class="fv-rd-foot"><span>Acknowledged by store managers</span><strong>71 / 78</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>The auditor, the BIS inspector, the regulator, answered in one filter.</h3>
      <p>Hallmarking SOPs by version, KYC training acknowledgements by store, BIS compliance trail by year, vendor agreement acceptances by partner, every record timestamped, filterable, exportable. The next regulator visit becomes a five-minute report, not a five-week scramble through Outlook and shared drives.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaudit">
        <div class="fv-rau-head">
          <div class="fv-rau-title">BIS audit pull, FY26</div>
          <span class="fv-rau-export">EXPORT &darr;</span>
        </div>
        <div class="fv-rau-filter">
          <span class="fv-rau-fchip">Region: South</span>
          <span class="fv-rau-fchip">Year: FY26</span>
          <span class="fv-rau-fchip">Doc: Hallmarking SOP</span>
        </div>
        <div class="fv-rau-row"><span class="fv-rau-name">Stores covered</span><span class="fv-rau-val">78 / 78</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Manager acks (v3.2)</span><span class="fv-rau-val">100%</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Bench team acks</span><span class="fv-rau-val">42 / 42</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Quiz pass rate</span><span class="fv-rau-val">96%</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Versions in trail</span><span class="fv-rau-val">v3.0, v3.1, v3.2</span></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the regional ops and merchandising teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
        <h3>Store app on the showroom phone <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Your brand, on iOS and Android, from your enterprise app store accounts. The pricing chart lives on the phone the floor staff already carry.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Festival &amp; regulator calendar <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Akshaya Tritiya, Dhanteras, Onam, regional festivals, regulator deadlines, all on one calendar the regional ops can subscribe to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
        <h3>Top Deck for stores <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Today's must-read pinned to the top of every store manager's home screen. Pricing protocols, advisories, festival rules, never scrolled past.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        <h3>Push notifications, time-sensitive <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>A pricing correction at 9 PM lands as a push before opening tomorrow. Acknowledge from the lock screen.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>SSO &amp; HRMS sync <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Store transfers, new joiners, role changes, all flow in automatically. The targeting stays current without HR or IT intervention.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Per-partner activity report <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>For every karigar, every gem supplier, every casting unit, a clean trail of what they received, signed, and read. Useful at contract renewal time.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real stores.</span></h2>
    <p>Five situations a regional retail operations team faces every season.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>Akshaya Tritiya morning, before 10 AM</h3>
      <p>Today's pricing protocol must land at all 78 stores before opening. The merchandising head publishes once; eight minutes later every store manager has the chart pinned in the regional language, with manager-level acknowledgement starting to roll in.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Targeted distribution &rarr; Regional language &rarr; Push to mobile</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h3>BIS hallmarking rule change</h3>
      <p>BIS notifies a revised standard on Friday. The bench team needs the new spec on Monday. Compliance publishes v3.2; the karigar consortium and the in-house bench acknowledge by the end of the weekend, with quiz scores backing the read.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version control &rarr; Partner distribution &rarr; Quiz</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>The high-value cash sale at 3 PM</h3>
      <p>A walk-in for a six-figure cash purchase. The salesperson opens the SOP at the counter, follows the visual flow, escalates to the manager at the threshold step, and completes the transaction without missing a KYC checkpoint.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Visual SOP &rarr; In-platform escalation &rarr; Audit trail</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
      <h3>A karigar partner quality issue</h3>
      <p>A repeat defect surfaces from one casting unit. The vendor-management lead publishes a quality advisory only to that consortium, with the affected SKUs, the corrective action, and an acknowledgement deadline. No naming-and-shaming on a shared group; a clean record on file.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Bounded vendor portal &rarr; Acknowledgement &rarr; Trail</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <h3>The auditor asks for "every KYC training ack from the Chennai region, last year"</h3>
      <p>One filter, one export. Stores, managers, training dates, quiz scores, all in the format the audit team expects. The compliance officer responds before lunch, not at the end of a week-long scramble.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Audit dashboard &rarr; Filter &rarr; Export</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "did it land at every store?" <br>to <span class="g-text">"every store, every partner, signed."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Store communication</h3>
      <p>From <strong>WhatsApp groups everyone's tuning out</strong> to <strong>pinned in the store app, signed before opening</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Partner alignment</h3>
      <p>From <strong>"the bench got it on email, I think"</strong> to <strong>partner-level acknowledgement, on record</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Regulator response</h3>
      <p>From <strong>"we'll get back next week"</strong> to <strong>exported and submitted the same afternoon</strong>.</p>
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
    <h2>Ready to bring your showroom floor <span class="g-text">on to one platform?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring your hallmarking SOP, a festival pricing chart, and a vendor circular. In 20 minutes we'll show you what the store manager sees, what the karigar consortium sees, and what the next BIS report looks like.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
