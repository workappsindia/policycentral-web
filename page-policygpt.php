<?php
/* Template Name: PolicyGPT Landing */
get_header();
?>

<style>
/* ══════════════════════════════════════════════════════════════
   PolicyGPT LANDING — hero + explainer (uses global theme tokens)
   ══════════════════════════════════════════════════════════════ */
.pcgpt-lp{--mono:ui-monospace,'SF Mono',Menlo,Consolas,monospace}
.pcgpt-lp *{box-sizing:border-box}
.pcgpt-lp .g-text{background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.pcgpt-lp a{text-decoration:none}

/* fade-up */
@keyframes pcgptUp{to{opacity:1;transform:none}}
.pcgpt-lp .fu{opacity:0;transform:translateY(16px);animation:pcgptUp .6s var(--ease) forwards}
.pcgpt-lp .d1{animation-delay:.05s}.pcgpt-lp .d2{animation-delay:.14s}.pcgpt-lp .d3{animation-delay:.24s}
@media(prefers-reduced-motion:reduce){.pcgpt-lp .fu{animation:none;opacity:1;transform:none}}

/* HERO */
.pcgpt-hero{position:relative;padding:calc(var(--nav-h,68px) + 92px) clamp(20px,5vw,64px) clamp(28px,4vw,44px);text-align:center;overflow:hidden;background:#fff}
.pcgpt-hero::before{content:"";position:absolute;inset:0;z-index:0;background:
  radial-gradient(58% 46% at 50% 0%,rgba(23,157,151,.10),transparent 70%),
  radial-gradient(48% 38% at 84% 16%,rgba(124,58,237,.07),transparent 70%)}
.pcgpt-hero > *{position:relative;z-index:1}
.pcgpt-hero-logo{height:clamp(64px,9vw,104px);width:auto;margin:0 auto 28px;display:block}
.pcgpt-hero h1{font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(28px,4vw,50px);font-weight:800;line-height:1.12;letter-spacing:-.02em;max-width:none;margin:0 auto 18px;color:var(--gray-900)}
.pcgpt-hero h1 br{display:inline}
@media(max-width:560px){.pcgpt-hero h1 br{display:none}}
.pcgpt-hero-sub{font-size:clamp(15px,1.7vw,19px);color:var(--gray-500);max-width:58ch;margin:0 auto;font-weight:500;line-height:1.6}
.pcgpt-hero-sub strong{color:var(--gray-700);font-weight:700}

/* search */
.pcgpt-search{max-width:760px;margin:36px auto 0}
.pcgpt-bar{display:flex;align-items:center;background:#fff;border:2px solid var(--gray-200);border-radius:var(--r-full);padding:7px 7px 7px 22px;box-shadow:var(--shadow-lg);gap:10px;transition:border-color .2s,box-shadow .2s}
.pcgpt-bar:focus-within{border-color:var(--teal);box-shadow:0 0 0 4px rgba(23,157,151,.12),var(--shadow-lg)}
.pcgpt-bar .pcgpt-ic{flex-shrink:0;color:var(--gray-400);line-height:0}
.pcgpt-input{flex:1;border:none;outline:none;font-family:'Manrope',sans-serif;font-size:16px;color:var(--gray-900);background:transparent;padding:11px 0;min-width:0}
.pcgpt-input::placeholder{color:var(--gray-400)}
.pcgpt-go{flex-shrink:0;background:var(--grad-primary);border:none;border-radius:var(--r-full);padding:13px 26px;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:14.5px;font-weight:700;cursor:pointer;white-space:nowrap;transition:transform .2s var(--ease),box-shadow .2s;box-shadow:0 4px 16px rgba(23,157,151,.3);display:inline-flex;align-items:center;gap:8px}
.pcgpt-go:hover:not(:disabled){transform:translateY(-1px);box-shadow:0 6px 24px rgba(23,157,151,.4)}
.pcgpt-go:disabled{opacity:.55;cursor:not-allowed}
.pcgpt-go svg{width:15px;height:15px}
.pcgpt-chips{display:flex;flex-wrap:wrap;justify-content:center;gap:8px;margin-top:18px}
.pcgpt-chip-label{width:100%;text-align:center;font-family:'Plus Jakarta Sans',sans-serif;font-size:10.5px;font-weight:800;letter-spacing:.11em;text-transform:uppercase;color:var(--gray-400);margin-bottom:2px}
.pcgpt-chip{background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--r-full);padding:7px 15px;font-family:'Manrope',sans-serif;font-size:13.5px;font-weight:600;color:var(--gray-600);cursor:pointer;transition:all .15s}
.pcgpt-chip:hover{background:var(--teal-lt);border-color:var(--teal);color:var(--teal)}

/* answer card */
.pcgpt-ans-shell{max-width:770px;margin:18px auto 0;text-align:left}
.pcgpt-ans{background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-xl);box-shadow:var(--shadow-xl);overflow:hidden;opacity:0;transform:translateY(14px);transition:opacity .5s var(--ease),transform .5s var(--ease)}
.pcgpt-ans.show{opacity:1;transform:none}
.pcgpt-ans-head{display:flex;align-items:center;gap:11px;padding:16px 22px;border-bottom:1px solid var(--gray-100);background:linear-gradient(180deg,#fff,var(--gray-50))}
.pcgpt-av{width:34px;height:34px;border-radius:9px;background:var(--grad-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 3px 10px rgba(67,56,202,.25)}
.pcgpt-av svg{width:19px;height:19px;color:#fff}
.pcgpt-who{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:14.5px;color:var(--gray-900);line-height:1.2}
.pcgpt-st{font-size:11.5px;color:var(--gray-400);font-family:var(--mono);display:flex;align-items:center;gap:6px;margin-top:2px}
.pcgpt-st .dot{width:6px;height:6px;border-radius:50%;background:var(--emerald)}
.pcgpt-q{padding:16px 22px 4px;font-size:13px;color:var(--gray-400);font-weight:600}
.pcgpt-q b{color:var(--gray-700)}
.pcgpt-body{padding:6px 22px 4px;font-size:15.5px;color:var(--gray-700);line-height:1.65;min-height:40px}
.pcgpt-body p{margin:0 0 13px}
.pcgpt-body ul{margin:0 0 13px;padding-left:20px}
.pcgpt-body li{margin:0 0 6px}
.pcgpt-cursor{display:inline-block;width:8px;height:17px;background:var(--teal);vertical-align:-3px;margin-left:2px;animation:pcgptBlink 1s steps(1) infinite;border-radius:1px}
@keyframes pcgptBlink{50%{opacity:0}}
.pcgpt-src{display:inline-flex;align-items:center;gap:7px;margin:4px 22px 18px;padding:6px 13px;background:var(--teal-lt);border:1px solid rgba(23,157,151,.25);border-radius:var(--r-full);font-size:12px;font-weight:700;color:var(--teal);font-family:var(--mono)}
.pcgpt-src svg{width:13px;height:13px}
.pcgpt-src.hidden{display:none}
.pcgpt-pitch{border-top:1px dashed var(--gray-200);background:linear-gradient(180deg,var(--gray-50),#fff);padding:20px 22px 22px;display:none}
.pcgpt-pitch.show{display:block;animation:pcgptUp .5s var(--ease)}
.pcgpt-pitch-line{font-size:14.5px;color:var(--gray-700);margin-bottom:15px;line-height:1.6}
.pcgpt-pitch-line b{color:var(--gray-900);font-weight:800}
.pcgpt-pitch-line .hl{background:linear-gradient(180deg,transparent 62%,rgba(23,157,151,.22) 0);padding:0 2px}
.pcgpt-pitch-actions{display:flex;flex-wrap:wrap;gap:10px}
.pcgpt-btn{display:inline-flex;align-items:center;gap:8px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13.5px;padding:11px 20px;border-radius:var(--r-full);cursor:pointer;border:none;transition:transform .2s var(--ease),box-shadow .2s,background .2s}
.pcgpt-btn-primary{background:var(--grad-primary);color:#fff;box-shadow:0 4px 16px rgba(23,157,151,.3)}
.pcgpt-btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 24px rgba(23,157,151,.4)}
.pcgpt-btn-ghost{background:#fff;color:var(--gray-700);border:1.5px solid var(--gray-200)}
.pcgpt-btn-ghost:hover{border-color:var(--teal);color:var(--teal);background:var(--teal-lt)}
.pcgpt-btn svg{width:15px;height:15px}

/* WHAT IS POLICYGPT */
.pcgpt-explain{padding:clamp(48px,7vw,84px) clamp(20px,5vw,64px);background:#fff}
.pcgpt-explain-in{max-width:1180px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:clamp(32px,5vw,72px);align-items:center}
.pcgpt-eyebrow{font-family:'Plus Jakarta Sans',sans-serif;font-size:11.5px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--teal);margin-bottom:14px}
.pcgpt-explain h2{font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(26px,3.4vw,40px);font-weight:800;line-height:1.14;letter-spacing:-.02em;text-wrap:balance;margin-bottom:18px;color:var(--gray-900)}
.pcgpt-lead{font-size:clamp(15px,1.5vw,17.5px);color:var(--gray-500);font-weight:500;margin-bottom:22px;line-height:1.7}
.pcgpt-feats{display:flex;flex-direction:column;gap:13px}
.pcgpt-feat{display:flex;gap:12px;align-items:flex-start}
.pcgpt-feat .fi{flex-shrink:0;width:26px;height:26px;border-radius:8px;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;margin-top:1px}
.pcgpt-feat .fi svg{width:14px;height:14px;color:var(--teal)}
.pcgpt-feat .ft{font-size:14.5px;color:var(--gray-700);line-height:1.6}
.pcgpt-feat .ft b{color:var(--gray-900);font-weight:700}
.pcgpt-vcard{background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-xl);box-shadow:var(--shadow-lg);overflow:hidden}
.pcgpt-vtop{display:flex;align-items:center;gap:7px;padding:12px 16px;border-bottom:1px solid var(--gray-100);background:var(--gray-50)}
.pcgpt-vtop .vd{width:11px;height:11px;border-radius:50%}
.pcgpt-vurl{margin-left:8px;font-family:var(--mono);font-size:11.5px;color:var(--gray-400)}
.pcgpt-vbody{padding:20px}
.pcgpt-mq{display:flex;align-items:center;gap:9px;border:1.5px solid var(--gray-200);border-radius:var(--r-full);padding:9px 15px;font-size:13px;color:var(--gray-500);margin-bottom:16px}
.pcgpt-ma{font-size:13.5px;color:var(--gray-700);line-height:1.65}
.pcgpt-ma b{color:var(--gray-900)}
.pcgpt-kb{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:16px}
.pcgpt-kbi{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--gray-600);background:var(--gray-50);border:1px solid var(--gray-100);border-radius:8px;padding:8px 10px;font-weight:600}
.pcgpt-kbi svg{width:13px;height:13px;color:var(--emerald);flex-shrink:0}

@media(max-width:840px){
  .pcgpt-explain-in{grid-template-columns:1fr;gap:34px}
}
@media(max-width:520px){
  .pcgpt-go .lbl{display:none}
  .pcgpt-go{padding:13px 15px}
  .pcgpt-chips .pcgpt-chip:nth-child(n+8){display:none}
}
</style>

<style>
/* ══════════════════════════════════════════════════════════════
   Reused from Explore V2 (.explore-wrap scope) — today, stack, cta
   ══════════════════════════════════════════════════════════════ */
.explore-wrap {
  --teal:#0694A2;--teal-lt:#E0F5F7;--teal-dk:#056875;
  --violet:#7C3AED;--violet-lt:#EDE9FE;
  --indigo:#4338CA;
  --emerald:#059669;--em-lt:#D1FAE5;
  --amber:#D97706;--amber-lt:#FEF3C7;
  --rose:#E11D48;--rose-lt:#FFE4E6;
  --grad:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);
  --grad-text:linear-gradient(135deg,#0694A2,#4338CA,#7C3AED);
  --white:#FFF;
  --g50:#F9FAFB;--g100:#F3F4F6;--g200:#E5E7EB;--g300:#D1D5DB;
  --g400:#9CA3AF;--g500:#6B7280;--g600:#4B5563;--g700:#374151;
  --g800:#1F2937;--g900:#111827;
}
.explore-wrap .g-text{background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.explore-wrap .exp-reveal{opacity:0;transform:translateY(20px);transition:opacity .6s ease,transform .6s ease}
.explore-wrap .exp-reveal.visible{opacity:1;transform:none}
.explore-wrap .exp-rd1{transition-delay:.05s}.explore-wrap .exp-rd2{transition-delay:.15s}
.explore-wrap .exp-rd3{transition-delay:.25s}.explore-wrap .exp-rd4{transition-delay:.35s}

.explore-wrap .exp-section-kicker{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--g400);margin-bottom:10px}
.explore-wrap .exp-section-title{font-size:clamp(22px,3vw,36px);font-weight:900;line-height:1.15;margin-bottom:12px;color:var(--g900)}
.explore-wrap .exp-section-sub{font-size:15px;color:var(--g500);line-height:1.7;max-width:720px;margin-bottom:40px}

.explore-wrap .today-section{background:var(--g50);border-top:1px solid var(--g100);border-bottom:1px solid var(--g100);padding:64px clamp(20px,4vw,60px)}
.explore-wrap .today-inner{max-width:1240px;margin:0 auto}
.explore-wrap .problem-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:24px}
.explore-wrap .prob-card{background:#fff;border:1.5px solid var(--g200);border-radius:14px;padding:20px 18px;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.explore-wrap .prob-icon{width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.explore-wrap .prob-icon svg{width:24px;height:24px}
.explore-wrap .prob-icon.pi-email{background:rgba(239,68,68,.1);color:#EF4444}
.explore-wrap .prob-icon.pi-drive{background:rgba(245,158,11,.1);color:#F59E0B}
.explore-wrap .prob-icon.pi-print{background:rgba(107,114,128,.1);color:#6B7280}
.explore-wrap .prob-icon.pi-intra{background:rgba(59,130,246,.1);color:#3B82F6}
.explore-wrap .prob-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:800;color:var(--g800);margin-bottom:6px}
.explore-wrap .prob-desc{font-size:12.5px;color:var(--g500);line-height:1.6}
.explore-wrap .vs-bridge{display:flex;align-items:center;gap:16px}
.explore-wrap .vs-line{flex:1;height:1px;background:var(--g200)}
.explore-wrap .vs-pill{background:var(--grad);color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;padding:6px 20px;border-radius:9999px;white-space:nowrap;box-shadow:0 4px 16px rgba(6,148,162,.3)}

.explore-wrap .stack-section{padding:72px clamp(20px,4vw,60px) 20px;background:#fff;border-bottom:1px solid var(--g100)}
.explore-wrap .stack-top{max-width:1240px;margin:0 auto;margin-bottom:52px}
.explore-wrap .stack-body{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:280px 1fr;gap:60px;align-items:start}
.explore-wrap .stack-left{position:sticky;top:80px}
.explore-wrap .sl-num{font-size:56px;font-weight:900;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:-.04em;line-height:1;background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:12px;transition:all .35s}
.explore-wrap .sl-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:17px;font-weight:800;color:var(--g900);line-height:1.25;margin-bottom:10px;transition:all .35s}
.explore-wrap .sl-desc{font-size:13px;color:var(--g500);line-height:1.7;margin-bottom:16px;transition:all .35s}
.explore-wrap .sl-pills{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:24px}
.explore-wrap .sl-pill{font-size:11px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;padding:4px 10px;border-radius:9999px;background:var(--teal-lt);color:var(--teal-dk);border:1px solid rgba(6,148,162,.2)}
.explore-wrap .sl-prog-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.explore-wrap .sl-prog-label{font-size:11px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;color:var(--g400);letter-spacing:.06em;text-transform:uppercase}
.explore-wrap .sl-link{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;color:var(--teal);text-decoration:none}
.explore-wrap .sl-link:hover{text-decoration:underline}
.explore-wrap .sl-prog-track{height:4px;background:var(--g200);border-radius:2px;overflow:hidden}
.explore-wrap .sl-prog-fill{height:4px;background:var(--grad);border-radius:2px;transition:width .5s cubic-bezier(.4,0,.2,1)}
.explore-wrap .sc-item{position:sticky;margin-bottom:120px}
.explore-wrap .sc-item:last-child{margin-bottom:120px}
.explore-wrap .sc-item:nth-child(1){top:80px}.explore-wrap .sc-item:nth-child(2){top:92px}.explore-wrap .sc-item:nth-child(3){top:104px}
.explore-wrap .sc-item:nth-child(4){top:116px}.explore-wrap .sc-item:nth-child(5){top:128px}.explore-wrap .sc-item:nth-child(6){top:140px}
.explore-wrap .sc-item:nth-child(7){top:152px}.explore-wrap .sc-item:nth-child(8){top:164px}.explore-wrap .sc-item:nth-child(9){top:176px}
.explore-wrap .sc-card{background:#fff;border:1.5px solid var(--g200);border-radius:20px;padding:28px 28px 24px;box-shadow:0 4px 20px rgba(0,0,0,.06),0 1px 4px rgba(0,0,0,.04);transition:box-shadow .3s}
.explore-wrap .sc-card:hover{box-shadow:0 8px 32px rgba(0,0,0,.1),0 2px 8px rgba(0,0,0,.06)}
.explore-wrap .sc-card-num{font-size:10px;font-weight:500;color:var(--g400);letter-spacing:.1em;margin-bottom:14px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .sc-card-head{display:flex;align-items:center;gap:14px;margin-bottom:14px}
.explore-wrap .sc-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.explore-wrap .sc-card-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:800;color:var(--g900);line-height:1.2}
.explore-wrap .sc-card-body{font-size:14px;color:var(--g600);line-height:1.75;margin-bottom:16px}
.explore-wrap .sc-tags{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px}
.explore-wrap .sc-tag{font-size:11px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;padding:4px 10px;border-radius:9999px;background:var(--g50);border:1px solid var(--g200);color:var(--g600)}
.explore-wrap .sc-aws{font-size:11px;color:var(--g400);border-top:1px solid var(--g100);padding-top:12px;margin-top:4px}
.explore-wrap .sc-aws-pill{display:inline-block;background:rgba(255,153,0,.1);border:1px solid rgba(255,153,0,.2);color:#B45309;font-weight:700;font-size:9.5px;padding:1px 7px;border-radius:4px;margin-right:4px;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.04em;text-transform:uppercase}
@media(max-width:900px){
  .explore-wrap .stack-body{grid-template-columns:1fr;gap:0}
  .explore-wrap .stack-left{position:static;background:var(--g50);border:1.5px solid var(--g200);border-radius:16px;padding:20px;margin-bottom:24px}
  .explore-wrap .sl-num{font-size:36px;margin-bottom:6px}
  .explore-wrap .sc-item{position:static;margin-bottom:12px}
  .explore-wrap .sc-item:last-child{margin-bottom:0}
}
@media(max-width:600px){
  .explore-wrap .stack-section{padding:48px 20px 80px}
  .explore-wrap .stack-top{margin-bottom:32px}
  .explore-wrap .sc-card{padding:20px}
  .explore-wrap .sc-card-title{font-size:15px}
  .explore-wrap .sc-card-body{font-size:13px}
}
.explore-wrap .cta-section{padding:72px clamp(20px,4vw,60px);background:var(--g50);position:relative;overflow:hidden}
.explore-wrap .cta-bg-icons{position:absolute;inset:0;pointer-events:none;overflow:hidden;opacity:.045}
.explore-wrap .cta-bg-icons svg{position:absolute;width:32px;height:32px;color:var(--g900)}
.explore-wrap .cta-bg-icons .bgi-1{top:8%;left:5%;transform:rotate(-12deg)}
.explore-wrap .cta-bg-icons .bgi-2{top:15%;right:8%;transform:rotate(18deg)}
.explore-wrap .cta-bg-icons .bgi-3{top:45%;left:12%;transform:rotate(-8deg)}
.explore-wrap .cta-bg-icons .bgi-4{top:70%;right:15%;transform:rotate(22deg)}
.explore-wrap .cta-bg-icons .bgi-5{bottom:10%;left:20%;transform:rotate(10deg)}
.explore-wrap .cta-bg-icons .bgi-6{top:25%;left:42%;transform:rotate(-20deg)}
.explore-wrap .cta-bg-icons .bgi-7{bottom:18%;right:30%;transform:rotate(14deg)}
.explore-wrap .cta-bg-icons .bgi-8{top:60%;left:35%;transform:rotate(-15deg)}
.explore-wrap .cta-bg-icons .bgi-9{top:10%;left:65%;transform:rotate(8deg)}
.explore-wrap .cta-bg-icons .bgi-10{bottom:25%;left:55%;transform:rotate(-25deg)}
.explore-wrap .cta-bg-icons .bgi-11{top:38%;right:5%;transform:rotate(30deg)}
.explore-wrap .cta-bg-icons .bgi-12{bottom:5%;right:10%;transform:rotate(-10deg)}
.explore-wrap .cta-inner{max-width:1240px;margin:0 auto;position:relative;z-index:1}
.explore-wrap .cta-header{text-align:center;margin-bottom:36px}
.explore-wrap .cta-kicker{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--teal);margin-bottom:16px}
.explore-wrap .cta-title{font-size:clamp(24px,3.5vw,40px);font-weight:900;line-height:1.1;color:var(--g900);margin-bottom:16px}
.explore-wrap .cta-sub{font-size:15px;color:var(--g500);line-height:1.7}
.explore-wrap .cta-form-wrap{max-width:1000px;margin:0 auto;background:#fff;border:1.5px solid var(--g200);border-radius:16px;padding:28px 32px;box-shadow:0 4px 20px rgba(0,0,0,.06)}
.explore-wrap .cta-form-wrap .exp-form-row{display:grid;gap:12px;margin-bottom:12px}
.explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr 1fr 1fr}
.explore-wrap .cta-form-wrap .exp-form-row.row-msg{grid-template-columns:1fr auto;align-items:end}
.explore-wrap .cta-form-wrap .exp-form-hint{display:block;margin:-4px 0 14px;font-size:11.5px;line-height:1.4;color:var(--g500);font-family:'Manrope',sans-serif}
.explore-wrap .cta-form-wrap .exp-form-group{margin-bottom:0}
.explore-wrap .cta-form-wrap label{display:block;font-size:12px;font-weight:700;color:var(--g600);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .cta-form-wrap label .req{color:var(--rose);margin-left:2px}
.explore-wrap .cta-form-wrap .exp-form-input{width:100%;padding:10px 14px;border:1.5px solid var(--g200);border-radius:10px;font-size:14px;font-family:'Manrope',sans-serif;color:var(--g900);background:var(--g50);transition:all .2s;outline:none}
.explore-wrap .cta-form-wrap .exp-form-input::placeholder{color:var(--g400)}
.explore-wrap .cta-form-wrap .exp-form-input:focus{border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(6,148,162,.1)}
.explore-wrap .cta-form-wrap textarea.exp-form-input{resize:vertical;min-height:42px}
.explore-wrap .cta-form-wrap .exp-form-submit{padding:10px 28px;border-radius:9999px;white-space:nowrap;background:linear-gradient(135deg,#179D97,#05162A);color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;border:none;cursor:pointer;transition:all .25s;box-shadow:0 4px 20px rgba(23,157,151,.28);display:inline-flex;align-items:center;justify-content:center;gap:8px;height:42px}
.explore-wrap .cta-form-wrap .exp-form-submit:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(23,157,151,.4)}
.explore-wrap .cta-form-wrap .exp-form-submit:disabled{opacity:.7;cursor:not-allowed}
.explore-wrap .cta-form-wrap .exp-form-submit svg{width:16px;height:16px}
.explore-wrap .exp-form-status{padding:12px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:12px}
.explore-wrap .exp-form-status.error{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA}
.explore-wrap .exp-form-status.success{background:#F0FDF4;color:#16A34A;border:1px solid #BBF7D0}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
@media(max-width:900px){
  .explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr 1fr}
}
@media(max-width:680px){
  .explore-wrap .today-section,.explore-wrap .stack-section,.explore-wrap .cta-section{padding:48px 20px}
  .explore-wrap .problem-grid{grid-template-columns:1fr}
  .explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr}
  .explore-wrap .cta-form-wrap .exp-form-row.row-msg{grid-template-columns:1fr}
  .explore-wrap .cta-form-wrap{padding:20px}
}
@media(max-width:1024px){
  .explore-wrap .problem-grid{grid-template-columns:1fr 1fr}
}
</style>

<div class="pcgpt-lp">

<!-- ══════════════ HERO ══════════════ -->
<section class="pcgpt-hero">
  <h1 class="fu d1">Ask any workplace policy question.<br>Get a straight answer<br>with <span class="g-text">PolicyGPT</span>.</h1>
  <p class="pcgpt-hero-sub fu d2">PolicyGPT reads real company policies and answers in plain English. No scrolling through PDFs. No digging through Google Drive. Try it below on a live library of 65 sample policies from Meridian Finance, a fictional company we created for this demo.</p>

  <div class="pcgpt-search fu d3">
    <div class="pcgpt-bar">
      <span class="pcgpt-ic"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
      <input type="text" class="pcgpt-input" id="pcgptQ" placeholder="Try: what is sandwich leave?" autocomplete="off">
      <button class="pcgpt-go" id="pcgptSend">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        <span class="lbl">Ask PolicyGPT</span>
      </button>
    </div>
    <div class="pcgpt-chips" id="pcgptChips">
      <span class="pcgpt-chip-label">Popular questions</span>
      <button class="pcgpt-chip">What is sandwich leave?</button>
      <button class="pcgpt-chip">What is KYC?</button>
      <button class="pcgpt-chip">Anti-money laundering rules</button>
      <button class="pcgpt-chip">How do I report fraud?</button>
      <button class="pcgpt-chip">Can I accept a client gift?</button>
      <button class="pcgpt-chip">How is my personal data protected?</button>
      <button class="pcgpt-chip">Notice period &amp; full-and-final</button>
      <button class="pcgpt-chip">Maternity &amp; paternity leave</button>
      <button class="pcgpt-chip">What is POSH?</button>
      <button class="pcgpt-chip">Conflict of interest disclosure</button>
      <button class="pcgpt-chip">Whistleblower protection</button>
      <button class="pcgpt-chip">Password &amp; MFA rules</button>
      <button class="pcgpt-chip">Work from home rules</button>
      <button class="pcgpt-chip">Code of conduct basics</button>
      <button class="pcgpt-chip">Variable pay &amp; bonus</button>
    </div>
  </div>

  <div class="pcgpt-ans-shell">
    <div class="pcgpt-ans" id="pcgptAns">
      <div class="pcgpt-ans-head">
        <div class="pcgpt-av"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><path d="M11 8v6M8 11h6" stroke-width="2.2"/></svg></div>
        <div>
          <div class="pcgpt-who">PolicyGPT</div>
          <div class="pcgpt-st"><span class="dot"></span> <span id="pcgptStatus">Reading policies&hellip;</span></div>
        </div>
      </div>
      <div class="pcgpt-q" id="pcgptQuery"></div>
      <div class="pcgpt-body" id="pcgptBody"></div>
      <div class="pcgpt-src hidden" id="pcgptSrc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><span id="pcgptSrcTxt"></span></div>
      <div class="pcgpt-pitch" id="pcgptPitch">
        <div class="pcgpt-pitch-line">That answer came straight from a policy document, in about three seconds. Now picture <b>every policy in your organization</b> searchable exactly like this, <span class="hl">for every employee, in 10 Indian languages.</span> That is PolicyCentral.ai.</div>
        <div class="pcgpt-pitch-actions">
          <a href="#cta-form" class="pcgpt-btn pcgpt-btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Book a demo</a>
          <button class="pcgpt-btn pcgpt-btn-ghost" id="pcgptShare"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg> Share with your HR head</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ WHAT IS POLICYGPT ══════════════ -->
<section class="pcgpt-explain">
  <div class="pcgpt-explain-in">
    <div>
      <div class="pcgpt-eyebrow">What is PolicyGPT?</div>
      <h2>The AI that answers policy questions, so nobody reads the whole PDF.</h2>
      <p class="pcgpt-lead">PolicyGPT is the AI search built into PolicyCentral.ai. Employees ask a question in plain language and get an instant, accurate answer, drawn only from their company's own approved policies, never the open internet.</p>
      <div class="pcgpt-feats">
        <div class="pcgpt-feat"><span class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="20 6 9 17 4 12"/></svg></span><span class="ft"><b>Answers, not documents.</b> Ask "how many casual leaves do I get?" and get the answer, not a 40-page file to scroll.</span></div>
        <div class="pcgpt-feat"><span class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span><span class="ft"><b>Grounded and safe.</b> It only uses policies your organization has approved and shared, so answers are always on-policy.</span></div>
        <div class="pcgpt-feat"><span class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg></span><span class="ft"><b>Every employee, every language.</b> Available 24/7 on web and mobile, in 10 Indian languages.</span></div>
      </div>
    </div>
    <div>
      <div class="pcgpt-vcard">
        <div class="pcgpt-vtop"><span class="vd" style="background:#FF5F57"></span><span class="vd" style="background:#FEBC2E"></span><span class="vd" style="background:#28C840"></span><span class="pcgpt-vurl">policygpt &middot; employee portal</span></div>
        <div class="pcgpt-vbody">
          <div class="pcgpt-mq"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> Can I carry forward my earned leave?</div>
          <div class="pcgpt-ma"><b>Yes.</b> Earned Leave accrues as you work and can be carried forward year to year, up to the cap set in your Leave &amp; Attendance policy. Casual Leave cannot be carried forward. Your unused Earned Leave is also encashed when you leave.</div>
          <div class="pcgpt-kb">
            <div class="pcgpt-kbi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Leave &amp; Attendance</div>
            <div class="pcgpt-kbi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Travel &amp; Expenses</div>
            <div class="pcgpt-kbi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> POSH &amp; Conduct</div>
            <div class="pcgpt-kbi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> +25 more policies</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div><!-- .pcgpt-lp -->

<div class="explore-wrap">

<!-- ══════════════ HOW POLICIES ARE MANAGED TODAY ══════════════ -->
<section class="today-section">
  <div class="today-inner">
    <div class="exp-reveal">
      <h2 class="exp-section-title">How policies are managed today</h2>
      <p class="exp-section-sub">Most organisations distribute policies through tools never built for the job and have no visibility into whether anyone actually read them.</p>
    </div>
    <div class="problem-grid">
      <div class="prob-card exp-reveal exp-rd1">
        <div class="prob-icon pi-email"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
        <div class="prob-title">Buried in Email</div>
        <div class="prob-desc">Policies sent as email attachments. No version control. No idea if the right people even opened it.</div>
      </div>
      <div class="prob-card exp-reveal exp-rd2">
        <div class="prob-icon pi-drive"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></div>
        <div class="prob-title">Shared Drives &amp; Folders</div>
        <div class="prob-desc">Google Drive or SharePoint folders with no targeting, no tracking, no acknowledgement trail.</div>
      </div>
      <div class="prob-card exp-reveal exp-rd3">
        <div class="prob-icon pi-print"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg></div>
        <div class="prob-title">Print &amp; Sign</div>
        <div class="prob-desc">Paper acknowledgements filed somewhere. Impossible to audit. Doesn't scale beyond a small team.</div>
      </div>
      <div class="prob-card exp-reveal exp-rd4">
        <div class="prob-icon pi-intra"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
        <div class="prob-title">Intranet Links</div>
        <div class="prob-desc">Policies buried in intranets employees rarely visit. No notifications, no read tracking, no sign-off.</div>
      </div>
    </div>
    <div class="vs-bridge exp-reveal" style="margin-top:32px">
      <div class="vs-line"></div>
      <div class="vs-pill">There is a better way &rarr;</div>
      <div class="vs-line"></div>
    </div>
  </div>
</section>

<!-- ══════════════ EVERYTHING YOUR ENTERPRISE NEEDS — 9 FEATURES ══════════════ -->
<section class="stack-section">
  <div class="stack-top exp-reveal">
    <h2 class="exp-section-title">Everything your enterprise needs, out of the box</h2>
    <p class="exp-section-sub">Built for large organisations where policies touch thousands of employees across departments, locations, and languages.</p>
  </div>

  <div class="stack-body">
    <div class="stack-left" id="stackLeft">
      <div class="sl-num" id="slNum">01</div>
      <div class="sl-title" id="slTitle">Gen AI-Powered Policy Intelligence</div>
      <div class="sl-desc" id="slDesc">AI summaries, auto FAQs, quizzes, translation and conversational answers for every policy in your library.</div>
      <div class="sl-pills" id="slPills">
        <span class="sl-pill">PolicyGPT</span>
        <span class="sl-pill">Auto FAQ's</span>
        <span class="sl-pill">Quiz Creation</span>
      </div>
      <div class="sl-progress">
        <div class="sl-prog-row">
          <span class="sl-prog-label" id="slProgLabel">1 of 9</span>
          <a href="<?php echo esc_url(home_url('/features/')); ?>" class="sl-link">All features &rarr;</a>
        </div>
        <div class="sl-prog-track"><div class="sl-prog-fill" id="slProgFill" style="width:11.1%"></div></div>
      </div>
    </div>

    <div class="stack-cards" id="stackCards">
      <div class="sc-item" id="sci0">
        <div class="sc-card">
          <div class="sc-card-num">Feature 01 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#E0F5F7">🧠</div><h3 class="sc-card-title">Gen AI-Powered Policy Intelligence</h3></div>
          <p class="sc-card-body">AI summaries, auto-generated FAQs, infographics, audio versions in 60+ voices, and 10-language translation, all generated from your existing policy content. Plus PolicyGPT, a conversational chatbot that answers employee questions from their specific policies, not the internet.</p>
          <div class="sc-tags"><span class="sc-tag">AI Summaries</span><span class="sc-tag">PolicyGPT Chatbot</span><span class="sc-tag">10 Indian Languages</span><span class="sc-tag">Audio Policies</span><span class="sc-tag">Infographics</span></div>
          <div class="sc-aws"><span class="sc-aws-pill">Powered by</span> Amazon Bedrock &middot; Amazon Polly &middot; AWS Translate</div>
        </div>
      </div>
      <div class="sc-item" id="sci1">
        <div class="sc-card">
          <div class="sc-card-num">Feature 02 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#EEF2FF">✏️</div><h3 class="sc-card-title">Policy Creation &amp; Content Management</h3></div>
          <p class="sc-card-body">A familiar Word-style editor for policy creation: headings, fonts, tables, lists. Enhance with rich media: images, YouTube, GIFs, audio, private video. Upload .docx files and auto-convert to HTML. Built-in responsive PDF viewer. No restrictions on content size.</p>
          <div class="sc-tags"><span class="sc-tag">Word-Style Editor</span><span class="sc-tag">Rich Media</span><span class="sc-tag">PDF Viewer</span><span class="sc-tag">Word Upload</span><span class="sc-tag">Secure Video Hosting</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci2">
        <div class="sc-card">
          <div class="sc-card-num">Feature 03 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#FEF3C7">📋</div><h3 class="sc-card-title">Publisher Controls &amp; Workflow Management</h3></div>
          <p class="sc-card-body">Maker-checker approval with single or multi-level sign-off. Version control with simultaneous publishing. Set expiry dates, resend to unread users only, edit post-publication, recall or permanently delete, with full audit trail of every action.</p>
          <div class="sc-tags"><span class="sc-tag">Maker-Checker</span><span class="sc-tag">Version Control</span><span class="sc-tag">Expiry Management</span><span class="sc-tag">Resend Unread</span><span class="sc-tag">Auto-Delete</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci3">
        <div class="sc-card">
          <div class="sc-card-num">Feature 04 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#E0F5F7">🎯</div><h3 class="sc-card-title">Policy Distribution &amp; Targeting</h3></div>
          <p class="sc-card-body">Target policies by department, location, grade, and designation, synced from Active Directory or HRMS. Evergreen mode auto-shares with employees who join in future and match the criteria. Mail merge for personalised content per employee. Public access for vendors and candidates.</p>
          <div class="sc-tags"><span class="sc-tag">AD / HRMS Sync</span><span class="sc-tag">Evergreen Mode</span><span class="sc-tag">Mail Merge</span><span class="sc-tag">Custom Lists</span><span class="sc-tag">Public Access</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci4">
        <div class="sc-card">
          <div class="sc-card-num">Feature 05 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#EDE9FE">📱</div><h3 class="sc-card-title">Employee Portal &amp; Mobile App</h3></div>
          <p class="sc-card-body">White-label Android and iOS apps published under your own app store accounts. Advanced Google-style search inside Word, PDF, Excel and PowerPoint attachments. Smart folders by department, calendar view for deadlines, personalised dashboard, and a Top Deck banner for critical policies.</p>
          <div class="sc-tags"><span class="sc-tag">White-Label App</span><span class="sc-tag">Advanced Search</span><span class="sc-tag">Smart Folders</span><span class="sc-tag">Calendar View</span><span class="sc-tag">Top Deck</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci5">
        <div class="sc-card">
          <div class="sc-card-num">Feature 06 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#D1FAE5">✅</div><h3 class="sc-card-title">Employee Interaction &amp; Acknowledgement</h3></div>
          <p class="sc-card-body">Formal sign-off via AD password, Aadhaar, or digital signature tools, each with a secure timestamp in the audit trail. Custom one-click response buttons, policy-level Q&amp;A threads, employee comments, peer recommendations, and 12+ emoji reactions for sentiment tracking.</p>
          <div class="sc-tags"><span class="sc-tag">Digital Signature</span><span class="sc-tag">Aadhaar Sign-off</span><span class="sc-tag">Q&amp;A Thread</span><span class="sc-tag">Comments</span><span class="sc-tag">Reactions</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci6">
        <div class="sc-card">
          <div class="sc-card-num">Feature 07 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#FEF3C7">📊</div><h3 class="sc-card-title">Tracking, Analytics &amp; Reporting</h3></div>
          <p class="sc-card-body">Per-employee read receipts showing who read, when, and how many times. Timeline engagement reports to track how acknowledgements evolve. Monthly search analytics to understand what employees are looking for. All reports exportable in CSV, Excel, and PDF.</p>
          <div class="sc-tags"><span class="sc-tag">Read Receipts</span><span class="sc-tag">Timeline Reports</span><span class="sc-tag">Search Analytics</span><span class="sc-tag">Response Reports</span><span class="sc-tag">CSV / Excel / PDF</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci7">
        <div class="sc-card">
          <div class="sc-card-num">Feature 08 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#E0F5F7">🏛️</div><h3 class="sc-card-title">Enterprise Features</h3></div>
          <p class="sc-card-body">SSO and Active Directory integration with MFA. White-label platform on your custom subdomain. Open REST API for HRMS, intranet, and ERP integration. OTP-based login for non-AD users: partners, contractors, off-payroll staff. WebView embedding for existing enterprise apps.</p>
          <div class="sc-tags"><span class="sc-tag">SSO + AD + MFA</span><span class="sc-tag">White-Label Domain</span><span class="sc-tag">Open API</span><span class="sc-tag">HRMS Integration</span><span class="sc-tag">Multi-Department</span></div>
        </div>
      </div>
      <div class="sc-item" id="sci8">
        <div class="sc-card">
          <div class="sc-card-num">Feature 09 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#FFE4E6">🔒</div><h3 class="sc-card-title">Banking-Grade Security &amp; Compliance</h3></div>
          <p class="sc-card-body">AES-256 encryption at rest, TLS 1.2+ in transit. Annual VAPT with certification reports available. IP-based access restriction, screenshot protection, and tamper-proof audit logs. Aligned with ISO 27001, SOC 2 Type II, GDPR, NIST, and RBI BFSI guidelines. SaaS or your own AWS account.</p>
          <div class="sc-tags"><span class="sc-tag">AES-256</span><span class="sc-tag">Annual VAPT</span><span class="sc-tag">ISO 27001</span><span class="sc-tag">SOC 2 Type II</span><span class="sc-tag">RBI BFSI</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ CTA FORM ══════════════ -->
<section class="cta-section" id="cta-form">
  <div class="cta-bg-icons">
    <svg class="bgi-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    <svg class="bgi-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    <svg class="bgi-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
    <svg class="bgi-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
    <svg class="bgi-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <svg class="bgi-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    <svg class="bgi-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    <svg class="bgi-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
    <svg class="bgi-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>
    <svg class="bgi-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
    <svg class="bgi-11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
    <svg class="bgi-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
  </div>

  <div class="cta-inner exp-reveal">
    <div class="cta-header">
      <div class="cta-kicker">Bring PolicyGPT to your organisation</div>
      <h2 class="cta-title">See PolicyCentral.ai on your own policies</h2>
      <p class="cta-sub">Request a personalised demo for your organisation. Most teams are live within 4 to 6 weeks.</p>
    </div>
    <div class="cta-form-wrap">
      <form id="exp-contact-form" autocomplete="off" novalidate>
        <?php wp_nonce_field('pc_contact_submit', 'pc_nonce'); ?>
        <div class="exp-form-row row-3">
          <div class="exp-form-group">
            <label>Your name <span class="req">*</span></label>
            <input type="text" name="full_name" class="exp-form-input" placeholder="Full name" required>
          </div>
          <div class="exp-form-group">
            <label>Company name <span class="req">*</span></label>
            <input type="text" name="company" class="exp-form-input" placeholder="Company name" required>
          </div>
          <div class="exp-form-group">
            <label>Your work email <span class="req">*</span></label>
            <input type="email" name="email" class="exp-form-input" placeholder="you@company.com" required>
          </div>
        </div>
        <small class="exp-form-hint">Please use your corporate email id. Personal addresses (Gmail, Yahoo, etc.) aren't accepted.</small>
        <div class="exp-form-row row-3">
          <div class="exp-form-group">
            <label>Contact number <span class="req">*</span></label>
            <input type="tel" name="phone" class="exp-form-input" placeholder="Enter phone number with country code" required>
          </div>
          <div class="exp-form-group">
            <label>Company size</label>
            <select name="people_strength" class="exp-form-input">
              <option value="">Select number of employees</option>
              <option value="1-10">1 to 10</option>
              <option value="11-50">11 to 50</option>
              <option value="51-200">51 to 200</option>
              <option value="201-500">201 to 500</option>
              <option value="501-1000">501 to 1000</option>
              <option value="1000+">1000+</option>
            </select>
          </div>
          <div class="exp-form-group">
            <label>City</label>
            <input type="text" name="city" class="exp-form-input" placeholder="Enter your city">
          </div>
        </div>
        <div class="exp-form-row row-msg">
          <div class="exp-form-group">
            <label>Your message</label>
            <input type="text" name="message" class="exp-form-input" placeholder="How can we help?">
          </div>
          <button type="submit" class="exp-form-submit" id="exp-btn-submit">
            Send Message
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>
        </div>
        <div class="exp-form-status" id="exp-form-status" style="display:none"></div>
      </form>
    </div>
  </div>
</section>

</div><!-- .explore-wrap -->

<script>
/* ── PolicyGPT live search — streams real answers from the sample policy corpus ── */
(function(){
  var CFG = window.PCGPT_POLICY || {};
  var qI=document.getElementById('pcgptQ'),send=document.getElementById('pcgptSend'),
      card=document.getElementById('pcgptAns'),q=document.getElementById('pcgptQuery'),
      body=document.getElementById('pcgptBody'),st=document.getElementById('pcgptStatus'),
      src=document.getElementById('pcgptSrc'),srcTxt=document.getElementById('pcgptSrcTxt'),
      pitch=document.getElementById('pcgptPitch');
  var busy=false, CURSOR='<span class="pcgpt-cursor"></span>';

  function esc(s){return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
  // light renderer: **bold**, "- " bullet lists, ## headings, > quotes, paragraphs
  function render(t){
    t=esc(t).replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>');
    var out='', inList=false, para=[];
    function flushPara(){ if(para.length){ out+='<p>'+para.join('<br>')+'</p>'; para=[]; } }
    function flushList(){ if(inList){ out+='</ul>'; inList=false; } }
    t.split(/\n/).forEach(function(raw){
      var x=raw.replace(/^\s*&gt;\s?/,'').replace(/\s+$/,''); // strip blockquote marker
      if(x.trim()===''){ flushPara(); flushList(); return; }
      var mb=x.match(/^\s*[-•*]\s+(.+)$/);       // bullet
      var mh=x.match(/^#{1,6}\s+(.+)$/);          // heading
      if(mb){ flushPara(); if(!inList){ out+='<ul>'; inList=true; } out+='<li>'+mb[1]+'</li>'; }
      else if(mh){ flushList(); flushPara(); out+='<p><strong>'+mh[1]+'</strong></p>'; }
      else { flushList(); para.push(x); }
    });
    flushPara(); flushList();
    return out;
  }

  async function run(text){
    text=(text||'').trim();
    if(busy||!text)return; busy=true;
    q.innerHTML='<b>You asked:</b> '+esc(text);
    body.innerHTML=''; st.textContent='Reading policies…';
    src.classList.add('hidden'); srcTxt.textContent=''; pitch.classList.remove('show');
    card.classList.add('show');
    card.scrollIntoView({behavior:'smooth',block:'center'});
    send.disabled=true;
    var sources=[], full='', started=false;
    try{
      var params=new URLSearchParams();
      params.append('action','pcgpt_policy_search');
      params.append('nonce',CFG.nonce||'');
      params.append('query',text);
      var res=await fetch(CFG.ajax_url,{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:params.toString()});
      if(!res.ok) throw new Error('HTTP '+res.status);
      if((res.headers.get('Content-Type')||'').indexOf('application/json')!==-1){
        var j=await res.json(); throw new Error(j.error||'Search error');
      }
      var reader=res.body.getReader(), dec=new TextDecoder(), buf='';
      while(true){
        var r=await reader.read(); if(r.done) break;
        buf+=dec.decode(r.value,{stream:true});
        var lines=buf.split('\n'); buf=lines.pop();
        for(var i=0;i<lines.length;i++){
          var ln=lines[i]; if(ln.indexOf('data: ')!==0) continue;
          var d=ln.slice(6).trim(); if(!d||d==='[DONE]') continue;
          var p; try{p=JSON.parse(d);}catch(e){continue;}
          if(p.type==='pc_sources'){ sources=p.sources||[]; }
          else if(p.type==='content_block_delta'&&p.delta&&p.delta.type==='text_delta'){
            if(!started){started=true; st.textContent='Answering';}
            full+=p.delta.text;
            body.innerHTML=render(full)+CURSOR;
          } else if(p.type==='error'){ throw new Error((p.error&&p.error.message)||'Model error'); }
        }
      }
      if(!full.trim()) throw new Error('Empty response');
      body.innerHTML=render(full);
      finish(sources);
    }catch(err){
      body.innerHTML='<p style="color:var(--gray-500)">Sorry, the demo could not answer that just now. Please try again, or book a demo below.</p>';
      st.textContent='Try again'; busy=false; send.disabled=false;
    }
  }

  function finish(sources){
    var n=sources.length;
    st.textContent = n ? ('Answered from '+n+' '+(n>1?'policies':'policy')) : 'Answered';
    if(n){ srcTxt.textContent='Source: '+sources[0]+(n>1?(' (+'+(n-1)+' more)'):''); src.classList.remove('hidden'); }
    setTimeout(function(){ pitch.classList.add('show'); busy=false; send.disabled=false; },300);
  }
  send.addEventListener('click',function(){run(qI.value);});
  qI.addEventListener('keydown',function(e){if(e.key==='Enter')run(qI.value);});
  document.querySelectorAll('#pcgptChips .pcgpt-chip').forEach(function(c){
    c.addEventListener('click',function(){qI.value=c.textContent;run(c.textContent);});
  });
  var shareBtn=document.getElementById('pcgptShare');
  if(shareBtn)shareBtn.addEventListener('click',function(){
    var url=window.location.href, txt='Try PolicyGPT — ask any HR policy question and get an instant answer: ';
    if(navigator.share){navigator.share({title:'PolicyGPT by PolicyCentral.ai',text:txt,url:url});}
    else{window.open('https://wa.me/?text='+encodeURIComponent(txt+url),'_blank');}
  });
})();

/* ── Explore V2 behaviours: scroll reveal + sticky card stack + CTA form ── */
(function(){
  var observer = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.explore-wrap .exp-reveal').forEach(function(el){ observer.observe(el); });

  var leftData = [
    { num:'01', title:'Gen AI-Powered Policy Intelligence',    desc:'AI summaries, auto FAQs, quizzes, audio and the PolicyGPT chatbot for every policy in your library.',   pills:['PolicyGPT','Auto FAQ\'s','Quiz Creation'] },
    { num:'02', title:'Policy Creation & Content Management',  desc:'Word-style editor, rich media, PDF viewer and secure video hosting. No size limits.',          pills:['Word Editor','PDF Viewer','Rich Media'] },
    { num:'03', title:'Publisher Controls & Workflow',         desc:'Maker-checker approval, version control and full lifecycle management in one place.',             pills:['Maker-Checker','Version Control','Workflow'] },
    { num:'04', title:'Policy Distribution & Targeting',       desc:'Precision targeting by department, location, grade — with evergreen mode for new joiners.',       pills:['AD/HRMS Sync','Evergreen Mode','Mail Merge'] },
    { num:'05', title:'Employee Portal & Mobile App',          desc:'White-label mobile app under your own app store accounts, with full-text file search.',            pills:['Android + iOS','White-Label','Advanced Search'] },
    { num:'06', title:'Interaction & Acknowledgement',         desc:'AD password, Aadhaar or digital signature — all timestamped and audit-ready.',                    pills:['E-Signature','Aadhaar','Q&A Thread'] },
    { num:'07', title:'Tracking, Analytics & Reporting',       desc:'Per-employee read receipts, search analytics and comprehensive exportable reports.',               pills:['Read Receipts','Search Analytics','Reports'] },
    { num:'08', title:'Enterprise Features',                   desc:'SSO, AD, white-label subdomain, open API and multi-department publishing.',                        pills:['SSO + AD','White-Label','Open API'] },
    { num:'09', title:'Banking-Grade Security & Compliance',   desc:'AES-256 encryption, annual VAPT, ISO 27001, SOC 2 and RBI BFSI alignment.',                       pills:['ISO 27001','SOC 2','RBI BFSI'] },
  ];
  var lastIdx = -1;
  function updateLeft(idx){
    if(idx === lastIdx) return; lastIdx = idx;
    var d = leftData[idx];
    document.getElementById('slNum').textContent   = d.num;
    document.getElementById('slTitle').textContent = d.title;
    document.getElementById('slDesc').textContent  = d.desc;
    document.getElementById('slPills').innerHTML   = d.pills.map(function(p){ return '<span class="sl-pill">'+p+'</span>'; }).join('');
    document.getElementById('slProgLabel').textContent = (idx+1)+' of 9';
    document.getElementById('slProgFill').style.width  = ((idx+1)/9*100).toFixed(1)+'%';
  }
  function getActiveCard(){
    var TRIGGER = 220, active = 0;
    for(var i = 0; i < 9; i++){
      var el = document.getElementById('sci'+i); if(!el) continue;
      if(el.getBoundingClientRect().top <= TRIGGER){ active = i; }
    }
    return active;
  }
  function onScroll(){ updateLeft(getActiveCard()); }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  var expForm = document.getElementById('exp-contact-form');
  var expBtn  = document.getElementById('exp-btn-submit');
  var expStatus = document.getElementById('exp-form-status');
  if (expForm) {
    var expEmail = expForm.querySelector('input[name="email"]');
    var personalDomains = <?php echo wp_json_encode(array_values(pc_personal_email_domains())); ?>;
    function isPersonalEmail(value){
      var at = (value || '').toLowerCase().trim().lastIndexOf('@');
      if (at === -1) return false;
      return personalDomains.indexOf(value.toLowerCase().trim().slice(at + 1)) !== -1;
    }
    function validateCorporateEmail(){
      if (isPersonalEmail(expEmail.value)) { expEmail.setCustomValidity('Please use your corporate email address. Personal providers like Gmail, Yahoo or Outlook are not accepted.'); }
      else { expEmail.setCustomValidity(''); }
    }
    expEmail.addEventListener('input', validateCorporateEmail);
    expEmail.addEventListener('blur', validateCorporateEmail);
    expForm.addEventListener('submit', function(e){
      e.preventDefault();
      validateCorporateEmail();
      if (!expForm.checkValidity()) { expForm.reportValidity(); return; }
      expBtn.disabled = true;
      expBtn.innerHTML = 'Sending... <svg class="spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px;animation:spin .8s linear infinite"><circle cx="12" cy="12" r="10" stroke-dasharray="30 70" stroke-linecap="round"/></svg>';
      expStatus.style.display = 'none';
      var data = new FormData(expForm);
      data.append('action', 'pc_contact_submit');
      fetch('<?php echo admin_url("admin-ajax.php"); ?>', { method: 'POST', body: data })
      .then(function(r){ return r.json(); })
      .then(function(res){
        if (res.success) {
          window.dataLayer = window.dataLayer || [];
          dataLayer.push({ event: 'form_submit', form_name: 'contact_form' });
          var expires = new Date(Date.now() + 5 * 60 * 1000).toUTCString();
          document.cookie = 'pc_ty_name=' + encodeURIComponent(data.get('full_name')) + ';expires=' + expires + ';path=/;SameSite=Lax';
          document.cookie = 'pc_ty_company=' + encodeURIComponent(data.get('company')) + ';expires=' + expires + ';path=/;SameSite=Lax';
          document.cookie = 'pc_ty_email=' + encodeURIComponent(data.get('email')) + ';expires=' + expires + ';path=/;SameSite=Lax';
          window.location.href = '<?php echo home_url("/thank-you/"); ?>';
        } else {
          expStatus.className = 'exp-form-status error';
          expStatus.textContent = res.data || 'Something went wrong. Please try again.';
          expStatus.style.display = 'block';
          expBtn.disabled = false;
          expBtn.innerHTML = 'Send Message <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
        }
      })
      .catch(function(){
        expStatus.className = 'exp-form-status error';
        expStatus.textContent = 'Network error. Please check your connection.';
        expStatus.style.display = 'block';
        expBtn.disabled = false;
        expBtn.innerHTML = 'Send Message <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
      });
    });
  }
})();
</script>

<?php get_footer(); ?>
