<?php
/* Template Name: Use Case - Compliance & Legal */
get_header();
?>
<style>
/* Page-specific accent, royal blue (financial gravitas) */
:root { --accent:#1D4ED8; --accent-dark:#1E40AF; --accent-light:#EFF6FF; --accent-border:rgba(29,78,216,.18); }

/* ── HERO VISUAL: AMC Compliance Console ── */
.cl-mockup{position:relative;width:100%;max-width:520px;animation:clFloat 7s ease-in-out infinite}
@keyframes clFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes clCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.cl-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.cl-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.cl-dots{display:flex;gap:5px}
.cl-dots span{width:9px;height:9px;border-radius:50%}
.cl-dots span:nth-child(1){background:#EF4444}
.cl-dots span:nth-child(2){background:#F59E0B}
.cl-dots span:nth-child(3){background:#22C55E}
.cl-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.cl-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#1D4ED8,#1E40AF);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.cl-body{padding:16px}
.cl-doc-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.cl-doc-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.cl-doc-live{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.cl-doc-live::before{content:"";width:6px;height:6px;border-radius:50%;background:#059669;box-shadow:0 0 0 2px rgba(5,150,105,.2)}
.cl-doc-title{font-size:14px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.cl-doc-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

.cl-section-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}

.cl-cascade{display:flex;align-items:stretch;gap:6px;margin-bottom:6px}
.cl-cas-step{flex:1;padding:8px 7px;border-radius:8px;background:rgba(29,78,216,.06);border:1px solid rgba(29,78,216,.16);font-family:'Plus Jakarta Sans',sans-serif;text-align:center}
.cl-cas-icon{font-size:14px;margin-bottom:3px}
.cl-cas-label{font-size:9px;font-weight:800;color:var(--accent-dark);line-height:1.2}
.cl-cas-arrow{display:flex;align-items:center;color:var(--gray-400);font-size:11px;font-weight:800}

.cl-divider{height:1px;background:var(--gray-100);margin:12px 0}

.cl-channel-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.cl-channel{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:6px}
.cl-channel-tag{font-size:8.5px;color:var(--gray-500);font-weight:600;padding:1px 6px;border-radius:4px;background:var(--gray-100)}
.cl-channel-bar{flex:1.4;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.cl-channel-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.cl-channel-pct{font-size:10px;font-weight:800;color:var(--accent-dark);min-width:34px;text-align:right}

.cl-float-sebi{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:182px;animation:clCardIn .6s ease-out both;animation-delay:.3s}
.cl-float-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.cl-float-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.cl-float-icon svg{width:11px;height:11px;color:#fff}
.cl-float-head h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.cl-sebi-row{display:flex;justify-content:space-between;align-items:center;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px}
.cl-sebi-label{color:var(--gray-700);font-weight:700;flex:1;line-height:1.3}
.cl-sebi-status{padding:1px 6px;border-radius:4px;font-size:8.5px;font-weight:800;letter-spacing:.02em;flex-shrink:0;margin-left:6px}
.cl-sebi-status.ack{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.cl-sebi-status.pend{background:rgba(217,119,6,.1);color:#B45309;border:1px solid rgba(217,119,6,.2)}

.cl-float-insp{position:absolute;bottom:-18px;left:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:206px;animation:clCardIn .6s ease-out both;animation-delay:.55s}
.cl-insp-head{display:flex;align-items:center;gap:6px;margin-bottom:7px}
.cl-insp-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#059669,var(--accent-dark));display:flex;align-items:center;justify-content:center}
.cl-insp-icon svg{width:11px;height:11px;color:#fff}
.cl-insp-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.cl-insp-body{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600;line-height:1.45}
.cl-insp-body strong{color:var(--accent-dark);font-weight:800}

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

/* Capability 1: SID version timeline */
.fv-clver{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-clv-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center}
.fv-clv-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-clv-timeline{position:relative;padding-left:18px}
.fv-clv-timeline::before{content:"";position:absolute;left:4px;top:8px;bottom:8px;width:2px;background:var(--gray-200)}
.fv-clv-item{position:relative;padding:6px 0;margin-bottom:6px}
.fv-clv-item::before{content:"";position:absolute;left:-18px;top:12px;width:10px;height:10px;border-radius:50%;background:var(--gray-300);border:2px solid #fff;box-shadow:0 0 0 1px var(--gray-200)}
.fv-clv-item.live::before{background:#059669;box-shadow:0 0 0 3px rgba(5,150,105,.18)}
.fv-clv-head{display:flex;align-items:center;justify-content:space-between;gap:8px}
.fv-clv-ver{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-clv-item.live .fv-clv-ver{color:#059669}
.fv-clv-item.old .fv-clv-ver{color:var(--gray-500)}
.fv-clv-date{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600}
.fv-clv-note{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px}

/* Capability 2: Distributor channel chips */
.fv-cldist{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-cld-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-cld-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.fv-cld-channel{display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-cld-channel.on{background:linear-gradient(135deg,var(--accent-light) 0%,#F5F9FF 100%);border-color:var(--accent-border)}
.fv-cld-toggle{width:30px;height:16px;border-radius:8px;background:var(--gray-300);position:relative;flex-shrink:0}
.fv-cld-toggle::after{content:"";position:absolute;top:2px;left:2px;width:12px;height:12px;border-radius:50%;background:#fff;transition:all .25s var(--ease)}
.fv-cld-channel.on .fv-cld-toggle{background:var(--accent)}
.fv-cld-channel.on .fv-cld-toggle::after{left:16px}
.fv-cld-name{flex:1;font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-cld-count{font-size:10px;color:var(--gray-500);font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-cld-foot{padding-top:10px;border-top:1px solid var(--gray-100);margin-top:6px;font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--gray-500);font-weight:600;display:flex;justify-content:space-between}
.fv-cld-foot strong{color:var(--accent-dark);font-weight:800}

/* Capability 3: Acknowledgement record */
.fv-clack{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-cla-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-cla-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-cla-pill{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2);letter-spacing:.04em}
.fv-cla-grid{display:grid;grid-template-columns:50px 1fr 70px 50px;gap:8px;padding:7px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;align-items:center}
.fv-cla-grid:first-of-type{border-top:none}
.fv-cla-grid.head{font-size:8.5px;color:var(--gray-500);font-weight:800;letter-spacing:.05em;text-transform:uppercase}
.fv-cla-arn{font-weight:800;color:var(--accent-dark)}
.fv-cla-name{font-weight:700;color:var(--gray-800)}
.fv-cla-time{color:var(--gray-500);font-weight:600;font-size:9.5px}
.fv-cla-sig{padding:1px 5px;border-radius:4px;font-size:8.5px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2);text-align:center}

/* Capability 4: PolicyGPT chat */
.fv-clgpt{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-clg-head{display:flex;align-items:center;gap:8px;margin-bottom:12px}
.fv-clg-badge{padding:3px 8px;border-radius:5px;background:linear-gradient(135deg,#7C3AED,var(--accent));color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.fv-clg-title{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-clg-q{font-size:11px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif;padding:8px 11px;background:var(--gray-50);border-radius:9px 9px 9px 2px;margin-bottom:6px;border:1px solid var(--gray-100);line-height:1.4}
.fv-clg-a{font-size:10.5px;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;padding:9px 11px;background:linear-gradient(135deg,var(--accent-light),#F5F9FF);border-radius:9px 9px 2px 9px;border:1px solid var(--accent-border);line-height:1.5;margin-bottom:6px}
.fv-clg-a strong{color:var(--accent-dark);font-weight:800}
.fv-clg-cite{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--accent-dark);background:#fff;padding:3px 7px;border-radius:5px;border:1px dashed var(--accent-border);display:inline-block;margin-top:4px}

/* Capability 5: Training ring */
.fv-cltrain{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-clt-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-clt-wrap{display:flex;align-items:center;gap:18px;padding:8px 0 14px;border-bottom:1px solid var(--gray-100);margin-bottom:10px}
.fv-clt-ring{width:62px;height:62px;border-radius:50%;background:conic-gradient(var(--accent) 0% 92%, #E5E7EB 92% 100%);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-clt-ring-in{width:48px;height:48px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:800;color:var(--accent-dark)}
.fv-clt-stats{flex:1}
.fv-clt-stat{font-size:11px;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-600);display:flex;justify-content:space-between;margin-bottom:4px;font-weight:700}
.fv-clt-stat strong{color:var(--gray-900);font-weight:800}
.fv-clt-row{display:flex;align-items:center;justify-content:space-between;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px}
.fv-clt-l{color:var(--gray-700);font-weight:700}
.fv-clt-v{color:var(--accent-dark);font-weight:800}

/* Capability 6: Inspection export */
.fv-clinsp{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-clin-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-clin-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-clin-dl{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;letter-spacing:.04em}
.fv-clin-filter{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:12px}
.fv-clin-chip{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;padding:4px 9px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-clin-row{display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px}
.fv-clin-row:first-of-type{border-top:none}
.fv-clin-l{color:var(--gray-700);font-weight:700}
.fv-clin-v{color:var(--accent-dark);font-weight:800}
.fv-clin-foot{margin-top:10px;padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600;text-align:center}
.fv-clin-foot strong{color:#059669;font-weight:800}

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
  .cl-mockup{max-width:420px;margin:0 auto}
  .cl-float-sebi{right:-8px;top:-8px}
  .cl-float-insp{left:-8px;bottom:-10px}
  .fv-clver,.fv-cldist,.fv-clack,.fv-clgpt,.fv-cltrain,.fv-clinsp{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .cl-mockup{max-width:340px}
  .cl-float-sebi,.cl-float-insp{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}
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
    <h1>Every fund. Every disclosure. <br><span class="accent">Every distributor on record.</span></h1>
    <p class="subtitle">Scheme Information Documents, SID updates, distributor codes, KYC norms, SEBI circulars, suitability training, distributed to fund managers, RTAs, distributors, branches, and BDM teams, with acknowledgement evidence ready for the next regulator inspection. Built for Compliance, Legal, Risk, and Operations teams at asset management companies.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Compliance &amp; Legal</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="cl-mockup">
      <div class="cl-dash">
        <div class="cl-titlebar">
          <div class="cl-dots"><span></span><span></span><span></span></div>
          <span class="cl-titlebar-text">AMC Compliance Console</span>
          <span class="cl-titlebar-badge">&#x2713; INSPECTION READY</span>
        </div>
        <div class="cl-body">
          <div class="cl-doc-head">
            <span class="cl-doc-tag">&#x1F4D1; SID &middot; Equity Hybrid Fund</span>
            <span class="cl-doc-live">v8.2 Live</span>
          </div>
          <div class="cl-doc-title">Scheme Information Document, supersession Apr 14</div>
          <div class="cl-doc-meta">Cascade: SEBI &rarr; Legal &rarr; Operations &rarr; RTA &rarr; Distribution &middot; 4,127 ARNs</div>

          <div class="cl-section-label">Cascade status</div>
          <div class="cl-cascade">
            <div class="cl-cas-step"><div class="cl-cas-icon">&#x1F3DB;&#xFE0F;</div><div class="cl-cas-label">SEBI<br>circular</div></div>
            <span class="cl-cas-arrow">&rsaquo;</span>
            <div class="cl-cas-step"><div class="cl-cas-icon">&#x2696;&#xFE0F;</div><div class="cl-cas-label">Legal<br>review</div></div>
            <span class="cl-cas-arrow">&rsaquo;</span>
            <div class="cl-cas-step"><div class="cl-cas-icon">&#x1F3E2;</div><div class="cl-cas-label">RTA &amp;<br>Operations</div></div>
            <span class="cl-cas-arrow">&rsaquo;</span>
            <div class="cl-cas-step"><div class="cl-cas-icon">&#x1F4E2;</div><div class="cl-cas-label">Distributor<br>advisory</div></div>
          </div>

          <div class="cl-divider"></div>

          <div class="cl-section-label">Distributor acknowledgement, 72h</div>
          <div class="cl-channel-row"><span class="cl-channel">ARN distributors<span class="cl-channel-tag">4,127</span></span><div class="cl-channel-bar"><div class="cl-channel-fill" style="width:94%"></div></div><span class="cl-channel-pct">94%</span></div>
          <div class="cl-channel-row"><span class="cl-channel">Bank channel<span class="cl-channel-tag">4</span></span><div class="cl-channel-bar"><div class="cl-channel-fill" style="width:100%"></div></div><span class="cl-channel-pct">100%</span></div>
          <div class="cl-channel-row"><span class="cl-channel">Branch RMs<span class="cl-channel-tag">280</span></span><div class="cl-channel-bar"><div class="cl-channel-fill" style="width:97%"></div></div><span class="cl-channel-pct">97%</span></div>
          <div class="cl-channel-row"><span class="cl-channel">Sub-brokers<span class="cl-channel-tag">12</span></span><div class="cl-channel-bar"><div class="cl-channel-fill" style="width:92%"></div></div><span class="cl-channel-pct">92%</span></div>
        </div>
      </div>

      <div class="cl-float-sebi">
        <div class="cl-float-head">
          <div class="cl-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg></div>
          <h3>SEBI circular tracker</h3>
        </div>
        <div class="cl-sebi-row"><span class="cl-sebi-label">Cir/IMD/2026/14 &middot; Scheme reclass</span><span class="cl-sebi-status ack">DONE</span></div>
        <div class="cl-sebi-row"><span class="cl-sebi-label">Cir/IMD/2026/15 &middot; KYC norm</span><span class="cl-sebi-status ack">DONE</span></div>
        <div class="cl-sebi-row"><span class="cl-sebi-label">Cir/IMD/2026/16 &middot; Disclosure</span><span class="cl-sebi-status pend">7 D</span></div>
      </div>

      <div class="cl-float-insp">
        <div class="cl-insp-head">
          <div class="cl-insp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
          <span class="cl-insp-title">Inspection-ready</span>
        </div>
        <div class="cl-insp-body"><strong>FY26 KYC training:</strong> 4,127 / 4,127 evidence on file. One filter from regulator export.</div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>Every product change has to <span class="g-text">land in fourteen places.</span></h2>
    <p>A new SEBI circular on category-of-scheme reclassification. A change in the expense ratio of the flagship fund. A revised KYC norm for distributors. A correction in the SID. Each one needs to reach the fund manager, the compliance head, the RTA, the BDM teams, the four thousand distributors, the branch staff servicing direct investors, the call-centre script, all within the regulatory deadline, with proof.</p>
    <p>An AMC runs on disclosures and acknowledgements. Compliance &amp; Legal on PolicyCentral.ai turns the distribution chain, internal teams, distributors, RTAs, branches, into a single addressable surface with audit-grade acknowledgement trails, not a fan-out of emails nobody can prove was delivered.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a large Indian mutual fund house</span>
      <h3>From SEBI circular to the last-mile distributor, on one platform.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>An AMC managing forty-plus schemes across equity, debt, hybrid, and passive categories. The compliance ecosystem is dense: SEBI sits above with circulars that drop unpredictably, AMFI overlays best-practice norms, the in-house Legal team interprets and codifies, the Operations team rolls out changes to the RTA and the factsheet engine, and the distribution backbone, 4,000+ ARN-holders, 280 branch RMs, a dozen sub-brokers, four bank channels, needs to know within 48 hours what just changed.</p>
      <p><strong>An email blast to a distributor list doesn't prove acknowledgement. A SID update sitting on the AMC website doesn't reach the distributor servicing a Tier-3 town. A KYC training pushed via portal-of-the-week is a SEBI finding waiting to happen.</strong> What the AMC needs is one distribution platform that targets by role and channel, captures acknowledgement with e-signature, and produces an inspection-ready audit trail per circular, per scheme, per cohort.</p>
      <p>That's what Compliance &amp; Legal on PolicyCentral.ai looks like. The same governance spine that already runs policies for regulated lenders, applied to fund factsheets, distributor codes, KYC norms, and the circulars cascade.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">AMC compliance.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Scheme document versioning, SEBI-grade.</h3>
      <p>Every version of every SID, SAI, KIM, and factsheet, preserved with timestamps, approvers, and diffs. Show exactly which scheme document was in force on any given date for any given investor cohort. Multiple parallel versions for category-A vs category-B distributors when needed. Minor post-publication corrections don't destroy the history.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Version Control <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-clver">
        <div class="fv-clv-title">Equity Hybrid Fund SID <span class="fv-clv-badge">&#x2713; All preserved</span></div>
        <div class="fv-clv-timeline">
          <div class="fv-clv-item live">
            <div class="fv-clv-head"><span class="fv-clv-ver">v8.2 (Live)</span><span class="fv-clv-date">Apr 14, 2026</span></div>
            <div class="fv-clv-note">Expense ratio revision &middot; SEBI Cir 2026/14 incorporated</div>
          </div>
          <div class="fv-clv-item old">
            <div class="fv-clv-head"><span class="fv-clv-ver">v8.1</span><span class="fv-clv-date">Jan 03, 2026</span></div>
            <div class="fv-clv-note">Superseded &middot; acknowledgements retained on record</div>
          </div>
          <div class="fv-clv-item old">
            <div class="fv-clv-head"><span class="fv-clv-ver">v8.0</span><span class="fv-clv-date">Aug 22, 2025</span></div>
            <div class="fv-clv-note">Archived &middot; available for regulator export</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
      <h3>Distributor and channel targeting, ARN-aware.</h3>
      <p>Push a regulatory advisory to all 4,127 ARNs, or to just the bank channel, or to the sub-broker network, or to direct-investor-servicing RMs only. AMFI-EUIN-aware audience lists; new ARN auto-included on registration. The distributor in a Tier-3 town receives the same advisory as the metro RM, the moment it goes live.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-cldist">
        <div class="fv-cld-title">Audience, SID update Apr 14</div>
        <div class="fv-cld-label">Channels</div>
        <div class="fv-cld-channel on"><div class="fv-cld-toggle"></div><span class="fv-cld-name">ARN distributors</span><span class="fv-cld-count">4,127</span></div>
        <div class="fv-cld-channel on"><div class="fv-cld-toggle"></div><span class="fv-cld-name">Branch RMs</span><span class="fv-cld-count">280</span></div>
        <div class="fv-cld-channel on"><div class="fv-cld-toggle"></div><span class="fv-cld-name">Bank channel</span><span class="fv-cld-count">4 banks</span></div>
        <div class="fv-cld-channel on"><div class="fv-cld-toggle"></div><span class="fv-cld-name">Sub-broker network</span><span class="fv-cld-count">12</span></div>
        <div class="fv-cld-channel"><div class="fv-cld-toggle"></div><span class="fv-cld-name">BDM team</span><span class="fv-cld-count">42</span></div>
        <div class="fv-cld-foot"><span>Total addressed</span><strong>4,423 recipients</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h3>Acknowledgement that's SEBI-inspection grade.</h3>
      <p>Every distributor, every RM, every fund manager who acknowledged the SID update, captured with timestamp, IP, e-signature, EUIN, and the exact version they saw. The "we sent the email" defence is replaced with "here is the acknowledgement record, filtered by ARN and date, exportable in the format the inspector asked for".</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Acknowledgement &amp; E-signature <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-clack">
        <div class="fv-cla-head">
          <div class="fv-cla-title">Acknowledgement record &middot; SID v8.2</div>
          <span class="fv-cla-pill">4,127 OK</span>
        </div>
        <div class="fv-cla-grid head"><span>ARN</span><span>Distributor</span><span>Time</span><span>Sig</span></div>
        <div class="fv-cla-grid"><span class="fv-cla-arn">14782</span><span class="fv-cla-name">M. Bhatt &amp; Co.</span><span class="fv-cla-time">14 Apr 10:42</span><span class="fv-cla-sig">e-Sign</span></div>
        <div class="fv-cla-grid"><span class="fv-cla-arn">21065</span><span class="fv-cla-name">S. Iyer Wealth</span><span class="fv-cla-time">14 Apr 11:18</span><span class="fv-cla-sig">e-Sign</span></div>
        <div class="fv-cla-grid"><span class="fv-cla-arn">38914</span><span class="fv-cla-name">FinPath Distributors</span><span class="fv-cla-time">14 Apr 12:04</span><span class="fv-cla-sig">e-Sign</span></div>
        <div class="fv-cla-grid"><span class="fv-cla-arn">47120</span><span class="fv-cla-name">A. Mehta Financial</span><span class="fv-cla-time">14 Apr 13:51</span><span class="fv-cla-sig">e-Sign</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>AI Q&amp;A for distributors, grounded in the live SID.</h3>
      <p>A distributor in Indore asks "what's the exit load on the new hybrid fund?" in the app. PolicyGPT answers from the current SID, cites the section, links the full document. No call to the compliance helpdesk. No wrong figure quoted to an investor. Every answer traceable to a specific clause in a specific version.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Gen AI Intelligence <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-clgpt">
        <div class="fv-clg-head">
          <span class="fv-clg-badge">&#x2728; POLICYGPT</span>
          <span class="fv-clg-title">Distributor app &middot; Indore</span>
        </div>
        <div class="fv-clg-q">What's the exit load on the Equity Hybrid Fund after the Apr 14 update?</div>
        <div class="fv-clg-a"><strong>PolicyGPT:</strong> 1% on units redeemed within 12 months of purchase; nil thereafter. The Apr 14 update did not change the exit load structure.
          <div class="fv-clg-cite">SID v8.2 &middot; &sect; 5.4 Exit Load</div>
        </div>
        <div class="fv-clg-q">And for the SIP plan?</div>
        <div class="fv-clg-a"><strong>PolicyGPT:</strong> Each SIP instalment is treated as a separate purchase for exit-load calculation.
          <div class="fv-clg-cite">SID v8.2 &middot; &sect; 5.4.2 SIP units</div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
      <h3>KYC, AML, suitability training, with quizzes that defend.</h3>
      <p>Mandatory KYC and AML modules pushed to every RM and distributor, with quiz scores tied to the individual. The "did your distributor actually understand suitability?" question gets a numeric answer, not a sign-off sheet. Failures route directly to the compliance head for a follow-up, not into a quarterly report nobody reads.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Training &amp; Quizzes <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-cltrain">
        <div class="fv-clt-title">KYC + AML refresher, FY26</div>
        <div class="fv-clt-wrap">
          <div class="fv-clt-ring"><div class="fv-clt-ring-in">92%</div></div>
          <div class="fv-clt-stats">
            <div class="fv-clt-stat"><span>Completed</span><strong>3,797</strong></div>
            <div class="fv-clt-stat"><span>Quiz passed</span><strong>87%</strong></div>
            <div class="fv-clt-stat"><span>Pending</span><strong>330</strong></div>
          </div>
        </div>
        <div class="fv-clt-row"><span class="fv-clt-l">Bank channel</span><span class="fv-clt-v">100% &middot; 9.2 avg</span></div>
        <div class="fv-clt-row"><span class="fv-clt-l">Branch RMs</span><span class="fv-clt-v">97% &middot; 8.9 avg</span></div>
        <div class="fv-clt-row"><span class="fv-clt-l">ARN distributors</span><span class="fv-clt-v">91% &middot; 8.4 avg</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Inspection-ready, one filter away.</h3>
      <p>A SEBI inspection asks for "all KYC training acknowledgements for Q2, by RM, with quiz scores". The compliance head filters the dashboard, exports a regulator-format PDF, attaches to the response, in fifteen minutes. The six-week scramble through Outlook and shared drives ends.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-clinsp">
        <div class="fv-clin-head">
          <div class="fv-clin-title">SEBI inspection export, Q2 FY26</div>
          <span class="fv-clin-dl">PDF &darr;</span>
        </div>
        <div class="fv-clin-filter">
          <span class="fv-clin-chip">Channel: Bank</span>
          <span class="fv-clin-chip">Quarter: Q2 FY26</span>
          <span class="fv-clin-chip">Module: KYC</span>
        </div>
        <div class="fv-clin-row"><span class="fv-clin-l">RMs covered</span><span class="fv-clin-v">280 / 280</span></div>
        <div class="fv-clin-row"><span class="fv-clin-l">Acknowledgement</span><span class="fv-clin-v">100%</span></div>
        <div class="fv-clin-row"><span class="fv-clin-l">Avg quiz score</span><span class="fv-clin-v">9.2 / 10</span></div>
        <div class="fv-clin-row"><span class="fv-clin-l">Re-attempts logged</span><span class="fv-clin-v">14</span></div>
        <div class="fv-clin-row"><span class="fv-clin-l">SID versions cited</span><span class="fv-clin-v">v8.1, v8.2</span></div>
        <div class="fv-clin-foot"><strong>Ready in 12 minutes.</strong> Filterable by ARN, EUIN, scheme, date.</div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the compliance and operations teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>SSO &amp; AD with EUIN sync <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>RMs and distributors log in through your identity provider with EUIN already mapped. No extra password, no orphaned access.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Regulator-deadline calendar <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>SEBI submission dates, AMFI deadlines, KYC refresh windows, all on one calendar compliance can subscribe to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
        <h3>Distributor search analytics <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>See what the distribution network is searching for. Repeat queries become the FAQs you should have written into the next SID.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><circle cx="12" cy="11" r="2"/></svg></div>
        <h3>VAPT &amp; source code review <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Independently penetration-tested every year, with source code reviewed by external specialists. The CISO sign-off is ready.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-6h3zm-18 0a2 2 0 0 0 2 2h1v-6H3z"/></svg></div>
        <h3>Audio versions of circulars <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>The distributor on the road listens to the regulatory advisory between client meetings. Reach the people who don't read at their desks.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
        <h3>Flexible deployment <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Cloud, private cloud, or on-premise. Match your data-residency policy and the CISO's deployment guardrails.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real circulars.</span></h2>
    <p>Five situations an AMC compliance team will recognise from any given quarter.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>A SEBI circular drops at 4 PM</h3>
      <p>Legal interprets, Operations publishes a distributor advisory by 7. By next morning's market open, every ARN has acknowledged. The compliance head sees a green dashboard before the trading day starts.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Targeted distribution &rarr; Acknowledgement &rarr; Time-bound dashboard</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
      <h3>The flagship fund's expense ratio changes</h3>
      <p>Every fund manager, branch RM, and distributor needs the new figure on the same page in 24 hours. SID v8.2 publishes, the cascade fires, the factsheet engine and the distributor portal align without a single Slack message.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version control &rarr; Multi-channel cascade &rarr; AI Q&amp;A</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>A SID correction, typo in the asset allocation table</h3>
      <p>Silent in-place edit, version history preserved. Resend-to-unread pings the distributors who hadn't opened the original. No "please disregard" thread, no version confusion at the field level.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Edit-in-place &rarr; Resend-to-unread &rarr; Version history</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
      <h3>The AMFI annual KYC refresh</h3>
      <p>4,127 distributors, a 30-day completion window, a SEBI-defined coverage threshold. The compliance head watches a single ring fill to 100%, with daily nudges going only to the people still pending.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Mandatory training &rarr; Quiz &rarr; Auto-escalation</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>The SEBI inspector asks "show me KYC training evidence for the bank channel, FY25"</h3>
      <p>One filter, one PDF, attached to the response, before the inspector finishes the next sentence. Filterable by ARN, EUIN, scheme, date. The "we'll come back to you" answer becomes "the export is in your inbox".</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Inspection dashboard &rarr; Filter &rarr; Regulator-format export</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "we sent the email blast" <br>to <span class="g-text">"every ARN, e-signed, on record."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Acknowledgement defensibility</h3>
      <p>From <strong>"the email went out"</strong> to <strong>every ARN's acknowledgement, e-signed and time-stamped</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Source-of-truth alignment</h3>
      <p>From <strong>"the factsheet engine and the distributor portal disagree"</strong> to <strong>one platform, one current version, cascaded everywhere</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Inspection readiness</h3>
      <p>From <strong>"the prep took six weeks"</strong> to <strong>the export was ready before the inspector finished asking</strong>.</p>
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
    <h2>Ready to put every fund disclosure <span class="g-text">on the same governance spine?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a recent SEBI circular, your latest SID update, and your distributor advisory format. In 20 minutes we'll show you the cascade, the acknowledgement trail, and the inspection-ready export.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
