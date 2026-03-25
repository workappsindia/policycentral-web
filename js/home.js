/* ===================================================================
   home.js — Home page only JS
   =================================================================== */

/* --- Hero slider auto-cycling --- */
(function() {
  const track = document.getElementById('heroSliderTrack');
  const dots = document.querySelectorAll('#heroSliderDots .hs-dot-btn');
  const label = document.getElementById('heroSliderLabel');
  const slider = document.getElementById('heroSlider');
  const labels = ['Policy Library', 'Policy Document', 'Compliance Tracking', 'Gen AI Intelligence', 'Use Cases'];
  let cur = 0, total = 5, timer = null, paused = false;

  function go(i) {
    cur = ((i % total) + total) % total;
    track.style.transform = 'translateX(-' + cur * 20 + '%)';
    dots.forEach((d, idx) => d.classList.toggle('active', idx === cur));
    label.textContent = labels[cur];
  }

  function auto() { timer = setInterval(() => { if (!paused) go(cur + 1); }, 4000); }

  dots.forEach(d => d.addEventListener('click', () => { go(+d.dataset.slide); clearInterval(timer); auto(); }));
  slider.addEventListener('mouseenter', () => paused = true);
  slider.addEventListener('mouseleave', () => paused = false);

  // Touch support
  let tx = 0;
  slider.addEventListener('touchstart', e => { tx = e.touches[0].clientX; paused = true; }, { passive: true });
  slider.addEventListener('touchend', e => {
    const dx = e.changedTouches[0].clientX - tx;
    if (Math.abs(dx) > 40) { go(cur + (dx < 0 ? 1 : -1)); clearInterval(timer); auto(); }
    paused = false;
  }, { passive: true });

  auto();
})();

/* --- Feature tab switching --- */
const exploreMap = {
  'makers-ai':        { href: 'pc_feature_ai-intelligence.html',        text: 'Explore all AI-Powered Policy Intelligence features' },
  'makers-content':   { href: 'pc_feature_content-management.html',     text: 'Explore all Policy Creation & Content Management features' },
  'makers-publish':   { href: 'pc_feature_publisher-controls.html',     text: 'Explore all Publisher Controls & Workflow Management features' },
  'emp-distribution': { href: 'pc_feature_distribution-targeting.html', text: 'Explore all Policy Distribution & Targeting features' },
  'emp-portal':       { href: 'pc_feature_employee-portal.html',        text: 'Explore all Employee Portal & Mobile Experience features' },
  'emp-interact':     { href: 'pc_feature_employee-interaction.html',   text: 'Explore all Employee Interaction & Acknowledgement features' },
  'org-tracking':     { href: 'pc_feature_tracking-reporting.html',     text: 'Explore all Tracking, Analytics & Reporting features' },
  'org-enterprise':   { href: 'pc_feature_enterprise.html',             text: 'Explore all Enterprise Features' },
  'org-security':     { href: 'pc_feature_security-compliance.html',    text: 'Explore all Banking-Grade Security & Compliance features' }
};

document.querySelectorAll('.fblock').forEach(block => {
  block.querySelectorAll('.ftab').forEach(tab => {
    tab.addEventListener('click', () => {
      block.querySelectorAll('.ftab').forEach(t => t.classList.remove('on'));
      block.querySelectorAll('.fpanel').forEach(p => p.classList.remove('on'));
      tab.classList.add('on');
      document.getElementById(tab.dataset.panel).classList.add('on');
      const link = block.querySelector('.fblock-bottom-link');
      const info = exploreMap[tab.dataset.panel];
      if (link && info) {
        link.href = info.href;
        link.childNodes[0].textContent = info.text + ' ';
      }
    });
  });
});

/* --- Journey steps stagger --- */
const jsteps = document.querySelectorAll('.jstep');
const jObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      jsteps.forEach((s, i) => setTimeout(() => s.classList.add('visible'), i * 80));
      jObs.disconnect();
    }
  });
}, { threshold: 0.2 });
if (jsteps[0]) jObs.observe(jsteps[0].closest('.journey') || document.getElementById('platform'));

