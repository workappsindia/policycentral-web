<?php
/* Template Name: Feature - Tracking & Reporting */
get_header();
?>
<style>
/* Page-specific accent color override */
:root { --accent:#047857; --accent-dark:#065F46; --accent-light:#ECFDF5; --accent-border:rgba(4,120,87,.15); }

/* Page-specific glow colors and hero mockup CSS */
.hsg1{width:300px;height:200px;background:rgba(4,120,87,.18);top:-40px;left:-60px}
.hsg2{width:260px;height:180px;background:rgba(6,148,162,.14);bottom:-30px;right:-50px}

/* Hero Visual Mockup - Tracking & Reporting */
.tr-mockup{position:relative;width:100%;max-width:520px;animation:trMockFloat 7s ease-in-out infinite}
@keyframes trMockFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes trCardIn{from{opacity:0;transform:translateY(10px) scale(.95)}to{opacity:1;transform:translateY(0) scale(1)}}

/* Main Dashboard Card */
.tr-dash{background:#fff;border-radius:14px;border:1px solid var(--gray-200);box-shadow:0 20px 60px rgba(0,0,0,.10),0 8px 24px rgba(0,0,0,.06);overflow:hidden;position:relative;z-index:2}
.tr-titlebar{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gray-50);border-bottom:1px solid var(--gray-100)}
.tr-dots{display:flex;gap:5px}
.tr-dots span{width:9px;height:9px;border-radius:50%}
.tr-dots span:nth-child(1){background:#EF4444}
.tr-dots span:nth-child(2){background:#F59E0B}
.tr-dots span:nth-child(3){background:#22C55E}
.tr-titlebar-text{font-size:11px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-left:4px;flex:1}
.tr-titlebar-badge{padding:3px 9px;border-radius:6px;background:linear-gradient(135deg,#047857,#059669);color:#fff;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.03em}
.tr-body{padding:14px 16px}
.tr-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:12px}
.tr-kpi{background:var(--gray-50);border-radius:8px;border:1px solid var(--gray-100);padding:8px 10px}
.tr-kpi-val{font-size:18px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;line-height:1}
.tr-kpi-lbl{font-size:8px;font-weight:600;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;margin-top:2px;line-height:1.3}
.tr-kpi.kpi-em .tr-kpi-val{color:#059669}
.tr-kpi.kpi-teal .tr-kpi-val{color:#0694A2}
.tr-kpi.kpi-am .tr-kpi-val{color:#D97706}
.tr-chart-area{background:var(--gray-50);border-radius:8px;border:1px solid var(--gray-100);padding:10px 12px;margin-bottom:10px}
.tr-chart-label{font-size:9px;font-weight:700;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.tr-bar-group{display:flex;flex-direction:column;gap:5px}
.tr-bar-row{display:flex;align-items:center;gap:7px}
.tr-bar-name{font-size:8px;font-weight:600;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;width:56px;flex-shrink:0;text-align:right}
.tr-bar-track{flex:1;height:10px;background:var(--gray-200);border-radius:5px;overflow:hidden;position:relative}
.tr-bar-fill{height:100%;border-radius:5px}
.tr-bar-fill.bf-em{background:linear-gradient(90deg,#059669,#34d399)}
.tr-bar-fill.bf-teal{background:linear-gradient(90deg,#0694A2,#2dd4bf)}
.tr-bar-fill.bf-am{background:linear-gradient(90deg,#D97706,#fbbf24)}
.tr-bar-pct{font-size:8px;font-weight:700;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif;width:26px;flex-shrink:0}
.tr-search-row{display:flex;align-items:center;gap:6px;background:var(--gray-50);border-radius:7px;border:1px solid var(--gray-100);padding:6px 9px}
.tr-search-icon{width:13px;height:13px;color:var(--gray-400);flex-shrink:0}
.tr-search-text{font-size:9px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.tr-search-chip{padding:2px 7px;border-radius:4px;background:rgba(4,120,87,.1);color:#059669;font-size:8px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid rgba(4,120,87,.2)}

/* Read Receipts Floating Card */
.tr-receipts{position:absolute;top:-14px;right:-20px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:12px 14px;min-width:158px;animation:trCardIn .6s ease-out both;animation-delay:.3s}
.tr-receipts-icon{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#059669,#047857);display:flex;align-items:center;justify-content:center;margin-bottom:8px}
.tr-receipts-icon svg{width:15px;height:15px;color:#fff}
.tr-receipts h5{font-size:11px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.tr-donut-wrap{display:flex;align-items:center;gap:10px}
.tr-donut{width:44px;height:44px;border-radius:50%;background:conic-gradient(#059669 0% 85%,#E5E7EB 85% 100%);flex-shrink:0;position:relative;display:flex;align-items:center;justify-content:center}
.tr-donut::after{content:'';position:absolute;width:28px;height:28px;background:#fff;border-radius:50%}
.tr-donut-pct{position:absolute;font-size:9px;font-weight:800;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;z-index:1}
.tr-donut-legend{display:flex;flex-direction:column;gap:3px}
.tr-donut-leg-item{display:flex;align-items:center;gap:4px;font-size:8px;font-weight:600;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif}
.tr-donut-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0}
.tr-donut-dot.d-read{background:#059669}
.tr-donut-dot.d-unread{background:#E5E7EB;border:1px solid var(--gray-300)}

/* Timeline Floating Card */
.tr-timeline{position:absolute;bottom:-18px;left:-16px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:11px 13px;min-width:172px;animation:trCardIn .6s ease-out both;animation-delay:.5s}
.tr-timeline h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:8px}
.tr-tl-chart{display:flex;align-items:flex-end;gap:4px;height:38px;margin-bottom:5px}
.tr-tl-bar{flex:1;border-radius:3px 3px 0 0;min-height:4px}
.tr-tl-bar.tl-b1{background:#059669;opacity:.3;height:40%}
.tr-tl-bar.tl-b2{background:#059669;opacity:.45;height:55%}
.tr-tl-bar.tl-b3{background:#059669;opacity:.6;height:70%}
.tr-tl-bar.tl-b4{background:#059669;opacity:.75;height:90%}
.tr-tl-bar.tl-b5{background:#059669;height:100%}
.tr-tl-bar.tl-b6{background:#0694A2;height:82%}
.tr-tl-bar.tl-b7{background:#0694A2;opacity:.7;height:60%}
.tr-tl-labels{display:flex;gap:4px}
.tr-tl-lbl{flex:1;font-size:7px;font-weight:600;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif;text-align:center}
.tr-tl-stat{font-size:9px;font-weight:700;color:var(--gray-600);font-family:'Plus Jakarta Sans',sans-serif}
.tr-tl-stat span{color:#059669}

/* Reports Floating Card */
.tr-reports{position:absolute;bottom:52px;right:-22px;z-index:3;background:#fff;border-radius:12px;border:1px solid var(--gray-200);box-shadow:0 12px 36px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);padding:10px 12px;animation:trCardIn .6s ease-out both;animation-delay:.7s}
.tr-reports h5{font-size:10px;font-weight:800;color:var(--gray-900);font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.tr-report-row{display:flex;flex-direction:column;gap:4px}
.tr-report-item{display:flex;align-items:center;gap:7px;padding:4px 7px;border-radius:6px;background:var(--gray-50);border:1px solid var(--gray-100)}
.tr-report-icon{width:20px;height:20px;border-radius:5px;flex-shrink:0;display:flex;align-items:center;justify-content:center}
.tr-report-icon svg{width:11px;height:11px;color:#fff}
.tr-report-icon.ri-pdf{background:linear-gradient(135deg,#EF4444,#f87171)}
.tr-report-icon.ri-xls{background:linear-gradient(135deg,#059669,#34d399)}
.tr-report-icon.ri-csv{background:linear-gradient(135deg,#0694A2,#2dd4bf)}
.tr-report-name{font-size:9px;font-weight:700;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.tr-report-type{font-size:8px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}

/* ── Read Receipts Mockup ── */
.tr-feat-receipts{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.tr-feat-receipts-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#059669,#047857);color:#fff}
.tr-feat-receipts-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.tr-feat-receipts-head-icon svg{width:14px;height:14px;color:#fff}
.tr-feat-receipts-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.tr-feat-receipts-head-badge{padding:3px 8px;border-radius:6px;background:rgba(255,255,255,.2);font-size:9px;font-weight:800;letter-spacing:.03em;font-family:'Plus Jakarta Sans',sans-serif}
.tr-feat-receipts-body{padding:14px 16px}
.tr-feat-receipt-label{font-size:9px;font-weight:700;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:7px;display:flex;align-items:center;gap:4px}
.tr-feat-receipt-label svg{width:10px;height:10px}
.tr-feat-emp-row{display:flex;align-items:center;gap:8px;padding:6px 8px;border-radius:8px;margin-bottom:4px;border:1px solid var(--gray-100)}
.tr-feat-emp-avatar{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;color:#fff;flex-shrink:0}
.tr-feat-emp-name{font-size:10px;font-weight:700;color:var(--gray-800);font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.tr-feat-emp-time{font-size:9px;color:var(--gray-400);font-family:'Plus Jakarta Sans',sans-serif}
.tr-feat-emp-status{padding:2px 7px;border-radius:5px;font-size:8px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif}
.tr-feat-emp-read{background:rgba(5,150,105,.1);color:#059669;border:1px solid rgba(5,150,105,.2)}
.tr-feat-emp-unread{background:rgba(225,29,72,.08);color:#E11D48;border:1px solid rgba(225,29,72,.2)}

/* ── Comprehensive Report Mockup ── */
.tr-feat-report{background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:0 16px 48px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.04);overflow:hidden;width:100%;max-width:400px}
.tr-feat-report-head{display:flex;align-items:center;gap:8px;padding:12px 16px;background:linear-gradient(135deg,#4338CA,#6366F1);color:#fff}
.tr-feat-report-head-icon{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.tr-feat-report-head-icon svg{width:14px;height:14px;color:#fff}
.tr-feat-report-head span{font-size:12px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;flex:1}
.tr-feat-report-body{padding:14px 16px}
.tr-feat-report-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:6px;margin-bottom:12px}
.tr-feat-report-stat{background:var(--gray-50);border:1px solid var(--gray-100);border-radius:8px;padding:7px;text-align:center}
.tr-feat-report-stat-num{font-size:16px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;color:#4338CA}
.tr-feat-report-stat-label{font-size:8px;font-weight:600;color:var(--gray-500);font-family:'Plus Jakarta Sans',sans-serif;margin-top:1px}
.tr-feat-chart-label{font-size:9px;font-weight:700;color:#4338CA;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:6px}
.tr-feat-chart-bars{display:flex;align-items:flex-end;gap:5px;height:44px;margin-bottom:10px}
.tr-feat-chart-bar{flex:1;border-radius:3px 3px 0 0;background:linear-gradient(180deg,#6366F1,#4338CA)}
.tr-feat-chart-bar-sm{opacity:.4}
.tr-feat-donut-row{display:flex;align-items:center;gap:16px;margin-bottom:14px}
.tr-feat-donut{width:68px;height:68px;border-radius:50%;background:conic-gradient(#059669 0% 68%,#E5E7EB 68% 100%);display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative}
.tr-feat-donut::after{content:'';position:absolute;width:46px;height:46px;border-radius:50%;background:#fff}
.tr-feat-donut-label{position:absolute;font-size:12px;font-weight:800;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;z-index:1}
.tr-feat-donut-legend{flex:1}
.tr-feat-donut-legend-item{display:flex;align-items:center;gap:6px;margin-bottom:4px}
.tr-feat-donut-legend-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.tr-feat-donut-legend-text{font-size:11px;font-weight:600;color:var(--gray-700);font-family:'Plus Jakarta Sans',sans-serif}
.tr-feat-export-row{display:flex;gap:5px}
.tr-feat-export-btn{display:flex;align-items:center;gap:4px;padding:5px 9px;border-radius:7px;font-size:9px;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif;cursor:default;border:1px solid}
.tr-feat-export-btn svg{width:10px;height:10px}
.tr-feat-export-pdf{background:rgba(225,29,72,.08);color:#E11D48;border-color:rgba(225,29,72,.2)}
.tr-feat-export-xlsx{background:rgba(5,150,105,.08);color:#059669;border-color:rgba(5,150,105,.2)}
.tr-feat-export-csv{background:rgba(99,102,241,.08);color:#4338CA;border-color:rgba(99,102,241,.2)}
.tr-feat-receipts,.tr-feat-report{max-width:100%}
</style>


<!-- HERO -->
<section class="fpage-hero">
<div class="fpage-hero-mesh"></div>
<div class="hero-grid container">
  <div class="hero-content reveal">
    <h1>Tracking, Analytics<br>&amp; <span class="accent">Reporting</span></h1>
    <p class="subtitle">Comprehensive tracking and reporting to monitor policy engagement, compliance, and employee responses across every level of the organization.</p>
    <div class="hero-btns">
      <a href="https://cdn.prod.website-files.com/68efc4b526c2e63e771e121e/68f20c9b61c79f027f17c460_794813c088428a5b000f3ae90bcb8edd_PolicyCenter.co.pdf" target="_blank" class="btn btn-primary" style="padding:14px 28px;font-size:14px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary" style="padding:14px 28px;font-size:14px;">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost" style="padding:14px 28px;font-size:14px;">Mobile Demo</a>
    </div>
    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url(home_url('/features/')); ?>">Features</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      <span style="color:var(--accent)">Tracking &amp; Reporting</span>
    </div>
  </div>
  <div class="hero-screenshot-wrap reveal rd2">
    <div class="hero-ss-glow hsg1"></div>
    <div class="hero-ss-glow hsg2"></div>
    <div class="tr-mockup">
      <!-- Main Analytics Dashboard Card -->
      <div class="tr-dash">
        <div class="tr-titlebar">
          <div class="tr-dots"><span></span><span></span><span></span></div>
          <span class="tr-titlebar-text">PolicyCentral.ai</span>
          <span class="tr-titlebar-badge">Analytics Dashboard</span>
        </div>
        <div class="tr-body">
          <!-- KPI Row -->
          <div class="tr-kpi-row">
            <div class="tr-kpi kpi-em">
              <div class="tr-kpi-val">94%</div>
              <div class="tr-kpi-lbl">Acknowledged</div>
            </div>
            <div class="tr-kpi kpi-teal">
              <div class="tr-kpi-val">1,247</div>
              <div class="tr-kpi-lbl">Policies Read</div>
            </div>
            <div class="tr-kpi kpi-am">
              <div class="tr-kpi-val">38</div>
              <div class="tr-kpi-lbl">Pending</div>
            </div>
          </div>
          <!-- Bar Chart -->
          <div class="tr-chart-area">
            <div class="tr-chart-label">Policy Engagement by Department</div>
            <div class="tr-bar-group">
              <div class="tr-bar-row">
                <span class="tr-bar-name">Compliance</span>
                <div class="tr-bar-track"><div class="tr-bar-fill bf-em" style="width:97%"></div></div>
                <span class="tr-bar-pct">97%</span>
              </div>
              <div class="tr-bar-row">
                <span class="tr-bar-name">HR</span>
                <div class="tr-bar-track"><div class="tr-bar-fill bf-teal" style="width:91%"></div></div>
                <span class="tr-bar-pct">91%</span>
              </div>
              <div class="tr-bar-row">
                <span class="tr-bar-name">Operations</span>
                <div class="tr-bar-track"><div class="tr-bar-fill bf-am" style="width:78%"></div></div>
                <span class="tr-bar-pct">78%</span>
              </div>
            </div>
          </div>
          <!-- Search Analytics -->
          <div class="tr-search-row">
            <svg class="tr-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <span class="tr-search-text">Search analytics: "leave policy"</span>
            <span class="tr-search-chip">847 searches</span>
          </div>
        </div>
      </div>

      <!-- Floating Card: Read Receipts with Donut -->
      <div class="tr-receipts">
        <div class="tr-receipts-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h5>Read Receipts</h5>
        <div class="tr-donut-wrap">
          <div class="tr-donut">
            <span class="tr-donut-pct">85%</span>
          </div>
          <div class="tr-donut-legend">
            <div class="tr-donut-leg-item"><div class="tr-donut-dot d-read"></div>Read (85%)</div>
            <div class="tr-donut-leg-item"><div class="tr-donut-dot d-unread"></div>Unread (15%)</div>
          </div>
        </div>
      </div>

      <!-- Floating Card: Timeline -->
      <div class="tr-timeline">
        <h5>Engagement Timeline</h5>
        <div class="tr-tl-chart">
          <div class="tr-tl-bar tl-b1"></div>
          <div class="tr-tl-bar tl-b2"></div>
          <div class="tr-tl-bar tl-b3"></div>
          <div class="tr-tl-bar tl-b4"></div>
          <div class="tr-tl-bar tl-b5"></div>
          <div class="tr-tl-bar tl-b6"></div>
          <div class="tr-tl-bar tl-b7"></div>
        </div>
        <div class="tr-tl-labels">
          <span class="tr-tl-lbl">Mon</span>
          <span class="tr-tl-lbl">Tue</span>
          <span class="tr-tl-lbl">Wed</span>
          <span class="tr-tl-lbl">Thu</span>
          <span class="tr-tl-lbl">Fri</span>
          <span class="tr-tl-lbl">Sat</span>
          <span class="tr-tl-lbl">Sun</span>
        </div>
        <div class="tr-tl-stat">Peak day: <span>Friday +62%</span></div>
      </div>

      <!-- Floating Card: Export Reports -->
      <div class="tr-reports">
        <h5>Export Reports</h5>
        <div class="tr-report-row">
          <div class="tr-report-item">
            <div class="tr-report-icon ri-pdf">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div>
              <div class="tr-report-name">Compliance Report</div>
              <div class="tr-report-type">PDF Export</div>
            </div>
          </div>
          <div class="tr-report-item">
            <div class="tr-report-icon ri-xls">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            </div>
            <div>
              <div class="tr-report-name">Employee Report</div>
              <div class="tr-report-type">Excel Export</div>
            </div>
          </div>
          <div class="tr-report-item">
            <div class="tr-report-icon ri-csv">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div>
              <div class="tr-report-name">Analytics Data</div>
              <div class="tr-report-type">CSV Export</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


<!-- FEATURES GRID -->
<section class="features-section">
<div class="container">
  <div class="section-header reveal">
    <h2>Visibility Into Every <span style="color:var(--accent)">Engagement Metric</span></h2>
    <p>From read receipts to search analytics, track how employees interact with policies at every touchpoint.</p>
  </div>

  <!-- ═══ HERO BLOCK 1: Policy-Level Read Receipts (emerald) ═══ -->
  <div class="feat-hero feat-hero-emerald reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <h3>Policy-Level Read Receipts</h3>
      <p>Track exactly who read each policy, when they read it, and how many times. Get per-employee granularity on every published document. A live donut chart shows read vs. unread at a glance, so compliance managers always know where they stand.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Per-Employee · Real-Time</span>
    </div>
    <div class="feat-hero-visual">
      <div class="tr-feat-receipts">
        <div class="tr-feat-receipts-head">
          <div class="tr-feat-receipts-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
          <span>Leave Policy - Read Receipts</span>
          <span class="tr-feat-receipts-head-badge">68% Read</span>
        </div>
        <div class="tr-feat-receipts-body">
          <div class="tr-feat-donut-row">
            <div class="tr-feat-donut" style="position:relative">
              <div class="tr-feat-donut-label">68%</div>
            </div>
            <div class="tr-feat-donut-legend">
              <div class="tr-feat-donut-legend-item">
                <div class="tr-feat-donut-legend-dot" style="background:#059669"></div>
                <div class="tr-feat-donut-legend-text">Read - 136 employees</div>
              </div>
              <div class="tr-feat-donut-legend-item">
                <div class="tr-feat-donut-legend-dot" style="background:#E5E7EB"></div>
                <div class="tr-feat-donut-legend-text">Unread - 64 employees</div>
              </div>
            </div>
          </div>
          <div class="tr-feat-receipt-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Recent Activity
          </div>
          <div class="tr-feat-emp-row">
            <div class="tr-feat-emp-avatar" style="background:linear-gradient(135deg,#059669,#047857)">PS</div>
            <div class="tr-feat-emp-name">Priya Sharma</div>
            <div class="tr-feat-emp-time">2m ago</div>
            <div class="tr-feat-emp-status tr-feat-emp-read">Read</div>
          </div>
          <div class="tr-feat-emp-row">
            <div class="tr-feat-emp-avatar" style="background:linear-gradient(135deg,#4338CA,#6366F1)">RK</div>
            <div class="tr-feat-emp-name">Rahul Kumar</div>
            <div class="tr-feat-emp-time">8m ago</div>
            <div class="tr-feat-emp-status tr-feat-emp-read">Read</div>
          </div>
          <div class="tr-feat-emp-row">
            <div class="tr-feat-emp-avatar" style="background:linear-gradient(135deg,#D97706,#B45309)">AM</div>
            <div class="tr-feat-emp-name">Anjali Mehta</div>
            <div class="tr-feat-emp-time">-</div>
            <div class="tr-feat-emp-status tr-feat-emp-unread">Unread</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 4-CARD GRID: Reports & Analytics ═══ -->
  <div class="features-grid four-col" style="margin-bottom:40px">
    <div class="feature-card fc-teal reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
      <h3>Individual Employee Policy Report</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> Per Employee</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> Compliance</span>
      </div>
      <p>View all policies shared with a specific employee along with their read/unread status. Perfect for onboarding audits, compliance checks, and performance reviews.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> Employee View</span>
    </div>
    <div class="feature-card fc-amber reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
      <h3>Summary Report</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Trends</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> Over Time</span>
      </div>
      <p>Visualize how read receipts evolve over time with trend analysis. Identify engagement patterns, spot declining readership, and measure the impact of campaigns.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Trend Analysis</span>
    </div>
    <div class="feature-card fc-rose reveal rd3">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
      <h3>Policy Search Analytics</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Keywords</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Monthly</span>
      </div>
      <p>Monthly keyword search reports reveal what employees are looking for most. Identify communication gaps, unmet information needs, and improve policy discoverability.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Gap Analysis</span>
    </div>
    <div class="feature-card fc-violet reveal rd4">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h3>Employee Response Report</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> Responses</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg> By Dept</span>
      </div>
      <p>Monitor how many employees responded to policy-level actions, track participation rates across departments, and identify teams that need additional follow-up.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg> Participation</span>
    </div>
  </div>

  <!-- ═══ HERO BLOCK 2: All Policy Report (indigo, reversed) ═══ -->
  <div class="feat-hero feat-hero-indigo reversed reveal">
    <div class="feat-hero-content">
      <div class="feat-hero-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
      <h3>All Policy Report</h3>
      <p>A unified dashboard showing all published policies with complete engagement metrics: reads, acknowledgements, responses, reactions, comments, and questions per policy. Export to PDF, Excel, or CSV with a single click for audit-ready reporting.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg> PDF · Excel · CSV Export</span>
    </div>
    <div class="feat-hero-visual">
      <div class="tr-feat-report">
        <div class="tr-feat-report-head">
          <div class="tr-feat-report-head-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
          <span>All Policy Report</span>
        </div>
        <div class="tr-feat-report-body">
          <div class="tr-feat-report-stats">
            <div class="tr-feat-report-stat">
              <div class="tr-feat-report-stat-num">48</div>
              <div class="tr-feat-report-stat-label">Policies</div>
            </div>
            <div class="tr-feat-report-stat">
              <div class="tr-feat-report-stat-num" style="color:#059669">74%</div>
              <div class="tr-feat-report-stat-label">Read Rate</div>
            </div>
            <div class="tr-feat-report-stat">
              <div class="tr-feat-report-stat-num" style="color:#D97706">12</div>
              <div class="tr-feat-report-stat-label">Pending Sign</div>
            </div>
          </div>
          <div class="tr-feat-chart-label">Reads over last 7 days</div>
          <div class="tr-feat-chart-bars">
            <div class="tr-feat-chart-bar tr-feat-chart-bar-sm" style="height:55%"></div>
            <div class="tr-feat-chart-bar" style="height:70%"></div>
            <div class="tr-feat-chart-bar tr-feat-chart-bar-sm" style="height:45%"></div>
            <div class="tr-feat-chart-bar" style="height:85%"></div>
            <div class="tr-feat-chart-bar tr-feat-chart-bar-sm" style="height:60%"></div>
            <div class="tr-feat-chart-bar" style="height:95%"></div>
            <div class="tr-feat-chart-bar" style="height:78%"></div>
          </div>
          <div class="tr-feat-export-row">
            <div class="tr-feat-export-btn tr-feat-export-pdf">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
              PDF
            </div>
            <div class="tr-feat-export-btn tr-feat-export-xlsx">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
              Excel
            </div>
            <div class="tr-feat-export-btn tr-feat-export-csv">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/></svg>
              CSV
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ 2-CARD GRID: Questions & Comments ═══ -->
  <div class="features-grid">
    <div class="feature-card fc-emerald reveal rd1">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="12" y1="8" x2="12" y2="8.01" stroke-width="3"/><line x1="12" y1="12" x2="12" y2="14"/></svg></div>
      <h3>Employee Questions Report</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> Per Policy</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/></svg> Searchable</span>
      </div>
      <p>Consolidate all employee questions submitted per policy into a single report. Quickly identify areas of confusion and address them proactively with clarifications or policy updates.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> Clarity Insights</span>
    </div>
    <div class="feature-card fc-indigo reveal rd2">
      <div class="feature-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
      <h3>Employee Comments Report</h3>
      <div class="fc-mini-visual">
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7"/></svg> All Policies</span>
        <span class="fc-mini-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg> Sentiment</span>
      </div>
      <p>Aggregate all employee comments across policies for complete visibility. Surface feedback trends, common concerns, and sentiment to drive continuous improvement in policy communication.</p>
      <span class="feature-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7"/></svg> Feedback Loop</span>
    </div>
  </div>

</div>
</section>

<!-- CTA -->
<section class="cta-section">
<div class="container">
  <div class="cta-inner reveal">
    <h2>Ready to Track Policy<br><span style="color:var(--accent)">Engagement</span>?</h2>
    <p>See how real-time analytics and comprehensive reporting can transform your compliance monitoring.</p>
    <div class="cta-buttons">
      <a href="https://cdn.prod.website-files.com/68efc4b526c2e63e771e121e/68f20c9b61c79f027f17c460_794813c088428a5b000f3ae90bcb8edd_PolicyCenter.co.pdf" target="_blank" class="btn btn-primary" style="padding:14px 28px;font-size:14px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="<?php echo esc_url(home_url('/features/')); ?>" class="btn btn-outline">View All Features <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<!-- PRODUCT DEMO -->
<section class="demo-section">
<div class="container">
  <div class="section-header reveal">
    <span class="eyebrow">Product Demo</span>
    <h2>Watch PolicyCentral.ai in action</h2>
  </div>
  <div class="demo-frame reveal" onclick="this.innerHTML='<iframe src=\'https://www.youtube.com/embed/VhS97FE4UX0?autoplay=1\' style=\'width:100%;height:100%;border:none;position:absolute;inset:0\' allow=\'autoplay;fullscreen\' allowfullscreen></iframe>';this.style.cursor='default';this.onclick=null">
    <div class="demo-grid"></div>
    <div class="demo-glow dg1"></div>
    <div class="demo-glow dg2"></div>
    <div class="demo-center">
      <div class="play-btn"><svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
      <span class="demo-lbl">Click to play · Product Demo</span>
    </div>
  </div>
  <div class="demo-btns reveal">
    <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-primary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-secondary">Mobile Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
  </div>
</div>
</section>


<!-- CUSTOMERS -->
<section class="customers-bar">
<div class="container">
  <div class="cust-inner">
    <span class="cust-label">Live Customers</span>
    <div class="cust-logos">
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/HDFC-Life-Logo.png" alt="HDFC Life"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/Kotak Mahindra Bank logo.png" alt="Kotak Mahindra Bank"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/arohan.png" alt="Arohan Financial Services"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/SBI Life Insurance.png" alt="SBI Life Insurance"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/LTFS.png" alt="L&T Financial Services"></div>
      <div class="cchip"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client-logos/reliance-nippon-life-insurance-logo.png" alt="Reliance Nippon Life Insurance"></div>
    </div>
  </div>
</div>
</section>

<!-- OTHER FEATURES -->
<section class="other-features">
<div class="container">
  <div class="section-header reveal">
    <h2>Other <span style="color:var(--accent)">Features</span></h2>
  </div>
  <div class="other-grid">
    <a href="<?php echo esc_url(home_url('/features/ai-intelligence/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
      <h4>AI-Powered Policy Intelligence</h4>
      <p>Smart search, summaries, chatbot</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/content-management/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div>
      <h4>Policy Creation &amp; Content Management</h4>
      <p>Author, version, organize policies</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/publisher-controls/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
      <h4>Publisher Controls &amp; Workflow</h4>
      <p>Approvals, publishing, workflows</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/distribution-targeting/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div>
      <h4>Policy Distribution &amp; Targeting</h4>
      <p>Target audiences, push notifications</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/employee-portal/')); ?>" class="other-card reveal rd1">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div>
      <h4>Employee Portal &amp; Mobile</h4>
      <p>Mobile app, multi-language access</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/employee-interaction/')); ?>" class="other-card reveal rd2">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
      <h4>Employee Interaction &amp; Acknowledgement</h4>
      <p>Read receipts, e-sign, quizzes</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/enterprise/')); ?>" class="other-card reveal rd3">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      <h4>Enterprise Features</h4>
      <p>AD, SSO, white-label, multi-entity</p>
    </a>
    <a href="<?php echo esc_url(home_url('/features/security-compliance/')); ?>" class="other-card reveal rd4">
      <div class="other-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
      <h4>Banking-Grade Security &amp; Compliance</h4>
      <p>Encryption, RBAC, audit logs</p>
    </a>
  </div>
</div>
</section>

<!-- FOOTER -->

<?php get_footer(); ?>
