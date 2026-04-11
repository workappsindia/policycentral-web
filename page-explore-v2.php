<?php
/* Template Name: Explore V2 */
get_header();
?>

<style>
/* ── Explore V2 page variables (scoped) ─────────────────────────── */
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

/* ── FADE ANIMATIONS ── */
.explore-wrap .exp-reveal{opacity:0;transform:translateY(20px);transition:opacity .6s ease,transform .6s ease}
.explore-wrap .exp-reveal.visible{opacity:1;transform:none}
.explore-wrap .exp-rd1{transition-delay:.05s}
.explore-wrap .exp-rd2{transition-delay:.15s}
.explore-wrap .exp-rd3{transition-delay:.25s}
.explore-wrap .exp-rd4{transition-delay:.35s}

/* ══════════════════════════════════════════
   SCROLL 1 — HERO
══════════════════════════════════════════ */
.explore-wrap .exp-hero{
  padding:calc(68px + 110px) clamp(20px,4vw,60px) 64px;
  background:#fff;
  border-bottom:1px solid var(--g100);
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:60px;
  align-items:center;
  max-width:1240px;
  margin:0 auto;
}

.explore-wrap .exp-hero-left{}

.explore-wrap .exp-hero-kicker{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--teal-lt);border:1.5px solid rgba(6,148,162,.2);
  border-radius:6px;padding:5px 12px;
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:var(--teal-dk);margin-bottom:24px;
}
.explore-wrap .kicker-dot{width:6px;height:6px;border-radius:50%;background:var(--teal);animation:exp-blink 1.4s infinite}
@keyframes exp-blink{0%,100%{opacity:1}50%{opacity:.2}}

.explore-wrap .exp-hero h1{
  font-size:clamp(28px,3.8vw,50px);font-weight:900;
  line-height:1.08;letter-spacing:-.03em;
  margin-bottom:20px;color:var(--g900);
}

.explore-wrap .exp-hero-sub{
  font-size:clamp(15px,1.6vw,18px);color:var(--g500);
  line-height:1.7;margin-bottom:32px;font-weight:400;max-width:480px;
}

.explore-wrap .exp-hero-actions{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.explore-wrap .exp-btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:14px 28px;border-radius:9999px;
  font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;
  cursor:pointer;transition:all .25s cubic-bezier(.4,0,.2,1);
  text-decoration:none;border:none;
}
.explore-wrap .exp-btn svg{width:14px;height:14px}
.explore-wrap .exp-btn-primary{
  background:var(--grad);color:#fff;
  box-shadow:0 4px 20px rgba(6,148,162,.3);
}
.explore-wrap .exp-btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(6,148,162,.4)}
.explore-wrap .exp-btn-ghost{
  background:#fff;color:var(--g700);
  border:1.5px solid var(--g200);
}
.explore-wrap .exp-btn-ghost:hover{background:var(--g50);border-color:var(--g300);transform:translateY(-1px)}

/* Client logos in hero */
.explore-wrap .exp-hero-trust{margin-top:28px;padding-top:20px;border-top:1px solid var(--g100)}
.explore-wrap .exp-trust-label{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--g400);margin-bottom:16px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .exp-logo-strip{display:flex;align-items:center;gap:24px;flex-wrap:wrap}
.explore-wrap .exp-logo-strip img{height:28px;width:auto;transition:all .2s}
.explore-wrap .exp-logo-strip img:hover{transform:scale(1.05)}

