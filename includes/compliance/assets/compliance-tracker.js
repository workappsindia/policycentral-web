/**
 * Compliance Intelligence — enforcement tracker filtering.
 * Client-side filter over the server-rendered cards. Reads URL params on load
 * (?theme= ?re_group= ?scope= ?fy= ?reason=) so hub/decode links can deep-link.
 */
(function () {
  var grid = document.getElementById('trk-grid');
  if (!grid) return;

  var cards   = Array.prototype.slice.call(grid.querySelectorAll('.trk-card'));
  var selects = Array.prototype.slice.call(document.querySelectorAll('.trk-controls select[data-filter]'));
  var countEl = document.getElementById('trk-count');
  var emptyEl = document.getElementById('trk-empty');

  // data-theme and data-reason hold multiple '|'-joined values.
  var MULTI = { theme: true, reason: true };

  function matches(card) {
    return selects.every(function (sel) {
      var val = sel.value;
      if (!val) return true;
      var key  = sel.getAttribute('data-filter');
      var data = card.getAttribute('data-' + key) || '';
      return MULTI[key] ? data.split('|').indexOf(val) !== -1 : data === val;
    });
  }

  function apply() {
    var shown = 0;
    cards.forEach(function (card) {
      var ok = matches(card);
      card.classList.toggle('is-hidden', !ok);
      if (ok) shown++;
    });
    if (countEl) countEl.textContent = shown;
    if (emptyEl) emptyEl.classList.toggle('show', shown === 0);
  }

  function clearAll() {
    selects.forEach(function (s) { s.value = ''; });
    apply();
  }

  function applyUrlParams() {
    var p = new URLSearchParams(window.location.search);
    // URL param name -> select data-filter name
    var map = { theme: 'theme', re_group: 'group', scope: 'scope', fy: 'fy', reason: 'reason' };
    Object.keys(map).forEach(function (param) {
      var v = p.get(param);
      if (!v) return;
      var sel = document.querySelector('.trk-controls select[data-filter="' + map[param] + '"]');
      if (!sel) return;
      var exists = Array.prototype.some.call(sel.options, function (o) { return o.value === v; });
      if (exists) sel.value = v;
    });
  }

  selects.forEach(function (s) { s.addEventListener('change', apply); });
  var clearBtn = document.getElementById('trk-clear');
  if (clearBtn) clearBtn.addEventListener('click', clearAll);
  var resetLink = document.getElementById('trk-reset');
  if (resetLink) resetLink.addEventListener('click', function (e) { e.preventDefault(); clearAll(); });

  applyUrlParams();
  apply();
})();
