<?php
/* Template Name: Use Case - Corporate Updates */
get_header();
?>
<style>
/* Page-specific accent, indigo/violet (leadership gravitas) */
:root { --accent:#4338CA; --accent-dark:#3730A3; --accent-light:#EEF2FF; --accent-border:rgba(67,56,202,.15); }

/* ── HERO VISUAL: Broadcast Analytics ── */
.cu-mockup{position:relative;width:100%;max-width:520px;animation:cuFloat 7s ease-in-out infinite}
@keyframes cuFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes cuCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.cu-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.cu-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.cu-dots{display:flex;gap:5px}
.cu-dots span{width:9px;height:9px;border-radius:50%}
.cu-dots span:nth-child(1){background:#EF4444}
.cu-dots span:nth-child(2){background:#F59E0B}
.cu-dots span:nth-child(3){background:#22C55E}
.cu-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.cu-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#4338CA,#3730A3);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.cu-body{padding:16px}
.cu-topdeck{background:linear-gradient(135deg,#4338CA,#6366F1);border-radius:12px;padding:14px 16px;color:#fff;position:relative;overflow:hidden;margin-bottom:14px}
.cu-topdeck::after{content:"";position:absolute;top:-20px;right:-20px;width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,.08)}
.cu-topdeck-label{font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.12em;opacity:.8;margin-bottom:4px;text-transform:uppercase}
.cu-topdeck-title{font-size:14px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px;position:relative;z-index:2}
.cu-topdeck-meta{font-size:10px;opacity:.85;font-family:'Plus Jakarta Sans',sans-serif}
.cu-video-row{display:flex;align-items:center;gap:8px;margin-top:10px;padding:6px 10px;background:rgba(255,255,255,.15);border-radius:8px;position:relative;z-index:2}
.cu-video-play{width:22px;height:22px;border-radius:50%;background:#fff;color:#4338CA;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cu-video-play svg{width:9px;height:9px;margin-left:1px}
.cu-video-text{font-size:10px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.cu-video-dur{font-size:9px;opacity:.8;font-family:'Plus Jakarta Sans',sans-serif}

.cu-metrics-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:10px}
.cu-metric{padding:8px 10px;border-radius:8px;background:var(--gray-50);border:1px solid var(--gray-100)}
.cu-metric-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.04em;text-transform:uppercase;margin-bottom:3px}
.cu-metric-value{font-size:16px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1}
.cu-metric-trend{font-size:8.5px;font-weight:700;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;margin-top:3px}

.cu-segments-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin:8px 0 6px}
.cu-segment-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.cu-segment-label{font-size:10px;font-weight:700;color:var(--gray-700);flex:1}
.cu-segment-bar{flex:1.6;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.cu-segment-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,#4338CA,#6366F1)}
.cu-segment-pct{font-size:10px;font-weight:800;color:#4338CA;min-width:28px;text-align:right}

.cu-float-react{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:172px;animation:cuCardIn .6s ease-out both;animation-delay:.3s}
.cu-float-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.cu-float-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#4338CA,#6366F1);display:flex;align-items:center;justify-content:center}
.cu-float-icon svg{width:11px;height:11px;color:#fff}
.cu-float-head h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.cu-reactions{display:flex;gap:6px;flex-wrap:wrap}
.cu-react{display:flex;align-items:center;gap:3px;padding:3px 6px;border-radius:5px;background:var(--gray-50);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--gray-700);border:1px solid var(--gray-100)}

.cu-float-recall{position:absolute;bottom:-18px;left:-18px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:200px;animation:cuCardIn .6s ease-out both;animation-delay:.55s}
.cu-recall-step{display:flex;align-items:flex-start;gap:8px;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif}
.cu-recall-dot{width:6px;height:6px;border-radius:50%;background:#4338CA;margin-top:5px;flex-shrink:0}
.cu-recall-text{flex:1;font-size:9.5px;font-weight:700;color:var(--gray-800);line-height:1.35}
.cu-recall-time{font-size:8.5px;color:var(--gray-400);font-weight:600;margin-top:1px}

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
.fv-video-card{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-video-thumb{position:relative;border-radius:10px;overflow:hidden;aspect-ratio:16/9;background:linear-gradient(135deg,#312E81,#4338CA);display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.fv-video-thumb::after{content:"";position:absolute;inset:0;background:radial-gradient(ellipse at top right,rgba(255,255,255,.12) 0%,transparent 60%)}
.fv-video-play{width:48px;height:48px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;position:relative;z-index:2}
.fv-video-play svg{width:16px;height:16px;color:#4338CA;margin-left:2px}
.fv-video-dur{position:absolute;bottom:8px;right:8px;padding:2px 7px;border-radius:4px;background:rgba(0,0,0,.6);color:#fff;font-size:9px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;z-index:2}
.fv-video-title{font-size:13px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px}
.fv-video-speaker{font-size:11px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:10px}
.fv-video-chips{display:flex;gap:6px;flex-wrap:wrap}
.fv-video-chip{padding:4px 9px;border-radius:5px;background:var(--accent-light);color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;border:1px solid var(--accent-border)}

.fv-topdeck{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-td-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between}
.fv-td-badge{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border);letter-spacing:.03em}
.fv-td-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:6px}
.fv-td-item.pinned{background:linear-gradient(135deg,var(--accent-light) 0%,#F5F3FF 100%);border-color:var(--accent-border)}
.fv-td-pin{width:24px;height:24px;border-radius:7px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-td-pin svg{width:12px;height:12px}
.fv-td-number{width:24px;height:24px;border-radius:7px;background:var(--gray-200);color:var(--gray-600);display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;flex-shrink:0}
.fv-td-item-title{font-size:11px;font-weight:700;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1.3;flex:1}
.fv-td-item-meta{font-size:9.5px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}

.fv-reach{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-reach-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:14px}
.fv-reach-big{display:flex;align-items:flex-end;gap:12px;padding:12px 0;border-bottom:1px solid var(--gray-100);margin-bottom:12px}
.fv-reach-big-num{font-family:'Plus Jakarta Sans',sans-serif;font-size:36px;font-weight:800;color:var(--accent-dark);line-height:1}
.fv-reach-big-label{font-size:11px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;padding-bottom:4px}
.fv-reach-row{display:flex;align-items:center;gap:10px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.fv-reach-dept{font-size:10.5px;font-weight:700;color:var(--gray-700);min-width:68px}
.fv-reach-bar{flex:1;height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.fv-reach-bar-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--accent),var(--accent-dark))}
.fv-reach-pct{font-size:10px;font-weight:800;color:var(--accent);min-width:30px;text-align:right}

.fv-recall-full{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-rc-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}
.fv-rc-step{display:flex;align-items:flex-start;gap:10px;padding:7px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-rc-step:first-of-type{border-top:none;padding-top:0}
.fv-rc-bullet{width:20px;height:20px;border-radius:6px;background:var(--accent-light);color:var(--accent-dark);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;border:1px solid var(--accent-border)}
.fv-rc-body{flex:1}
.fv-rc-head{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-rc-sub{font-size:10px;color:var(--gray-500);margin-top:1px}

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
  .cu-mockup{max-width:420px;margin:0 auto}
  .cu-float-react{right:-8px;top:-8px}
  .cu-float-recall{left:-8px;bottom:-10px}
  .fv-video-card,.fv-topdeck,.fv-reach,.fv-recall-full{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .cu-mockup{max-width:340px}
  .cu-float-react,.cu-float-recall{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}
}

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
    <h1>When leadership speaks,<br><span class="accent">make sure it lands.</span></h1>
    <p class="subtitle">Leadership messages, board updates, and crisis comms. Tracked the moment they land, across your entire workforce.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Corporate Updates</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="cu-mockup">
      <div class="cu-dash">
        <div class="cu-titlebar">
          <div class="cu-dots"><span></span><span></span><span></span></div>
          <span class="cu-titlebar-text">Broadcast Analytics</span>
          <span class="cu-titlebar-badge">LIVE REACH</span>
        </div>
        <div class="cu-body">
          <div class="cu-topdeck">
            <div class="cu-topdeck-label">&#x1F4CC; Top Deck &middot; Pinned</div>
            <div class="cu-topdeck-title">Q4 Results, A note from the CEO</div>
            <div class="cu-topdeck-meta">Published 9:00 AM &middot; Audience: All employees</div>
            <div class="cu-video-row">
              <div class="cu-video-play"><svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
              <div class="cu-video-text">Watch the 3-min message</div>
              <div class="cu-video-dur">3:12</div>
            </div>
          </div>
          <div class="cu-metrics-grid">
            <div class="cu-metric"><div class="cu-metric-label">Reached</div><div class="cu-metric-value">98%</div><div class="cu-metric-trend">&uarr; in 2 hrs</div></div>
            <div class="cu-metric"><div class="cu-metric-label">Watched</div><div class="cu-metric-value">71%</div><div class="cu-metric-trend">&uarr; trending</div></div>
            <div class="cu-metric"><div class="cu-metric-label">Reactions</div><div class="cu-metric-value">2.4k</div><div class="cu-metric-trend">&uarr; 1.2k &#x1F44F;</div></div>
          </div>
          <div class="cu-segments-label">By Department</div>
          <div class="cu-segment-row"><span class="cu-segment-label">Retail Banking</span><div class="cu-segment-bar"><div class="cu-segment-fill" style="width:92%"></div></div><span class="cu-segment-pct">92%</span></div>
          <div class="cu-segment-row"><span class="cu-segment-label">Treasury</span><div class="cu-segment-bar"><div class="cu-segment-fill" style="width:88%"></div></div><span class="cu-segment-pct">88%</span></div>
          <div class="cu-segment-row"><span class="cu-segment-label">Technology</span><div class="cu-segment-bar"><div class="cu-segment-fill" style="width:76%"></div></div><span class="cu-segment-pct">76%</span></div>
        </div>
      </div>

      <div class="cu-float-react">
        <div class="cu-float-head">
          <div class="cu-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
          <h3>Sentiment</h3>
        </div>
        <div class="cu-reactions">
          <span class="cu-react">&#x1F44F; 1,243</span>
          <span class="cu-react">&#x1F525; 482</span>
          <span class="cu-react">&#x2764;&#xFE0F; 318</span>
          <span class="cu-react">&#x1F4AA; 157</span>
          <span class="cu-react">&#x1F91D; 94</span>
        </div>
      </div>

      <div class="cu-float-recall">
        <div class="cu-recall-step">
          <div class="cu-recall-dot"></div>
          <div class="cu-recall-text">Edit correction pushed<div class="cu-recall-time">2 min ago &middot; typo fix</div></div>
        </div>
        <div class="cu-recall-step">
          <div class="cu-recall-dot"></div>
          <div class="cu-recall-text">Video v1 recalled<div class="cu-recall-time">18 min ago &middot; superseded by v2</div></div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>CEO emails get <span class="g-text">archived, not read.</span></h2>
    <p>The most important messages in your company, a change in strategy, the quarterly results, a leadership transition, a response to a market event, are the ones most likely to sit unread in employee inboxes. And when something actually needs a recall or a correction, good luck finding everyone who saw version one.</p>
    <p>Corporate Updates on PolicyCentral.ai treats leadership communication the way serious organisations already treat regulated policies: a single publishing surface, targeted audiences, proof of reach, and the ability to edit or pull a message without a frantic round of replies-all.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a large financial services group</span>
      <h3>Every quarterly town hall, every board update, landed and measured.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>Imagine a multi-entity bank or insurance group. The Group CEO records a video on results day. The CFO follows up with a written note for the investor community. The HR head sends a leadership-transition update to senior employees only. A crisis communication needs to go out on a Sunday night to branch managers across every region.</p>
      <p>Four very different messages. Four very different audiences. <strong>One platform that delivers each to the right people, tracks who watched, who acknowledged, who responded, and lets Corporate Communications recall or edit without chasing the thread.</strong></p>
      <p>That's what Corporate Updates looks like on PolicyCentral.ai, the same platform your compliance team already runs policies on.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">leadership communications.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></div>
      <h3>Video and rich media, hosted securely.</h3>
      <p>Record a CEO message, upload an investor deck, embed a Loom walkthrough. Play from inside the platform, not a public YouTube link. Audio, images, PDFs, embedded video: whatever the message calls for, the format follows. Screenshot-protection and download controls keep sensitive content inside.</p>
      <a href="<?php echo esc_url(home_url('/feature/content-management/')); ?>" class="uc-cap-link">Explore Content Management <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-video-card">
        <div class="fv-video-thumb">
          <div class="fv-video-play"><svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
          <span class="fv-video-dur">3:12</span>
        </div>
        <div class="fv-video-title">Q4 Results, A note from the CEO</div>
        <div class="fv-video-speaker">Uday Kotak &middot; Group CEO &middot; Secure internal video</div>
        <div class="fv-video-chips">
          <span class="fv-video-chip">All employees</span>
          <span class="fv-video-chip">Screenshot blocked</span>
          <span class="fv-video-chip">No download</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="17" x2="12" y2="3"/><polyline points="6 11 12 17 18 11"/><line x1="5" y1="21" x2="19" y2="21"/></svg></div>
      <h3>Top Deck, so the important stays visible.</h3>
      <p>Pin up to five critical communications to the top of every employee's home screen. They scroll through the rest. They cannot scroll past the pinned ones. When the CEO speaks, it doesn't compete with the canteen menu.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-cap-link">Explore Employee Portal <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-topdeck">
        <div class="fv-td-title">Employee Home <span class="fv-td-badge">TOP DECK</span></div>
        <div class="fv-td-item pinned">
          <div class="fv-td-pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L13.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L10.91 8.26L12 2z"/></svg></div>
          <div><div class="fv-td-item-title">Q4 Results, CEO Message</div><div class="fv-td-item-meta">Critical &middot; 3-min video &middot; Acknowledge by EOD</div></div>
        </div>
        <div class="fv-td-item pinned">
          <div class="fv-td-pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L13.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L10.91 8.26L12 2z"/></svg></div>
          <div><div class="fv-td-item-title">Board meeting summary</div><div class="fv-td-item-meta">Important &middot; Published Mar 28</div></div>
        </div>
        <div class="fv-td-item">
          <div class="fv-td-number">3</div>
          <div><div class="fv-td-item-title">Revised POSH Policy</div><div class="fv-td-item-meta">Compliance &middot; Acknowledge required</div></div>
        </div>
        <div class="fv-td-item">
          <div class="fv-td-number">4</div>
          <div><div class="fv-td-item-title">Canteen menu, April</div><div class="fv-td-item-meta">General &middot; HR &middot; Read</div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h3>Reach, not just send.</h3>
      <p>Real-time dashboards show who was reached, who watched, who paused, who reacted, and where the message under-delivered. See reach broken down by department, grade, or location. A corporate update that stops at "sent" is half the job.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-reach">
        <div class="fv-reach-title">Q4 CEO Message, Reach</div>
        <div class="fv-reach-big">
          <span class="fv-reach-big-num">98%</span>
          <span class="fv-reach-big-label">reached within 2 hours</span>
        </div>
        <div class="fv-reach-row"><span class="fv-reach-dept">Retail</span><div class="fv-reach-bar"><div class="fv-reach-bar-fill" style="width:92%"></div></div><span class="fv-reach-pct">92%</span></div>
        <div class="fv-reach-row"><span class="fv-reach-dept">Treasury</span><div class="fv-reach-bar"><div class="fv-reach-bar-fill" style="width:88%"></div></div><span class="fv-reach-pct">88%</span></div>
        <div class="fv-reach-row"><span class="fv-reach-dept">Technology</span><div class="fv-reach-bar"><div class="fv-reach-bar-fill" style="width:76%"></div></div><span class="fv-reach-pct">76%</span></div>
        <div class="fv-reach-row"><span class="fv-reach-dept">Branches</span><div class="fv-reach-bar"><div class="fv-reach-bar-fill" style="width:96%"></div></div><span class="fv-reach-pct">96%</span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>Edit, recall, or replace, no apology email needed.</h3>
      <p>A stat was wrong. A line needs softening. A message went to the wrong audience. Edit in place, push an updated version, or recall entirely, in seconds. Employees see the current truth; the full history is preserved for record. No email chain of retractions.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-recall-full">
        <div class="fv-rc-title">Publisher Actions, Q4 Message</div>
        <div class="fv-rc-step">
          <div class="fv-rc-bullet">1</div>
          <div class="fv-rc-body"><div class="fv-rc-head">Published v1 at 9:00 AM</div><div class="fv-rc-sub">Reached 47% within first hour</div></div>
        </div>
        <div class="fv-rc-step">
          <div class="fv-rc-bullet">2</div>
          <div class="fv-rc-body"><div class="fv-rc-head">Edited at 9:18 AM</div><div class="fv-rc-sub">Revenue figure corrected &middot; silent update</div></div>
        </div>
        <div class="fv-rc-step">
          <div class="fv-rc-bullet">3</div>
          <div class="fv-rc-body"><div class="fv-rc-head">Resend-to-unread triggered</div><div class="fv-rc-sub">Only un-watched employees renotified</div></div>
        </div>
        <div class="fv-rc-step">
          <div class="fv-rc-bullet">4</div>
          <div class="fv-rc-body"><div class="fv-rc-head">Full recall available</div><div class="fv-rc-sub">One click &middot; message disappears for all</div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the IC team and CEO office lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>SSO &amp; Active Directory <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>One-click login through your existing identity provider. No extra password to manage.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></div>
        <h3>Personalized Employee Dashboard <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Each employee sees the leadership messages that matter to them, ranked by relevance, never buried.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-6h3zm-18 0a2 2 0 0 0 2 2h1v-6H3z"/></svg></div>
        <h3>Audio Version of Updates <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>The CEO note, generated as audio, played on the commute. Reach the people who don't read at their desks.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Calendar View for Events <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Town halls, results day, AGM, leadership offsites, all on one calendar your employees can subscribe to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><circle cx="12" cy="11" r="2"/></svg></div>
        <h3>VAPT &amp; Source Code Review <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Independently penetration-tested every year, with source code reviewed by external specialists.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Individual Employee Report <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Per-employee view of every message read, watched, or pending, in one click.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real reach.</span></h2>
    <p>Five situations a corporate communications team will recognise from the last twelve months.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></div>
      <h3>CEO results-day video</h3>
      <p>Recorded at 8 AM, pinned to every employee's home at 9. By 11, reach crosses 98% and reactions are pouring in. By noon the CFO sees a read-by-department cut and knows the Treasury team lagged.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Video hosting &rarr; Top Deck &rarr; Reach analytics</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <h3>Crisis communication on a Sunday night</h3>
      <p>A social-media incident breaks late Sunday. The head of comms writes a two-paragraph note, targets all branch managers and customer-facing staff, and publishes. Monday morning every relevant person has already read and acknowledged it.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Targeted distribution &rarr; Acknowledge &rarr; Push to mobile</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
      <h3>Board summary, senior-only</h3>
      <p>The Company Secretary pushes a sanitised board summary to just the senior leadership cohort. Screenshot protection on. Downloads disabled. Audit log confirms who read it and when.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Role-based targeting &rarr; Security controls &rarr; Audit trail</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
      <h3>Leadership transition with personalised names</h3>
      <p>The new business head wants to introduce themselves. Mail-merge personalises the greeting by first name and team, one message, thousands of variations, one publish click.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Mail-merge &rarr; Personalised content &rarr; Reach tracking</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg></div>
      <h3>The correction nobody wants to send</h3>
      <p>A figure in yesterday's all-hands note was off by a decimal. The communications team edits the message in place, triggers resend-to-unread for employees who hadn't opened it yet, and the original version is preserved in history. No apology email required; no "please disregard" thread.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Real-time edit &rarr; Resend-to-unread &rarr; Version history</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "did it land?" <br>to <span class="g-text">"we can see it landed."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Leadership voice</h3>
      <p>From <strong>archived inbox</strong> to <strong>pinned to the home screen</strong> until acknowledged.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Corp comms measurability</h3>
      <p>From <strong>"sent"</strong> to <strong>reach, watched, and department-level data</strong> in real time.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Correction speed</h3>
      <p>From <strong>apology replies-all</strong> to <strong>silent in-place edit</strong> with history preserved.</p>
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
    <h2>Ready to see <span class="g-text">your next big announcement</span> land with data behind it?</h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a recent leadership message, a results note, a town-hall video, a policy-shift announcement. In 20 minutes we'll show you what it would look like going out on PolicyCentral.ai, and what the reach dashboard would say an hour later.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
