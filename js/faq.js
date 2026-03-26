/* ==========================================================
   FAQ Page JS — accordion, auto-open, sidebar scroll-spy
   ========================================================== */

// --- Accordion toggle ---
// Clicking a trigger opens its item and closes any other open item.
document.querySelectorAll('.acc-trigger').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.acc-item');
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.acc-item.open').forEach(i => i.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
  });
});

// --- Auto-open first accordion item on page load ---
document.querySelectorAll('.acc-item').forEach(i => i.classList.add('open'));

// --- Sidebar scroll-spy ---
// Highlights the active sidebar link based on which section is in view.
const sections = document.querySelectorAll('[data-sec]');
const slinks   = document.querySelectorAll('.sidebar-nav a');

window.addEventListener('scroll', () => {
  let cur = '';
  sections.forEach(s => {
    if (window.scrollY >= s.offsetTop - 100) cur = s.dataset.sec;
  });
  slinks.forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + cur);
  });
}, { passive: true });
