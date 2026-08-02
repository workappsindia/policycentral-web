<?php
/**
 * Template Name: Policy Template Showcase
 *
 * PROTOTYPE — a single "PolicyCentral.ai Policy Template" page (KYC & CDD)
 * to review the design before building the full /policies/ library.
 * Reuses the blog hero + CTA components (blog-style.css) for a native look.
 * Body + FAQ HTML are bundled under assets/policy-templates/kyc-cdd-policy/.
 */
defined('ABSPATH') || exit;

$tpl_dir   = get_template_directory() . '/assets/policy-templates/kyc-cdd-policy';
$body_html = file_exists("$tpl_dir/body.html") ? file_get_contents("$tpl_dir/body.html") : '';
$faq_html  = file_exists("$tpl_dir/faq.html")  ? file_get_contents("$tpl_dir/faq.html")  : '';
$hero_svg  = get_template_directory_uri() . '/assets/policy-templates/hero-kyc-cdd.svg';

$toc = array(
  'sec-policy-statement' => 'Policy Statement',
  'sec-objective' => 'Objective',
  'sec-regulatory-framework' => 'Regulatory Framework',
  'sec-scope-and-applicability' => 'Scope & Applicability',
  'sec-kyc-components' => 'KYC Components',
  'sec-risk-categorization' => 'Risk Categorization',
  'sec-customer-identification-procedure-cip' => 'Customer Identification (CIP)',
  'sec-ongoing-monitoring' => 'Ongoing Monitoring',
  'sec-record-keeping' => 'Record Keeping',
  'sec-employee-training-awareness' => 'Employee Training',
  'sec-non-compliance-penalties' => 'Non-Compliance & Penalties',
  'sec-policy-review' => 'Policy Review',
);

// Middle CTA (blog pcb-cta-mid component, policy-template copy) injected after the 3rd section.
$mid_cta = '
<div class="pcb-cta-mid" role="complementary">
  <div class="pcb-cta-mid-inner">
    <div class="pcb-cta-mid-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
    <div class="pcb-cta-mid-body">
      <div class="pcb-cta-mid-eyebrow">See it in action</div>
      <h3 class="pcb-cta-mid-title">Turn this template into a <span class="g-text">living policy</span></h3>
      <p class="pcb-cta-mid-sub">Book a 20-minute demo to see how PolicyCentral.ai distributes, translates, and tracks acknowledgement of policies like this across your entire workforce.</p>
      <a href="' . esc_url(home_url('/contact/')) . '" class="btn btn-primary pcb-cta-mid-btn">Book a Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>';

// Inject the mid CTA after the 3rd </section>
$parts = explode('</section>', $body_html);
if (count($parts) > 4) {
    $body_with_cta = implode('</section>', array_slice($parts, 0, 3)) . '</section>' . $mid_cta . implode('</section>', array_slice($parts, 3));
} else {
    $body_with_cta = $body_html;
}

get_header();
?>
<style>
/* ============ Policy Template page (.pt-*) ============ */
.pt-hero-byline{font-size:17px;line-height:1.6;color:var(--gray-600);max-width:560px;margin:14px 0 22px}
.pt-hero-btns{display:flex;flex-wrap:wrap;gap:12px}
.pcb-post-hero-figure .pt-hero-img{width:100%;max-width:520px;height:auto}

.pt-wrap{background:var(--gray-50);padding:44px 0 0}
.pt-body{max-width:1180px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 330px;gap:52px;align-items:start}
.pt-main{min-width:0}

/* Document sections */
.pt-doc .pt-sec{margin-bottom:30px;scroll-margin-top:calc(var(--nav-h) + 28px)}
.pt-doc h2{font-size:22px;font-weight:800;color:var(--gray-900);margin:0 0 12px;padding-bottom:10px;border-bottom:2px solid var(--tealline);font-family:'Plus Jakarta Sans',sans-serif}
.pt-doc p{font-size:16px;line-height:1.75;color:var(--gray-600);margin:0 0 12px}
.pt-doc ul{margin:0 0 12px;padding-left:0;list-style:none}
.pt-doc ul li{position:relative;padding-left:22px;font-size:16px;line-height:1.7;color:var(--gray-600);margin-bottom:8px}
.pt-doc ul li::before{content:'';position:absolute;left:2px;top:11px;width:6px;height:6px;border-radius:50%;background:var(--teal)}