/* --- Timeline auto-cycling animation --- */
(function() {
  const CYCLE_MS = 4000;
  const SEC = CYCLE_MS / 1000;

  const allPanels = document.querySelectorAll('.fpanel.tl-panel');
  const timelines = new Map();

  allPanels.forEach(panel => {
    const list = panel.querySelector('.timeline-list');
    if (!list) return;
    const items = list.querySelectorAll('.tl-item');
    const progressBar = list.querySelector('.timeline-progress');
    const track = list.querySelector('.timeline-track');
    const visCards = panel.querySelectorAll('.timeline-vis .tl-vis-card');
    if (!items.length || !visCards.length) return;

    timelines.set(panel.id, {
      panel, list, items, progressBar, track, visCards,
      count: items.length, current: 0, intervalId: null, paused: false
    });
  });

  function getDotY(state, index) {
    const listRect = state.list.getBoundingClientRect();
    const trackTop = state.track.getBoundingClientRect().top - listRect.top;
    const dotCenter = state.items[index].getBoundingClientRect().top + 36.5 - listRect.top;
    return Math.max(0, dotCenter - trackTop);
  }

  function activate(state, index) {
    state.current = index;
    state.items.forEach((item, i) => {
      item.classList.remove('tl-active', 'tl-done');
      if (i < index) item.classList.add('tl-done');
      if (i === index) item.classList.add('tl-active');
    });
    state.visCards.forEach(card => {
      if (parseInt(card.dataset.tlIndex) === index) {
        card.classList.remove('tl-fade-out');
        card.classList.add('tl-fade-in');
      } else {
        card.classList.remove('tl-fade-in');
        card.classList.add('tl-fade-out');
      }
    });
  }

  function jumpProgressTo(state, index) {
    const y = getDotY(state, index);
    state.progressBar.style.transition = 'none';
    state.progressBar.style.height = y + 'px';
    state.progressBar.offsetHeight; // force reflow
  }

  function animateProgressTo(state, index) {
    requestAnimationFrame(() => {
      const y = getDotY(state, index);
      state.progressBar.style.transition = 'height ' + SEC + 's linear';
      state.progressBar.style.height = y + 'px';
    });
  }

  function stopTimer(state) {
    if (state.intervalId) { clearInterval(state.intervalId); state.intervalId = null; }
  }

  function startTimer(state) {
    stopTimer(state);
    const nextIdx = (state.current + 1) % state.count;
    animateProgressTo(state, nextIdx);

    state.intervalId = setInterval(() => {
      if (state.paused) return;
      const next = state.current + 1;
      if (next >= state.count) {
        activate(state, 0);
        jumpProgressTo(state, 0);
        animateProgressTo(state, 1);
        return;
      }
      activate(state, next);
      if (next < state.count - 1) {
        animateProgressTo(state, next + 1);
      }
    }, CYCLE_MS);
  }

  // Init: only start the currently visible panel
  timelines.forEach(state => {
    activate(state, 0);
    if (state.panel.classList.contains('on')) {
      jumpProgressTo(state, 0);
      setTimeout(() => startTimer(state), 100);
    }

    // Click handlers
    state.items.forEach((item, i) => {
      item.addEventListener('click', () => {
        activate(state, i);
        jumpProgressTo(state, i);
        setTimeout(() => startTimer(state), 30);
      });
      item.addEventListener('mouseenter', () => { state.paused = true; });
      item.addEventListener('mouseleave', () => { state.paused = false; });
    });
  });

  // Tab switching: stop all in same fblock, start the newly active one
  document.querySelectorAll('.fblock').forEach(block => {
    block.querySelectorAll('.ftab').forEach(tab => {
      tab.addEventListener('click', () => {
        setTimeout(() => {
          timelines.forEach(state => {
            if (!block.contains(state.panel)) return;
            if (state.panel.classList.contains('on')) {
              activate(state, 0);
              jumpProgressTo(state, 0);
              setTimeout(() => startTimer(state), 50);
            } else {
              stopTimer(state);
            }
          });
        }, 50);
      });
    });
  });
})();
