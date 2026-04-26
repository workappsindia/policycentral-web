<?php
/* Template Name: Use Case - SOPs */
get_header();
?>
<style>
/* Page-specific accent, amber/orange (operational) */
:root { --accent:#D97706; --accent-dark:#B45309; --accent-light:#FEF3C7; --accent-border:rgba(217,119,6,.18); }

/* ── HERO VISUAL: SOP on mobile with flowchart ── */
.so-mockup{position:relative;width:100%;max-width:520px;display:flex;align-items:center;justify-content:center;animation:soFloat 7s ease-in-out infinite}
@keyframes soFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes soCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.so-phone{width:260px;background:#111827;border-radius:32px;padding:9px;box-shadow:0 30px 80px rgba(0,0,0,.22),0 12px 30px rgba(0,0,0,.14);position:relative;z-index:2}
.so-screen{background:#fff;border-radius:24px;overflow:hidden;height:520px;display:flex;flex-direction:column;position:relative}
.so-notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:90px;height:22px;background:#111827;border-radius:0 0 16px 16px;z-index:3}
.so-statusbar{padding:8px 18px 6px;display:flex;align-items:center;justify-content:space-between;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--gray-900);padding-top:14px}
.so-header{padding:8px 14px 12px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:10px}
.so-back{width:26px;height:26px;border-radius:8px;background:var(--gray-100);display:flex;align-items:center;justify-content:center}
.so-back svg{width:12px;height:12px;color:var(--gray-700)}
.so-htitle{flex:1;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.so-lang{padding:3px 7px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid var(--accent-border)}

.so-content{flex:1;padding:12px 14px;overflow:hidden;display:flex;flex-direction:column;gap:10px}
.so-ctag{display:inline-flex;align-items:center;gap:5px;padding:3px 8px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;border:1px solid var(--accent-border);align-self:flex-start}
.so-sop-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;font-weight:800;color:var(--gray-900);line-height:1.25;letter-spacing:-.01em}
.so-sop-title-h{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--gray-500);line-height:1.35;font-weight:600}

.so-flow{background:linear-gradient(180deg,#FEF3C7 0%,#FFFBEB 100%);border-radius:12px;padding:12px;border:1px solid var(--accent-border)}
.so-flow-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--accent-dark);letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}
.so-flow-step{display:flex;align-items:flex-start;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif;position:relative}
.so-flow-num{width:22px;height:22px;border-radius:50%;background:#fff;border:2px solid var(--accent);color:var(--accent-dark);font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.so-flow-step.done .so-flow-num{background:var(--accent);color:#fff}
.so-flow-text{font-size:10px;color:var(--gray-700);line-height:1.4;font-weight:600;padding-top:3px}
.so-flow-line{position:absolute;left:10px;top:24px;bottom:-6px;width:2px;background:var(--accent-border)}
.so-flow-step:last-child .so-flow-line{display:none}

.so-action{padding:10px 12px;background:var(--gray-50);border-radius:10px;display:flex;align-items:center;gap:8px;border:1px solid var(--gray-100)}
.so-action-icon{width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.so-action-icon svg{width:14px;height:14px;color:#fff}
.so-action-text{flex:1;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--gray-800);line-height:1.3}

.so-float-quiz{position:absolute;bottom:40px;left:-30px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.15);padding:11px 13px;min-width:170px;animation:soCardIn .6s ease-out both;animation-delay:.55s}
.so-quiz-head{display:flex;align-items:center;gap:6px;margin-bottom:6px}
.so-quiz-icon{width:20px;height:20px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.so-quiz-icon svg{width:10px;height:10px;color:#fff}
.so-quiz-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;color:var(--gray-900)}
.so-quiz-score{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:800;color:var(--accent-dark);line-height:1;margin:4px 0}
.so-quiz-sub{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;color:var(--gray-500);font-weight:600}

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

/* Capability visuals, SOPs */
.fv-info{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-info-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-info-step{display:flex;align-items:center;gap:10px;padding:7px 11px;border-radius:8px;margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(90deg,rgba(217,119,6,.08),rgba(217,119,6,.02));border:1px solid var(--accent-border)}
.fv-info-dot{width:8px;height:8px;border-radius:50%;background:var(--accent);flex-shrink:0}
.fv-info-text{font-size:11px;font-weight:700;color:var(--gray-800);flex:1;line-height:1.35}
.fv-info-arrow{display:flex;justify-content:center;padding:2px 0;color:var(--accent)}
.fv-info-arrow svg{width:12px;height:12px}
.fv-info-step.branch{background:linear-gradient(90deg,rgba(5,150,105,.08),rgba(5,150,105,.02));border-color:rgba(5,150,105,.2)}
.fv-info-step.branch .fv-info-dot{background:#059669}

.fv-quiz{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-q-head{margin-bottom:12px}
.fv-q-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:800;color:var(--accent-dark);letter-spacing:.1em;text-transform:uppercase;margin-bottom:4px}
.fv-q-question{font-family:'Plus Jakarta Sans',sans-serif;font-size:12.5px;font-weight:800;color:var(--gray-900);line-height:1.35}
.fv-q-opt{display:flex;align-items:center;gap:9px;padding:9px 12px;border-radius:9px;margin-bottom:5px;border:1.5px solid var(--gray-200);font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;color:var(--gray-700);cursor:default}
.fv-q-opt.correct{background:rgba(5,150,105,.08);border-color:rgba(5,150,105,.35);color:#065F46}
.fv-q-check{width:18px;height:18px;border-radius:50%;border:2px solid var(--gray-300);flex-shrink:0;display:flex;align-items:center;justify-content:center}
.fv-q-opt.correct .fv-q-check{background:#059669;border-color:#059669}
.fv-q-opt.correct .fv-q-check svg{width:10px;height:10px;color:#fff}

.fv-lang{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-lang-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px}
.fv-lang-row{display:flex;align-items:center;gap:10px;padding:7px 10px;border-radius:9px;margin-bottom:4px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-lang-flag{font-size:16px;flex-shrink:0}
.fv-lang-body{flex:1;min-width:0}
.fv-lang-name{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-lang-text{font-size:9.5px;color:var(--gray-500);font-weight:600;margin-top:1px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fv-lang-done{padding:2px 7px;border-radius:5px;font-size:8.5px;font-weight:800;background:rgba(5,150,105,.1);color:#047857;border:1px solid rgba(5,150,105,.2);letter-spacing:.03em}

.fv-mobile{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-m-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-m-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.fv-m-card{padding:12px;border-radius:10px;border:1px solid var(--gray-200);text-align:center}
.fv-m-card-icon{width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;margin:0 auto 8px}
.fv-m-card-icon svg{width:15px;height:15px;color:#fff}
.fv-m-card-icon.alt{background:linear-gradient(135deg,#059669,#047857)}
.fv-m-card-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px;font-weight:800;color:var(--gray-900);margin-bottom:2px}
.fv-m-card-sub{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;color:var(--gray-500);font-weight:600;line-height:1.35}

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
  .so-mockup{max-width:360px;margin:0 auto}
  .so-float-quiz{left:-10px;bottom:20px}
  .fv-info,.fv-quiz,.fv-lang,.fv-mobile{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){.so-phone{width:220px}.so-screen{height:460px}.so-float-quiz{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}}

/* Capability 5: Maker-checker approval */
.fv-so-maker{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-sm-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px}
.fv-sm-step{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:10px;background:rgba(5,150,105,.06);border:1px solid rgba(5,150,105,.18);margin-bottom:6px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-sm-av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:800;flex-shrink:0}
.fv-sm-av.a{background:linear-gradient(135deg,var(--accent),var(--accent-dark))}
.fv-sm-av.b{background:linear-gradient(135deg,#059669,#047857)}
.fv-sm-av.c{background:linear-gradient(135deg,#0E7490,#155E75)}
.fv-sm-body{flex:1;min-width:0}
.fv-sm-role{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-sm-time{font-size:10px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-sm-status{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2);letter-spacing:.03em;font-family:'Plus Jakarta Sans',sans-serif}

/* Capability 6: Version control + audit trail */
.fv-so-audit{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-sa-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;gap:8px}
.fv-sa-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border);letter-spacing:.03em}
.fv-sa-section{margin-bottom:10px}
.fv-sa-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--gray-500);letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.fv-sa-ver{display:flex;align-items:center;gap:10px;padding:7px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:3px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-sa-ver.live{background:var(--accent-light);border-color:var(--accent-border)}
.fv-sa-v{font-size:10.5px;font-weight:800;color:var(--gray-900);padding:2px 7px;border-radius:4px;background:#fff;border:1px solid var(--gray-200);flex-shrink:0}
.fv-sa-ver.live .fv-sa-v{background:var(--accent);color:#fff;border-color:transparent}
.fv-sa-note{flex:1;font-size:10px;color:var(--gray-700);font-weight:600}
.fv-sa-date{font-size:9px;color:var(--gray-500);font-weight:600}
.fv-sa-log-row{display:grid;grid-template-columns:60px 1fr 70px;gap:8px;padding:6px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;align-items:center;border-top:1px solid var(--gray-100)}
.fv-sa-log-row:first-of-type{border-top:none;padding-top:0}
.fv-sa-log-time{color:var(--gray-400);font-weight:600}
.fv-sa-log-action{color:var(--gray-800);font-weight:600}
.fv-sa-log-action strong{color:var(--gray-900);font-weight:800}
.fv-sa-log-actor{color:var(--accent-dark);font-weight:700;text-align:right;font-size:9px}

/* ── ALSO INCLUDED (secondary capabilities, nested under main capabilities) ── */
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
    <h1>The SOP is only useful <br>if it's <span class="accent">in your hand, in the moment</span>.</h1>
    <p class="subtitle">Standard operating procedures for every function, branch banking, claims processing, field operations, customer service, delivered on mobile, in the right language, with comprehension tested before it matters. Built for Operations, Quality, L&amp;D, and Process Excellence teams.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-secondary">Mobile demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">SOPs</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="so-mockup">
      <div class="so-phone">
        <div class="so-screen">
          <div class="so-notch"></div>
          <div class="so-statusbar"><span>9:41</span><span>&#x1F4F6; &#x1F50B;</span></div>
          <div class="so-header">
            <div class="so-back"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg></div>
            <div class="so-htitle">Customer SOP</div>
            <span class="so-lang">&#x1F1EE;&#x1F1F3; हिंदी</span>
          </div>
          <div class="so-content">
            <span class="so-ctag">&#x1F4CB; SOP v4.2 &middot; Branch Ops</span>
            <div class="so-sop-title">KYC for walk-in customer</div>
            <div class="so-sop-title-h">ग्राहक से KYC प्रक्रिया, स्टेप बाय स्टेप</div>
            <div class="so-flow">
              <div class="so-flow-label">&#x1F50E; Process flow</div>
              <div class="so-flow-step done"><div class="so-flow-num">&#x2713;</div><div class="so-flow-text">पहचान प्रमाण लें<div class="so-flow-line"></div></div></div>
              <div class="so-flow-step done"><div class="so-flow-num">&#x2713;</div><div class="so-flow-text">फॉर्म भरें और सत्यापित करें<div class="so-flow-line"></div></div></div>
              <div class="so-flow-step"><div class="so-flow-num">3</div><div class="so-flow-text">CRM में जानकारी दर्ज करें<div class="so-flow-line"></div></div></div>
              <div class="so-flow-step"><div class="so-flow-num">4</div><div class="so-flow-text">Approval के लिए शाखा प्रबंधक को भेजें</div></div>
            </div>
            <div class="so-action">
              <div class="so-action-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
              <span class="so-action-text">Complete short quiz to confirm understanding</span>
            </div>
          </div>
        </div>
      </div>

      <div class="so-float-quiz">
        <div class="so-quiz-head"><div class="so-quiz-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><span class="so-quiz-title">Quiz passed</span></div>
        <div class="so-quiz-score">9/10</div>
        <div class="so-quiz-sub">Comprehension confirmed &middot; 94% first-try rate</div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>An SOP in a PDF on a shared drive <span class="g-text">isn't an SOP.</span></h2>
    <p>It's a document. It only becomes an SOP when the person doing the work, the branch teller, the claims processor, the field agent, the nurse, the floor supervisor, can reach it in the moment, read it in a language they're fluent in, and actually understand the process it describes.</p>
    <p>SOPs on PolicyCentral.ai are built for the person in front of the customer, the machine, or the claim, not for the person who wrote the PDF.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">In branch banking &amp; field operations</span>
      <h3>SOPs that work for the workforce actually doing the work.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A retail bank has thousands of branches across towns and cities. A microfinance institution has field agents on motorbikes between villages. An insurer has claims assessors at the scene of an accident. A hospital has nurses at the bedside.</p>
      <p>The person who needs an SOP at that moment is <strong>not at a desktop, may not read English as a first language, and does not have time to figure out where the document lives</strong>. They need it on the phone they're already holding, in the language they think in, with the key process as a visual, and a short check at the end that confirms they got it.</p>
      <p>That's what SOPs on PolicyCentral.ai look like. AI-generated infographics for procedural flows, 10 Indian languages, instant search across the SOP and its attachments, and a three-question quiz to prove comprehension, all tracked back to the compliance dashboard the operations head already runs.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">mid-task retrieval.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
      <h3>AI infographics for procedural flows.</h3>
      <p>Feed the platform a text SOP; it produces a visual flowchart of the process: the steps, the decisions, the branches. Easier to grasp at a glance, easier to recall under pressure. The PM for the SOP reviews and approves the generated visual before it ever reaches the floor.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore AI Intelligence <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-info">
        <div class="fv-info-title">KYC Walk-in Flow, auto-infographic</div>
        <div class="fv-info-step"><span class="fv-info-dot"></span><span class="fv-info-text">Collect photo ID + address proof</span></div>
        <div class="fv-info-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg></div>
        <div class="fv-info-step"><span class="fv-info-dot"></span><span class="fv-info-text">Verify against CKYC repository</span></div>
        <div class="fv-info-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg></div>
        <div class="fv-info-step branch"><span class="fv-info-dot"></span><span class="fv-info-text">If verified &rarr; CRM entry</span></div>
        <div class="fv-info-step branch"><span class="fv-info-dot"></span><span class="fv-info-text">If mismatch &rarr; branch manager review</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
      <h3>Quizzes that confirm comprehension, not scrolling.</h3>
      <p>Three to five multiple-choice questions auto-generated from the SOP content. A pass is the signal that the person actually understood the process, not just that they swiped to the bottom. Failed quizzes route straight to the supervisor dashboard for a follow-up conversation.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Interaction &amp; Acknowledgement <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-quiz">
        <div class="fv-q-head">
          <div class="fv-q-label">Q2 of 3</div>
          <div class="fv-q-question">If a customer's photo ID doesn't match CKYC, what is the correct next step?</div>
        </div>
        <div class="fv-q-opt"><span class="fv-q-check"></span>Proceed with CRM entry</div>
        <div class="fv-q-opt correct"><span class="fv-q-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg></span>Route to branch manager for review</div>
        <div class="fv-q-opt"><span class="fv-q-check"></span>Ask customer to return next day</div>
        <div class="fv-q-opt"><span class="fv-q-check"></span>Override with senior teller's credentials</div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
      <h3>Ten Indian languages, comprehension's biggest lever.</h3>
      <p>Hindi, Tamil, Telugu, Kannada, Malayalam, Marathi, Bengali, Gujarati, Punjabi, Urdu. An employee reading a process in their first language is measurably more likely to follow it correctly. Every translation reviewed by a human before it reaches the floor.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Translation <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-lang">
        <div class="fv-lang-title">KYC SOP v4.2, translations live</div>
        <div class="fv-lang-row"><span class="fv-lang-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-lang-body"><div class="fv-lang-name">Hindi</div><div class="fv-lang-text">ग्राहक से KYC प्रक्रिया</div></div><span class="fv-lang-done">&#x2713;</span></div>
        <div class="fv-lang-row"><span class="fv-lang-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-lang-body"><div class="fv-lang-name">Tamil</div><div class="fv-lang-text">வாடிக்கையாளர் KYC செயல்முறை</div></div><span class="fv-lang-done">&#x2713;</span></div>
        <div class="fv-lang-row"><span class="fv-lang-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-lang-body"><div class="fv-lang-name">Bengali</div><div class="fv-lang-text">গ্রাহক KYC প্রক্রিয়া</div></div><span class="fv-lang-done">&#x2713;</span></div>
        <div class="fv-lang-row"><span class="fv-lang-flag">&#x1F1EE;&#x1F1F3;</span><div class="fv-lang-body"><div class="fv-lang-name">Marathi</div><div class="fv-lang-text">ग्राहक KYC प्रक्रिया</div></div><span class="fv-lang-done">&#x2713;</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h3>Mobile-native, searchable in three words.</h3>
      <p>White-label iOS and Android apps with native push, the SOP update lands on the floor agent's phone the moment it goes live. 4D search across title, body, attachments, and content inside attachments gets the answer in seconds, no scrolling through a fifty-page document to find the one paragraph that matters.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore Employee Portal <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-mobile">
        <div class="fv-m-title">On the field phone</div>
        <div class="fv-m-grid">
          <div class="fv-m-card"><div class="fv-m-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="2"/></svg></div><div class="fv-m-card-title">White-label app</div><div class="fv-m-card-sub">Your brand &middot; iOS + Android</div></div>
          <div class="fv-m-card"><div class="fv-m-card-icon alt"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 8h14M5 12h14M5 16h10"/></svg></div><div class="fv-m-card-title">10 languages</div><div class="fv-m-card-sub">Read in your first language</div></div>
          <div class="fv-m-card"><div class="fv-m-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div><div class="fv-m-card-title">4D search</div><div class="fv-m-card-sub">Title &middot; body &middot; file &middot; in-file</div></div>
          <div class="fv-m-card"><div class="fv-m-card-icon alt"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><div class="fv-m-card-title">Push notify</div><div class="fv-m-card-sub">SOP updated &middot; instant alert</div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg></div>
      <h3>Maker-checker approval, with quality in the loop.</h3>
      <p>SOPs don't reach the floor until the process owner, the quality lead, and the compliance officer have signed off. Every approval step, every reviewer, every timestamp is captured automatically. When an auditor asks who authorised this SOP on which date, the answer is one click away.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-so-maker">
        <div class="fv-sm-title">Claims Intake SOP v4.2, Approval</div>
        <div class="fv-sm-step">
          <div class="fv-sm-av a">PM</div>
          <div class="fv-sm-body"><div class="fv-sm-role">Process Owner, uploaded</div><div class="fv-sm-time">Apr 02 &middot; 10:12 AM</div></div>
          <span class="fv-sm-status">Signed</span>
        </div>
        <div class="fv-sm-step">
          <div class="fv-sm-av b">QL</div>
          <div class="fv-sm-body"><div class="fv-sm-role">Quality Lead, reviewed</div><div class="fv-sm-time">Apr 04 &middot; 3:40 PM</div></div>
          <span class="fv-sm-status">Signed</span>
        </div>
        <div class="fv-sm-step">
          <div class="fv-sm-av c">CO</div>
          <div class="fv-sm-body"><div class="fv-sm-role">Compliance Officer, approved</div><div class="fv-sm-time">Apr 05 &middot; 9:15 AM</div></div>
          <span class="fv-sm-status">Signed</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Version control and audit trail, compliance-grade.</h3>
      <p>Every SOP version preserved with timestamps, approvers, and what changed. Every acknowledgement, every quiz attempt, every read, logged. Export audit-ready reports by SOP, cohort, or date range. ISO, GMP, or internal operational audits: one filter, one download, every answer provable.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-so-audit">
        <div class="fv-sa-title"><span>Claims Intake SOP</span><span class="fv-sa-badge">AUDIT-READY</span></div>
        <div class="fv-sa-section">
          <div class="fv-sa-label">Versions</div>
          <div class="fv-sa-ver live"><span class="fv-sa-v">v4.2</span><span class="fv-sa-note">Updated escalation matrix</span><span class="fv-sa-date">Apr 05</span></div>
          <div class="fv-sa-ver"><span class="fv-sa-v">v4.1</span><span class="fv-sa-note">Field data fix, retained for audit</span><span class="fv-sa-date">Feb 12</span></div>
        </div>
        <div class="fv-sa-section">
          <div class="fv-sa-label">Recent activity</div>
          <div class="fv-sa-log-row"><span class="fv-sa-log-time">11:22 AM</span><span class="fv-sa-log-action"><strong>Quiz</strong>, 9 of 10</span><span class="fv-sa-log-actor">Priya S.</span></div>
          <div class="fv-sa-log-row"><span class="fv-sa-log-time">Apr 05</span><span class="fv-sa-log-action"><strong>Publish</strong>, v4.2 Live</span><span class="fv-sa-log-actor">Compliance</span></div>
          <div class="fv-sa-log-row"><span class="fv-sa-log-time">Apr 02</span><span class="fv-sa-log-action"><strong>Upload</strong>, v4.2 added</span><span class="fv-sa-log-actor">Process Mgr</span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the operations and quality teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
        <h3>Evergreen for future joiners <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Every new floor agent who joins after publish date auto-receives the SOP on day one. No manual chase.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></div>
        <h3>Personalized Employee Dashboard <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Each agent sees the SOPs that govern their role, in their branch, in their language, ranked by what's new.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
        <h3>Policy Search Analytics <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>See exactly what the floor is searching for. The repeat queries are the SOP gaps no one filed a ticket about.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Individual Employee Report <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Per-agent view of every SOP read, quizzed, or pending. Useful when ops asks who's been through the new flow.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></div>
        <h3>HRMS Integration <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Branch transfers, role changes, and new joiner data flow in automatically. SOP audiences stay current.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <h3>Automated Policy Expiry <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Set a date; the SOP retires and archives on schedule. The old version stays traceable for audit.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real work.</span></h2>
    <p>Five situations front-line teams face every day.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="9" width="18" height="12" rx="2"/><path d="M3 9l9-7 9 7"/></svg></div>
      <h3>A customer at the teller window</h3>
      <p>A teller hits an edge case in the KYC process. They open the SOP app, see the infographic of the decision tree in Hindi, confirm the step, all before the customer loses patience.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Infographic &rarr; Native language &rarr; Mobile-first</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
      <h3>A field officer at a customer's doorstep</h3>
      <p>A microfinance officer at a borrower's home hits a documentation edge case the standard onboarding flow didn't anticipate. They open the SOP on their phone, search "income proof exception" in three words, and complete the visit without rescheduling.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Mobile-first &rarr; Quick search &rarr; Exception flow</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
      <h3>A new SOP rolls out</h3>
      <p>Updated escalation matrix for fraud-suspect transactions. Pushed to all branch-facing staff, with a three-question quiz. Quiz-pass rate visible by branch. Any branch below 80% gets a live session.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Targeted distribution &rarr; Quiz &rarr; Branch-level analytics</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>"What do I do if the customer refuses biometric?"</h3>
      <p>A three-word search, a hit inside the KYC SOP attachment, two lines of answer. The agent's on to the next step without calling the supervisor.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>4D Search across attachment contents</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3zM9 3v18M15 3v18M3 9h18M3 15h18"/></svg></div>
      <h3>Quarterly operations review</h3>
      <p>The Ops head wants to see: which SOPs have the lowest quiz-pass rates, which branches lag on acknowledgement, which SOP has been searched most often (usually the one employees find hardest). One dashboard, one export, root causes surfaced.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Analytics dashboard &rarr; search-behaviour reports &rarr; Quiz scores</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "filed somewhere" <br>to <span class="g-text">"in hand when it matters."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Process consistency</h3>
      <p>From <strong>"every branch does it slightly differently"</strong> to <strong>the same SOP, in every language, on every phone</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Comprehension evidence</h3>
      <p>From <strong>"I acknowledged it"</strong> to <strong>quiz scores and search patterns</strong> that show what was actually understood.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Field reality</h3>
      <p>From <strong>"call the supervisor"</strong> to <strong>self-serve on the phone you're already holding</strong>.</p>
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
    <h2>Ready to put your SOPs <span class="g-text">in hand, in language, in the moment?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring an SOP your field team actually uses. In 20 minutes we'll show you the AI-generated infographic, the auto-translation into four languages, and what a three-question quiz would look like at the end.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