/* Related (above FAQ) */
.pt-related{margin-top:48px}
.pt-related h2{font-size:22px;font-weight:800;margin-bottom:18px;font-family:'Plus Jakarta Sans',sans-serif}
.pt-rel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.pt-rel{display:block;background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-lg);padding:18px;transition:all .2s}
.pt-rel:hover{border-color:var(--teal);transform:translateY(-2px);box-shadow:var(--shadow-md)}
.pt-rel .k{font-size:10.5px;letter-spacing:.08em;text-transform:uppercase;color:var(--teal);font-weight:700}
.pt-rel .t{font-family:'Plus Jakarta Sans',sans-serif;font-size:15.5px;font-weight:700;color:var(--gray-800);margin:8px 0 6px;line-height:1.3}
.pt-rel .d{font-size:13px;color:var(--gray-500);line-height:1.55}

/* FAQ (below related) */
.pt-faqs{margin-top:48px}
.pt-faqs>h2{font-size:22px;font-weight:800;color:var(--gray-900);margin-bottom:18px;font-family:'Plus Jakarta Sans',sans-serif}
.pt-faq{background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-md);margin-bottom:10px;overflow:hidden}
.pt-faq summary{list-style:none;cursor:pointer;padding:16px 20px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:15.5px;color:var(--gray-800);display:flex;justify-content:space-between;align-items:center;gap:14px}
.pt-faq summary::-webkit-details-marker{display:none}
.pt-faq summary::after{content:'+';font-size:22px;color:var(--teal);font-weight:400;flex:none}
.pt-faq[open] summary::after{content:'\2013'}
.pt-faq[open] summary{border-bottom:1px solid var(--gray-100)}
.pt-faq-a{padding:14px 20px 18px}
.pt-faq-a p{font-size:15px;line-height:1.7;color:var(--gray-600);margin:0}

/* Sidebar */
.pt-side{position:sticky;top:calc(var(--nav-h) + 24px);display:flex;flex-direction:column;gap:18px}

/* Personalize + download (lead capture) */
.pt-form-card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-lg);padding:22px;box-shadow:var(--shadow-sm)}
.pt-form-card .pt-fc-icon{width:40px;height:40px;border-radius:11px;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;color:var(--teal);margin-bottom:12px}
.pt-form-card h4{font-family:'Plus Jakarta Sans',sans-serif;font-size:17px;font-weight:800;color:var(--gray-900);line-height:1.25;margin-bottom:6px}
.pt-form-card p{font-size:13px;line-height:1.55;color:var(--gray-500);margin-bottom:16px}
.pt-form-card input{width:100%;padding:11px 13px;margin-bottom:9px;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:'Manrope',sans-serif;font-size:14px;color:var(--gray-800)}
.pt-form-card input:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px var(--tealfaint)}
.pt-form-card .btn{width:100%;justify-content:center;margin-top:4px}
.pt-fc-note{display:block;font-size:11.5px;color:var(--gray-400);margin-top:10px;text-align:center}
.pt-proto-flag{display:block;margin-top:8px;font-size:10.5px;color:var(--gray-300);text-align:center}

/* TOC */
.pt-toc{background:#fff;border:1px solid var(--gray-200);border-radius:var(--r-lg);padding:20px}
.pt-toc h4{font-size:11.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);margin-bottom:12px}
.pt-toc a{display:block;font-size:13.5px;color:var(--gray-500);padding:5px 0 5px 12px;border-left:2px solid var(--gray-200);line-height:1.4}
.pt-toc a:hover,.pt-toc a.on{color:var(--teal);border-left-color:var(--teal)}

