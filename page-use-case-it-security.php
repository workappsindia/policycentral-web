<?php
/* Template Name: Use Case - IT & Security */
get_header();
?>
<style>
/* Page-specific accent, violet/purple (security depth + sensitive data) */
:root { --accent:#6D28D9; --accent-dark:#5B21B6; --accent-light:#F5F3FF; --accent-border:rgba(109,40,217,.2); }

/* ── HERO VISUAL: Secure Knowledge Console ── */
.is-mockup{position:relative;width:100%;max-width:520px;animation:isFloat 7s ease-in-out infinite}
@keyframes isFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes isCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

.is-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.is-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:#0F172A;border-bottom:1px solid #1E293B}
.is-dots{display:flex;gap:5px}
.is-dots span{width:9px;height:9px;border-radius:50%}
.is-dots span:nth-child(1){background:#EF4444}
.is-dots span:nth-child(2){background:#F59E0B}
.is-dots span:nth-child(3){background:#22C55E}
.is-titlebar-text{font-size:11px;font-weight:700;color:#94A3B8;font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.is-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#6D28D9,#5B21B6);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}

.is-body{padding:16px}
.is-doc-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.is-doc-tag{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:5px;font-size:10px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.is-doc-restrict{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;background:rgba(225,29,72,.08);color:#BE123C;border:1px solid rgba(225,29,72,.2)}
.is-doc-restrict::before{content:"";width:6px;height:6px;border-radius:50%;background:#E11D48}
.is-doc-title{font-size:13.5px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:3px}
.is-doc-meta{font-size:10px;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:12px}

.is-section-label{font-size:9px;font-weight:800;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.1em;text-transform:uppercase;margin-bottom:8px}

.is-access{padding:10px 12px;border-radius:10px;background:linear-gradient(135deg,var(--accent-light) 0%,#FAF5FF 100%);border:1px solid var(--accent-border);margin-bottom:10px}
.is-access-row{display:flex;align-items:center;justify-content:space-between;padding:3px 0;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px}
.is-access-role{color:var(--gray-800);font-weight:700;display:flex;align-items:center;gap:6px}
.is-access-icon{width:14px;height:14px;border-radius:3px;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:9px;font-weight:800}
.is-access-count{color:var(--accent-dark);font-weight:800}

.is-events{padding:8px 0;font-family:'Plus Jakarta Sans',sans-serif}
.is-event-row{display:flex;align-items:center;gap:8px;padding:4px 0;font-size:10px}
.is-event-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0}
.is-event-dot.ok{background:#059669}
.is-event-dot.blk{background:#E11D48}
.is-event-dot.alert{background:#D97706}
.is-event-label{flex:1;font-weight:700;color:var(--gray-800)}
.is-event-count{color:var(--gray-500);font-weight:600;font-size:9.5px}

.is-float-contract{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:196px;animation:isCardIn .6s ease-out both;animation-delay:.3s}
.is-float-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.is-float-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center}
.is-float-icon svg{width:11px;height:11px;color:#fff}
.is-float-head h3{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif}
.is-contract-avatar{display:flex;align-items:center;gap:8px;padding:4px 0;font-family:'Plus Jakarta Sans',sans-serif}
.is-contract-circle{width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-size:9px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.is-contract-name{font-size:10.5px;font-weight:800;color:var(--gray-900);line-height:1.2}
.is-contract-vendor{font-size:9px;color:var(--gray-500);font-weight:600}
.is-contract-timer{margin-top:8px;padding:6px 9px;border-radius:7px;background:linear-gradient(135deg,rgba(225,29,72,.06),rgba(217,119,6,.06));border:1px solid rgba(217,119,6,.18);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;font-weight:700;color:#7C2D12;text-align:center}
.is-contract-timer strong{color:#9F1239;font-weight:800}

.is-float-audit{position:absolute;bottom:-18px;left:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:206px;animation:isCardIn .6s ease-out both;animation-delay:.55s}
.is-audit-head{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.is-audit-icon{width:22px;height:22px;border-radius:6px;background:linear-gradient(135deg,#059669,var(--accent-dark));display:flex;align-items:center;justify-content:center}
.is-audit-icon svg{width:11px;height:11px;color:#fff}
.is-audit-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:var(--gray-900)}
.is-audit-hash{font-family:'JetBrains Mono','Courier New',monospace;font-size:8.5px;color:var(--gray-500);font-weight:600;background:var(--gray-50);padding:4px 7px;border-radius:5px;border:1px solid var(--gray-100);letter-spacing:.03em;margin-bottom:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.is-audit-foot{font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600;display:flex;align-items:center;gap:6px}
.is-audit-foot svg{width:11px;height:11px;color:#059669}
.is-audit-foot strong{color:#059669;font-weight:800}

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

/* Capability 1: Role-bounded access */
.fv-isrole{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-isr-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px;display:flex;justify-content:space-between;align-items:center}
.fv-isr-doc{font-size:10px;color:var(--gray-500);font-weight:700;font-family:'Plus Jakarta Sans',sans-serif}
.fv-isr-row{display:flex;align-items:center;gap:10px;padding:8px 11px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-isr-row.on{background:linear-gradient(135deg,var(--accent-light) 0%,#FAF5FF 100%);border-color:var(--accent-border)}
.fv-isr-row.deny{background:rgba(225,29,72,.04);border-color:rgba(225,29,72,.15)}
.fv-isr-grp-icon{width:24px;height:24px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:var(--gray-200);color:var(--gray-600)}
.fv-isr-row.on .fv-isr-grp-icon{background:var(--accent);color:#fff}
.fv-isr-row.deny .fv-isr-grp-icon{background:#E11D48;color:#fff}
.fv-isr-grp-icon svg{width:11px;height:11px}
.fv-isr-grp{flex:1;min-width:0}
.fv-isr-name{font-size:11px;font-weight:800;color:var(--gray-900);line-height:1.2}
.fv-isr-meta{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-isr-tag{padding:2px 7px;border-radius:5px;font-size:8.5px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.02em}
.fv-isr-tag.allow{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.fv-isr-tag.deny{background:rgba(225,29,72,.1);color:#BE123C;border:1px solid rgba(225,29,72,.2)}

/* Capability 2: Contractor timer */
.fv-iscontract{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:18px;width:100%;max-width:360px}
.fv-isc-card{padding:12px 14px;border-radius:11px;background:linear-gradient(135deg,var(--accent-light) 0%,#FAF5FF 100%);border:1px solid var(--accent-border);margin-bottom:10px}
.fv-isc-head{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.fv-isc-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-family:'Plus Jakarta Sans',sans-serif}
.fv-isc-name{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);line-height:1.2}
.fv-isc-vendor{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-isc-window{display:flex;align-items:center;justify-content:space-between;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-600);font-weight:700;padding:6px 0;border-top:1px solid var(--accent-border)}
.fv-isc-window strong{color:var(--accent-dark);font-weight:800}
.fv-isc-bar{height:6px;border-radius:3px;background:var(--gray-100);overflow:hidden;margin:6px 0 4px}
.fv-isc-bar-fill{height:100%;width:50%;border-radius:3px;background:linear-gradient(90deg,#059669,#D97706 65%,#E11D48 95%)}
.fv-isc-foot{display:flex;justify-content:space-between;font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600}
.fv-isc-revoke{padding:8px 11px;border-radius:9px;background:rgba(225,29,72,.05);border:1px solid rgba(225,29,72,.18);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:#9F1239;font-weight:700;display:flex;align-items:center;gap:8px}
.fv-isc-revoke svg{width:13px;height:13px;color:#E11D48;flex-shrink:0}
.fv-isc-revoke strong{color:#BE123C;font-weight:800}

/* Capability 3: Doc viewer with watermark */
.fv-iswm{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-isw-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:10px;display:flex;justify-content:space-between;align-items:center}
.fv-isw-doc{font-size:10px;color:var(--gray-500);font-weight:700}
.fv-isw-viewer{position:relative;background:linear-gradient(135deg,#1E1B4B 0%,#312E81 100%);border-radius:10px;height:160px;overflow:hidden;margin-bottom:10px}
.fv-isw-viewer::before{content:"CONFIDENTIAL";position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(-25deg);color:rgba(255,255,255,.08);font-family:'Plus Jakarta Sans',sans-serif;font-size:32px;font-weight:800;letter-spacing:.1em;white-space:nowrap;pointer-events:none}
.fv-isw-watermark{position:absolute;bottom:8px;right:10px;font-family:'JetBrains Mono','Courier New',monospace;font-size:8.5px;color:rgba(255,255,255,.5);font-weight:600;text-align:right;line-height:1.4}
.fv-isw-page{position:absolute;top:12px;left:12px;display:flex;gap:6px;align-items:center}
.fv-isw-page-icon{width:18px;height:18px;border-radius:4px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;color:#fff}
.fv-isw-page-icon svg{width:9px;height:9px}
.fv-isw-page-text{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;color:rgba(255,255,255,.7);font-weight:700;letter-spacing:.05em;text-transform:uppercase}
.fv-isw-controls{display:flex;flex-direction:column;gap:5px}
.fv-isw-ctrl{display:flex;align-items:center;gap:8px;padding:6px 10px;border-radius:7px;background:var(--gray-50);border:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;color:var(--gray-700)}
.fv-isw-ctrl-icon{width:18px;height:18px;border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:rgba(225,29,72,.1);color:#BE123C}
.fv-isw-ctrl-icon svg{width:10px;height:10px}
.fv-isw-ctrl-tag{margin-left:auto;padding:1px 6px;border-radius:4px;font-size:8.5px;font-weight:800;background:rgba(225,29,72,.1);color:#BE123C;border:1px solid rgba(225,29,72,.2)}

/* Capability 4: Runbook versions */
.fv-isrun{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-isrn-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900);margin-bottom:12px;display:flex;justify-content:space-between;align-items:center}
.fv-isrn-tag{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:var(--accent-light);color:var(--accent-dark);border:1px solid var(--accent-border)}
.fv-isrn-ver{display:flex;align-items:center;gap:10px;padding:8px 11px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-isrn-ver.live{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.fv-isrn-pill{padding:2px 7px;border-radius:5px;font-family:'JetBrains Mono','Courier New',monospace;font-size:10px;font-weight:800;background:#fff;border:1px solid var(--gray-200);color:var(--gray-700);flex-shrink:0}
.fv-isrn-ver.live .fv-isrn-pill{background:#059669;border-color:#059669;color:#fff}
.fv-isrn-info{flex:1;min-width:0}
.fv-isrn-name{font-size:10.5px;font-weight:800;color:var(--gray-900);line-height:1.3}
.fv-isrn-meta{font-size:9px;color:var(--gray-500);font-weight:600;margin-top:1px}
.fv-isrn-foot{padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;color:var(--gray-500);font-weight:600;display:flex;justify-content:space-between}
.fv-isrn-foot strong{color:var(--accent-dark);font-weight:800}

/* Capability 5: Secure search */
.fv-issearch{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:360px}
.fv-iss-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.fv-iss-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-iss-deploy{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:#0F172A;color:#A78BFA;border:1px solid #1E293B;font-family:'JetBrains Mono','Courier New',monospace;letter-spacing:.02em}
.fv-iss-input{padding:8px 12px;border-radius:9px;background:var(--accent-light);border:1px solid var(--accent-border);font-family:'JetBrains Mono','Courier New',monospace;font-size:10.5px;color:var(--accent-dark);font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px}
.fv-iss-input svg{width:13px;height:13px;color:var(--accent-dark);flex-shrink:0}
.fv-iss-result{padding:9px 12px;border-radius:9px;background:var(--gray-50);border:1px solid var(--gray-100);margin-bottom:5px;font-family:'Plus Jakarta Sans',sans-serif}
.fv-iss-result-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:4px}
.fv-iss-result-name{font-size:11px;font-weight:800;color:var(--gray-900)}
.fv-iss-scope{font-size:8.5px;font-weight:800;color:var(--accent-dark);background:#fff;padding:1px 6px;border-radius:4px;border:1px solid var(--accent-border);letter-spacing:.02em}
.fv-iss-snip{font-size:9.5px;color:var(--gray-600);line-height:1.45;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif}
.fv-iss-foot{margin-top:10px;padding-top:10px;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:9.5px;color:var(--gray-500);font-weight:600;display:flex;align-items:center;gap:6px}
.fv-iss-foot svg{width:11px;height:11px;color:#059669}
.fv-iss-foot strong{color:var(--accent-dark);font-weight:800}

/* Capability 6: Audit log with hash */
.fv-isaudit{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:var(--shadow-lg);padding:16px;width:100%;max-width:380px}
.fv-isa-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.fv-isa-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:800;color:var(--gray-900)}
.fv-isa-integrity{padding:3px 8px;border-radius:5px;font-size:9px;font-weight:800;background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2);display:flex;align-items:center;gap:5px}
.fv-isa-integrity svg{width:10px;height:10px}
.fv-isa-row{display:grid;grid-template-columns:60px 1fr 80px;gap:8px;padding:8px 0;border-top:1px solid var(--gray-100);font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;align-items:center}
.fv-isa-row:first-of-type{border-top:none}
.fv-isa-time{color:var(--gray-500);font-weight:600;font-size:9.5px}
.fv-isa-action{color:var(--gray-800);font-weight:700;line-height:1.3}
.fv-isa-action strong{color:var(--gray-900);font-weight:800}
.fv-isa-hash{font-family:'JetBrains Mono','Courier New',monospace;font-size:8.5px;color:var(--accent-dark);font-weight:700;letter-spacing:.02em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:right}

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
  .is-mockup{max-width:420px;margin:0 auto}
  .is-float-contract{right:-8px;top:-8px}
  .is-float-audit{left:-8px;bottom:-10px}
  .fv-isrole,.fv-iscontract,.fv-iswm,.fv-isrun,.fv-issearch,.fv-isaudit{max-width:100%}
  .uc-vignette-card{grid-template-columns:1fr;gap:20px;padding:32px 28px}
  .uc-vignette-card::before{top:20px;bottom:20px}
}
@media(max-width:768px){.uc-sc-grid{grid-template-columns:1fr}.uc-ch-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .is-mockup{max-width:340px}
  .is-float-contract,.is-float-audit{position:relative;top:0;right:0;left:0;bottom:0;margin-top:10px;min-width:auto}
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
    <h1>Drilling data. Field plans. <br><span class="accent">Stay where they belong.</span></h1>
    <p class="subtitle">Acceptable-use policies, source-code repositories, well-survey reports, exploration data, contractor IT protocols, distributed to permanent staff, offshore crews, research analysts, and contract engineers, with screenshot protection, role-bounded access, and a tamper-evident audit trail. Built for IT, InfoSec, CISO, and Knowledge Management teams in upstream energy, defence, and critical-infrastructure organisations.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">See a live demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>">Use Cases</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">IT &amp; Security</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="is-mockup">
      <div class="is-dash">
        <div class="is-titlebar">
          <div class="is-dots"><span></span><span></span><span></span></div>
          <span class="is-titlebar-text">Secure Knowledge Console</span>
          <span class="is-titlebar-badge">&#x1F512; AIR-GAPPED</span>
        </div>
        <div class="is-body">
          <div class="is-doc-head">
            <span class="is-doc-tag">&#x1F4CA; Seismic Survey &middot; Block KG-D6</span>
            <span class="is-doc-restrict">RESTRICTED</span>
          </div>
          <div class="is-doc-title">Q2 seismic survey, North flank reservoir model</div>
          <div class="is-doc-meta">v4.2 &middot; Exploration Cell only &middot; Reviewed by SecOps Apr 18</div>

          <div class="is-section-label">Role-bounded access</div>
          <div class="is-access">
            <div class="is-access-row"><span class="is-access-role"><span class="is-access-icon">&#x2713;</span>Exploration Cell &middot; basin leads</span><span class="is-access-count">14 users</span></div>
            <div class="is-access-row"><span class="is-access-role"><span class="is-access-icon">&#x2713;</span>SecOps reviewer</span><span class="is-access-count">3 users</span></div>
            <div class="is-access-row"><span class="is-access-role"><span class="is-access-icon">&#x2713;</span>Reservoir engineers (active campaign)</span><span class="is-access-count">9 users</span></div>
          </div>

          <div class="is-section-label">Access events, last 24 hrs</div>
          <div class="is-events">
            <div class="is-event-row"><span class="is-event-dot ok"></span><span class="is-event-label">Reads, authenticated</span><span class="is-event-count">47</span></div>
            <div class="is-event-row"><span class="is-event-dot blk"></span><span class="is-event-label">Print attempts &middot; blocked</span><span class="is-event-count">3</span></div>
            <div class="is-event-row"><span class="is-event-dot alert"></span><span class="is-event-label">Screenshot &middot; blocked</span><span class="is-event-count">1</span></div>
            <div class="is-event-row"><span class="is-event-dot ok"></span><span class="is-event-label">Watermarked downloads</span><span class="is-event-count">0</span></div>
          </div>
        </div>
      </div>

      <div class="is-float-contract">
        <div class="is-float-head">
          <div class="is-float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
          <h3>Contractor expiry</h3>
        </div>
        <div class="is-contract-avatar">
          <div class="is-contract-circle">RM</div>
          <div><div class="is-contract-name">Rohit M.</div><div class="is-contract-vendor">Vendor &middot; Schlumberger</div></div>
        </div>
        <div class="is-contract-timer">Auto-revoke <strong>in 18 days</strong> &middot; engagement window closes 18 Sep 2026</div>
      </div>

      <div class="is-float-audit">
        <div class="is-audit-head">
          <div class="is-audit-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
          <span class="is-audit-title">Audit chain</span>
        </div>
        <div class="is-audit-hash">sha256: a47f...3e2c &middot; chain verified</div>
        <div class="is-audit-foot"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Hash-chain integrity <strong>OK</strong> &middot; 1,847 events</span></div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- SCENE -->
<section class="uc-scene">
<div class="container">
  <div class="uc-scene-inner reveal">
    <h2>Some documents <span class="g-text">cannot leak.</span></h2>
    <p>A seismic survey on a new offshore block. A well-test result that hasn't yet been filed with the regulator. The procurement plan for the next drilling campaign. The acceptable-use policy for an upstream IT environment. The incident-response runbook for a SCADA failure. Each one has a list of people who must read it, and a list far longer of people who must not see it, including the contract engineer who left last quarter, the consultant whose engagement ended yesterday, and the screenshot some unauthorised reader might take next week.</p>
    <p>IT &amp; Security on PolicyCentral.ai is built for organisations where the cost of a leak is measured in market reaction, in regulatory penalty, in national interest. Role-bounded distribution, screenshot and print protection, time-bounded contractor access, source-of-truth-and-only-source-of-truth, with a tamper-evident audit trail that satisfies an internal IT auditor and the CISO at the same time.</p>
  </div>
</div>
</section>

<!-- INDUSTRY VIGNETTE -->
<section class="uc-vignette">
<div class="container">
  <div class="uc-vignette-card reveal">
    <div class="uc-vignette-side">
      <span class="uc-vignette-kicker">At a national oil &amp; gas major</span>
      <h3>Permanent staff, offshore crews, vendors, consultants. One platform, role-bounded access.</h3>
    </div>
    <div class="uc-vignette-content">
      <p>A national-scale upstream energy company runs operations across onshore basins, offshore platforms, refineries, R&amp;D centres, and a corporate HQ. The workforce is unusually layered: tenured employees, three-year offshore-rotation crews, contract engineers on six-month tickets, consulting firms attached to a single drilling campaign, university research analysts collaborating on basin studies. And the documents in circulation span the operationally sensitive (well plans, seismic data, reservoir models) to the IT-critical (source code, SCADA configs, network diagrams, incident playbooks).</p>
      <p><strong>The risk surface is enormous: a contractor's laptop, an offshore satellite link, a shared drive from a previous campaign, a print-out left at a refinery canteen.</strong> The control surface has to be just as deliberate: who reads what, when, on which device, and the moment the engagement ends, what access disappears. IT &amp; Security needs a platform that handles role-bounded distribution, time-bounded contractor access, screenshot and print protection, and an audit trail no insider can rewrite.</p>
      <p>That's what IT &amp; Security on PolicyCentral.ai looks like. The same governance and acknowledgement spine that runs in regulated financial services, hardened with VAPT-tested controls, on-prem or private-cloud deployment, and per-role access boundaries down to the individual document.</p>
    </div>
  </div>
</div>
</section>

<!-- CAPABILITIES -->
<section class="uc-caps">
<div class="container">
  <div class="section-header reveal">
    <h2>Capabilities that play a critical role<br>in <span class="g-text">secure knowledge governance.</span></h2>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
      <h3>Role-bounded access, down to the document.</h3>
      <p>A seismic survey is visible to the Exploration Cell, the basin lead, and the SecOps reviewer, and nobody else. A field-test report restricted to the campaign team auto-revokes the day the campaign closes. A contractor's view-list shrinks the moment their engagement ends. The access boundary lives on the document, not in someone's spreadsheet.</p>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-cap-link">Explore Security &amp; Compliance <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-isrole">
        <div class="fv-isr-title">Seismic Survey, KG-D6 <span class="fv-isr-doc">v4.2</span></div>
        <div class="fv-isr-row on">
          <div class="fv-isr-grp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div class="fv-isr-grp"><div class="fv-isr-name">Exploration Cell</div><div class="fv-isr-meta">14 users &middot; basin leads + analysts</div></div>
          <span class="fv-isr-tag allow">ALLOW</span>
        </div>
        <div class="fv-isr-row on">
          <div class="fv-isr-grp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div class="fv-isr-grp"><div class="fv-isr-name">SecOps reviewer</div><div class="fv-isr-meta">3 users &middot; review-only access</div></div>
          <span class="fv-isr-tag allow">ALLOW</span>
        </div>
        <div class="fv-isr-row on">
          <div class="fv-isr-grp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div class="fv-isr-grp"><div class="fv-isr-name">Active campaign engineers</div><div class="fv-isr-meta">9 users &middot; auto-revoke on close</div></div>
          <span class="fv-isr-tag allow">ALLOW</span>
        </div>
        <div class="fv-isr-row deny">
          <div class="fv-isr-grp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>
          <div class="fv-isr-grp"><div class="fv-isr-name">Previous campaign team</div><div class="fv-isr-meta">22 users &middot; access expired 14 Mar</div></div>
          <span class="fv-isr-tag deny">DENY</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <h3>Time-bounded contractor &amp; consultant access.</h3>
      <p>A consulting firm onboards for a six-month engagement. Their access list is set with a start and an expiry date; on day-181, the platform revokes automatically, no email to IT, no helpdesk ticket. New consultants in the firm onboard against the parent agreement, not a sprawling individual access tree. The day the engagement ends, the access disappears, on every document, on every device.</p>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-cap-link">Explore Access Controls <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-iscontract">
        <div class="fv-isc-card">
          <div class="fv-isc-head">
            <div class="fv-isc-avatar">RM</div>
            <div><div class="fv-isc-name">Rohit Mehta</div><div class="fv-isc-vendor">Vendor: Schlumberger &middot; Reservoir Engineer</div></div>
          </div>
          <div class="fv-isc-window">
            <span>Engagement window</span>
            <strong>20 Mar &rarr; 18 Sep 2026</strong>
          </div>
          <div class="fv-isc-bar"><div class="fv-isc-bar-fill"></div></div>
          <div class="fv-isc-foot"><span>Days elapsed: 90</span><span>Days remaining: 90</span></div>
        </div>
        <div class="fv-isc-revoke">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
          <span>Auto-revoke on <strong>18 Sep 2026, 00:00 IST</strong> &middot; no IT ticket needed</span>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h3>Screenshot, print, download, all controllable.</h3>
      <p>A sensitive document opens in a hardened in-app viewer; screenshots produce a black frame, printing produces a watermarked stub with the reader's name embedded, downloads are either disabled or watermarked with a per-recipient identifier. The leak trail is built into the page, not assumed. When something does walk out, you know whose screen it walked out of.</p>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-cap-link">Explore Content Protection <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-iswm">
        <div class="fv-isw-title">Secure viewer <span class="fv-isw-doc">Well-test &middot; Block KG-D6</span></div>
        <div class="fv-isw-viewer">
          <div class="fv-isw-page">
            <div class="fv-isw-page-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
            <span class="fv-isw-page-text">Page 14 of 42</span>
          </div>
          <div class="fv-isw-watermark">R. Mehta &middot; Schlumberger<br>2026-04-22 14:38 IST</div>
        </div>
        <div class="fv-isw-controls">
          <div class="fv-isw-ctrl"><div class="fv-isw-ctrl-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></div>Screenshot<span class="fv-isw-ctrl-tag">BLOCKED</span></div>
          <div class="fv-isw-ctrl"><div class="fv-isw-ctrl-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></div>Print<span class="fv-isw-ctrl-tag">WATERMARK</span></div>
          <div class="fv-isw-ctrl"><div class="fv-isw-ctrl-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></div>Download<span class="fv-isw-ctrl-tag">OFF</span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
      <h3>Source code, SCADA configs, runbooks, versioned and governed.</h3>
      <p>IT runbooks, network diagrams, SCADA configuration files, code repositories with sensitive credentials redacted, all versioned with diffs, governed with approvals, targeted to the IT and OT teams that need them. A 3 AM incident response opens the latest runbook on the duty engineer's phone, not last quarter's archived copy.</p>
      <a href="<?php echo esc_url(home_url('/feature/publisher-controls/')); ?>" class="uc-cap-link">Explore Version Control <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-isrun">
        <div class="fv-isrn-title">SCADA failover runbook <span class="fv-isrn-tag">OT-OPS only</span></div>
        <div class="fv-isrn-ver live">
          <span class="fv-isrn-pill">v3.2</span>
          <div class="fv-isrn-info"><div class="fv-isrn-name">Updated escalation matrix + dual-PLC failover</div><div class="fv-isrn-meta">Apr 18, 2026 &middot; SecOps approved</div></div>
        </div>
        <div class="fv-isrn-ver">
          <span class="fv-isrn-pill">v3.1</span>
          <div class="fv-isrn-info"><div class="fv-isrn-name">Patched comm-link diagnostic step</div><div class="fv-isrn-meta">Feb 04 &middot; superseded, retained for audit</div></div>
        </div>
        <div class="fv-isrn-ver">
          <span class="fv-isrn-pill">v3.0</span>
          <div class="fv-isrn-info"><div class="fv-isrn-name">Refactored for new HMI architecture</div><div class="fv-isrn-meta">Dec 12, 2025 &middot; archived</div></div>
        </div>
        <div class="fv-isrn-foot"><span>Audience</span><strong>42 OT engineers &middot; offshore + onshore</strong></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>AI search, but on-perimeter.</h3>
      <p>A reservoir analyst types "porosity overlay for KG-D6 north flank" and gets the exact section from the survey report, without the query, the document, or the answer ever leaving the deployed environment. The same 4D search the rest of the platform offers, with the AI model running inside the organisation's data perimeter, on private cloud, on-prem, or air-gapped.</p>
      <a href="<?php echo esc_url(home_url('/feature/ai-intelligence/')); ?>" class="uc-cap-link">Explore Gen AI Intelligence <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-issearch">
        <div class="fv-iss-head">
          <span class="fv-iss-title">Secure Knowledge Search</span>
          <span class="fv-iss-deploy">ON-PERIMETER</span>
        </div>
        <div class="fv-iss-input">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span>porosity overlay KG-D6 north flank</span>
        </div>
        <div class="fv-iss-result">
          <div class="fv-iss-result-head"><span class="fv-iss-result-name">Seismic Survey v4.2</span><span class="fv-iss-scope">IN-FILE</span></div>
          <div class="fv-iss-snip">&hellip;north flank porosity overlay shows 14&ndash;18% variance across the upper sand unit, suggesting&hellip;</div>
        </div>
        <div class="fv-iss-result">
          <div class="fv-iss-result-head"><span class="fv-iss-result-name">Reservoir Model Notes</span><span class="fv-iss-scope">BODY</span></div>
          <div class="fv-iss-snip">&hellip;cross-referenced against the gamma-ray log, the overlay confirms the lateral pinch-out at&hellip;</div>
        </div>
        <div class="fv-iss-foot"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Query, document, answer &mdash; <strong>none left the perimeter</strong></span></div>
      </div>
    </div>
  </div>

  <div class="feat-hero feat-hero-uc feat-hero-uc-soft reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
      <h3>Tamper-evident audit trail, CISO-grade.</h3>
      <p>Every read, every access change, every share request, every contractor onboarding and offboarding, logged, hashed, timestamped, and exportable. A leak investigation starts with "who read this document in the 48 hours before the press call" and gets an answer in 30 seconds, with no possibility that an insider rewrote the log.</p>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-cap-link">Explore Tracking &amp; Reporting <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="feat-hero-visual">
      <div class="fv-isaudit">
        <div class="fv-isa-head">
          <div class="fv-isa-title">Audit chain &middot; Seismic v4.2</div>
          <span class="fv-isa-integrity"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>INTEGRITY OK</span>
        </div>
        <div class="fv-isa-row"><span class="fv-isa-time">14:38</span><span class="fv-isa-action"><strong>Read</strong> by R. Mehta (vendor)</span><span class="fv-isa-hash">a47f...3e2c</span></div>
        <div class="fv-isa-row"><span class="fv-isa-time">14:12</span><span class="fv-isa-action"><strong>Screenshot blocked</strong>, S. Iyer</span><span class="fv-isa-hash">f912...b80a</span></div>
        <div class="fv-isa-row"><span class="fv-isa-time">11:03</span><span class="fv-isa-action"><strong>Access granted</strong>, basin lead R. Singh</span><span class="fv-isa-hash">c14e...92d7</span></div>
        <div class="fv-isa-row"><span class="fv-isa-time">09:47</span><span class="fv-isa-action"><strong>Contractor offboarded</strong>, P. Kumar</span><span class="fv-isa-hash">b203...41f8</span></div>
        <div class="fv-isa-row"><span class="fv-isa-time">Apr 18</span><span class="fv-isa-action"><strong>v4.2 published</strong>, SecOps approval</span><span class="fv-isa-hash">7e3a...0c95</span></div>
      </div>
    </div>
  </div>

  <div class="uc-also">
    <p class="uc-also-intro reveal">Quieter capabilities the IT, InfoSec, and CISO teams lean on, ready on day one.</p>
    <div class="uc-also-grid">
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>SSO &amp; AD role provisioning <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Identity flows from your existing IdP; role-to-document mappings stay current as people join, change roles, and leave.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/enterprise/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
        <h3>Flexible deployment <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Private cloud, on-premise, or air-gapped. Pick the perimeter the CISO can defend, the platform runs there.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/security-compliance/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><circle cx="12" cy="11" r="2"/></svg></div>
        <h3>VAPT &amp; source code review <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Independently penetration-tested annually, with source code reviewed by external specialists. CISO sign-off ready.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd1">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        <h3>Regulatory &amp; drill calendar <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>DGH filings, environmental clearance windows, IT security drills, SCADA failover tests, all on one calendar IT can subscribe to.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/employee-portal/')); ?>" class="uc-also-card reveal rd2">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        <h3>Push notifications for incidents <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>The 3 AM SCADA alarm reaches the duty engineer's phone with the runbook one tap away. No paging through a wiki.</p>
      </a>
      <a href="<?php echo esc_url(home_url('/feature/tracking-reporting/')); ?>" class="uc-also-card reveal rd3">
        <div class="uc-also-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Per-contractor access report <svg class="uc-also-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></h3>
        <p>Every consultant, every vendor, every contract engineer: exactly what they accessed, when, and what's revoked. One click for the IT auditor.</p>
      </a>
    </div>
  </div>
</div>
</section>

<!-- WHERE IT SHOWS UP -->
<section class="uc-scenarios">
<div class="container">
  <div class="section-header reveal">
    <h2>Real moments. <span class="g-text">Real perimeter.</span></h2>
    <p>Five situations an IT, InfoSec, or CISO team faces on the upstream floor and offshore.</p>
  </div>
  <div class="uc-sc-grid">
    <div class="uc-sc reveal rd1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      <h3>A new offshore campaign launches</h3>
      <p>Sixty contractors onboard for six months across two vendor firms. Access lists set against the parent engagement; expiry dates locked at the start. The IT team doesn't touch individual accounts; the platform handles it.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Time-bounded access &rarr; Parent-engagement onboarding</div>
    </div>
    <div class="uc-sc reveal rd2">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
      <h3>A SCADA incident at 3 AM</h3>
      <p>The duty engineer's phone alerts. The failover runbook v3.2 is one tap away, in their hand, on the latest version. The 30-minute hunt through a shared drive doesn't happen; the failover does.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Push notification &rarr; Mobile runbook &rarr; Latest version</div>
    </div>
    <div class="uc-sc reveal rd3">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></div>
      <h3>A consultant's engagement ends Friday</h3>
      <p>Monday morning the consultant logs in and finds the restricted dashboard empty. No leftover access, no orphaned credentials, no helpdesk ticket. The IT team learns about it from the audit log, not the other way round.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Auto-revoke &rarr; Audit log &rarr; Zero IT touch</div>
    </div>
    <div class="uc-sc reveal rd4">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>A leak investigation kicks off</h3>
      <p>"Who read this document in the 48 hours before the press call?" The CISO pulls the access log, filters by document and time window, sees the 12 readers, the 1 blocked screenshot attempt, and the watermark ID on every download. The investigation has a starting point in 30 seconds.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Audit log &rarr; Filter &rarr; Per-recipient watermark</div>
    </div>
    <div class="uc-sc reveal rd1" style="grid-column:1/-1">
      <div class="uc-sc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <h3>The IT auditor's annual review</h3>
      <p>"Show me every contractor's access history for FY26, with start, expiry, and last-touch date." One filter, one export, every contractor across every vendor, every engagement window, every audit-chain hash that proves the record wasn't edited. The auditor finishes faster than expected; that's a good thing.</p>
      <div class="uc-sc-answer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Per-contractor report &rarr; Hash chain &rarr; Export</div>
    </div>
  </div>
</div>
</section>

<!-- WHAT CHANGES -->
<section class="uc-changes">
<div class="container">
  <div class="section-header reveal">
    <h2>From "we'll revoke when IT remembers" <br>to <span class="g-text">"revoked the day the engagement ended."</span></h2>
  </div>
  <div class="uc-ch-grid">
    <div class="uc-ch reveal rd1">
      <div class="uc-ch-num">1</div>
      <h3>Access integrity</h3>
      <p>From <strong>"the contractor's still in the AD group"</strong> to <strong>auto-revoked the day the engagement ends</strong>.</p>
    </div>
    <div class="uc-ch reveal rd2">
      <div class="uc-ch-num">2</div>
      <h3>Leak forensics</h3>
      <p>From <strong>"the audit trail is in someone's email"</strong> to <strong>tamper-evident chain, queryable in seconds</strong>.</p>
    </div>
    <div class="uc-ch reveal rd3">
      <div class="uc-ch-num">3</div>
      <h3>Field readiness</h3>
      <p>From <strong>"the runbook is on the shared drive, if you can find it"</strong> to <strong>in your hand, the moment the incident starts</strong>.</p>
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
    <h2>Ready to put your most sensitive documents <span class="g-text">under one governance spine?</span></h2>
    <p style="font-size:16px;color:var(--gray-500);margin:14px 0 28px;line-height:1.7">Bring a representative IT runbook, a sample restricted document, and a contractor onboarding scenario. In 20 minutes we'll show you the access controls, the per-recipient watermark, and what the audit chain looks like in practice.</p>
    <div class="cta-buttons" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="<?php echo esc_url(home_url('/use-cases/')); ?>" class="btn btn-outline">Explore other use cases <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>
