<?php
/* Template Name: Industry - Pharma & Healthcare */
get_header();
?>
<style>
/* Page-specific accent, clinical teal/cyan (life sciences) */
:root { --accent:#0891B2; --accent-dark:#0E7490; --accent-light:#ECFEFF; --accent-border:rgba(8,145,178,.20); }
/* 21 CFR Part 11 coverage grid */
.p11{padding:100px 0;background:linear-gradient(180deg,#F9FAFB 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.p11-note{max-width:820px;margin:0 auto 44px;text-align:center;font-size:16px;color:var(--gray-600);line-height:1.75}
.p11-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;max-width:1000px;margin:0 auto}
.p11-item{display:flex;gap:14px;padding:20px 22px;border-radius:14px;background:#fff;border:1px solid var(--gray-200);transition:all .2s var(--ease)}
.p11-item:hover{border-color:var(--accent-border);box-shadow:var(--shadow-md)}
.p11-check{width:30px;height:30px;flex-shrink:0;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.p11-check svg{width:15px;height:15px;color:#fff}
.p11-req{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.06em;text-transform:uppercase;color:var(--accent-dark);margin-bottom:3px}
.p11-body h4{font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:800;color:var(--gray-900);margin-bottom:4px;line-height:1.3}
.p11-body p{font-size:13px;color:var(--gray-600);line-height:1.6}
.p11-disclaimer{max-width:900px;margin:40px auto 0;padding:20px 24px;border-radius:12px;background:var(--gray-50);border:1px solid var(--gray-200);font-size:13px;color:var(--gray-500);line-height:1.7;font-family:'Plus Jakarta Sans',sans-serif}
.p11-disclaimer strong{color:var(--gray-700);font-weight:800}
@media(max-width:768px){.p11-grid{grid-template-columns:1fr}}

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
    <h1>Controlled documents,<br>built for the <span class="accent">regulated life sciences floor.</span></h1>
    <p class="subtitle">Controlled documents, electronic signatures, audit trails and role-based approvals for SOPs, quality manuals and training records. Built to support your FDA 21 CFR Part 11 workflows for electronic records and signatures.</p>
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
      <span style="color:var(--accent)">Pharma &amp; Healthcare</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="ro-mockup">
      <div class="ro-dash">
        <div class="ro-titlebar">
          <div class="ro-dots"><span></span><span></span><span></span></div>
          <span class="ro-titlebar-text">Controlled Document Control</span>
          <span class="ro-titlebar-badge">PART 11 READY</span>
        </div>
        <div class="ro-body">
          <div class="ro-pin-head">
            <span class="ro-pin-tag">&#x1F512; Controlled SOP</span>
            <span class="ro-pin-priority">EFFECTIVE v4.0</span>
          </div>
          <div class="ro-pin-title">SOP-QA-014 &middot; Deviation Handling &amp; CAPA</div>
          <div class="ro-pin-meta">Unit II &middot; Supersedes v3.2 &middot; Next review Aug 2027</div>

          <div class="ro-section-label">Read &amp; training acknowledgement by site</div>
          <div class="ro-state-row"><span class="ro-state">Unit I, Formulations <span class="ro-state-stores">&middot; 84</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:98%"></div></div><span class="ro-state-pct">98%</span></div>
          <div class="ro-state-row"><span class="ro-state">Unit II, Injectables <span class="ro-state-stores">&middot; 66</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:95%"></div></div><span class="ro-state-pct">95%</span></div>
          <div class="ro-state-row"><span class="ro-state">QC Laboratory <span class="ro-state-stores">&middot; 41</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:100%"></div></div><span class="ro-state-pct">100%</span></div>
          <div class="ro-state-row"><span class="ro-state">R&amp;D, Analytical <span class="ro-state-stores">&middot; 29</span></span><div class="ro-state-bar"><div class="ro-state-fill" style="width:90%"></div></div><span class="ro-state-pct">90%</span></div>

          <div class="ro-divider"></div>

          <div class="ro-design">
            <div class="ro-design-icon">&#x270D;</div>
            <div class="ro-design-body">
              <div class="ro-design-name">Electronic signature applied &middot; QA Head</div>
              <div class="ro-design-meta">Reason: Approved &middot; 12 Aug 2026, 14:22 UTC &middot; locked to record</div>
            </div>
          </div>
        </div>
      </div>

      <div class="ro-float-bench">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <h3>Audit trail</h3>
        </div>
        <div class="ro-bench-row"><span>Authored</span><strong>A. Rao</strong></div>
        <div class="ro-bench-row"><span>Reviewed</span><strong>S. Mehta</strong></div>
        <div class="ro-bench-row"><span>Approved</span><strong>QA Head</strong></div>
      </div>

      <div class="ro-float-vendor">
        <div class="ro-float-head">
          <div class="ro-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
          <h3>Signature meanings</h3>
        </div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Author</span><span class="ro-vendor-stat">Signed</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">Reviewer</span><span class="ro-vendor-stat">Signed</span></div>
        <div class="ro-vendor-row"><span class="ro-vendor-dot"></span><span class="ro-vendor-name">QA Approver</span><span class="ro-vendor-stat">Signed</span></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>When an SOP change has to reach every operator, <span class="g-text">and prove it did.</span></h2>
    <p>A deviation is raised on the injectables line. The CAPA closes with a revised SOP. That revision has to be reviewed, approved with an electronic signature, made effective, and read and understood by every operator, QC analyst and supervisor it applies to, before they touch the process again. The previous version must retire cleanly, stay retrievable, and never be mistaken for the current one.</p>
    <p>PolicyCentral.ai gives QA, Regulatory and Manufacturing one controlled system for that: a single document lifecycle, electronic signatures with meaning, an audit trail that cannot be edited, and training acknowledgement tied to the exact revision, built to support your 21 CFR Part 11 workflows.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a mid-size pharma manufacturer</span>
      <h3>Two plants. Four hundred SOPs. One version of the truth.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A formulations and injectables manufacturer with two sites, a QC laboratory, an R&amp;D group, and a few hundred controlled SOPs, quality manuals and work instructions. Every month brings revisions: a CAPA-driven SOP update, a change control that touches three documents, a new regulatory guidance that has to cascade to the shop floor, and a training obligation attached to each one.</p>
      <p><strong>Shared drives and printed binders cannot prove who read the current version, cannot stop someone working to a superseded revision, and turn an inspection into a scramble.</strong> The quality team needs controlled documents, electronic signatures, a clean audit trail, and training records an auditor can read in one filter.</p>
      <p>That is what this looks like on PolicyCentral.ai. The operator opens the effective SOP on the shop floor tablet, the system logs the read and the training acknowledgement, and the QA lead watches coverage climb on the dashboard, revision by revision.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>The controls a regulated <br>quality system <span class="g-text">expects.</span></h2>
  </div>

  <!-- 1. Controlled document lifecycle -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>A controlled lifecycle, Draft to Obsolete.</h3>
      <p>Every controlled document moves through defined states: Draft, In Review, Approved, Effective, and Obsolete. Only an Effective version is visible to the floor. When a revision is approved, the prior version retires automatically and stays retrievable in the archive. No document goes live without passing through review and approval, and nothing effective can be quietly edited underneath your people.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rosop">
        <div class="fv-rs-title">SOP-QA-014 lifecycle <span class="fv-rs-badge">v4.0</span></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Draft authored</div><div class="fv-rs-sub">A. Rao &middot; change control CC-2211</div></div></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Reviewed</div><div class="fv-rs-sub">QA reviewer &middot; e-signed</div></div></div>
        <div class="fv-rs-step done"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div><div class="fv-rs-text">Approved</div><div class="fv-rs-sub">QA Head &middot; reason: Approved</div></div></div>
        <div class="fv-rs-step escalate"><div class="fv-rs-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div><div class="fv-rs-text">Effective &middot; v3.2 superseded</div><div class="fv-rs-sub">Prior version archived, retrievable</div></div></div>
      </div>
    </div>
  </div>

  <!-- 2. Electronic signatures -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg></div>
      <h3>Electronic signatures that carry meaning.</h3>
      <p>Each signature records who signed, when, and what the signature means, Authored, Reviewed, Approved, or Acknowledged. The signature is bound permanently to that record and that version. It cannot be copied to another document or transferred to another user. Re-authentication at the point of signing and a captured signing reason make each approval defensible when an inspector asks how it was applied.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore E-signatures &amp; Acknowledgement <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rolang">
        <div class="fv-rol-title">Signatures on this record <span class="fv-rol-badge">BOUND</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F464;</span><div class="fv-rol-body"><div class="fv-rol-name">A. Rao &middot; Author</div><div class="fv-rol-sample">Meaning: Authored &middot; 11 Aug 10:04 UTC</div></div><span class="fv-rol-done">SIGNED</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F464;</span><div class="fv-rol-body"><div class="fv-rol-name">S. Mehta &middot; Reviewer</div><div class="fv-rol-sample">Meaning: Reviewed &middot; 11 Aug 16:41 UTC</div></div><span class="fv-rol-done">SIGNED</span></div>
        <div class="fv-rol-row"><span class="fv-rol-flag">&#x1F464;</span><div class="fv-rol-body"><div class="fv-rol-name">QA Head &middot; Approver</div><div class="fv-rol-sample">Meaning: Approved &middot; 12 Aug 14:22 UTC</div></div><span class="fv-rol-done">SIGNED</span></div>
      </div>
    </div>
  </div>

  <!-- 3. Audit trail -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v6m0 0l3-3m-3 3L9 5"/><rect x="3" y="8" width="18" height="13" rx="2"/><line x1="7" y1="13" x2="17" y2="13"/><line x1="7" y1="17" x2="13" y2="17"/></svg></div>
      <h3>An audit trail that cannot be edited.</h3>
      <p>Every material action, created, edited, reviewed, approved, made effective, superseded, read, acknowledged, is written to a time-stamped trail that no user, including an administrator, can alter or delete. Where a value changed, the trail holds the previous and the new value. When the auditor asks who approved SOP-QA-014 v4.0 and who was trained on it, the answer is one filter and one export, not a week in shared drives and inboxes.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaudit">
        <div class="fv-rau-head">
          <div class="fv-rau-title">Audit trail &middot; SOP-QA-014</div>
          <span class="fv-rau-export">EXPORT &darr;</span>
        </div>
        <div class="fv-rau-filter">
          <span class="fv-rau-fchip">Doc: SOP-QA-014</span>
          <span class="fv-rau-fchip">Version: v4.0</span>
        </div>
        <div class="fv-rau-row"><span class="fv-rau-name">10:04 &middot; Created</span><span class="fv-rau-val">A. Rao</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">16:41 &middot; Reviewed</span><span class="fv-rau-val">S. Mehta</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">14:22 &middot; Approved</span><span class="fv-rau-val">QA Head</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">14:23 &middot; Effective</span><span class="fv-rau-val">System</span></div>
        <div class="fv-rau-row"><span class="fv-rau-name">Locked &middot; tamper-evident</span><span class="fv-rau-val">Yes</span></div>
      </div>
    </div>
  </div>

  <!-- 4. Role-based access & maker-checker -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h3>Role-based access, maker and checker kept apart.</h3>
      <p>Operators view and author. Reviewers review and comment. QA managers approve or reject. Administrators configure the system. The person who drafts a document cannot be the one who approves it, so segregation of duties is enforced by the platform, not by trust. Access is granted by role, site and function, and it updates automatically as people join, move or leave.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rovendor">
        <div class="fv-rv-title">Roles &amp; permissions</div>
        <div class="fv-rv-group on">
          <div class="fv-rv-head"><span class="fv-rv-name">Operator</span><span class="fv-rv-tag">Shop floor</span></div>
          <div class="fv-rv-docs"><strong>Can:</strong> View effective SOPs, acknowledge, complete training</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">Reviewer</span><span class="fv-rv-tag">QA</span></div>
          <div class="fv-rv-docs"><strong>Can:</strong> Review, comment, e-sign as Reviewed</div>
        </div>
        <div class="fv-rv-group">
          <div class="fv-rv-head"><span class="fv-rv-name">QA Manager</span><span class="fv-rv-tag">Approver</span></div>
          <div class="fv-rv-docs"><strong>Can:</strong> Approve or reject, make effective, retire versions</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 5. Version history & controlled revisions -->
  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="15" y2="15"/></svg></div>
      <h3>Every revision on record, none of them lost.</h3>
      <p>A controlled document cannot be changed in place. Any edit creates a new, numbered revision that carries its change reason, its change-control reference, its approvers, and its effective date. Superseded versions stay in the archive, readable and retrievable for the full retention period, so the history of what was effective, and when, is always answerable.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Versioning <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rodesign">
        <div class="fv-rd-title">Revision record <span class="fv-rd-pill">CONTROLLED</span></div>
        <div class="fv-rd-card">
          <div class="fv-rd-name">SOP-QA-014 &middot; v4.0</div>
          <div class="fv-rd-sku">Supersedes v3.2 &middot; effective 12 Aug 2026</div>
          <div class="fv-rd-grid">
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Change control</div><div class="fv-rd-cell-v">CC-2211</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Reason</div><div class="fv-rd-cell-v">CAPA close</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Approver</div><div class="fv-rd-cell-v">QA Head</div></div>
            <div class="fv-rd-cell"><div class="fv-rd-cell-l">Retention</div><div class="fv-rd-cell-v">10 yr</div></div>
          </div>
        </div>
        <div class="fv-rd-foot"><span>Prior versions retrievable</span><strong>v1.0, v2.0, v3.0, v3.2</strong></div>
      </div>
    </div>
  </div>

  <!-- 6. Training tied to revisions -->
  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1 2.5 3 6 3s6-2 6-3v-5"/></svg></div>
      <h3>Training tied to the exact revision.</h3>
      <p>When a revision goes effective, the read-and-understand and training obligation attaches to it automatically for the roles and sites it applies to. A short quiz backs the read where you need evidence of comprehension, not just a click. The result is a training record linked to the precise document version, so "trained on the current SOP" is a fact you can prove, per person, per revision.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Training &amp; Quizzes <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-roaud">
        <div class="fv-roa-title">Training obligation &middot; SOP-QA-014 v4.0</div>
        <div class="fv-roa-label">Applies to sites</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Unit I</span>
          <span class="fv-roa-chip on">Unit II</span>
          <span class="fv-roa-chip on">QC Lab</span>
          <span class="fv-roa-chip">Corporate</span>
        </div>
        <div class="fv-roa-label">Applies to roles</div>
        <div class="fv-roa-chips">
          <span class="fv-roa-chip on">Operator</span>
          <span class="fv-roa-chip on">QC Analyst</span>
          <span class="fv-roa-chip on">Supervisor</span>
        </div>
        <div class="fv-roa-count"><span>Trained on v4.0</span><strong>212 / 220 &middot; quiz 96%</strong></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">The quieter controls a validated environment expects, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
        <h3>Authentication &amp; password policy <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Unique user identity, enforced password rules, and multi-factor authentication so only authorized people reach controlled records.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <h3>Session timeout <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Automatic logout after inactivity keeps an unattended shop-floor terminal from becoming an open door to controlled documents.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
        <h3>Controlled distribution <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>The right SOP reaches only the roles and sites it applies to, never the whole company, with acknowledgement captured per recipient.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 8v13H3V8"/><rect x="1" y="3" width="22" height="5" rx="1"/><line x1="10" y1="12" x2="14" y2="12"/></svg></div>
        <h3>Record retention &amp; retrieval <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Records stay readable and retrievable for the retention period you set, so a document from years ago is still there when an inspection asks.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg></div>
        <h3>Validation support <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Documentation to support your computer system validation, so your team can qualify the platform inside your own quality system.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>Encryption, backup &amp; recovery <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Encryption in transit and at rest, with backup and disaster recovery, to protect the integrity and availability of your records.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- 21 CFR PART 11 COVERAGE -->
<section class="p11">
<div class="container">
  <div class="section-header reveal">
    <h2>Built to support <span class="g-text">21 CFR Part 11.</span></h2>
  </div>
  <p class="p11-note reveal">There is no FDA certification for Part 11 software, and any vendor claiming to be "Part 11 certified" is misstating it. What a platform can do is provide the capabilities that let your validated system meet Part 11 for electronic records and electronic signatures. Here is how PolicyCentral.ai maps to those requirements.</p>
  <div class="p11-grid">
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Electronic signatures</div><h4>Signed, attributed, bound to the record</h4><p>Signer identity, date, time and signing meaning, permanently linked to the version and not transferable.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Audit trail</div><h4>Time-stamped, tamper-evident</h4><p>Every material action recorded, with previous and new values, and no ability to edit or delete the trail.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Access control</div><h4>Role-based, least privilege</h4><p>Permissions by role, site and function, with maker and checker duties kept separate.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Authentication</div><h4>Unique identity, MFA, password policy</h4><p>Every user uniquely identified, with multi-factor authentication and enforced password rules.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Record integrity</div><h4>Controlled, versioned, protected</h4><p>Effective records cannot be altered in place; changes create a new controlled revision.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Retention</div><h4>Readable and retrievable</h4><p>Records retained for your defined period, retrievable throughout, for inspection and review.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Time-stamping</div><h4>Date, time and user on every action</h4><p>Consistent, system-applied timestamps on approvals, acknowledgements and changes.</p></div></div>
    <div class="p11-item reveal"><div class="p11-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="p11-body"><div class="p11-req">Validation support</div><h4>Documentation for your CSV</h4><p>Materials to support installation, operational and performance qualification within your own quality system.</p></div></div>
  </div>
  <div class="p11-disclaimer reveal">
    <strong>Compliance note.</strong> PolicyCentral.ai provides capabilities that help regulated organizations meet FDA 21 CFR Part 11 requirements for electronic records and electronic signatures. Final compliance depends on the customer's own configuration, standard operating procedures, procedural controls, and system validation. PolicyCentral.ai does not claim to be "21 CFR Part 11 certified" or "HIPAA compliant"; no such certification exists for software, and compliance is achieved by the customer within their validated environment.
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real quality teams.</span></h2>
    <p>Five situations a pharma quality and regulatory team faces every month.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/></svg></div>
      <h3>A CAPA closes with an SOP revision</h3>
      <p>The revised SOP is authored, reviewed and approved with electronic signatures, made effective, and the prior version retires. Training attaches automatically, and coverage climbs before the line restarts.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Lifecycle &rarr; E-signature &rarr; Training on revision</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <h3>The inspector asks "who was trained on v4.0?"</h3>
      <p>One filter on the document and revision returns every signature, every acknowledgement, every quiz score, per person, per site, exported in minutes rather than reconstructed over a week.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Audit trail &rarr; Filter &rarr; Export</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h3>Someone tries to work to a superseded SOP</h3>
      <p>Only the effective version is visible on the floor. The superseded revision sits in the archive, clearly marked, retrievable for the record but never mistakable for the current one.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Controlled lifecycle &rarr; Effective-only visibility</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
      <h3>A new guidance has to reach two sites</h3>
      <p>A regulatory update cascades to Unit I and Unit II, in the language each site reads, with acknowledgement captured per operator and a clean record for the file. No all-company email, no guessing who saw it.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Controlled distribution &rarr; Translation &rarr; Acknowledgement</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/></svg></div>
      <h3>An approver signs, and it has to mean something</h3>
      <p>The QA Head re-authenticates at the point of signing, the reason is captured as Approved, and the signature is bound to that exact record. When the meaning of a signature is questioned in an audit, the answer is on the record, not in someone's memory.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Signature meaning &rarr; Re-authentication &rarr; Bound to record</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "which version is current?" <br>to <span class="g-text">"controlled, signed, and trained on."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Document control</h3>
      <p>From <strong>shared drives and printed binders</strong> to <strong>one controlled lifecycle, effective-only on the floor</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Approvals</h3>
      <p>From <strong>a scanned signature on a PDF</strong> to <strong>an electronic signature bound to the record, with meaning</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Inspection readiness</h3>
      <p>From <strong>a week reconstructing who read what</strong> to <strong>one filter, one export, per revision</strong>.</p>
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
    <h2>Ready to bring your controlled documents <span class="g-text">on to one platform?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring one SOP, its revision history, and your approval flow. In 30 minutes we'll show you the controlled lifecycle, the electronic signature, the audit trail, and the training record an inspector would ask for.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/industries/')); ?>" class="btn btn-outline">Explore other industries <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
