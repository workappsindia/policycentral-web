/* ===================================================================
   main.js — Shared JS (loaded on every page)
   =================================================================== */

/* --- Nav scroll detection --- */
const nav = document.getElementById('nav');
window.addEventListener('scroll', () => {
  nav.classList.toggle('scrolled', window.scrollY > 20);
});

/* --- Scroll reveal animation --- */
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

/* --- Smooth anchor scroll --- */
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    // Close mobile nav on link click
    document.querySelector('.nav-links')?.classList.remove('open');
    document.querySelector('.hamburger')?.classList.remove('active');
    document.body.style.overflow = '';
  });
});

/* --- Hamburger menu toggle --- */
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
if (hamburger && navLinks) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('open');
    document.body.style.overflow = navLinks.classList.contains('open') ? 'hidden' : '';
  });
}

/* --- Mobile dropdown toggles (tap to expand) --- */
document.querySelectorAll('.nav-item .nav-link').forEach(link => {
  link.addEventListener('click', (e) => {
    if (window.innerWidth <= 1024) {
      e.preventDefault();
      const item = link.closest('.nav-item');
      const wasOpen = item.classList.contains('mob-open');
      document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('mob-open'));
      if (!wasOpen) item.classList.add('mob-open');
    }
  });
});

/* --- GTM dataLayer events --- */
window.dataLayer = window.dataLayer || [];

// Contact form submission
document.addEventListener('click', function(e) {
  var btn = e.target.closest('.btn-submit');
  if (btn) {
    var form = btn.closest('form');
    if (form && form.checkValidity()) {
      dataLayer.push({ event: 'form_submit', form_name: 'contact_form' });
    }
  }
});

// Download Presentation click
document.addEventListener('click', function(e) {
  var link = e.target.closest('a[href*="download/presentation"]');
  if (link) {
    dataLayer.push({ event: 'download_click', file_name: 'PolicyCentral_Presentation' });
  }
});

// Web Demo click
document.addEventListener('click', function(e) {
  var link = e.target.closest('a[href*="demo.policycentral.ai"]');
  if (link && !link.href.includes('mobile')) {
    dataLayer.push({ event: 'demo_click', demo_type: 'web_demo' });
  }
});

// Mobile Demo click
document.addEventListener('click', function(e) {
  var link = e.target.closest('a[href*="demo.policycentral.ai/mobile"]');
  if (link) {
    dataLayer.push({ event: 'demo_click', demo_type: 'mobile_demo' });
  }
});

// Contact Us CTA clicks (nav + page CTAs, not the form submit)
document.addEventListener('click', function(e) {
  var link = e.target.closest('a[href*="/contact"]');
  if (link && link.classList.contains('btn')) {
    dataLayer.push({ event: 'cta_click', cta_text: link.textContent.trim().replace(/\s+/g, ' '), cta_location: link.closest('nav') ? 'nav' : 'page' });
  }
});

// External link clicks (workapps.com, videocx.io)
document.addEventListener('click', function(e) {
  var link = e.target.closest('a[target="_blank"]');
  if (link) {
    var href = link.href;
    if (href.includes('workapps.com') || href.includes('videocx.io')) {
      dataLayer.push({ event: 'external_link_click', link_url: href, link_text: link.textContent.trim().replace(/\s+/g, ' ') });
    }
  }
});

/* --- Window resize handler (clean up mobile nav state) --- */
window.addEventListener('resize', () => {
  if (window.innerWidth > 1024) {
    document.querySelector('.nav-links')?.classList.remove('open');
    document.querySelector('.hamburger')?.classList.remove('active');
    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('mob-open'));
    document.body.style.overflow = '';
  }
});
