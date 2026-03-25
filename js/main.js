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

/* --- Window resize handler (clean up mobile nav state) --- */
window.addEventListener('resize', () => {
  if (window.innerWidth > 1024) {
    document.querySelector('.nav-links')?.classList.remove('open');
    document.querySelector('.hamburger')?.classList.remove('active');
    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('mob-open'));
    document.body.style.overflow = '';
  }
});
