/**
 * Blog — single-post TOC scrollspy
 * Highlights the TOC link whose corresponding H2 is currently in view.
 */
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    var toc = document.querySelector('[data-pcb-toc]');
    if (!toc) return;

    var links = toc.querySelectorAll('.pcb-toc-link');
    if (!links.length) return;

    var targets = [];
    links.forEach(function(link) {
      var id = link.getAttribute('data-target');
      var el = document.getElementById(id);
      if (el) targets.push({ id: id, el: el, link: link });
    });

    if (!targets.length) return;

    function setActive(id) {
      links.forEach(function(l) { l.classList.remove('is-active'); });
      var hit = targets.find(function(t) { return t.id === id; });
      if (hit) hit.link.classList.add('is-active');
    }

    // IntersectionObserver: activate the first H2 whose top has crossed ~20% from viewport top
    var observer = new IntersectionObserver(function(entries) {
      // Pick the topmost currently-intersecting entry
      var visible = entries.filter(function(e) { return e.isIntersecting; });
      if (visible.length) {
        visible.sort(function(a, b) { return a.target.offsetTop - b.target.offsetTop; });
        setActive(visible[0].target.id);
      }
    }, {
      rootMargin: '-80px 0px -70% 0px',
      threshold: 0
    });

    targets.forEach(function(t) { observer.observe(t.el); });

    // Smooth-scroll with header offset when clicking a TOC link
    links.forEach(function(link) {
      link.addEventListener('click', function(e) {
        var id = link.getAttribute('data-target');
        var el = document.getElementById(id);
        if (!el) return;
        e.preventDefault();
        var navH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-h')) || 68;
        var top = el.getBoundingClientRect().top + window.pageYOffset - navH - 12;
        window.scrollTo({ top: top, behavior: 'smooth' });
        history.replaceState(null, '', '#' + id);
      });
    });
  });
})();