/* Hero right — platform mockup */
.explore-wrap .exp-hero-right{
  background:var(--g50);border:1.5px solid var(--g200);
  border-radius:20px;overflow:hidden;
  box-shadow:0 24px 64px rgba(0,0,0,.09),0 8px 24px rgba(0,0,0,.05);
}
.explore-wrap .mockup-bar{
  display:flex;align-items:center;gap:6px;
  padding:10px 14px;background:#fff;border-bottom:1px solid var(--g200);
}
.explore-wrap .m-dot{width:9px;height:9px;border-radius:50%}
.explore-wrap .mockup-body{padding:16px}
.explore-wrap .stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:12px}
.explore-wrap .stat-chip{
  background:#fff;border:1px solid var(--g200);border-radius:10px;
  padding:10px 12px;text-align:center;
}
.explore-wrap .stat-chip-val{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:900;line-height:1}
.explore-wrap .stat-chip-lbl{font-size:9.5px;color:var(--g400);font-weight:500;margin-top:2px}
.explore-wrap .stat-chip.teal .stat-chip-val{color:var(--teal)}
.explore-wrap .stat-chip.ok .stat-chip-val{color:var(--emerald)}
.explore-wrap .stat-chip.grad .stat-chip-val{background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

.explore-wrap .policy-item{
  display:flex;align-items:center;gap:10px;
  background:#fff;border:1px solid var(--g200);border-radius:10px;
  padding:10px 12px;margin-bottom:8px;
}
.explore-wrap .pi-icon{width:28px;height:28px;border-radius:7px;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px}
.explore-wrap .pi-name{font-size:12px;font-weight:600;color:var(--g800);flex:1}
.explore-wrap .pi-badge{font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .badge-high{background:var(--em-lt);color:var(--emerald)}
.explore-wrap .badge-med{background:var(--teal-lt);color:var(--teal-dk)}
.explore-wrap .badge-pend{background:var(--amber-lt);color:var(--amber)}
.explore-wrap .pi-pct{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--teal);min-width:36px;text-align:right}

.explore-wrap .ai-row{
  display:flex;align-items:flex-start;gap:8px;
  background:linear-gradient(135deg,rgba(6,148,162,.05),rgba(67,56,202,.05));
  border:1px solid rgba(6,148,162,.15);border-radius:10px;
  padding:10px 12px;margin-top:8px;
}
.explore-wrap .ai-row-icon{width:22px;height:22px;border-radius:6px;background:var(--grad);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.explore-wrap .ai-row-icon svg{width:11px;height:11px;color:#fff}
.explore-wrap .ai-row-text{font-size:11px;color:var(--g600);line-height:1.5}
.explore-wrap .ai-row-tag{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;color:var(--teal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px}

/* ══════════════════════════════════════════
   SCROLL 2 — HOW IT'S MANAGED TODAY + FEATURES
══════════════════════════════════════════ */
.explore-wrap .today-section{
  background:var(--g50);
  border-top:1px solid var(--g100);border-bottom:1px solid var(--g100);
  padding:64px clamp(20px,4vw,60px);
}
.explore-wrap .today-inner{max-width:1240px;margin:0 auto}

.explore-wrap .exp-section-kicker{
  font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;
  letter-spacing:.1em;text-transform:uppercase;color:var(--g400);
  margin-bottom:10px;
}
.explore-wrap .exp-section-title{
  font-size:clamp(22px,3vw,36px);font-weight:900;
  line-height:1.15;margin-bottom:12px;color:var(--g900);
}
.explore-wrap .exp-section-sub{
  font-size:15px;color:var(--g500);line-height:1.7;
  max-width:720px;margin-bottom:40px;
}

/* Today — 4 problem cards */
.explore-wrap .problem-grid{
  display:grid;grid-template-columns:repeat(4,1fr);gap:12px;
  margin-bottom:24px;
}
.explore-wrap .prob-card{
  background:#fff;border:1.5px solid var(--g200);border-radius:14px;
  padding:20px 18px;
  box-shadow:0 2px 8px rgba(0,0,0,.04);
}
.explore-wrap .prob-icon{width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.explore-wrap .prob-icon svg{width:24px;height:24px}
.explore-wrap .prob-icon.pi-email{background:rgba(239,68,68,.1);color:#EF4444}
.explore-wrap .prob-icon.pi-drive{background:rgba(245,158,11,.1);color:#F59E0B}
.explore-wrap .prob-icon.pi-print{background:rgba(107,114,128,.1);color:#6B7280}
.explore-wrap .prob-icon.pi-intra{background:rgba(59,130,246,.1);color:#3B82F6}
.explore-wrap .prob-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:800;color:var(--g800);margin-bottom:6px}
.explore-wrap .prob-desc{font-size:12.5px;color:var(--g500);line-height:1.6}

.explore-wrap .vs-bridge{
  display:flex;align-items:center;gap:16px;
  margin-bottom:0;
}
.explore-wrap .vs-line{flex:1;height:1px;background:var(--g200)}
.explore-wrap .vs-pill{
  background:var(--grad);color:#fff;
  font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;
  padding:6px 20px;border-radius:9999px;white-space:nowrap;
  box-shadow:0 4px 16px rgba(6,148,162,.3);
}

/* ── LIFECYCLE STEPS ── */
.explore-wrap .lifecycle-section{
  padding:64px clamp(20px,4vw,60px);
  background:#fff;
  border-bottom:1px solid var(--g100);
}
.explore-wrap .lifecycle-inner{max-width:1240px;margin:0 auto}

.explore-wrap .steps-row{
  display:flex;align-items:stretch;
  gap:0;
  margin-top:36px;
  border:1.5px solid var(--g200);border-radius:16px;
  overflow:hidden;
  box-shadow:0 4px 16px rgba(0,0,0,.05);
}
.explore-wrap .step{
  flex:1;padding:20px 16px;background:#fff;
  border-right:1px solid var(--g200);
  display:flex;flex-direction:column;align-items:center;
  text-align:center;
  transition:background .2s;
  position:relative;
}
.explore-wrap .step:last-child{border-right:none}
.explore-wrap .step:hover{background:var(--g50)}
.explore-wrap .step-icon{
  width:52px;height:52px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  margin-bottom:10px;flex-shrink:0;
  box-shadow:0 4px 14px rgba(0,0,0,.1);
}
.explore-wrap .step-icon svg{width:24px;height:24px;color:#fff}
.explore-wrap .step-label{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--g800);margin-bottom:4px}
.explore-wrap .step-desc{font-size:11px;color:var(--g400);line-height:1.5}

/* ── STICKY CARD STACK ── */
.explore-wrap .stack-section{
  padding:72px clamp(20px,4vw,60px) 20px;
  background:#fff;
  border-bottom:1px solid var(--g100);
}
.explore-wrap .stack-top{max-width:1240px;margin:0 auto;margin-bottom:52px}
.explore-wrap .stack-body{
  max-width:1240px;margin:0 auto;
  display:grid;grid-template-columns:280px 1fr;gap:60px;align-items:start;
}
.explore-wrap .stack-left{position:sticky;top:80px}
.explore-wrap .sl-num{
  font-size:56px;font-weight:900;font-family:'Plus Jakarta Sans',sans-serif;
  letter-spacing:-.04em;line-height:1;
  background:var(--grad-text);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  margin-bottom:12px;transition:all .35s;
}
.explore-wrap .sl-title{
  font-family:'Plus Jakarta Sans',sans-serif;font-size:17px;font-weight:800;
  color:var(--g900);line-height:1.25;margin-bottom:10px;transition:all .35s;
}
.explore-wrap .sl-desc{font-size:13px;color:var(--g500);line-height:1.7;margin-bottom:16px;transition:all .35s}
.explore-wrap .sl-pills{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:24px}
.explore-wrap .sl-pill{
  font-size:11px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;
  padding:4px 10px;border-radius:9999px;
  background:var(--teal-lt);color:var(--teal-dk);border:1px solid rgba(6,148,162,.2);
}
.explore-wrap .sl-progress{}
.explore-wrap .sl-prog-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.explore-wrap .sl-prog-label{
  font-size:11px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;
  color:var(--g400);letter-spacing:.06em;text-transform:uppercase;
}
.explore-wrap .sl-link{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;color:var(--teal);text-decoration:none}
.explore-wrap .sl-link:hover{text-decoration:underline}
.explore-wrap .sl-prog-track{height:4px;background:var(--g200);border-radius:2px;overflow:hidden}
.explore-wrap .sl-prog-fill{height:4px;background:var(--grad);border-radius:2px;transition:width .5s cubic-bezier(.4,0,.2,1)}
.explore-wrap .sc-item{position:sticky;margin-bottom:120px}
.explore-wrap .sc-item:last-child{margin-bottom:120px}
.explore-wrap .sc-item:nth-child(1){top:80px}.explore-wrap .sc-item:nth-child(2){top:92px}.explore-wrap .sc-item:nth-child(3){top:104px}
.explore-wrap .sc-item:nth-child(4){top:116px}.explore-wrap .sc-item:nth-child(5){top:128px}.explore-wrap .sc-item:nth-child(6){top:140px}
.explore-wrap .sc-item:nth-child(7){top:152px}.explore-wrap .sc-item:nth-child(8){top:164px}.explore-wrap .sc-item:nth-child(9){top:176px}
.explore-wrap .sc-card{
  background:#fff;border:1.5px solid var(--g200);border-radius:20px;
  padding:28px 28px 24px;
  box-shadow:0 4px 20px rgba(0,0,0,.06),0 1px 4px rgba(0,0,0,.04);
  transition:box-shadow .3s;
}
.explore-wrap .sc-card:hover{box-shadow:0 8px 32px rgba(0,0,0,.1),0 2px 8px rgba(0,0,0,.06)}
.explore-wrap .sc-card-num{font-size:10px;font-weight:500;color:var(--g400);letter-spacing:.1em;margin-bottom:14px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .sc-card-head{display:flex;align-items:center;gap:14px;margin-bottom:14px}
.explore-wrap .sc-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.explore-wrap .sc-card-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:800;color:var(--g900);line-height:1.2}
.explore-wrap .sc-card-body{font-size:14px;color:var(--g600);line-height:1.75;margin-bottom:16px}
.explore-wrap .sc-tags{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px}
.explore-wrap .sc-tag{
  font-size:11px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;
  padding:4px 10px;border-radius:9999px;
  background:var(--g50);border:1px solid var(--g200);color:var(--g600);
}
.explore-wrap .sc-aws{font-size:11px;color:var(--g400);border-top:1px solid var(--g100);padding-top:12px;margin-top:4px}
.explore-wrap .sc-aws-pill{
  display:inline-block;background:rgba(255,153,0,.1);border:1px solid rgba(255,153,0,.2);
  color:#B45309;font-weight:700;font-size:9.5px;padding:1px 7px;border-radius:4px;
  margin-right:4px;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.04em;text-transform:uppercase;
}
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

/* CTA */
.explore-wrap .cta-section{
  padding:72px clamp(20px,4vw,60px);
  background:var(--g50);
  position:relative;overflow:hidden;
}
/* Background icon pattern */
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
.explore-wrap .cta-kicker{
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:var(--teal);margin-bottom:16px;
}
.explore-wrap .cta-title{
  font-size:clamp(24px,3.5vw,40px);font-weight:900;
  line-height:1.1;color:var(--g900);margin-bottom:16px;
}
.explore-wrap .cta-sub{font-size:15px;color:var(--g500);line-height:1.7}
/* CTA form — wide compact layout */
.explore-wrap .cta-form-wrap{
  max-width:1000px;margin:0 auto;
  background:#fff;border:1.5px solid var(--g200);
  border-radius:16px;padding:28px 32px;
  box-shadow:0 4px 20px rgba(0,0,0,.06);
}
.explore-wrap .cta-form-wrap .exp-form-row{display:grid;gap:12px;margin-bottom:12px}
.explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr 1fr 1fr}
.explore-wrap .cta-form-wrap .exp-form-row.row-btn{grid-template-columns:1fr 2fr auto;align-items:end}
.explore-wrap .cta-form-wrap .exp-form-group{margin-bottom:0}
.explore-wrap .cta-form-wrap label{display:block;font-size:12px;font-weight:700;color:var(--g600);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.explore-wrap .cta-form-wrap label .req{color:var(--rose);margin-left:2px}
.explore-wrap .cta-form-wrap .exp-form-input{
  width:100%;padding:10px 14px;border:1.5px solid var(--g200);border-radius:10px;
  font-size:14px;font-family:'Manrope',sans-serif;color:var(--g900);background:var(--g50);
  transition:all .2s;outline:none;
}
.explore-wrap .cta-form-wrap .exp-form-input::placeholder{color:var(--g400)}
.explore-wrap .cta-form-wrap .exp-form-input:focus{border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(6,148,162,.1)}
.explore-wrap .cta-form-wrap textarea.exp-form-input{resize:vertical;min-height:42px}
.explore-wrap .cta-form-wrap .exp-form-submit{
  padding:10px 28px;border-radius:9999px;white-space:nowrap;
  background:linear-gradient(135deg,#179D97,#05162A);color:#fff;
  font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:700;
  border:none;cursor:pointer;transition:all .25s;
  box-shadow:0 4px 20px rgba(23,157,151,.28);
  display:inline-flex;align-items:center;justify-content:center;gap:8px;
  height:42px;
}
.explore-wrap .cta-form-wrap .exp-form-submit:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(23,157,151,.4)}
.explore-wrap .cta-form-wrap .exp-form-submit:disabled{opacity:.7;cursor:not-allowed}
.explore-wrap .cta-form-wrap .exp-form-submit svg{width:16px;height:16px}
.explore-wrap .exp-form-status{padding:12px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:12px}
.explore-wrap .exp-form-status.error{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA}
.explore-wrap .exp-form-status.success{background:#F0FDF4;color:#16A34A;border:1px solid #BBF7D0}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .explore-wrap .exp-hero{grid-template-columns:1fr;gap:40px}
  .explore-wrap .exp-hero-right{max-width:520px}
  .explore-wrap .problem-grid{grid-template-columns:1fr 1fr}
  .explore-wrap .steps-row{flex-wrap:wrap}
  .explore-wrap .step{flex:1 1 calc(33% - 1px);border-bottom:1px solid var(--g200)}
}
@media(max-width:900px){
  .explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr 1fr}
  .explore-wrap .cta-form-wrap .exp-form-row.row-btn{grid-template-columns:1fr 1fr}
  .explore-wrap .cta-form-wrap .exp-form-submit{grid-column:1/-1}
}
@media(max-width:680px){
  .explore-wrap .exp-hero{padding:calc(68px + 60px) 20px 40px}
  .explore-wrap .today-section,.explore-wrap .lifecycle-section,.explore-wrap .stack-section,.explore-wrap .cta-section{padding:48px 20px}
  .explore-wrap .problem-grid{grid-template-columns:1fr}
  .explore-wrap .step{flex:1 1 calc(50% - 1px)}
  .explore-wrap .cta-form-wrap .exp-form-row.row-3{grid-template-columns:1fr}
  .explore-wrap .cta-form-wrap .exp-form-row.row-btn{grid-template-columns:1fr}
  .explore-wrap .cta-form-wrap{padding:20px}
}
</style>

<div class="explore-wrap">

<!-- ══════════════════════════════════════════
     SCROLL 1 — HERO
══════════════════════════════════════════ -->
<section class="exp-hero">

  <div class="exp-hero-left exp-reveal">

    <h1>Every policy.<br>Read, signed,<br><span class="g-text">and tracked.</span></h1>

    <p class="exp-hero-sub">
      PolicyCentral.ai is an AI-driven policy management platform built for large organisations. Host, publish, target, and track every policy across your entire workforce.
    </p>

    <div class="exp-hero-actions">
      <a href="#cta-form" class="exp-btn exp-btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        Book a Demo
      </a>
      <a href="<?php echo esc_url(home_url('/features/')); ?>" class="exp-btn exp-btn-ghost">Explore Features</a>
    </div>

    <div class="exp-hero-trust exp-reveal exp-rd2">
      <div class="exp-trust-label">Live Customers</div>
      <div class="exp-logo-strip">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/HDFC-Life-Logo.png" alt="HDFC Life">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/Kotak Mahindra Bank logo.png" alt="Kotak Mahindra Bank">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/arohan.png" alt="Arohan Financial Services">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/SBI Life Insurance.png" alt="SBI Life Insurance">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/LTFS.png" alt="L&amp;T Financial Services">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/reliance-nippon-life-insurance-logo.png" alt="Reliance Nippon Life Insurance">
      </div>
    </div>
  </div>

  <div class="exp-hero-right exp-reveal exp-rd3">
    <div class="mockup-bar">
      <div class="m-dot" style="background:#FF5F57"></div>
      <div class="m-dot" style="background:#FEBC2E"></div>
      <div class="m-dot" style="background:#28C840"></div>
      <span style="flex:1;text-align:center;font-size:11px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--g400)">PolicyCentral.ai — Live Dashboard</span>
    </div>
    <div class="mockup-body">
      <div class="stat-row">
        <div class="stat-chip teal"><div class="stat-chip-val">94%</div><div class="stat-chip-lbl">Read Rate</div></div>
        <div class="stat-chip ok"><div class="stat-chip-val">1,247</div><div class="stat-chip-lbl">Acknowledged</div></div>
        <div class="stat-chip grad"><div class="stat-chip-val">247</div><div class="stat-chip-lbl">Policies Live</div></div>
      </div>
      <div class="policy-item">
        <div class="pi-icon">📋</div>
        <div class="pi-name">Code of Conduct Policy v3.1</div>
        <span class="pi-badge badge-high">Live</span>
        <div class="pi-pct">96%</div>
      </div>
      <div class="policy-item">
        <div class="pi-icon">🔒</div>
        <div class="pi-name">IT Security Policy v2.0</div>
        <span class="pi-badge badge-med">Active</span>
        <div class="pi-pct">88%</div>
      </div>
      <div class="policy-item">
        <div class="pi-icon">📄</div>
        <div class="pi-name">Leave &amp; Attendance Policy</div>
        <span class="pi-badge badge-pend">Pending</span>
        <div class="pi-pct">61%</div>
      </div>
      <div class="ai-row">
        <div class="ai-row-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <div>
          <div class="ai-row-tag">PolicyGPT</div>
          <div class="ai-row-text">"Leave Policy v3.2 — 61% read. 234 employees pending. Auto-reminder sent to unread users."</div>
        </div>
      </div>
    </div>
  </div>

</section>

<!-- ══════════════════════════════════════════
     SCROLL 2 — HOW IT'S MANAGED TODAY
══════════════════════════════════════════ -->
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
      <div class="vs-pill">There is a better way →</div>
      <div class="vs-line"></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     LIFECYCLE
══════════════════════════════════════════ -->
<section class="lifecycle-section">
  <div class="lifecycle-inner">
    <div class="exp-reveal">
      <div class="exp-section-kicker">The PolicyCentral.ai Approach</div>
      <h2 class="exp-section-title">The complete policy lifecycle,<br><span class="g-text">managed in one place</span></h2>
    </div>
    <div class="steps-row exp-reveal exp-rd2">
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#0d9488,#14b8a6)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9z"/></svg></div>
        <div class="step-label">Host</div>
        <div class="step-desc">All org-wide policies in one structured library</div>
      </div>
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></div>
        <div class="step-label">Publish</div>
        <div class="step-desc">Word-style editor, rich media, maker-checker approval</div>
      </div>
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#ea580c,#f97316)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <div class="step-label">Enable AI</div>
        <div class="step-desc">Auto summaries, FAQs, translations, audio, PolicyGPT</div>
      </div>
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#2563eb,#60a5fa)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
        <div class="step-label">Share</div>
        <div class="step-desc">Target by department, location, grade — or individual</div>
      </div>
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#059669,#34d399)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2"/></svg></div>
        <div class="step-label">Access</div>
        <div class="step-desc">Web portal and white-label mobile app for employees</div>
      </div>
      <div class="step">
        <div class="step-icon" style="background:linear-gradient(135deg,#0891b2,#22d3ee)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
        <div class="step-label">Track</div>
        <div class="step-desc">Read receipts, e-signatures, responses, audit logs</div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     STICKY CARD STACK — 9 FEATURES
══════════════════════════════════════════ -->
<section class="stack-section">
  <div class="stack-top exp-reveal">
    <h2 class="exp-section-title">Everything your enterprise needs, out of the box</h2>
    <p class="exp-section-sub">Built for large organisations where policies touch thousands of employees across departments, locations, and languages.</p>
  </div>

  <div class="stack-body">
    <div class="stack-left" id="stackLeft">
      <div class="sl-num" id="slNum">01</div>
      <div class="sl-title" id="slTitle">Gen AI-Powered Policy Intelligence</div>
      <div class="sl-desc" id="slDesc">AWS Bedrock, Polly and Translate to summarise, translate, and converse with every policy in your library.</div>
      <div class="sl-pills" id="slPills">
        <span class="sl-pill">AWS Bedrock</span>
        <span class="sl-pill">Amazon Polly</span>
        <span class="sl-pill">AWS Translate</span>
      </div>
      <div class="sl-progress">
        <div class="sl-prog-row">
          <span class="sl-prog-label" id="slProgLabel">1 of 9</span>
          <a href="<?php echo esc_url(home_url('/features/')); ?>" class="sl-link">All features →</a>
        </div>
        <div class="sl-prog-track"><div class="sl-prog-fill" id="slProgFill" style="width:11.1%"></div></div>
      </div>
    </div>

    <div class="stack-cards" id="stackCards">

      <div class="sc-item" id="sci0">
        <div class="sc-card">
          <div class="sc-card-num">Feature 01 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#E0F5F7">🧠</div><h3 class="sc-card-title">Gen AI-Powered Policy Intelligence</h3></div>
          <p class="sc-card-body">AI summaries, auto-generated FAQs, infographics, audio versions in 60+ voices, and 10-language translation — all generated from your existing policy content. Plus PolicyGPT, a conversational chatbot that answers employee questions from their specific policies, not the internet.</p>
          <div class="sc-tags"><span class="sc-tag">AI Summaries</span><span class="sc-tag">PolicyGPT Chatbot</span><span class="sc-tag">10 Indian Languages</span><span class="sc-tag">Audio Policies</span><span class="sc-tag">Infographics</span></div>
          <div class="sc-aws"><span class="sc-aws-pill">Powered by</span> Amazon Bedrock · Amazon Polly · AWS Translate</div>
        </div>
      </div>

      <div class="sc-item" id="sci1">
        <div class="sc-card">
          <div class="sc-card-num">Feature 02 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#EEF2FF">✏️</div><h3 class="sc-card-title">Policy Creation &amp; Content Management</h3></div>
          <p class="sc-card-body">A familiar Word-style editor for policy creation — headings, fonts, tables, lists. Enhance with rich media: images, YouTube, GIFs, audio, private video. Upload .docx files and auto-convert to HTML. Built-in responsive PDF viewer. No restrictions on content size.</p>
          <div class="sc-tags"><span class="sc-tag">Word-Style Editor</span><span class="sc-tag">Rich Media</span><span class="sc-tag">PDF Viewer</span><span class="sc-tag">Word Upload</span><span class="sc-tag">Secure Video Hosting</span></div>
        </div>
      </div>

      <div class="sc-item" id="sci2">
        <div class="sc-card">
          <div class="sc-card-num">Feature 03 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#FEF3C7">📋</div><h3 class="sc-card-title">Publisher Controls &amp; Workflow Management</h3></div>
          <p class="sc-card-body">Maker-checker approval with single or multi-level sign-off. Version control with simultaneous publishing. Set expiry dates, resend to unread users only, edit post-publication, recall or permanently delete — with full audit trail of every action.</p>
          <div class="sc-tags"><span class="sc-tag">Maker-Checker</span><span class="sc-tag">Version Control</span><span class="sc-tag">Expiry Management</span><span class="sc-tag">Resend Unread</span><span class="sc-tag">Auto-Delete</span></div>
        </div>
      </div>

      <div class="sc-item" id="sci3">
        <div class="sc-card">
          <div class="sc-card-num">Feature 04 / 09</div>
          <div class="sc-card-head"><div class="sc-icon" style="background:#E0F5F7">🎯</div><h3 class="sc-card-title">Policy Distribution &amp; Targeting</h3></div>
          <p class="sc-card-body">Target policies by department, location, grade, and designation — synced from Active Directory or HRMS. Evergreen mode auto-shares with employees who join in future and match the criteria. Mail merge for personalised content per employee. Public access for vendors and candidates.</p>
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
          <p class="sc-card-body">Formal sign-off via AD password, Aadhaar, or digital signature tools — each with a secure timestamp in the audit trail. Custom one-click response buttons, policy-level Q&amp;A threads, employee comments, peer recommendations, and 12+ emoji reactions for sentiment tracking.</p>
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
          <p class="sc-card-body">SSO and Active Directory integration with MFA. White-label platform on your custom subdomain. Open REST API for HRMS, intranet, and ERP integration. OTP-based login for non-AD users — partners, contractors, off-payroll staff. WebView embedding for existing enterprise apps.</p>
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



<section class="cta-section" id="cta-form">
  <!-- Background decorative icons -->
  <div class="cta-bg-icons">
    <svg class="bgi-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    <svg class="bgi-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    <svg class="bgi-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
    <svg class="bgi-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
    <svg class="bgi-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <svg class="bgi-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    <svg class="bgi-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    <svg class="bgi-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
    <svg class="bgi-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    <svg class="bgi-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
    <svg class="bgi-11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
    <svg class="bgi-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
  </div>

  <div class="cta-inner exp-reveal">
    <div class="cta-header">
      <div class="cta-kicker">Ready to see it live?</div>
      <h2 class="cta-title">See PolicyCentral.ai in action</h2>
      <p class="cta-sub">Request a personalised demo for your organisation. Most teams are live within 4-6 weeks.</p>
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
            <label>Your email <span class="req">*</span></label>
            <input type="email" name="email" class="exp-form-input" placeholder="you@company.com" required>
          </div>
        </div>
        <div class="exp-form-row row-btn">
          <div class="exp-form-group">
            <label>Contact number</label>
            <input type="tel" name="phone" class="exp-form-input" placeholder="Phone number">
          </div>
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
(function(){
  // Scroll reveal — scoped to .explore-wrap .exp-reveal
  var observer = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.explore-wrap .exp-reveal').forEach(function(el){ observer.observe(el); });

  // Sticky card stack — scroll-driven left panel (works up AND down)
  var leftData = [
    { num:'01', title:'Gen AI-Powered Policy Intelligence',    desc:'AWS Bedrock, Polly and Translate — summaries, translation, audio and PolicyGPT chatbot.',   pills:['AWS Bedrock','Amazon Polly','AWS Translate'] },
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
    if(idx === lastIdx) return;
    lastIdx = idx;
    var d = leftData[idx];
    document.getElementById('slNum').textContent   = d.num;
    document.getElementById('slTitle').textContent = d.title;
    document.getElementById('slDesc').textContent  = d.desc;
    document.getElementById('slPills').innerHTML   = d.pills.map(function(p){ return '<span class="sl-pill">'+p+'</span>'; }).join('');
    document.getElementById('slProgLabel').textContent = (idx+1)+' of 9';
    document.getElementById('slProgFill').style.width  = ((idx+1)/9*100).toFixed(1)+'%';
  }

  function getActiveCard(){
    var TRIGGER = 220;
    var active = 0;
    for(var i = 0; i < 9; i++){
      var el = document.getElementById('sci'+i);
      if(!el) continue;
      var rect = el.getBoundingClientRect();
      if(rect.top <= TRIGGER){ active = i; }
    }
    return active;
  }

  function onScroll(){
    updateLeft(getActiveCard());
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // CTA form submission — same logic as homepage
  var expForm = document.getElementById('exp-contact-form');
  var expBtn  = document.getElementById('exp-btn-submit');
  var expStatus = document.getElementById('exp-form-status');

  if (expForm) {
    expForm.addEventListener('submit', function(e) {
      e.preventDefault();
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
