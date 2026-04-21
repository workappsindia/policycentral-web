<?php
/* Template Name: Use Case - Branch Circulars */
get_header();
?>
<style>
/* Page-specific accent, emerald/green (geographic reach) */
:root { --accent:#059669; --accent-dark:#047857; --accent-light:#ECFDF5; --accent-border:rgba(5,150,105,.18); }

/* ── HERO VISUAL: Circular targeting map ── */
.bc-mockup{position:relative;width:100%;max-width:520px;animation:bcFloat 7s ease-in-out infinite}
@keyframes bcFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes bcCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.bc-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.bc-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.bc-dots{display:flex;gap:5px}.bc-dots span{width:9px;height:9px;border-radius:50%}
.bc-dots span:nth-child(1){background:#EF4444}.bc-dots span:nth-child(2){background:#F59E0B}.bc-dots span:nth-child(3){background:#22C55E}
.bc-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.bc-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#059669,#047857);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.bc-body{padding:16px}
.bc-circ-head{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.bc-circ-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.bc-circ-title{font-size:13.5px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.bc-circ-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

/* India map / cluster visual */
.bc-map{position:relative;height:160px;background:linear-gradient(180deg,var(--accent-light) 0%,#F0FDF4 100%);border-radius:12px;border:1px solid var(--accent-border);overflow:hidden;margin-bottom:12px}
.bc-map-label{position:absolute;top:10px;left:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--accent-dark);letter-spacing:.1em;text-transform:uppercase}
.bc-map-stat{position:absolute;top:10px;right:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;color:var(--accent-dark);padding:3px 8px;background:#fff;border-radius:5px;border:1px solid var(--accent-border)}
.bc-pin{position:absolute;display:flex;align-items:center;gap:5px}
.bc-pin-dot{width:12px;height:12px;border-radius:50%;background:var(--accent);box-shadow:0 0 0 4px rgba(5,150,105,.18);position:relative}
.bc-pin-dot::after{content:"";position:absolute;inset:-2px;border-radius:50%;border:1.5px solid var(--accent);animation:bcPulse 2.5s infinite}
@keyframes bcPulse{0%{transform:scale(1);opacity:1}100%{transform:scale(2);opacity:0}}
.bc-pin-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:var(--accent-dark);padding:2px 6px;background:#fff;border-radius:4px;border:1px solid var(--accent-border);white-space:nowrap}
.bc-pin.p1{top:40px;left:20%}
.bc-pin.p2{top:64px;left:50%}
.bc-pin.p3{top:90px;left:30%}
.bc-pin.p4{top:115px;left:62%}
.bc-pin.p5{top:50px;left:78%}

.bc-targets{padding:10px 0}
.bc-t-label{font-size:9.5px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}
.bc-t-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.bc-t-region{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:6px}
.bc-t-flag{font-size:12px}
.bc-t-bar{flex:1.5;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.bc-t-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.bc-t-pct{font-size:10px;font-weight:800;color:var(--accent);min-width:32px;text-align:right}

.bc-float-lang{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.15);padding:11px 13px;min-width:170px;animation:bcCardIn .6s ease-out both;animation-delay:.3s}
.bc-lang-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.bc-lang-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.bc-lang-icon svg{width:11px;height:11px;color:#fff}
.bc-lang-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.bc-lang-chip{display:inline-flex;align-items:center;gap:4px;padding:3px 7px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;margin:2px 3px 2px 0;border:1px solid var(--accent-border)}

.bc-float-ever{position:absolute;bottom:-18px;left:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.15);padding:11px 13px;min-width:200px;animation:bcCardIn .6s ease-out both;animation-delay:.55s}
.bc-ever-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.bc-ever-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.bc-ever-icon svg{width:11px;height:11px;color:#fff}
.bc-ever-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.bc-ever-body{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600;line-height:1.4}
.bc-ever-body strong{color:var(--gray-900);font-weight:800}

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
.fv-loc{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-l-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-l-chip-row{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:8px}
.fv-l-chip{display:inline-flex;align-items:center;gap:4px;padding:4px 9px;border-radius:5px;background:var(--gray-100);color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;border:1px solid var(--gray-200)}
.fv-l-chip.sel{background:var(--accent-light);color:var(--accent-dark);border-color:var(--accent-border)}
.fv-l-count{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--gray-500);padding:8px 0;border-top:1px solid var(--gray-100);margin-top:6px;display:flex;justify-content:space-between;font-weight:600}
.fv-l-count strong{color:var(--accent-dark);font-weight:800}

.fv-regional{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-r-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px;display:flex;justify-content:space-between;align-items:center}
.fv-r-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-r-row{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:9px;margin-bottom:4px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-r-flag{font-size:15px}
.fv-r-body{flex:1}
.fv-r-lang{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-r-sample{font-size:9.5px;color:var(--gray-500);margin-top:1px;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fv-r-done{padding:2px 7px;border-radius:5px;font-size:8.5px;font-weight:800;background:rgba(5,150,105,.1);color:#047857;border:1px solid rgba(5,150,105,.2);letter-spacing:.02em}

.fv-ever{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-e-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px}
.fv-e-flow{position:relative;padding:4px 0}
.fv-e-step{display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:9px;border:1px solid var(--gray-100);background:var(--gray-50);margin-bottom:6px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-e-step.live{background:var(--accent-light);border-color:var(--accent-border)}
.fv-e-icon{width:24px;height:24px;border-radius:6px;background:var(--gray-200);color:var(--gray-500);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-e-step.live .fv-e-icon{background:var(--accent);color:#fff}
.fv-e-icon svg{width:12px;height:12px}
.fv-e-text{flex:1;font-size:10.5px;font-weight:700;color:var(--gray-800)}
.fv-e-sub{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:1px}

.fv-bdash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-bd-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-bd-row{display:flex;align-items:center;gap:10px;padding:7px 11px;border-radius:9px;border:1px solid var(--gray-100);margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-bd-row.flag{background:rgba(225,29,72,.04);border-color:rgba(225,29,72,.15)}
.fv-bd-city{font-size:11px;font-weight:800;color:var(--gray-900);min-width:64px}
.fv-bd-bar{flex:1;height:6px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.fv-bd-bar-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.fv-bd-row.flag .fv-bd-bar-fill{background:linear-gradient(90deg,#E11D48,#BE123C)}
.fv-bd-pct{font-size:11px;font-weight:800;color:var(--accent);min-width:32px;text-align:right}
.fv-bd-row.flag .fv-bd-pct{color:#E11D48}

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
  .bc-mockup{max-width:420px;margin:0 auto}
  .bc-float-lang{right:-8px;top:-8px}
  .bc-float-ever{left:-8px;bottom:-10px}
  .fv-loc,.fv-regional,.fv-ever,.fv-bdash{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){.bc-mockup{max-width:340px}.bc-float-lang,.bc-float-ever{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}}

/* Capability 5: Mobile app + push notification */
.fv-bc-mobile-v{display:flex;justify-content:center;align-items:center;width:100%;max-width:360px;position:relative;padding:12px 0}
.fv-bc-phone-mini{width:186px;background:#111827;border-radius:28px;padding:8px;box-shadow:var(--shadow-xl);position:relative}
.fv-bc-phone-screen{background:linear-gradient(180deg,var(--accent-light) 0%,#fff 55%);border-radius:22px;height:280px;overflow:hidden;position:relative}
.fv-bc-phone-notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:60px;height:18px;background:#111827;border-radius:0 0 12px 12px;z-index:2}
.fv-bc-phone-time{padding:14px 16px 6px;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--gray-900);display:flex;justify-content:space-between}
.fv-bc-push{margin:12px;padding:12px 14px;background:#fff;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.12),0 2px 8px rgba(0,0,0,.06);position:relative;animation:bcPushIn .8s ease-out both;animation-delay:.4s}
@keyframes bcPushIn{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)}}
.fv-bc-push-head{display:flex;align-items:center;gap:7px;margin-bottom:6px}
.fv-bc-push-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-bc-push-icon svg{width:11px;height:11px;color:#fff}
.fv-bc-push-app{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:var(--gray-700);letter-spacing:.04em;flex:1;text-transform:uppercase}
.fv-bc-push-time{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;color:var(--gray-400);font-weight:600}
.fv-bc-push-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900);margin-bottom:3px;line-height:1.3}
.fv-bc-push-body{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-600);line-height:1.4;font-weight:600}
.fv-bc-badge-live{position:absolute;top:10px;right:-10px;padding:4px 10px;border-radius:var(--r-full);background:linear-gradient(135deg,#E11D48,#BE123C);color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;letter-spacing:.06em;box-shadow:0 4px 12px rgba(225,29,72,.3);z-index:3;display:flex;align-items:center;gap:5px}
.fv-bc-badge-live::before{content:"";width:6px;height:6px;border-radius:50%;background:#fff;animation:bcPulseDot 1.5s infinite}
@keyframes bcPulseDot{0%,100%{opacity:1}50%{opacity:.4}}

/* Capability 6: Mail-merge + recall */
.fv-bc-mail{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-mail-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-mail-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--gray-500);letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.fv-mail-template{background:var(--gray-50);border:1px solid var(--gray-100);border-radius:10px;padding:11px 13px;margin-bottom:10px;font-family:'Manrope',sans-serif;font-size:11px;color:var(--gray-700);line-height:1.55}
.fv-mail-template .token{background:var(--accent-light);color:var(--accent-dark);padding:2px 6px;border-radius:4px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;margin:0 1px}
.fv-mail-preview{background:#fff;border:1px solid rgba(5,150,105,.2);background:linear-gradient(135deg,rgba(5,150,105,.04),transparent);border-radius:10px;padding:11px 13px;margin-bottom:10px;font-family:'Manrope',sans-serif;font-size:11px;color:var(--gray-700);line-height:1.55}
.fv-mail-preview strong{color:var(--gray-900);font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-recall{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;background:linear-gradient(135deg,rgba(217,119,6,.08),rgba(245,158,11,.08));border:1px solid rgba(217,119,6,.2);font-family:'Plus Jakarta Sans',sans-serif}
.fv-recall svg{width:16px;height:16px;color:#B45309;flex-shrink:0}
.fv-recall-text{font-size:10.5px;font-weight:700;color:#78350F;line-height:1.4}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content">
    <h1>One circular. <br><span class="accent">The right branches.</span></h1>
    <p class="subtitle">Region-specific and branch-specific notices delivered to the right geographies, in the right languages, with read tracking, acknowledgement, and evergreen inclusion of new joiners. Built for Branch Banking, Retail Operations, Regional Heads, and Circle Managers.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Branch Circulars</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="bc-mockup">
      <div class="bc-dash">
        <div class="bc-titlebar">
          <div class="bc-dots"><span></span><span></span><span></span></div>
          <span class="bc-titlebar-text">Circular Distribution</span>
          <span class="bc-titlebar-badge">LIVE DISPATCH</span>
        </div>
        <div class="bc-body">
          <div class="bc-circ-head">
            <span class="bc-circ-tag">&#x1F4E9; Branch Circular</span>
          </div>
          <div class="bc-circ-title">Revised cash-handling limits, Western region</div>
          <div class="bc-circ-meta">Effective: Apr 01 &middot; Audience: 342 branches across MH, GJ, GA</div>

          <div class="bc-map">
            <span class="bc-map-label">&#x1F4CD; Dispatched to regions</span>
            <span class="bc-map-stat">342 branches</span>
            <div class="bc-pin p1"><div class="bc-pin-dot"></div><span class="bc-pin-label">Mumbai 87</span></div>
            <div class="bc-pin p2"><div class="bc-pin-dot"></div><span class="bc-pin-label">Pune 54</span></div>
            <div class="bc-pin p3"><div class="bc-pin-dot"></div><span class="bc-pin-label">Surat 38</span></div>
            <div class="bc-pin p4"><div class="bc-pin-dot"></div><span class="bc-pin-label">Nagpur 42</span></div>
            <div class="bc-pin p5"><div class="bc-pin-dot"></div><span class="bc-pin-label">Ahmedabad 61</span></div>
          </div>

          <div class="bc-targets">
            <div class="bc-t-label">Acknowledgement by region</div>
            <div class="bc-t-row"><span class="bc-t-region"><span class="bc-t-flag">&#x1F1EE;&#x1F1F3;</span>Maharashtra</span><div class="bc-t-bar"><div class="bc-t-fill" style="width:94%"></div></div><span class="bc-t-pct">94%</span></div>
            <div class="bc-t-row"><span class="bc-t-region"><span class="bc-t-flag">&#x1F1EE;&#x1F1F3;</span>Gujarat</span><div class="bc-t-bar"><div class="bc-t-fill" style="width:89%"></div></div><span class="bc-t-pct">89%</span></div>
            <div class="bc-t-row"><span class="bc-t-region"><span class="bc-t-flag">&#x1F1EE;&#x1F1F3;</span>Goa</span><div class="bc-t-bar"><div class="bc-t-fill" style="width:97%"></div></div><span class="bc-t-pct">97%</span></div>
          </div>
        </div>
      </div>

      <div class="bc-float-lang">
        <div class="bc-lang-head">
          <div class="bc-lang-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg></div>
          <span class="bc-lang-title">Translated live</span>
        </div>
        <span class="bc-lang-chip">&#x1F1EE;&#x1F1F3; Marathi</span>
        <span class="bc-lang-chip">&#x1F1EE;&#x1F1F3; Gujarati</span>
        <span class="bc-lang-chip">&#x1F1EE;&#x1F1F3; Konkani</span>
        <span class="bc-lang-chip">EN</span>
      </div>

      <div class="bc-float-ever">
        <div class="bc-ever-head">
          <div class="bc-ever-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
          <span class="bc-ever-title">Evergreen mode</span>
        </div>
        <div class="bc-ever-body">New branch joiners in <strong>MH, GJ, GA</strong> auto-receive this circular on day one.</div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>Mumbai's circular shouldn't land <span class="g-text">in Hyderabad's inbox.</span></h2>
    <p>Circulars are precision communication. A revised cash-handling limit for the Western region is not a policy for Technology in Bangalore. A service advisory for Kerala branches means nothing to Punjab. And a regional festival holiday announcement sent to every branch is just noise that trains everyone to ignore the next circular.</p>
    <p>Branch Circulars on PolicyCentral.ai let operations and regional heads target by geography, role, and branch type, in the regional language, with proof of who received it and acknowledgement from every branch manager, without cc'ing ten thousand inboxes.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a large retail bank</span>
      <h3>Thousands of branches. One dispatch. Zero wrong recipients.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A large private-sector bank or NBFC operates branches in every state. Regional heads, circle managers, and operations teams push dozens of circulars every month: regulatory updates for specific products, operational changes in a geography, festival holidays, service advisories, fraud alerts, new product launches limited to a pilot region.</p>
      <p><strong>If every circular goes to every branch, branch managers tune out. If circulars go only to some branches but nobody can prove which, the auditor finds the gap.</strong> The right answer is precision targeting with proof, the exact branches, in their language, with acknowledgement by branch manager.</p>
      <p>That's what Branch Circulars on PolicyCentral.ai look like. The same platform that already runs the bank's policy library, just used for geography-first, time-sensitive content.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Six capabilities that play a critical role<br>in <span class="g-text">branch distribution.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <h3>1. Location-based targeting, synced with HRMS.</h3>
      <p>Target a circular to a state, a zone, a circle, a branch type, a specific set of branches, or individual branches by name. Audience fields pull from Active Directory or the HRMS, so when a branch opens, closes, or moves zones, the targeting stays accurate without manual maintenance.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-loc">
        <div class="fv-l-title">Audience, Western Region</div>
        <div class="fv-l-chip-row">
          <span class="fv-l-chip sel">State: Maharashtra</span>
          <span class="fv-l-chip sel">State: Gujarat</span>
          <span class="fv-l-chip sel">State: Goa</span>
          <span class="fv-l-chip">State: Rajasthan</span>
          <span class="fv-l-chip">State: MP</span>
        </div>
        <div class="fv-l-chip-row">
          <span class="fv-l-chip sel">Branch type: Retail</span>
          <span class="fv-l-chip sel">Branch type: Priority</span>
          <span class="fv-l-chip">Branch type: Wealth</span>
        </div>
        <div class="fv-l-chip-row">
          <span class="fv-l-chip sel">Role: Branch Manager</span>
          <span class="fv-l-chip sel">Role: Teller</span>
          <span class="fv-l-chip sel">Role: Cashier</span>
        </div>
        <div class="fv-l-count"><span>Matches</span><strong>342 branches &middot; 4,127 employees</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>2. Regional languages, what the region actually reads.</h3>
      <p>A Marathi circular for Maharashtra. Gujarati for Gujarat. Tamil for Tamil Nadu. Ten Indian languages, auto-translated and reviewable by a regional coordinator before it goes live. Branch staff read in their first language, comprehension up, compliance friction down.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Translation <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-regional">
        <div class="fv-r-title">Languages auto-prepared <span class="fv-r-badge">10 LIVE</span></div>
        <div class="fv-r-row"><span class="fv-r-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-r-body"><div class="fv-r-lang">Marathi</div><div class="fv-r-sample">नकद हाताळणी मर्यादेचा नविन नियम</div></div><span class="fv-r-done">READY</span></div>
        <div class="fv-r-row"><span class="fv-r-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-r-body"><div class="fv-r-lang">Gujarati</div><div class="fv-r-sample">રોકડ હેન્ડલિંગની મર્યાદા સુધારો</div></div><span class="fv-r-done">READY</span></div>
        <div class="fv-r-row"><span class="fv-r-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-r-body"><div class="fv-r-lang">Hindi</div><div class="fv-r-sample">नकद संचालन की नई सीमा</div></div><span class="fv-r-done">READY</span></div>
        <div class="fv-r-row"><span class="fv-r-flag">&#x1F1EC;&#x1F1E7;</span><div class="fv-r-body"><div class="fv-r-lang">English</div><div class="fv-r-sample">Revised cash-handling limits</div></div><span class="fv-r-done">READY</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h3>3. Evergreen inclusion, for every new joiner, forever.</h3>
      <p>A branch manager joins the Pune region in June. They automatically receive every currently-live Western-region circular on day one, the cash-handling advisory from April, the regional festival calendar, the Diwali branch timing notice. No chasing HR, no missed onboarding doc. The circular audience auto-maintains.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Evergreen Mode <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-ever">
        <div class="fv-e-title">New joiner, Pune Region, June 4</div>
        <div class="fv-e-step live">
          <div class="fv-e-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div><div class="fv-e-text">Cash-handling limits (Apr)</div><div class="fv-e-sub">Auto-sent &middot; acknowledged</div></div>
        </div>
        <div class="fv-e-step live">
          <div class="fv-e-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div><div class="fv-e-text">Festival branch timings</div><div class="fv-e-sub">Auto-sent &middot; acknowledged</div></div>
        </div>
        <div class="fv-e-step">
          <div class="fv-e-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg></div>
          <div><div class="fv-e-text">Fraud alert, W-region</div><div class="fv-e-sub">Pending acknowledgement</div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>4. Branch-level acknowledgement dashboard.</h3>
      <p>See which branches have read and acknowledged, which haven't, and where to escalate. Sort by region, circle, or branch type. Resend-to-unread only pings the stragglers; branch managers who already signed don't get re-notified.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-bdash">
        <div class="fv-bd-title">Acknowledgement, by city</div>
        <div class="fv-bd-row"><span class="fv-bd-city">Mumbai</span><div class="fv-bd-bar"><div class="fv-bd-bar-fill" style="width:96%"></div></div><span class="fv-bd-pct">96%</span></div>
        <div class="fv-bd-row"><span class="fv-bd-city">Ahmedabad</span><div class="fv-bd-bar"><div class="fv-bd-bar-fill" style="width:91%"></div></div><span class="fv-bd-pct">91%</span></div>
        <div class="fv-bd-row"><span class="fv-bd-city">Pune</span><div class="fv-bd-bar"><div class="fv-bd-bar-fill" style="width:88%"></div></div><span class="fv-bd-pct">88%</span></div>
        <div class="fv-bd-row flag"><span class="fv-bd-city">Nagpur</span><div class="fv-bd-bar"><div class="fv-bd-bar-fill" style="width:62%"></div></div><span class="fv-bd-pct">62%</span></div>
        <div class="fv-bd-row"><span class="fv-bd-city">Surat</span><div class="fv-bd-bar"><div class="fv-bd-bar-fill" style="width:94%"></div></div><span class="fv-bd-pct">94%</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
      <h3>5. White-label mobile app with push.</h3>
      <p>Branch managers and tellers live on their phones, not desktops. PolicyCentral.ai's Android and iOS apps go out under your organisation's branding, from your enterprise app store accounts. A Sunday-night cash-handling advisory push-notifies every branch manager, and lands before Monday's shift begins.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore Employee Portal &amp; Mobile App <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-bc-mobile-v">
        <div class="fv-bc-phone-mini">
          <div class="fv-bc-phone-screen">
            <div class="fv-bc-phone-notch"></div>
            <div class="fv-bc-phone-time"><span>8:42 PM</span><span>&#x1F4F6; &#x1F50B;</span></div>
            <div class="fv-bc-push">
              <div class="fv-bc-push-head">
                <div class="fv-bc-push-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></div>
                <span class="fv-bc-push-app">YOURBANK</span>
                <span class="fv-bc-push-time">now</span>
              </div>
              <div class="fv-bc-push-title">Revised cash-handling limits</div>
              <div class="fv-bc-push-body">Effective tomorrow. Acknowledge before branch open.</div>
            </div>
          </div>
        </div>
        <span class="fv-bc-badge-live">LIVE</span>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>6. Personalisation per branch, correction per mistake.</h3>
      <p>Mail-merge every circular by branch name, manager name, state-specific dates, or any HRMS field, in a single dispatch. And when a figure goes out wrong, which it will, recall or edit in one click. Resend-to-unread chases only those who haven't opened it. No apology thread, no confusion about which version is live.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-bc-mail">
        <div class="fv-mail-title">Mail-merge preview</div>
        <div class="fv-mail-label">Template</div>
        <div class="fv-mail-template">Dear <span class="token">{Branch Manager}</span>, please note revised cash-handling limits effective <span class="token">{Date}</span> at <span class="token">{Branch City}</span>.</div>
        <div class="fv-mail-label">Rendered for Ramesh Shah, Ahmedabad</div>
        <div class="fv-mail-preview">Dear <strong>Ramesh Shah</strong>, please note revised cash-handling limits effective <strong>01 May 2026</strong> at <strong>Ahmedabad</strong>.</div>
        <div class="fv-recall">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
          <span class="fv-recall-text">Figure off? Edit once. Resend only to those who haven't seen it.</span>
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
    <h2>Real moments. <span class="g-text">Right branches.</span></h2>
    <p>Five situations regional operations teams face every week.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <h3>A Western-region cash-handling revision</h3>
      <p>Regional operations publishes at 10 AM. Targeted at 342 retail branches in MH, GJ, GA. Translated to Marathi, Gujarati, Hindi. By EOD, 94% of branch managers have acknowledged. Three lagging branches auto-escalated to their Circle Head.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Location targeting &rarr; Translation &rarr; Acknowledge &rarr; Escalation</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/></svg></div>
      <h3>A fraud alert for Tier-2 branches only</h3>
      <p>A new fraud pattern surfaces at Tier-2 branches in the North. A sharp one-pager goes only to Tier-2 branch managers in UP, Bihar, MP, Rajasthan, in Hindi, with a mandatory acknowledgement. Metro branches don't get the noise; the target list is provable.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Branch-type filter &rarr; Regional language &rarr; Mandatory ack</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
      <h3>Festival holiday branch timings</h3>
      <p>State-specific festival holidays differ across India. One circular, state-variant content, Onam for Kerala, Bihu for Assam, Pongal for Tamil Nadu. Every branch gets the right version for its state, personalised with the branch name.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>State-based targeting &rarr; Mail-merge &rarr; Regional calendar</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>A new branch opens in June</h3>
      <p>The moment the branch is added to HRMS with its zone and state, every currently-live circular for that region is delivered to its manager, the pending cash-handling advisory, the open festival timings, the active fraud alerts. Day-one readiness without a manual handover list.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Evergreen inclusion &rarr; HRMS sync &rarr; Zero manual onboarding</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>The audit asks: "Which branches acknowledged the fraud alert?"</h3>
      <p>Compliance filters by circular + region + date range. One CSV export: branch name, manager name, acknowledgement timestamp, e-signature method. The two branches that didn't acknowledge are surfaced with their escalation history.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Audit trail &rarr; filterable export &rarr; Exception surfacing</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "cc to all branches" <br>to <span class="g-text">precision dispatch.</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Targeting precision</h3>
      <p>From <strong>cc-everyone noise</strong> to the <strong>exact branches, exact roles, exact language</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Regional reach</h3>
      <p>From <strong>English circulars nobody reads</strong> to <strong>ten Indian languages</strong> per dispatch.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Auditability</h3>
      <p>From <strong>"we sent an email"</strong> to <strong>branch-level acknowledgement with timestamps</strong>, exportable.</p>
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
    <h2>Ready to see <span class="g-text">one circular land in the right branches</span>, and nowhere else?</h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a recent circular and the list of branches it was meant for. In 20 minutes we'll show you what targeting, regional translation, and branch-level acknowledgement would look like for your next dispatch.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