/* Bottom CTA band */
.pt-band{background:var(--gray-900);color:#fff;padding:56px 24px;text-align:center;margin-top:64px}
.pt-band h2{font-size:28px;font-weight:800;max-width:640px;margin:0 auto 12px;font-family:'Plus Jakarta Sans',sans-serif}
.pt-band p{color:var(--gray-400);max-width:560px;margin:0 auto 26px;font-size:16px;line-height:1.6}
.pt-band .hero-btns{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}

@media(max-width:900px){
  .pt-body{grid-template-columns:1fr;gap:28px}
  .pt-side{position:static;order:-1}
  .pt-rel-grid{grid-template-columns:1fr}
}
</style>

<!-- HERO (blog hero pattern: title/byline + 4 CTAs left, image right) -->
<section class="pcb-post-hero has-gradient has-side-image">
  <div class="pcb-post-hero-gradient" aria-hidden="true">
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--1"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--2"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--3"></div>
  </div>
  <div class="container">
    <div class="pcb-post-hero-inner">
      <div class="pcb-post-hero-text">
        <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/')); ?>">Resources</a>
          <span aria-hidden="true">/</span>
          <a href="#">Policy Templates</a>
          <span aria-hidden="true">/</span>
          <a href="#">Financial Crime &amp; KYC/AML</a>
          <span aria-hidden="true">/</span>
          <span aria-current="page">KYC &amp; CDD Policy Template</span>
        </nav>
        <h1 class="pcb-post-title">KYC &amp; Customer Due Diligence (CDD) Policy Template</h1>
        <p class="pt-hero-byline">A ready-to-adapt KYC &amp; CDD policy aligned to the RBI Master Directions and the PMLA, 2002.</p>
        <div class="hero-btns pt-hero-btns">
          <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
          <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
          <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
          <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
        </div>
      </div>
      <div class="pcb-post-hero-figure">
        <img src="<?php echo esc_url($hero_svg); ?>" alt="Policy template" class="pt-hero-img" loading="eager">
      </div>
    </div>
  </div>
</section>

<div class="pt-wrap">
  <div class="pt-body">
    <main class="pt-main">
      <div class="pt-doc"><?php echo $body_with_cta; // bundled, pre-escaped ?></div>

      <!-- Related (above FAQ) -->
      <section class="pt-related">
        <h2>Related policy templates</h2>
        <div class="pt-rel-grid">
          <a class="pt-rel" href="#"><div class="k">Financial Crime</div><div class="t">Anti-Money Laundering (AML) Policy</div><div class="d">PMLA-aligned framework for STR reporting, transaction monitoring, and red-flag detection.</div></a>
          <a class="pt-rel" href="#"><div class="k">Financial Crime</div><div class="t">Sanctions Screening &amp; Compliance</div><div class="d">Name-screening against UNSC/OFAC watchlists, embargoes, and designated persons.</div></a>
          <a class="pt-rel" href="#"><div class="k">Governance &amp; Ethics</div><div class="t">Whistleblower &amp; Ethics Policy</div><div class="d">Protected-disclosure and vigil-mechanism policy with anti-retaliation safeguards.</div></a>
        </div>
      </section>

      <!-- FAQ -->
      <div class="pt-faqs">
        <h2>Frequently asked questions</h2>
        <?php echo $faq_html; // bundled, pre-escaped ?>
      </div>
    </main>

    <aside class="pt-side">
      <div class="pt-form-card">
        <div class="pt-fc-icon"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></div>
        <h4>Get your personalized copy</h4>
        <p>Add your details and we'll insert your company name, then email you a ready-to-use PDF of this policy.</p>
        <form onsubmit="return false;">
          <input type="text" placeholder="Full name" autocomplete="name">
          <input type="text" placeholder="Company name" autocomplete="organization">
          <input type="email" placeholder="Work email" autocomplete="email">
          <button type="submit" class="btn btn-primary">Mail me the personalized PDF</button>
        </form>
        <span class="pt-fc-note">No spam, we'll only email you the document.</span>
        <span class="pt-proto-flag">(Prototype, form not wired yet)</span>
      </div>

      <nav class="pt-toc">
        <h4>In this template</h4>
        <?php foreach ($toc as $id => $label) : ?>
          <a href="#<?php echo esc_attr($id); ?>" class="toc-link"><?php echo esc_html($label); ?></a>
        <?php endforeach; ?>
      </nav>
    </aside>
  </div>

  <!-- BOTTOM CTA -->
  <div class="pt-band">
    <h2>Stop emailing policy PDFs nobody reads</h2>
    <p>PolicyCentral.ai turns templates like this into living policies, versioned, translated, acknowledged, and answerable by AI.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
      <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
    </div>
  </div>
</div>

<script>
(function(){
  var secs=document.querySelectorAll('.pt-sec[id]'), links=document.querySelectorAll('.pt-toc .toc-link');
  if(!secs.length||!links.length) return;
  var spy=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){links.forEach(function(l){l.classList.toggle('on',l.getAttribute('href')==='#'+e.target.id);});}});},{rootMargin:'-15% 0px -75% 0px'});
  secs.forEach(function(s){spy.observe(s);});
})();
</script>

<?php get_footer(); ?>
