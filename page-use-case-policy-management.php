<?php
/* Template Name: Use Case - Policy Management */
get_header();
?>
<style>
/* Page-specific accent, teal/emerald */
:root { --accent:#0E7490; --accent-dark:#155E75; --accent-light:#ECFEFF; --accent-border:rgba(14,116,144,.15); }

/* ── HERO VISUAL: Policy Compliance Dashboard ── */
.pm-mockup{position:relative;width:100%;max-width:520px;animation:pmFloat 7s ease-in-out infinite}
@keyframes pmFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}

.pm-dashboard{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.pm-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.pm-dots{display:flex;gap:5px}
.pm-dots span{width:9px;height:9px;border-radius:50%}
.pm-dots span:nth-child(1){background:#EF4444}
.pm-dots span:nth-child(2){background:#F59E0B}
.pm-dots span:nth-child(3){background:#22C55E}
.pm-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.pm-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#0E7490,#155E75);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.pm-body{padding:16px}
.pm-policy-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.pm-policy-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(14,116,144,.1);color:#0E7490;border:1px solid rgba(14,116,144,.2)}
.pm-policy-live{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.pm-policy-live::before{content:"";width:6px;height:6px;border-radius:50%;background:#059669;box-shadow:0 0 0 2px rgba(5,150,105,.2)}
.pm-policy-title{font-size:14px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:4px}
.pm-policy-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:14px}

.pm-divider{height:1px;background:var(--gray-100);margin:12px 0}

.pm-section-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}

.pm-chain{display:flex;align-items:center;gap:6px;margin-bottom:4px}
.pm-chain-step{flex:1;display:flex;align-items:center;gap:5px;padding:5px 8px;border-radius:6px;background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.18)}
.pm-chain-step svg{width:11px;height:11px;color:#059669;flex-shrink:0}
.pm-chain-step-text{font-size:9px;font-weight:700;color:#047857;font-family:'Plus Jakarta Sans',sans-serif}
.pm-chain-arrow{font-size:10px;color:var(--gray-400);font-weight:800}

.pm-progress{margin-top:12px}
.pm-progress-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:5px}
.pm-progress-label{font-size:10px;font-weight:600;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif}
.pm-progress-val{font-size:10px;font-weight:800;color:#0E7490;font-family:'Plus Jakarta Sans',sans-serif}
.pm-progress-bar{height:5px;border-radius:3px;background:var(--gray-100);overflow:hidden}
.pm-progress-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,#0E7490,#059669)}

/* Floating card: Version Timeline (top-right) */
.pm-versions{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:168px;animation:pmCardIn .6s ease-out both;animation-delay:.3s}
@keyframes pmCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}
.pm-versions-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.pm-versions-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#0E7490,#155E75);display:flex;align-items:center;justify-content:center}
.pm-versions-icon svg{width:11px;height:11px;color:#fff}
.pm-versions h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.pm-version-row{display:flex;align-items:center;gap:8px;padding:5px 0;font-family:'Plus Jakarta Sans',sans-serif}
.pm-version-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0}
.pm-version-dot.live{background:#059669;box-shadow:0 0 0 3px rgba(5,150,105,.18)}
.pm-version-dot.old{background:var(--gray-300)}
.pm-version-label{font-size:10px;font-weight:700;color:var(--gray-900);flex:1}
.pm-version-label.old{color:var(--gray-500)}
.pm-version-date{font-size:9px;color:var(--gray-400);font-weight:600}

/* Floating card: Audit Log (bottom-left) */
.pm-audit{position:absolute;bottom:-18px;left:-18px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:190px;animation:pmCardIn .6s ease-out both;animation-delay:.55s}
.pm-audit-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.pm-audit-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#059669,#0E7490);display:flex;align-items:center;justify-content:center}
.pm-audit-icon svg{width:11px;height:11px;color:#fff}
.pm-audit h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.pm-audit-item{display:flex;align-items:flex-start;gap:7px;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif}
.pm-audit-bullet{width:6px;height:6px;border-radius:50%;background:#059669;margin-top:5px;flex-shrink:0}
.pm-audit-body{flex:1;min-width:0}
.pm-audit-action{font-size:9.5px;font-weight:700;color:var(--gray-800);line-height:1.3}
.pm-audit-time{font-size:8.5px;color:var(--gray-400);font-weight:600;margin-top:1px}

/* ── SCENE (centered narrative) ── */
.uc-scene{padding:88px 0;background:#fff}
.uc-scene-inner{max-width:820px;margin:0 auto;text-align:center}
.uc-scene h2{margin-bottom:20px}
.uc-scene p{font-size:17px;color:var(--gray-500);line-height:1.8;margin-bottom:16px}
.uc-scene p:last-child{margin-bottom:0}
.uc-scene-persona{display:inline-block;margin-bottom:22px;padding:7px 16px;border-radius:var(--r-full);background:var(--accent-light);color:var(--accent-dark);font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;letter-spacing:.02em;border:1px solid var(--accent-border)}

/* ── VIGNETTE (editorial card, different rhythm) ── */
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

/* ── CAPABILITIES ── */
.uc-caps{padding:100px 0;background:#fff}
.uc-caps .section-header{margin-bottom:56px}
.uc-cap-link{display:inline-flex;align-items:center;gap:6px;margin-top:10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:700;color:var(--accent-dark);border-bottom:1.5px solid transparent;padding-bottom:2px;transition:all .2s var(--ease);align-self:flex-start}
.uc-cap-link:hover{border-bottom-color:var(--accent-dark)}
.uc-cap-link svg{width:13px;height:13px;transition:transform .2s var(--spring)}
.uc-cap-link:hover svg{transform:translateX(3px)}

/* Capability panels, quiet backgrounds; text is the hero */
.feat-hero-uc{background:#fff;border-color:var(--gray-200)}
.feat-hero-uc:hover{border-color:var(--accent-border)}
.feat-hero-uc .feat-hero-icon{background:linear-gradient(135deg,var(--accent),var(--accent-dark))}
.feat-hero-uc h2,.feat-hero-uc h3{color:var(--gray-900)}
.feat-hero-uc-soft{background:var(--gray-50);border-color:var(--gray-200)}

/* Mini visuals inside capability blocks */
.fv-maker-checker{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);padding:18px;width:100%;max-width:360px}
.fv-mc-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:14px}
.fv-mc-step{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:10px;background:var(--gray-50);margin-bottom:6px;border:1px solid var(--gray-100)}
.fv-mc-step.done{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.fv-mc-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#0E7490,#155E75);display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0}
.fv-mc-avatar.v2{background:linear-gradient(135deg,#059669,#047857)}
.fv-mc-avatar.v3{background:linear-gradient(135deg,#4338CA,#6366F1)}
.fv-mc-content{flex:1;min-width:0}
.fv-mc-role{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-mc-time{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.fv-mc-status{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}

.fv-versions{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);padding:18px;width:100%;max-width:360px}
.fv-v-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between}
.fv-v-badge{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;background:rgba(14,116,144,.1);color:#0E7490;border:1px solid rgba(14,116,144,.2);letter-spacing:.03em}
.fv-v-timeline{position:relative;padding-left:18px}
.fv-v-timeline::before{content:"";position:absolute;left:4px;top:8px;bottom:8px;width:2px;background:var(--gray-200)}
.fv-v-item{position:relative;padding:6px 0 6px 0;margin-bottom:6px}
.fv-v-item::before{content:"";position:absolute;left:-18px;top:12px;width:10px;height:10px;border-radius:50%;background:var(--gray-300);border:2px solid #fff;box-shadow:0 0 0 1px var(--gray-200)}
.fv-v-item.live::before{background:#059669;box-shadow:0 0 0 3px rgba(5,150,105,.18)}
.fv-v-head{display:flex;align-items:center;justify-content:space-between;gap:8px}
.fv-v-version{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-v-item.live .fv-v-version{color:#059669}
.fv-v-item.old .fv-v-version{color:var(--gray-500)}
.fv-v-date{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;font-weight:600}
.fv-v-note{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px}

.fv-ack{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);padding:18px;width:100%;max-width:360px}
.fv-ack-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
.fv-ack-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ack-policy{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.fv-ack-ring-wrap{display:flex;align-items:center;gap:18px;padding:8px 0 14px;border-bottom:1px solid var(--gray-100);margin-bottom:12px}
.fv-ack-ring{width:62px;height:62px;border-radius:50%;background:conic-gradient(#059669 0% 87%, #E5E7EB 87% 100%);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-ack-ring-inner{width:48px;height:48px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:800;color:#059669}
.fv-ack-stats{flex:1}
.fv-ack-stat{font-size:11px;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-600);display:flex;justify-content:space-between;margin-bottom:4px}
.fv-ack-stat strong{color:var(--gray-900);font-weight:800}
.fv-ack-person{display:flex;align-items:center;gap:10px;padding:7px 0;font-family:'Plus Jakarta Sans',sans-serif}
.fv-ack-avatar{width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,#0E7490,#155E75);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fv-ack-person-body{flex:1;min-width:0}
.fv-ack-person-name{font-size:11px;font-weight:700;color:var(--gray-800)}
.fv-ack-person-time{font-size:9px;color:var(--gray-400);margin-top:1px}
.fv-ack-esig{padding:3px 7px;border-radius:5px;font-size:9px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}

.fv-audit{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);padding:18px;width:100%;max-width:380px}
.fv-audit-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
.fv-audit-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.fv-audit-filter{padding:3px 8px;border-radius:6px;font-size:9px;font-weight:800;background:rgba(14,116,144,.08);color:#0E7490;border:1px solid rgba(14,116,144,.18);font-family:'Plus Jakarta Sans',sans-serif}
.fv-audit-row{display:grid;grid-template-columns:70px 1fr 70px;gap:10px;padding:7px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;align-items:center}
.fv-audit-row:first-of-type{border-top:none}
.fv-audit-time{color:var(--gray-400);font-weight:600;font-size:9.5px}
.fv-audit-action{color:var(--gray-800);font-weight:600}
.fv-audit-action strong{font-weight:800;color:var(--gray-900)}
.fv-audit-actor{color:#0E7490;font-weight:700;font-size:9.5px;text-align:right}

/* ── WHERE IT SHOWS UP ── */
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

/* ── WHAT CHANGES ── */
.uc-changes{padding:100px 0;background:#fff}
.uc-ch-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:1100px;margin:0 auto}
.uc-ch{padding:32px 28px;border-radius:16px;border:1px solid var(--gray-200);background:#fff;text-align:center;transition:all .25s var(--ease)}
.uc-ch:hover{border-color:var(--accent-border);box-shadow:var(--shadow-md);transform:translateY(-3px)}
.uc-ch-num{display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;margin-bottom:16px}
.uc-ch h3{font-size:16px;font-weight:800;color:var(--gray-900);margin-bottom:10px;line-height:1.35}
.uc-ch p{font-size:13.5px;color:var(--gray-600);line-height:1.65}
.uc-ch p strong{color:var(--accent-dark);font-weight:800}

/* ── CTA (white, quiet) ── */
.uc-cta{padding:100px 0;background:#fff;border-top:1px solid var(--gray-100)}

/* Responsive */
@media(max-width:1024px){
  .pm-mockup{max-width:420px;margin:0 auto}
  .pm-versions{right:-8px;top:-8px}
  .pm-audit{left:-8px;bottom:-10px}
  .fv-maker-checker,.fv-versions,.fv-ack,.fv-audit{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){
  .uc-sc-grid{grid-template-columns:1fr}
  .uc-ch-grid{grid-template-columns:1fr}
}
@media(max-width:640px){
  .pm-mockup{max-width:340px}
  .pm-versions{position:relative;top:0;right:0;margin-top:10px;min-width:auto}
  .pm-audit{position:relative;bottom:0;left:0;margin-top:10px}
  .uc-scene p{font-size:16px}
}

/* Capability 5: Gen AI Intelligence visual */
.fv-ai{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-ai-header{display:flex;align-items:center;gap:8px;margin-bottom:12px}
.fv-ai-badge{padding:3px 8px;border-radius:5px;background:linear-gradient(135deg,#7C3AED,#4338CA);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.fv-ai-title{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.fv-ai-summary{background:linear-gradient(180deg,rgba(124,58,237,.06) 0%,transparent 100%);border:1px solid rgba(124,58,237,.15);border-radius:10px;padding:10px;margin-bottom:10px}
.fv-ai-summary-label{font-size:9px;font-weight:800;color:#5B21B6;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px}
.fv-ai-summary-line{height:5px;border-radius:3px;background:rgba(124,58,237,.2);margin-bottom:4px}
.fv-ai-summary-line.l1{width:95%}
.fv-ai-summary-line.l2{width:82%}
.fv-ai-summary-line.l3{width:68%}
.fv-ai-q{font-size:10.5px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif;padding:7px 10px;background:var(--gray-50);border-radius:8px 8px 8px 2px;margin-bottom:4px;border:1px solid var(--gray-100)}
.fv-ai-a{font-size:10px;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif;padding:7px 10px;background:linear-gradient(135deg,rgba(67,56,202,.06),rgba(124,58,237,.06));border-radius:8px 8px 2px 8px;border:1px solid rgba(67,56,202,.12);line-height:1.45;margin-bottom:10px}
.fv-ai-a strong{color:#4338CA;font-weight:800}
.fv-ai-langs{display:flex;gap:4px;flex-wrap:wrap}
.fv-ai-lang{padding:3px 8px;border-radius:5px;background:rgba(14,116,144,.08);color:#0E7490;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;border:1px solid rgba(14,116,144,.18)}

/* Capability 6: Distribution & Targeting visual */
.fv-dist{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-dist-title{font-size:12px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}
.fv-dist-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.fv-dist-chips{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:10px}
.fv-dist-chip{padding:4px 9px;border-radius:5px;background:var(--gray-100);color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;border:1px solid var(--gray-200)}
.fv-dist-chip.on{background:var(--accent-light);color:var(--accent-dark);border-color:var(--accent-border)}
.fv-dist-ever{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;background:linear-gradient(135deg,#ECFDF5 0%,#ECFEFF 100%);border:1px solid rgba(5,150,105,.2);margin-bottom:10px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-dist-ever-toggle{width:34px;height:18px;border-radius:9px;background:#059669;position:relative;flex-shrink:0}
.fv-dist-ever-toggle::after{content:"";position:absolute;top:2px;right:2px;width:14px;height:14px;border-radius:50%;background:#fff}
.fv-dist-ever-body{flex:1}
.fv-dist-ever-t{font-size:11px;font-weight:800;color:#065F46}
.fv-dist-ever-s{font-size:9.5px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-dist-match{display:flex;justify-content:space-between;align-items:center;padding-top:8px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif}
.fv-dist-match-l{font-size:10px;color:var(--gray-500);font-weight:600}
.fv-dist-match-v{font-size:13px;font-weight:800;color:var(--accent-dark)}
</style>

<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content">
    <h1>Policy management, <br>from <span class="accent">first draft to final audit</span>.</h1>
    <p class="subtitle">The full lifecycle of every organisational policy, authored, approved, targeted, acknowledged, and audit-ready, running on one platform. Built for Compliance, Legal, HR, Risk, and Internal Audit teams at regulated enterprises.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Policy Management</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="pm-mockup">
      <div class="pm-dashboard">
        <div class="pm-titlebar">
          <div class="pm-dots"><span></span><span></span><span></span></div>
          <span class="pm-titlebar-text">Policy Compliance Dashboard</span>
          <span class="pm-titlebar-badge">&#x2713; AUDIT-READY</span>
        </div>
        <div class="pm-body">
          <div class="pm-policy-head">
            <span class="pm-policy-tag">&#x1F4DC; Code of Conduct &bull; v3.1</span>
            <span class="pm-policy-live">Live</span>
          </div>
          <div class="pm-policy-title">Employee Code of Conduct</div>
          <div class="pm-policy-meta">Published Mar 12 &middot; Applies to: All employees</div>

          <div class="pm-section-label">Approval Chain</div>
          <div class="pm-chain">
            <div class="pm-chain-step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg><span class="pm-chain-step-text">Legal</span></div>
            <span class="pm-chain-arrow">&rsaquo;</span>
            <div class="pm-chain-step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg><span class="pm-chain-step-text">Risk</span></div>
            <span class="pm-chain-arrow">&rsaquo;</span>
            <div class="pm-chain-step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg><span class="pm-chain-step-text">CHRO</span></div>
          </div>

          <div class="pm-divider"></div>

          <div class="pm-section-label">Compliance Status</div>
          <div class="pm-progress">
            <div class="pm-progress-row"><span class="pm-progress-label">Read</span><span class="pm-progress-val">94%</span></div>
            <div class="pm-progress-bar"><div class="pm-progress-fill" style="width:94%"></div></div>
          </div>
          <div class="pm-progress">
            <div class="pm-progress-row"><span class="pm-progress-label">Acknowledged</span><span class="pm-progress-val">87%</span></div>
            <div class="pm-progress-bar"><div class="pm-progress-fill" style="width:87%"></div></div>
          </div>
          <div class="pm-progress">
            <div class="pm-progress-row"><span class="pm-progress-label">Quiz passed</span><span class="pm-progress-val">81%</span></div>
            <div class="pm-progress-bar"><div class="pm-progress-fill" style="width:81%"></div></div>
          </div>
        </div>
      </div>

      <div class="pm-versions">
        <div class="pm-versions-head">
          <div class="pm-versions-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
          <h3>Version history</h3>
        </div>
        <div class="pm-version-row"><span class="pm-version-dot live"></span><span class="pm-version-label">v3.1</span><span class="pm-version-date">Mar 12</span></div>
        <div class="pm-version-row"><span class="pm-version-dot old"></span><span class="pm-version-label old">v3.0</span><span class="pm-version-date">Nov 14</span></div>
        <div class="pm-version-row"><span class="pm-version-dot old"></span><span class="pm-version-label old">v2.8</span><span class="pm-version-date">Jul 02</span></div>
      </div>

      <div class="pm-audit">
        <div class="pm-audit-head">
          <div class="pm-audit-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <h3>Audit log</h3>
        </div>
        <div class="pm-audit-item">
          <span class="pm-audit-bullet"></span>
          <div class="pm-audit-body"><div class="pm-audit-action">Acknowledged by Priya S.</div><div class="pm-audit-time">2 min ago &middot; e-signature</div></div>
        </div>
        <div class="pm-audit-item">
          <span class="pm-audit-bullet"></span>
          <div class="pm-audit-body"><div class="pm-audit-action">Resent to 14 unread</div><div class="pm-audit-time">1 hr ago &middot; auto-escalation</div></div>
        </div>
        <div class="pm-audit-item">
          <span class="pm-audit-bullet"></span>
          <div class="pm-audit-body"><div class="pm-audit-action">Approved by CHRO</div><div class="pm-audit-time">Mar 12 &middot; v3.1 published</div></div>
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
    <h2>Your organisation runs on <span class="g-text">hundreds of policies.</span></h2>
    <p>A Code of Conduct. KYC. Credit and lending. IT acceptable use. Whistleblower. Data handling. POSH. Variable pay. Each one gets drafted, reviewed, legally vetted, approved, rolled out, acknowledged, refreshed, superseded, and one day, asked about by a regulator.</p>
    <p>Doing that work through email, Word, and a shared drive is how gaps appear. Doing it on one platform with a governance spine is how they don't.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE, editorial card rhythm -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">In regulated financial services</span>
      <h3>Every policy, every employee, provable on demand.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A bank, an NBFC, or an insurer operates under <strong>RBI, SEBI, or IRDAI</strong>. Every policy must be governed, versioned, communicated to the specific employees it applies to, acknowledged, and provable on demand.</p>
      <p>The Credit Policy needs Legal and Risk sign-off before it publishes. The KYC Policy applies to branch-facing staff but not to the central tech team. The Whistleblower Policy is all-staff. The Variable Pay Policy applies by grade. When a regulator asks for evidence that <strong>version 3.1 of the KYC Policy</strong> was acknowledged by every branch-facing employee within thirty days of release, the answer needs to exist, timestamped, filterable, exportable.</p>
      <p>That workflow, end to end, is what Policy Management on PolicyCentral.ai looks like.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Six capabilities that play a critical role<br>in the <span class="g-text">policy lifecycle.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg></div>
      <h3>1. Maker-checker approval, built in.</h3>
      <p>Policies move through single or multi-level sign-off before they go live. Drafters draft, reviewers review, approvers approve, and the governance trail is created automatically. Any AI-enhanced content (summaries, translations, FAQs, infographics) passes through the same checker before an employee ever sees it. Compliance retains the final word.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Publisher Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-maker-checker">
        <div class="fv-mc-title">Code of Conduct v3.1, Approval</div>
        <div class="fv-mc-step done">
          <div class="fv-mc-avatar">AM</div>
          <div class="fv-mc-content"><div class="fv-mc-role">Drafted by Legal</div><div class="fv-mc-time">Mar 08 &middot; 11:42 AM</div></div>
          <span class="fv-mc-status">Signed</span>
        </div>
        <div class="fv-mc-step done">
          <div class="fv-mc-avatar v2">RJ</div>
          <div class="fv-mc-content"><div class="fv-mc-role">Reviewed by Risk</div><div class="fv-mc-time">Mar 10 &middot; 4:15 PM</div></div>
          <span class="fv-mc-status">Signed</span>
        </div>
        <div class="fv-mc-step done">
          <div class="fv-mc-avatar v3">SK</div>
          <div class="fv-mc-content"><div class="fv-mc-role">Approved by CHRO</div><div class="fv-mc-time">Mar 12 &middot; 9:03 AM</div></div>
          <span class="fv-mc-status">Signed</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>2. Version control an auditor can read.</h3>
      <p>Every version is preserved. Show exactly which policy was in force on any given date, who approved it, when it was superseded, and what changed between versions. Multiple versions can run in parallel when needed. Minor post-publication corrections don't destroy the history.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Version Control <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-versions">
        <div class="fv-v-title">KYC Policy, version timeline <span class="fv-v-badge">&#x2713; All preserved</span></div>
        <div class="fv-v-timeline">
          <div class="fv-v-item live">
            <div class="fv-v-head"><span class="fv-v-version">v3.1 (Live)</span><span class="fv-v-date">Mar 12, 2026</span></div>
            <div class="fv-v-note">Updated to reflect RBI Master Direction 2025</div>
          </div>
          <div class="fv-v-item old">
            <div class="fv-v-head"><span class="fv-v-version">v3.0</span><span class="fv-v-date">Nov 14, 2025</span></div>
            <div class="fv-v-note">Superseded &middot; acknowledgements retained on record</div>
          </div>
          <div class="fv-v-item old">
            <div class="fv-v-head"><span class="fv-v-version">v2.8</span><span class="fv-v-date">Jul 02, 2025</span></div>
            <div class="fv-v-note">Archived &middot; available for audit export</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h3>3. Acknowledgement that holds up.</h3>
      <p>Every read receipt, e-signature, and quiz score is captured with a timestamp and tied to the exact policy version. Mandatory deadlines, automatic resends to the unread, and manager-level escalation mean acknowledgement lives in the compliance dashboard, not in someone's inbox.</p>
      <a href="<?php echo esc_url(home_url('/feature/employee-interaction/')); ?>" class="uc-cap-link">Explore Interaction &amp; Acknowledgement <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-ack">
        <div class="fv-ack-head">
          <div><div class="fv-ack-title">Acknowledgement status</div><div class="fv-ack-policy">Code of Conduct v3.1 &middot; All employees</div></div>
        </div>
        <div class="fv-ack-ring-wrap">
          <div class="fv-ack-ring"><div class="fv-ack-ring-inner">87%</div></div>
          <div class="fv-ack-stats">
            <div class="fv-ack-stat"><span>Read</span><strong>94%</strong></div>
            <div class="fv-ack-stat"><span>E-signed</span><strong>87%</strong></div>
            <div class="fv-ack-stat"><span>Quiz passed</span><strong>81%</strong></div>
          </div>
        </div>
        <div class="fv-ack-person">
          <div class="fv-ack-avatar">PS</div>
          <div class="fv-ack-person-body"><div class="fv-ack-person-name">Priya Sharma</div><div class="fv-ack-person-time">2 min ago &middot; AD credentials</div></div>
          <span class="fv-ack-esig">e-Sign</span>
        </div>
        <div class="fv-ack-person">
          <div class="fv-ack-avatar">RK</div>
          <div class="fv-ack-person-body"><div class="fv-ack-person-name">Rahul Kumar</div><div class="fv-ack-person-time">11 min ago &middot; Quiz: 9/10</div></div>
          <span class="fv-ack-esig">e-Sign</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>4. An audit trail that writes itself.</h3>
      <p>Every action, draft, edit, approval, publish, recall, acknowledgement, escalation, is logged. Export to regulator-ready formats; filter by policy, cohort, or date range. What used to take compliance teams weeks to assemble becomes a report in minutes.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-audit">
        <div class="fv-audit-head">
          <div class="fv-audit-title">Audit trail, Code of Conduct</div>
          <span class="fv-audit-filter">Mar 1 to Mar 31</span>
        </div>
        <div class="fv-audit-row">
          <span class="fv-audit-time">11:03 AM</span>
          <span class="fv-audit-action"><strong>E-sign</strong>, v3.1 acknowledged</span>
          <span class="fv-audit-actor">Priya S.</span>
        </div>
        <div class="fv-audit-row">
          <span class="fv-audit-time">10:14 AM</span>
          <span class="fv-audit-action"><strong>Resend</strong>, to 14 unread</span>
          <span class="fv-audit-actor">System</span>
        </div>
        <div class="fv-audit-row">
          <span class="fv-audit-time">Mar 12</span>
          <span class="fv-audit-action"><strong>Publish</strong>, v3.1 to All</span>
          <span class="fv-audit-actor">CHRO</span>
        </div>
        <div class="fv-audit-row">
          <span class="fv-audit-time">Mar 10</span>
          <span class="fv-audit-action"><strong>Approve</strong>, Risk sign-off</span>
          <span class="fv-audit-actor">Rohan J.</span>
        </div>
        <div class="fv-audit-row">
          <span class="fv-audit-time">Mar 08</span>
          <span class="fv-audit-action"><strong>Draft</strong>, v3.1 created</span>
          <span class="fv-audit-actor">Legal</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>5. AI that makes policies actually readable.</h3>
      <p>Auto-generated summaries, FAQs, infographics, and audio versions. Translations into ten Indian languages so a branch employee can read the KYC policy in Tamil. And PolicyGPT, an in-product chatbot where employees ask "how many casual leaves do I get?" in natural language and get an answer grounded in the current policy text, not the open internet. Every AI output runs through the same maker-checker review before it reaches an employee.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Gen AI Intelligence <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-ai">
        <div class="fv-ai-header">
          <span class="fv-ai-badge">&#x2728; AI ENHANCED</span>
          <span class="fv-ai-title">KYC Policy v3.1</span>
        </div>
        <div class="fv-ai-summary">
          <div class="fv-ai-summary-label">Auto-summary</div>
          <div class="fv-ai-summary-line l1"></div>
          <div class="fv-ai-summary-line l2"></div>
          <div class="fv-ai-summary-line l3"></div>
        </div>
        <div class="fv-ai-q">How many days to complete KYC verification?</div>
        <div class="fv-ai-a"><strong>PolicyGPT:</strong> Within 30 days of onboarding, per section 3.2 of KYC Policy v3.1.</div>
        <div class="fv-ai-langs">
          <span class="fv-ai-lang">&#x1F1EE;&#x1F1F3; Hindi</span>
          <span class="fv-ai-lang">&#x1F1EE;&#x1F1F3; Tamil</span>
          <span class="fv-ai-lang">&#x1F1EE;&#x1F1F3; Marathi</span>
          <span class="fv-ai-lang">+7</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
      <h3>6. Precision distribution, self-maintaining.</h3>
      <p>Target policies by department, role, location, grade, or any combination. Audience lists stay current by syncing with Active Directory or your HRMS, no manual upkeep. Evergreen Mode auto-sends the policy to every matching new joiner from their first day. Mail-merge personalises content per recipient without hand-editing. A policy meant for branch-facing staff in Maharashtra reaches exactly those people, the day they join.</p>
      <a href="<?php echo esc_url(home_url('/feature/distribution-targeting/')); ?>" class="uc-cap-link">Explore Distribution &amp; Targeting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-dist">
        <div class="fv-dist-title">Audience, KYC Policy v3.1</div>
        <div class="fv-dist-label">Targeting</div>
        <div class="fv-dist-chips">
          <span class="fv-dist-chip on">Dept: Branch Banking</span>
          <span class="fv-dist-chip on">Role: Teller</span>
          <span class="fv-dist-chip on">Role: Cashier</span>
          <span class="fv-dist-chip">Role: Relationship Mgr</span>
          <span class="fv-dist-chip on">State: Maharashtra</span>
          <span class="fv-dist-chip on">State: Gujarat</span>
        </div>
        <div class="fv-dist-ever">
          <div class="fv-dist-ever-toggle"></div>
          <div class="fv-dist-ever-body">
            <div class="fv-dist-ever-t">Evergreen Mode: ON</div>
            <div class="fv-dist-ever-s">Future joiners matching these filters auto-receive on day one</div>
          </div>
        </div>
        <div class="fv-dist-match">
          <span class="fv-dist-match-l">Current match</span>
          <span class="fv-dist-match-v">342 branches &middot; 4,127 employees</span>
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
    <h2>Real moments. <span class="g-text">Real answers.</span></h2>
    <p>Five everyday situations your compliance team will recognise, and what the platform does in each.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
      <h3>A regulatory inspection lands</h3>
      <p>The inspector asks which employees acknowledged KYC v3.1, and when. Compliance filters the dashboard by policy version and date range. Answer in the meeting, not after it.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Tracking Dashboard &rarr; policy + date filter</div>
    </div>

    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
      <h3>A new Code of Conduct is rolled out</h3>
      <p>Legal drafts, the CHRO approves, it goes live to every employee, and auto-includes joiners who land after publish date. Resend-to-unread chases stragglers. A short quiz confirms comprehension.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Maker-Checker &rarr; Evergreen distribution &rarr; Quiz</div>
    </div>

    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h3>An employee asks, "How many casual leaves do I get?"</h3>
      <p>PolicyGPT answers from the actual Leave Policy, grounded in policy text, not the open internet. Not another HR ticket, not a Slack DM to the people team.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>PolicyGPT &rarr; answers grounded in your policies</div>
    </div>

    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></div>
      <h3>A Whistleblower Policy is updated mid-year</h3>
      <p>The earlier version stays traceable. Employees who acknowledged v1 are automatically asked to acknowledge v2. The platform knows the difference; employees don't have to figure it out.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Version control &rarr; differential re-acknowledgement</div>
    </div>

    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M7 15h4"/></svg></div>
      <h3>Internal audit runs a quarterly review</h3>
      <p>They need: every policy published in the quarter, its approver, its audience, acknowledgement percentages, and the list of employees still pending. One filter on the compliance dashboard, one export. What was a three-analyst week becomes a ten-minute Friday afternoon.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>All Policy Report &rarr; quarterly cohort export</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From reconstruction <br>to <span class="g-text">real-time readiness.</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Audit preparation</h3>
      <p>From <strong>weeks</strong> of reconstruction to <strong>hours</strong> of filtering.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Governance evidence</h3>
      <p>From <strong>compliance-team memory</strong> to a <strong>tamper-evident trail</strong> that writes itself.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Employee experience</h3>
      <p>From <strong>policies buried in email</strong> to one searchable home, in the language they prefer, on the device they're already using.</p>
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
    <h2>Ready to see <span class="g-text">your own audit questions</span> answered live?</h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a policy your compliance team actually cares about. In 20 minutes we'll walk through its lifecycle on PolicyCentral.ai, drafting, approval, distribution, acknowledgement, and the audit trail behind it.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
