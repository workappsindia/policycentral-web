<?php
/* Template Name: Use Case - Product Information */
get_header();
?>
<style>
/* Page-specific accent, cyan/sky (SaaS energy) */
:root { --accent:#0891B2; --accent-dark:#0E7490; --accent-light:#ECFEFF; --accent-border:rgba(8,145,178,.15); }

/* ── HERO VISUAL: Product Spec Card ── */
.pi-mockup{position:relative;width:100%;max-width:520px;animation:piFloat 7s ease-in-out infinite}
@keyframes piFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes piCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.pi-card{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.pi-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.pi-dots{display:flex;gap:5px}.pi-dots span{width:9px;height:9px;border-radius:50%}
.pi-dots span:nth-child(1){background:#EF4444}.pi-dots span:nth-child(2){background:#F59E0B}.pi-dots span:nth-child(3){background:#22C55E}
.pi-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.pi-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#0891B2,#0E7490);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.pi-body{padding:16px}
.pi-product-head{display:flex;align-items:center;gap:10px;margin-bottom:12px}
.pi-product-icon{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#0891B2,#0E7490);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pi-product-icon svg{width:16px;height:16px;color:#fff}
.pi-product-title{font-size:13px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.pi-product-sub{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px}
.pi-version-badge{margin-left:auto;padding:4px 10px;border-radius:5px;background:rgba(8,145,178,.1);color:var(--accent-dark);font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid var(--accent-border)}

.pi-diff{background:linear-gradient(180deg,rgba(8,145,178,.05) 0%,transparent 100%);border:1px solid var(--accent-border);border-radius:10px;padding:12px;margin-bottom:10px}
.pi-diff-label{font-size:9px;font-weight:800;color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}
.pi-diff-item{display:flex;align-items:flex-start;gap:8px;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif}
.pi-diff-plus{width:18px;height:18px;border-radius:5px;background:rgba(5,150,105,.12);color:#059669;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:10px}
.pi-diff-edit{width:18px;height:18px;border-radius:5px;background:rgba(217,119,6,.12);color:#D97706;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:10px}
.pi-diff-text{font-size:10.5px;font-weight:700;color:var(--gray-800);line-height:1.35}

.pi-segments{background:var(--gray-50);border-radius:10px;padding:10px 12px;margin-bottom:10px}
.pi-seg-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}
.pi-seg-row{display:flex;flex-wrap:wrap;gap:5px}
.pi-seg-chip{padding:4px 9px;border-radius:5px;background:#fff;border:1px solid var(--gray-200);font-size:10px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;display:inline-flex;align-items:center;gap:5px}
.pi-seg-chip.on{background:var(--accent-light);border-color:var(--accent-border);color:var(--accent-dark)}
.pi-seg-chip .dot{width:6px;height:6px;border-radius:50%;background:#059669}

.pi-delivered-row{display:flex;justify-content:space-between;align-items:center;padding-top:8px;font-family:'Plus Jakarta Sans',sans-serif}
.pi-delivered-label{font-size:10px;color:var(--gray-500);font-weight:700}
.pi-delivered-num{font-size:14px;font-weight:800;color:var(--accent-dark)}

.pi-float-search{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:186px;animation:piCardIn .6s ease-out both;animation-delay:.3s}
.pi-search-head{display:flex;align-items:center;gap:6px;padding:7px 10px;border:1px solid var(--gray-200);border-radius:8px;margin-bottom:8px}
.pi-search-head svg{width:11px;height:11px;color:var(--gray-400)}
.pi-search-q{font-size:10px;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-700);font-weight:600}
.pi-search-hit{padding:6px 8px;border-radius:7px;background:var(--accent-light);margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif}
.pi-search-hit-title{font-size:10px;font-weight:800;color:var(--accent-dark)}
.pi-search-hit-sub{font-size:9px;color:var(--gray-500);margin-top:1px}

.pi-float-comments{position:absolute;bottom:-18px;left:-18px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:200px;animation:piCardIn .6s ease-out both;animation-delay:.55s}
.pi-comm-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.pi-comm-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#0891B2,#0E7490);display:flex;align-items:center;justify-content:center}
.pi-comm-icon svg{width:11px;height:11px;color:#fff}
.pi-comm-title{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.pi-comm-item{display:flex;align-items:flex-start;gap:7px;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif}
.pi-comm-avatar{width:20px;height:20px;border-radius:50%;background:linear-gradient(135deg,#0891B2,#0E7490);color:#fff;font-size:9px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pi-comm-text{font-size:9.5px;color:var(--gray-700);font-weight:600;line-height:1.35}
.pi-comm-text strong{color:var(--gray-900);font-weight:800}

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

/* Capability visuals */
.fv-version-diff{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-vd-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-vd-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-vd-versions{display:flex;gap:6px;align-items:center}
.fv-vd-old{padding:3px 8px;border-radius:5px;background:var(--gray-100);color:var(--gray-500);font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.fv-vd-new{padding:3px 8px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid var(--accent-border)}
.fv-vd-arrow{font-size:10px;color:var(--gray-400);font-weight:800}
.fv-vd-line{display:flex;align-items:flex-start;gap:8px;padding:6px 10px;border-radius:7px;margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-vd-line.add{background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.18)}
.fv-vd-line.rm{background:rgba(225,29,72,.06);border:1px solid rgba(225,29,72,.15);text-decoration:line-through;color:var(--gray-500)}
.fv-vd-mark{font-weight:800;font-size:11px;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0}
.fv-vd-line.add .fv-vd-mark{color:#059669}
.fv-vd-line.rm .fv-vd-mark{color:#E11D48}
.fv-vd-text{font-size:11px;color:var(--gray-800);font-weight:600;line-height:1.4}
.fv-vd-line.rm .fv-vd-text{color:var(--gray-400)}

.fv-search{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-s-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px}
.fv-s-input{display:flex;align-items:center;gap:8px;padding:9px 12px;border:1.5px solid var(--accent-border);border-radius:9px;margin-bottom:10px;background:var(--accent-light)}
.fv-s-input svg{width:13px;height:13px;color:var(--accent)}
.fv-s-input-q{font-size:11px;font-weight:700;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-s-result{padding:9px 11px;border-radius:8px;background:var(--gray-50);margin-bottom:5px;border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-s-result-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:3px}
.fv-s-result-title{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-s-result-scope{font-size:8.5px;font-weight:700;color:var(--accent-dark);padding:2px 6px;border-radius:4px;background:var(--accent-light);letter-spacing:.04em;text-transform:uppercase}
.fv-s-result-sub{font-size:10px;color:var(--gray-500)}

.fv-rich{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rich-thumb{position:relative;border-radius:10px;overflow:hidden;aspect-ratio:16/9;background:linear-gradient(135deg,#0E7490,#0891B2);margin-bottom:10px;display:flex;align-items:center;justify-content:center}
.fv-rich-thumb::after{content:"";position:absolute;inset:0;background:repeating-linear-gradient(45deg,transparent 0,transparent 10px,rgba(255,255,255,.04) 10px,rgba(255,255,255,.04) 20px)}
.fv-rich-play{width:44px;height:44px;border-radius:50%;background:#fff;color:var(--accent-dark);display:flex;align-items:center;justify-content:center;position:relative;z-index:2}
.fv-rich-play svg{width:14px;height:14px;margin-left:2px}
.fv-rich-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.fv-rich-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px}
.fv-rich-atts{display:flex;gap:5px;flex-wrap:wrap}
.fv-rich-att{padding:3px 8px;border-radius:5px;background:var(--gray-100);font-size:9.5px;font-weight:700;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;gap:4px}
.fv-rich-att svg{width:9px;height:9px}

.fv-targets{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-t-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px}
.fv-t-group{padding:9px 12px;border-radius:9px;background:var(--gray-50);margin-bottom:5px;border:1px solid var(--gray-100);display:flex;align-items:center;gap:10px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-t-group.on{background:var(--accent-light);border-color:var(--accent-border)}
.fv-t-dot{width:8px;height:8px;border-radius:50%;background:var(--gray-300);flex-shrink:0}
.fv-t-group.on .fv-t-dot{background:var(--accent);box-shadow:0 0 0 3px var(--accent-border)}
.fv-t-name{flex:1;font-size:11px;font-weight:700;color:var(--gray-900)}
.fv-t-count{font-size:9.5px;font-weight:700;color:var(--gray-500)}
.fv-t-group.on .fv-t-count{color:var(--accent-dark)}

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
  .pi-mockup{max-width:420px;margin:0 auto}
  .pi-float-search{right:-8px;top:-8px}
  .pi-float-comments{left:-8px;bottom:-10px}
  .fv-version-diff,.fv-search,.fv-rich,.fv-targets{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){.pi-mockup{max-width:340px}.pi-float-search,.pi-float-comments{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}}

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
    <h1>Every team, <br><span class="accent">on the same version of the product.</span></h1>
    <p class="subtitle">Product specs, feature guides, pricing sheets, release notes, and launch collateral, distributed to the right teams the moment they change. Built for Product, Sales, Customer Success, and Marketing functions that need to stay in sync as the product moves.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Product Information</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="pi-mockup">
      <div class="pi-card">
        <div class="pi-titlebar">
          <div class="pi-dots"><span></span><span></span><span></span></div>
          <span class="pi-titlebar-text">Product Release Hub</span>
          <span class="pi-titlebar-badge">JUST SHIPPED</span>
        </div>
        <div class="pi-body">
          <div class="pi-product-head">
            <div class="pi-product-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/></svg></div>
            <div><div class="pi-product-title">Pricing Sheet, Enterprise Tier</div><div class="pi-product-sub">Updated Mar 28 &middot; Product team</div></div>
            <span class="pi-version-badge">v2.4</span>
          </div>

          <div class="pi-diff">
            <div class="pi-diff-label">What's new in v2.4</div>
            <div class="pi-diff-item"><span class="pi-diff-plus">+</span><span class="pi-diff-text">Annual commit pricing added for 500+ seat deals</span></div>
            <div class="pi-diff-item"><span class="pi-diff-edit">~</span><span class="pi-diff-text">SSO now standard on Business tier (was Enterprise-only)</span></div>
            <div class="pi-diff-item"><span class="pi-diff-plus">+</span><span class="pi-diff-text">New add-on: Dedicated CSM at 1000+ seats</span></div>
          </div>

          <div class="pi-segments">
            <div class="pi-seg-label">Live for</div>
            <div class="pi-seg-row">
              <span class="pi-seg-chip on"><span class="dot"></span>Sales</span>
              <span class="pi-seg-chip on"><span class="dot"></span>Customer Success</span>
              <span class="pi-seg-chip on"><span class="dot"></span>Marketing</span>
              <span class="pi-seg-chip on"><span class="dot"></span>Solution Engineers</span>
            </div>
          </div>

          <div class="pi-delivered-row">
            <span class="pi-delivered-label">Acknowledged by GTM</span>
            <span class="pi-delivered-num">94%</span>
          </div>
        </div>
      </div>

      <div class="pi-float-search">
        <div class="pi-search-head">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span class="pi-search-q">enterprise SSO pricing</span>
        </div>
        <div class="pi-search-hit">
          <div class="pi-search-hit-title">Pricing Sheet v2.4</div>
          <div class="pi-search-hit-sub">...SSO is included on Business tier as of Mar 28...</div>
        </div>
      </div>

      <div class="pi-float-comments">
        <div class="pi-comm-head">
          <div class="pi-comm-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
          <span class="pi-comm-title">Discussion &middot; 4 replies</span>
        </div>
        <div class="pi-comm-item">
          <div class="pi-comm-avatar">SA</div>
          <div class="pi-comm-text"><strong>Sales AE</strong>: What if customer already has SSO from an old contract?</div>
        </div>
        <div class="pi-comm-item">
          <div class="pi-comm-avatar" style="background:linear-gradient(135deg,#D97706,#B45309)">PM</div>
          <div class="pi-comm-text"><strong>Product</strong>: Grandfathered; no change to billing.</div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal" style="max-width:1060px">
    <h2 style="font-size:clamp(28px,3.2vw,40px)">Sales is pitching <span class="g-text">last sprint's feature set.</span></h2>
    <p>A product ships updates every few weeks. Pricing shifts. Packaging gets rewritten. New features launch, old ones get deprecated. And somewhere in the fog, a sales rep opens a deck from three months ago, a support agent quotes pricing that changed last Friday, and a marketing asset references a feature that hasn't existed since the last release.</p>
    <p>Product Information on PolicyCentral.ai makes one thing true: there is exactly one current version of every product artefact, it's targeted to the teams that need it, and changes since the last version are visible at a glance. The handover from Product to GTM stops being a drip of Slack messages and starts being a published source of truth.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a SaaS company shipping continuously</span>
      <h3>Product moves weekly. GTM shouldn't find out monthly.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A modern SaaS company can ship a new feature, deprecate an old one, and change packaging inside the same fortnight. Customer conversations happen every hour: sales is qualifying, CS is handling renewals, marketing is writing ad copy, solution engineers are scoping integrations.</p>
      <p><strong>Every one of those conversations is only as good as the product information the person on the front line has.</strong> A feature rollout note sent as an email attachment on Tuesday is unfindable by Thursday. A pricing update buried in a shared drive gets quoted wrong for weeks.</p>
      <p>The same platform that runs a bank's policy library, structured content, targeted distribution, version control, 4D search, team-level acknowledgement, is exactly what Product, Sales, CS, and Marketing need to stay in sync.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">product-GTM alignment.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Fast versioning, for teams shipping weekly.</h3>
      <p>A product artefact can have a new version every fortnight and still carry its full history. Every version shows what changed, who approved it, and who has acknowledged the latest. Sales knows exactly whether they're pitching the current pricing or the superseded one.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Version Control <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-version-diff">
        <div class="fv-vd-head">
          <span class="fv-vd-title">Pricing Sheet</span>
          <div class="fv-vd-versions"><span class="fv-vd-old">v2.3</span><span class="fv-vd-arrow">&rsaquo;</span><span class="fv-vd-new">v2.4</span></div>
        </div>
        <div class="fv-vd-line add"><span class="fv-vd-mark">+</span><span class="fv-vd-text">Annual commit pricing for 500+ seat deals</span></div>
        <div class="fv-vd-line add"><span class="fv-vd-mark">+</span><span class="fv-vd-text">Dedicated CSM add-on at 1000+ seats</span></div>
        <div class="fv-vd-line rm"><span class="fv-vd-mark">&minus;</span><span class="fv-vd-text">SSO limited to Enterprise tier only</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>4D Intelligent Search, answers mid-conversation.</h3>
      <p>A sales rep on a call types a three-word query and gets the exact line from the current pricing sheet. Search spans titles, body text, attached files, and content <em>inside</em> files. No switching to Slack. No pinging Product. The answer arrives while the customer is still on the line.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore 4D Search <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-search">
        <div class="fv-s-title">Advanced Policy Search</div>
        <div class="fv-s-input">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span class="fv-s-input-q">enterprise SSO pricing</span>
        </div>
        <div class="fv-s-result">
          <div class="fv-s-result-head"><span class="fv-s-result-title">Pricing Sheet v2.4</span><span class="fv-s-result-scope">Body</span></div>
          <div class="fv-s-result-sub">"SSO is included on Business tier as of Mar 28..."</div>
        </div>
        <div class="fv-s-result">
          <div class="fv-s-result-head"><span class="fv-s-result-title">Sales FAQ, Objections</span><span class="fv-s-result-scope">In-file</span></div>
          <div class="fv-s-result-sub">"If prospect asks for SSO on Business tier..."</div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></div>
      <h3>Rich media that actually gets watched.</h3>
      <p>Loom walkthroughs of new features. Three-minute PM demos. Audio-only release notes for reps on the road. PDFs, images, embedded videos, whatever format the content needs, the platform carries. Screenshot protection keeps competitive product content inside.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-rich">
        <div class="fv-rich-thumb">
          <div class="fv-rich-play"><svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
        </div>
        <div class="fv-rich-title">v2.4, Feature walkthrough</div>
        <div class="fv-rich-meta">Product Manager &middot; 4:18 &middot; Secure internal</div>
        <div class="fv-rich-atts">
          <span class="fv-rich-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>Pricing.pdf</span>
          <span class="fv-rich-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>Competitor.png</span>
          <span class="fv-rich-att"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/></svg>Audio notes</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg></div>
      <h3>Cross-function targeting, the right team, the right moment.</h3>
      <p>The pricing sheet goes to Sales, CS, and SEs but not to Engineering. The technical deep-dive goes to SEs and Eng but not to Marketing. The launch note goes to every GTM function simultaneously. AD/HRMS sync handles the audience lists; no manual maintenance. New joiners auto-receive everything relevant to their role.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-targets">
        <div class="fv-t-title">Audience, Pricing Sheet v2.4</div>
        <div class="fv-t-group on"><span class="fv-t-dot"></span><span class="fv-t-name">Sales, AE + SDR</span><span class="fv-t-count">187 users</span></div>
        <div class="fv-t-group on"><span class="fv-t-dot"></span><span class="fv-t-name">Customer Success</span><span class="fv-t-count">94 users</span></div>
        <div class="fv-t-group on"><span class="fv-t-dot"></span><span class="fv-t-name">Solution Engineers</span><span class="fv-t-count">42 users</span></div>
        <div class="fv-t-group on"><span class="fv-t-dot"></span><span class="fv-t-name">Marketing, Product Mkt</span><span class="fv-t-count">28 users</span></div>
        <div class="fv-t-group"><span class="fv-t-dot"></span><span class="fv-t-name">Engineering</span><span class="fv-t-count">off &middot; not in scope</span></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the product, GTM, and revops teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></div>
        <h3>Personalized Employee Dashboard <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Each rep sees what's new in their stack, ranked by relevance, never buried under irrelevant releases.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
        <h3>Policy Search Analytics <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>See what reps are searching for. The questions you didn't know they had become the FAQs you should have written.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
        <h3>AI-Generated FAQs <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Auto-extract the questions every release prompts, then publish the answers alongside the release notes.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Calendar View for Releases <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Release dates, training sessions, pricing changes, all on a calendar your GTM team can subscribe to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></div>
        <h3>HRMS &amp; Intranet Integration <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Audience lists by team, region, and quota stay current via your existing employee data systems.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>SSO &amp; Active Directory <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>One-click login through your existing identity provider. No extra password to manage.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real handovers. <span class="g-text">Actually handed over.</span></h2>
    <p>Five situations every Product and GTM team recognises.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Pricing changes on Friday</h3>
      <p>Product updates the pricing sheet Friday afternoon. A short diff shows what moved. By Monday, every AE and CSM has acknowledged the update. The new pricing is what shows up in search; the old one is archived but traceable.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version diff &rarr; Cross-function target &rarr; Acknowledge</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>Mid-call: "Do we support OAuth?"</h3>
      <p>A rep on a live call types three words and sees the integration matrix from the current Sales FAQ, and a one-line answer from inside the technical spec. No Slack, no DM, no callback-promise.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>4D Search across title + body + in-file</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
      <h3>Feature launch week</h3>
      <p>PM uploads a 4-minute walkthrough, the launch note, the competitive positioning, and the updated battlecard. Targeted at Sales, CS, Marketing, SEs. Reach and acknowledgement visible by team by EOD.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Rich media + Targeted distribution + Acknowledge</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
      <h3>GTM asks the PM a question</h3>
      <p>A sales rep drops a comment on a spec page. The PM replies directly in the platform. Everyone else who hits the same question in the future sees the answer without asking again.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Comments threaded on content &rarr; Knowledge compounds</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
      <h3>Onboarding a new AE</h3>
      <p>A new sales hire joins on day one. Evergreen targeting pushes them the current pricing sheet, active battlecards, feature walkthroughs, and objection handlers on Monday morning. By Wednesday they've acknowledged the core set and are allowed into first-call rotation.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Evergreen distribution &rarr; Acknowledge &rarr; Ready-to-sell signal</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "check with the PM" <br>to <span class="g-text">"it's in the platform."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Time-to-current</h3>
      <p>From <strong>weeks of drift</strong> to <strong>same-day alignment</strong> across every GTM function.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Answers mid-conversation</h3>
      <p>From <strong>"let me check and get back"</strong> to <strong>3-word search, on the call</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Product-GTM handover</h3>
      <p>From <strong>Slack threads and email attachments</strong> to a <strong>single source of truth</strong>, versioned.</p>
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
    <h2>Ready to make sure <span class="g-text">every team ships the same story?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring your current pricing sheet, a feature walkthrough, and a battlecard. In 20 minutes we'll show you what version control, 4D search, and targeted distribution look like for your GTM organisation.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
