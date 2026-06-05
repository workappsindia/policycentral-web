<?php
/* Template Name: Use Case - HR & Employee Governance */
get_header();
?>
<style>
/* Page-specific accent, fuchsia/magenta (creative-industry energy) */
:root { --accent:#C026D3; --accent-dark:#A21CAF; --accent-light:#FDF4FF; --accent-border:rgba(192,38,211,.18); }

/* ── HERO VISUAL: Production HR Dashboard ── */
.hg-mockup{position:relative;width:100%;max-width:520px;animation:hgFloat 7s ease-in-out infinite}
@keyframes hgFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes hgCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.hg-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.hg-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.hg-dots{display:flex;gap:5px}
.hg-dots span{width:9px;height:9px;border-radius:50%}
.hg-dots span:nth-child(1){background:#EF4444}
.hg-dots span:nth-child(2){background:#F59E0B}
.hg-dots span:nth-child(3){background:#22C55E}
.hg-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.hg-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#C026D3,#A21CAF);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.hg-body{padding:16px}
.hg-prod-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.hg-prod-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.hg-prod-live{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.hg-prod-live::before{content:"";width:6px;height:6px;border-radius:50%;background:#059669;box-shadow:0 0 0 2px rgba(5,150,105,.2)}
.hg-prod-title{font-size:14px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px}
.hg-prod-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

.hg-section-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}

.hg-dept-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.hg-dept{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:6px}
.hg-dept-icon{font-size:12px}
.hg-dept-bar{flex:1.4;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.hg-dept-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.hg-dept-pct{font-size:10px;font-weight:800;color:var(--accent-dark);min-width:34px;text-align:right}

.hg-divider{height:1px;background:var(--gray-100);margin:12px 0}

.hg-stat-row{display:flex;gap:8px}
.hg-stat{flex:1;padding:8px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100)}
.hg-stat-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.04em;text-transform:uppercase;margin-bottom:3px}
.hg-stat-val{font-size:15px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1}

.hg-float-posh{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:178px;animation:hgCardIn .6s ease-out both;animation-delay:.3s}
.hg-float-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.hg-float-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.hg-float-icon svg{width:11px;height:11px;color:#fff}
.hg-float-head h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.hg-posh-row{display:flex;justify-content:space-between;align-items:center;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px}
.hg-posh-dept{color:var(--gray-700);font-weight:700}
.hg-posh-pct{font-weight:800;color:var(--accent-dark)}

.hg-float-pass{position:absolute;bottom:-18px;left:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:200px;animation:hgCardIn .6s ease-out both;animation-delay:.55s}
.hg-pass-head{display:flex;align-items:center;gap:8px;margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif}
.hg-pass-avatar{width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.hg-pass-name{font-size:11px;font-weight:800;color:var(--gray-900);line-height:1.2}
.hg-pass-role{font-size:9px;color:var(--gray-500);font-weight:600}
.hg-pass-check{display:flex;align-items:center;gap:6px;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-700);font-weight:700}
.hg-pass-check svg{width:11px;height:11px;color:#059669;flex-shrink:0}

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

/* Capability 1: Handbook viewer */
.fv-handbook{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-hb-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between}
.fv-hb-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-hb-toc{margin-bottom:10px}
.fv-hb-ch{display:flex;align-items:center;gap:8px;padding:6px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-hb-num{width:18px;height:18px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;border:1px solid var(--accent-border)}
.fv-hb-name{font-size:11px;font-weight:700;color:var(--gray-800);flex:1}
.fv-hb-status{font-size:9px;color:#059669;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-hb-foot{padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--accent-dark);text-align:center}

/* Capability 2: Mobile form flow */
.fv-formflow{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-ff-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.fv-ff-progress{display:flex;align-items:center;gap:8px;margin-bottom:14px;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600}
.fv-ff-bar{flex:1;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.fv-ff-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark));width:43%}
.fv-ff-step{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-ff-step.done{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.fv-ff-step.active{background:var(--accent-light);border-color:var(--accent-border)}
.fv-ff-tick{width:18px;height:18px;border-radius:50%;background:#059669;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-ff-tick svg{width:10px;height:10px}
.fv-ff-num{width:18px;height:18px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0}
.fv-ff-dot{width:18px;height:18px;border-radius:50%;background:var(--gray-200);flex-shrink:0}
.fv-ff-label{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800)}
.fv-ff-label.pending{color:var(--gray-400)}
.fv-ff-sig{padding:2px 7px;border-radius:5px;font-size:8.5px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2);font-family:'Plus Jakarta Sans',sans-serif}

/* Capability 3: POSH quiz */
.fv-quiz{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-q-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.fv-q-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-q-counter{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-q-question{font-size:11.5px;font-weight:700;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.45;margin-bottom:10px}
.fv-q-opt{display:flex;align-items:center;gap:8px;padding:8px 11px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px;font-weight:600;color:var(--gray-700)}
.fv-q-opt.correct{background:rgba(5,150,105,.08);border-color:rgba(5,150,105,.22);color:#065F46;font-weight:700}
.fv-q-radio{width:14px;height:14px;border-radius:50%;border:1.5px solid var(--gray-300);flex-shrink:0}
.fv-q-opt.correct .fv-q-radio{border-color:#059669;background:#059669;position:relative}
.fv-q-opt.correct .fv-q-radio::after{content:"";position:absolute;top:3px;left:3px;width:6px;height:6px;border-radius:50%;background:#fff}
.fv-q-foot{margin-top:10px;padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600;display:flex;justify-content:space-between}
.fv-q-foot strong{color:var(--accent-dark);font-weight:800}

/* Capability 4: New joiner timeline */
.fv-joiner{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-jo-head{display:flex;align-items:center;gap:10px;margin-bottom:14px}
.fv-jo-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-family:'Plus Jakarta Sans',sans-serif}
.fv-jo-name{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.2}
.fv-jo-role{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.fv-jo-step{display:flex;align-items:center;gap:10px;padding:7px 11px;border-radius:9px;border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif;background:var(--gray-50)}
.fv-jo-step.done{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.fv-jo-step-icon{width:22px;height:22px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:var(--gray-200);color:var(--gray-500)}
.fv-jo-step.done .fv-jo-step-icon{background:#059669;color:#fff}
.fv-jo-step-icon svg{width:11px;height:11px}
.fv-jo-step-body{flex:1;min-width:0}
.fv-jo-step-name{font-size:10.5px;font-weight:700;color:var(--gray-800)}
.fv-jo-step-meta{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:1px}

/* Capability 5: Crew compliance passport */
.fv-passport{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-pp-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between}
.fv-pp-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;letter-spacing:.04em}
.fv-pp-card{padding:11px 13px;border-radius:10px;background:linear-gradient(135deg,var(--accent-light) 0%,#FAF5FF 100%);border:1px solid var(--accent-border);margin-bottom:10px}
.fv-pp-name{font-size:13px;font-weight:800;color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:2px}
.fv-pp-meta{font-size:9.5px;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600}
.fv-pp-row{display:flex;align-items:center;gap:8px;padding:6px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-pp-row:first-of-type{border-top:none}
.fv-pp-cert{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800)}
.fv-pp-prods{font-size:9px;color:var(--gray-500);font-weight:600}
.fv-pp-tick{width:16px;height:16px;border-radius:50%;background:#059669;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-pp-tick svg{width:9px;height:9px}

/* Capability 6: HR audit table */
.fv-hraudit{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:380px}
.fv-ha-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-ha-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ha-filter{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ha-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:6px;padding:7px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;border-top:1px solid var(--gray-100);align-items:center}
.fv-ha-grid:first-of-type{border-top:none}
.fv-ha-grid.head{font-size:8.5px;color:var(--gray-500);font-weight:800;letter-spacing:.05em;text-transform:uppercase;border-top:none;padding-bottom:4px}
.fv-ha-crew{font-weight:800;color:var(--gray-900)}
.fv-ha-cell{display:flex;justify-content:center}
.fv-ha-cell.ok{color:#059669}
.fv-ha-cell.miss{color:#E11D48}
.fv-ha-cell svg{width:12px;height:12px}

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
  .hg-mockup{max-width:420px;margin:0 auto}
  .hg-float-posh{right:-8px;top:-8px}
  .hg-float-pass{left:-8px;bottom:-10px}
  .fv-handbook,.fv-formflow,.fv-quiz,.fv-joiner,.fv-passport,.fv-hraudit{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .hg-mockup{max-width:340px}
  .hg-float-posh,.hg-float-pass{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}
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
    <h1>Employee handbooks that <br><span class="accent">show up on set</span>, not in a drawer.</h1>
    <p class="subtitle">Onboarding kits, HR forms, leave templates, POSH training, and code-of-conduct content, delivered to every cast and crew member from day one of a shoot, in a language they read, with proof they saw it. Built for HR, Production, and L&amp;D teams in entertainment, media, and creative-services organisations.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">HR &amp; Employee Governance</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="hg-mockup">
      <div class="hg-dash">
        <div class="hg-titlebar">
          <div class="hg-dots"><span></span><span></span><span></span></div>
          <span class="hg-titlebar-text">Production HR Console</span>
          <span class="hg-titlebar-badge">&#x2713; ON-SET READY</span>
        </div>
        <div class="hg-body">
          <div class="hg-prod-head">
            <span class="hg-prod-tag">&#x1F3AC; Production &middot; Project Monsoon</span>
            <span class="hg-prod-live">Live</span>
          </div>
          <div class="hg-prod-title">Onboarding kit, 312 crew across 9 departments</div>
          <div class="hg-prod-meta">Shoot begins Apr 22 &middot; Handbook v6.1 &middot; POSH v3.0</div>

          <div class="hg-section-label">Acknowledgement by department</div>
          <div class="hg-dept-row"><span class="hg-dept"><span class="hg-dept-icon">&#x1F3A5;</span>Camera</span><div class="hg-dept-bar"><div class="hg-dept-fill" style="width:96%"></div></div><span class="hg-dept-pct">96%</span></div>
          <div class="hg-dept-row"><span class="hg-dept"><span class="hg-dept-icon">&#x1F4A1;</span>Lighting</span><div class="hg-dept-bar"><div class="hg-dept-fill" style="width:91%"></div></div><span class="hg-dept-pct">91%</span></div>
          <div class="hg-dept-row"><span class="hg-dept"><span class="hg-dept-icon">&#x1F3AD;</span>Costume</span><div class="hg-dept-bar"><div class="hg-dept-fill" style="width:88%"></div></div><span class="hg-dept-pct">88%</span></div>
          <div class="hg-dept-row"><span class="hg-dept"><span class="hg-dept-icon">&#x1F4A5;</span>Stunt</span><div class="hg-dept-bar"><div class="hg-dept-fill" style="width:74%"></div></div><span class="hg-dept-pct">74%</span></div>

          <div class="hg-divider"></div>

          <div class="hg-stat-row">
            <div class="hg-stat"><div class="hg-stat-label">Handbook</div><div class="hg-stat-val">89%</div></div>
            <div class="hg-stat"><div class="hg-stat-label">POSH</div><div class="hg-stat-val">94%</div></div>
            <div class="hg-stat"><div class="hg-stat-label">Safety SOP</div><div class="hg-stat-val">82%</div></div>
          </div>
        </div>
      </div>

      <div class="hg-float-posh">
        <div class="hg-float-head">
          <div class="hg-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
          <h3>POSH training</h3>
        </div>
        <div class="hg-posh-row"><span class="hg-posh-dept">Camera</span><span class="hg-posh-pct">100%</span></div>
        <div class="hg-posh-row"><span class="hg-posh-dept">Catering</span><span class="hg-posh-pct">96%</span></div>
        <div class="hg-posh-row"><span class="hg-posh-dept">Stunt</span><span class="hg-posh-pct">82%</span></div>
        <div class="hg-posh-row"><span class="hg-posh-dept">Costume</span><span class="hg-posh-pct">100%</span></div>
      </div>

      <div class="hg-float-pass">
        <div class="hg-pass-head">
          <div class="hg-pass-avatar">AR</div>
          <div><div class="hg-pass-name">Anjali Rao</div><div class="hg-pass-role">Stunt Coordinator &middot; 3rd shoot</div></div>
        </div>
        <div class="hg-pass-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>Handbook signed &middot; POSH carried over</div>
        <div class="hg-pass-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>Safety SOP &middot; quiz 9/10</div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>The crew changes every shoot. <span class="g-text">The handbook can't.</span></h2>
    <p>A production house runs five projects in parallel. A feature film. Two web series. A documentary. A brand commercial. Each one assembled in days, with department heads, hundreds of crew, freelancers signing on the morning of the call sheet. The handbook, the POSH policy, the on-set safety SOP, the wage compliance summary, the equipment-handling code, all of it needs to land in every contractor's hand before the first take.</p>
    <p>Doing that through Excel sign-off sheets and WhatsApp forwards is how, six months after wrap, a POSH complaint lands on the line producer's desk with the question: did this person ever receive the policy? An HR governance platform answers that question with a timestamp, not a guess.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a film &amp; OTT production house</span>
      <h3>Hundreds of freelancers per shoot. Every one onboarded, acknowledged, on record.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A production house in Mumbai or Hyderabad runs back-to-back projects through the year. Each new shoot pulls in 200 to 400 freelancers, actors, technicians, assistants, vendors, many of whom haven't worked with the company before. They start tomorrow. The handbook, the on-set conduct code, the wage compliance summary, the POSH policy with the IC member contacts, the per-diem and food-hygiene rules, all need to reach them before they clock in.</p>
      <p><strong>Email lists from the line producer don't sync to HR. PDFs sent via WhatsApp aren't acknowledgements. The IC committee cannot prove a crew member received the POSH policy if the only record is a forward on someone's phone.</strong> What the show needs is a platform that the line producer can target by production, by department, by role, by gender, that auto-includes the next freelancer who signs on tomorrow morning, in the language they read.</p>
      <p>That's what HR &amp; Employee Governance on PolicyCentral.ai looks like. The handbook, the POSH content, the joining forms, the L&amp;D modules, all hosted on one platform, all delivered, all acknowledged, all auditable per shoot.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">HR &amp; Employee Governance.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
      <h3>Employee handbooks, in-flight, not in-drawer.</h3>
      <p>Upload your handbook as .docx or PDF, auto-converted to clean structured web content, distributed to every crew member from day one of a new production. Per-shoot personalisation: the call-sheet logo, the line producer's name, the IC committee contacts, all mail-merged into the cover. Update the parent handbook centrally; every shoot inherits the change.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-handbook">
        <div class="fv-hb-title">Crew Handbook v6.1 <span class="fv-hb-badge">Project Monsoon</span></div>
        <div class="fv-hb-toc">
          <div class="fv-hb-ch"><span class="fv-hb-num">1</span><span class="fv-hb-name">Conduct on set</span><span class="fv-hb-status">READ</span></div>
          <div class="fv-hb-ch"><span class="fv-hb-num">2</span><span class="fv-hb-name">POSH &amp; IC contacts</span><span class="fv-hb-status">READ</span></div>
          <div class="fv-hb-ch"><span class="fv-hb-num">3</span><span class="fv-hb-name">Safety &amp; equipment</span><span class="fv-hb-status">READ</span></div>
          <div class="fv-hb-ch"><span class="fv-hb-num">4</span><span class="fv-hb-name">Wages &amp; per-diems</span><span class="fv-hb-status">READ</span></div>
        </div>
        <div class="fv-hb-foot">Acknowledge before first call &rarr;</div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg></div>
      <h3>HR forms and templates, completed on the phone.</h3>
      <p>Joining form, KYC, bank details, Aadhaar consent, NDA, equipment-issue receipt, every form rendered as a mobile-native short flow with e-signature. No paper, no scanned PDFs lost in WhatsApp, no follow-ups two weeks later asking for the missing form. The new joiner finishes the kit before they reach base camp.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Forms &amp; E-signatures <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-formflow">
        <div class="fv-ff-title">Crew joining kit, Project Monsoon</div>
        <div class="fv-ff-progress"><div class="fv-ff-bar"><div class="fv-ff-fill"></div></div><span>3 of 7</span></div>
        <div class="fv-ff-step done"><div class="fv-ff-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="fv-ff-label">PAN &amp; Aadhaar consent</span><span class="fv-ff-sig">e-Sign</span></div>
        <div class="fv-ff-step done"><div class="fv-ff-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="fv-ff-label">Bank details for payouts</span><span class="fv-ff-sig">Verified</span></div>
        <div class="fv-ff-step done"><div class="fv-ff-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="fv-ff-label">NDA &middot; Project Monsoon</span><span class="fv-ff-sig">e-Sign</span></div>
        <div class="fv-ff-step active"><div class="fv-ff-num">4</div><span class="fv-ff-label">Equipment-issue receipt</span></div>
        <div class="fv-ff-step"><div class="fv-ff-dot"></div><span class="fv-ff-label pending">Per-diem &amp; food preferences</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
      <h3>POSH, Code of Conduct, anti-bribery, with comprehension proven.</h3>
      <p>The compliance content that matters most gets a three-question quiz at the end. Acknowledgement without comprehension is a signed paper, not a defence. Quiz-pass rate is visible by department; any failure auto-flags to the IC committee or the HR head, with a follow-up conversation scheduled before the next call sheet.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Acknowledgement &amp; Quizzes <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-quiz">
        <div class="fv-q-head">
          <span class="fv-q-title">POSH module quiz</span>
          <span class="fv-q-counter">Q2 of 3</span>
        </div>
        <div class="fv-q-question">If a crew member reports an incident on a remote location shoot, who is the first IC contact for the production?</div>
        <div class="fv-q-opt"><div class="fv-q-radio"></div>The line producer on set</div>
        <div class="fv-q-opt"><div class="fv-q-radio"></div>The production assistant for the day</div>
        <div class="fv-q-opt correct"><div class="fv-q-radio"></div>The named IC member listed in the handbook</div>
        <div class="fv-q-opt"><div class="fv-q-radio"></div>The studio HR helpline (next business day)</div>
        <div class="fv-q-foot"><span>First-try pass rate</span><strong>94%</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
      <h3>Per-shoot evergreen distribution.</h3>
      <p>A new freelancer signs on at 6 AM for a 9 AM call. They auto-receive the full onboarding kit on their first login, the handbook, the POSH policy, the on-set safety SOP, the wage rules, in their first language, with the production logo on the cover. The line producer doesn't chase. HR doesn't intervene. The audience list maintains itself.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-joiner">
        <div class="fv-jo-head">
          <div class="fv-jo-avatar">RK</div>
          <div><div class="fv-jo-name">Ravi K., Sound Assistant</div><div class="fv-jo-role">Joined Apr 22 &middot; 6:12 AM &middot; Project Monsoon</div></div>
        </div>
        <div class="fv-jo-step done"><div class="fv-jo-step-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="fv-jo-step-body"><div class="fv-jo-step-name">Crew Handbook v6.1</div><div class="fv-jo-step-meta">Auto-sent &middot; acknowledged 6:38 AM</div></div></div>
        <div class="fv-jo-step done"><div class="fv-jo-step-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="fv-jo-step-body"><div class="fv-jo-step-name">POSH module + IC contacts</div><div class="fv-jo-step-meta">Quiz passed 9/10 &middot; 7:01 AM</div></div></div>
        <div class="fv-jo-step done"><div class="fv-jo-step-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="fv-jo-step-body"><div class="fv-jo-step-name">On-set safety SOP</div><div class="fv-jo-step-meta">Read &middot; e-signed 7:14 AM</div></div></div>
        <div class="fv-jo-step"><div class="fv-jo-step-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg></div><div class="fv-jo-step-body"><div class="fv-jo-step-name">Wage &amp; per-diem rules</div><div class="fv-jo-step-meta">Pending acknowledgement</div></div></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/><circle cx="8.5" cy="14.5" r="1.5"/></svg></div>
      <h3>Learning &amp; compliance, with progress that travels.</h3>
      <p>Bite-size training modules, fire safety, on-set ethics, equipment handling, finance and tax basics for freelancers, tracked by individual and by production. A crew member who completes POSH on one shoot doesn't sit through it again on the next; their compliance record travels with them. New shoots inherit what's already proven.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore Employee Portal <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-passport">
        <div class="fv-pp-title">Crew Compliance Record <span class="fv-pp-badge">PORTABLE</span></div>
        <div class="fv-pp-card">
          <div class="fv-pp-name">Anjali Rao</div>
          <div class="fv-pp-meta">Stunt Coordinator &middot; 4 productions completed</div>
        </div>
        <div class="fv-pp-row"><span class="fv-pp-cert">POSH &middot; v3.0</span><span class="fv-pp-prods">3 shoots carried</span><div class="fv-pp-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div></div>
        <div class="fv-pp-row"><span class="fv-pp-cert">On-set safety &middot; quiz 9/10</span><span class="fv-pp-prods">Apr 14 &middot; current</span><div class="fv-pp-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div></div>
        <div class="fv-pp-row"><span class="fv-pp-cert">Stunt rigging &middot; cert L2</span><span class="fv-pp-prods">Valid till Sep 2026</span><div class="fv-pp-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div></div>
        <div class="fv-pp-row"><span class="fv-pp-cert">Finance &amp; tax for freelancers</span><span class="fv-pp-prods">Completed Feb 2026</span><div class="fv-pp-tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
      <h3>The HR audit, one click away.</h3>
      <p>Per-shoot, per-department, per-crew-member dashboard. Who got the handbook. Who signed the POSH acknowledgement. Who passed the quiz. Who's still pending. Export ready for an internal IC enquiry, a labour inspector, or a streamer-platform compliance audit, with timestamps, e-signature trails, and language served, all on record.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-hraudit">
        <div class="fv-ha-head">
          <div class="fv-ha-title">Project Monsoon &middot; HR audit</div>
          <span class="fv-ha-filter">Apr 22 to today</span>
        </div>
        <div class="fv-ha-grid head"><span>Crew</span><span style="text-align:center">Handbook</span><span style="text-align:center">POSH</span><span style="text-align:center">Safety</span></div>
        <div class="fv-ha-grid"><span class="fv-ha-crew">Anjali R.</span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span></div>
        <div class="fv-ha-grid"><span class="fv-ha-crew">Ravi K.</span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span></div>
        <div class="fv-ha-grid"><span class="fv-ha-crew">Meera P.</span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell miss"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
        <div class="fv-ha-grid"><span class="fv-ha-crew">Suresh J.</span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span><span class="fv-ha-cell ok"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the HR, IC, and production teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
        <h3>White-label mobile app <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Your studio logo, your colours, on iOS and Android. The handbook lives on the phone the crew already carries.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-6h3zm-18 0a2 2 0 0 0 2 2h1v-6H3z"/></svg></div>
        <h3>Audio version of handbook <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>For stunt, catering, and lighting crew who don't read at their desks. Listen on the way to base camp.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg></div>
        <h3>Ten Indian languages <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>The handbook and POSH content in Hindi, Tamil, Telugu, Marathi, Bengali, and more. The language the crew reads first.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>SSO &amp; HRMS sync <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Plug into Zoho People, Keka, or whatever runs your HR. New joiners auto-receive the kit on day one of the shoot.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Mandatory-training calendar <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>POSH refreshers, safety drills, vendor-onboarding sessions, all on one calendar the production office subscribes to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Individual crew report <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Per-crew-member view of every form signed, every module passed, every shoot completed. Useful when the IC asks.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real shoots.</span></h2>
    <p>Five situations a production HR team will recognise from the last twelve months.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>The morning of the shoot</h3>
      <p>24 freelancers report at 6 AM, half of whom signed on yesterday evening. They open the studio app, find the handbook, the POSH module, and the safety SOP already pinned to their home screen, and finish acknowledgement before the first call sheet drops.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Evergreen distribution &rarr; Mobile app &rarr; E-signature</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
      <h3>The IC enquiry, six months after wrap</h3>
      <p>A complaint surfaces. The IC needs to establish whether the named crew member ever received the POSH policy. One filter pulls the timestamp, the language served, the e-signature, and the quiz score. The "I think they got it on WhatsApp" answer becomes an exportable record.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Acknowledgement record &rarr; Audit trail &rarr; Export</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
      <h3>The OTT streamer's compliance audit</h3>
      <p>The streamer asks for POSH coverage and on-set safety acknowledgement for all 312 crew on Project Monsoon, with timestamps. The production HR head exports a filtered report in 15 minutes, in the format the streamer's audit template expects.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Per-shoot dashboard &rarr; Filterable export &rarr; Audit-ready</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h3>The veteran on their fifth shoot</h3>
      <p>"Do I really need to redo the POSH training?" The platform sees the certificate is current, carries it forward, and skips them straight to the production-specific brief. No friction for someone who's already compliant; no shortcut for someone who isn't.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Portable compliance record &rarr; Smart deduplication</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>The new HR head asking "show me everyone who hasn't acknowledged the handbook"</h3>
      <p>One filter, across every shoot, every department, every crew member. Names, departments, productions, days outstanding, contact details. The follow-up dispatches itself; the chase doesn't sit in the new HR head's inbox.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Compliance dashboard &rarr; Resend-to-unread &rarr; Escalation</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "I think they got it on WhatsApp" <br>to <span class="g-text">"signed, timestamped, exportable."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Onboarding consistency</h3>
      <p>From <strong>"depends on who briefed them"</strong> to <strong>the same kit, in the same language, on day one of every shoot</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Compliance defensibility</h3>
      <p>From <strong>"WhatsApp forward, no record"</strong> to <strong>e-signed, quiz-passed, audit-exportable per crew member</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Crew experience</h3>
      <p>From <strong>ten paper forms by Friday</strong> to <strong>seven mobile steps before the first call sheet</strong>.</p>
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
    <h2>Ready to put your handbook <span class="g-text">in every crew member's hand?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring your handbook, your POSH policy, and a sample joining form. In 20 minutes we'll show you what the onboarding looks like for your next production, and what the dashboard says by the end of the first call.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
