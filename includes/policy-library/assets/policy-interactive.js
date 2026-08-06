/**
 * Policy Library — "live policy" toolbar.
 * Translate (AJAX, client Claude key), AI Summary (lazy), Listen (Web Speech),
 * Ask AI (scoped Q&A). Reads config from the .pt-toolbar data attributes.
 */
(function () {
  var tb = document.querySelector('.pt-toolbar');
  var doc = document.getElementById('pt-doc');
  if (!tb || !doc) return;

  var AJAX = tb.getAttribute('data-ajax');
  var NONCE = tb.getAttribute('data-nonce');
  var SLUG = tb.getAttribute('data-slug');
  var statusEl = tb.querySelector('.pt-tb-status');
  var select = tb.querySelector('.pt-tb-select');
  var langLabels = {};
  if (select) {
    Array.prototype.forEach.call(select.options, function (o) { langLabels[o.value] = o.textContent.trim(); });
  }

  var originalHTML = doc.innerHTML;
  var currentLang = 'en';
  var currentBcp47 = 'en-IN';
  var prevLang = 'en';

  function setStatus(msg, kind) {
    statusEl.textContent = msg || '';
    statusEl.className = 'pt-tb-status' + (msg ? ' show' : '') + (kind ? ' pt-tb-' + kind : '');
  }

  function post(action, data) {
    var fd = new FormData();
    fd.append('action', action);
    fd.append('nonce', NONCE);
    fd.append('policy', SLUG);
    Object.keys(data || {}).forEach(function (k) { fd.append(k, data[k]); });
    return fetch(AJAX, { method: 'POST', body: fd, credentials: 'same-origin' })
      .then(function (r) { return r.json(); });
  }

  /* ---- Translate ---- */
  if (select) {
    select.addEventListener('change', function () {
      var lang = select.value;
      stopSpeech();
      if (lang === 'en') {
        doc.innerHTML = originalHTML;
        doc.setAttribute('dir', 'ltr');
        currentLang = 'en'; currentBcp47 = 'en-IN'; prevLang = 'en';
        setStatus('');
        return;
      }
      var label = langLabels[lang] || lang;
      setStatus('Translating into ' + label + '… the first time can take up to a minute. It is cached after, so it will be instant next time.', 'busy');
      select.disabled = true;
      var polls = 0, MAX = 40;
      (function attempt() {
        post('pcpl_translate', { lang: lang }).then(function (res) {
          if (res && res.success && res.data && res.data.done) {
            select.disabled = false;
            doc.innerHTML = res.data.html;
            doc.setAttribute('dir', lang === 'ur' ? 'rtl' : 'ltr');
            currentLang = res.data.lang;
            currentBcp47 = res.data.bcp47 || 'en-IN';
            prevLang = lang;
            setStatus('Showing ' + label + '. Choose English to revert.', 'ok');
          } else if (res && res.success && res.data && res.data.generating) {
            if (polls++ < MAX) { setTimeout(attempt, 4000); }
            else { select.disabled = false; select.value = prevLang; setStatus('Translation is taking longer than expected. Please try again in a moment.', 'err'); }
          } else {
            select.disabled = false; select.value = prevLang;
            setStatus((res && res.data) ? res.data : 'Translation failed. Please try again.', 'err');
          }
        }).catch(function () {
          if (polls++ < MAX) { setTimeout(attempt, 4000); }
          else { select.disabled = false; select.value = prevLang; setStatus('Network error. Please try again.', 'err'); }
        });
      })();
    });
  }

  /* ---- Buttons: summary / listen / ask ---- */
  var summaryPanel = document.querySelector('.pt-summary');
  var summaryBody = summaryPanel ? summaryPanel.querySelector('.pt-summary-body') : null;
  var askPanel = document.querySelector('.pt-ask');
  var summaryLoaded = false;

  tb.addEventListener('click', function (e) {
    var btn = e.target.closest('.pt-tb-btn');
    if (!btn) return;
    var act = btn.getAttribute('data-act');
    if (act === 'summary') toggleSummary(btn);
    else if (act === 'listen') toggleListen(btn);
    else if (act === 'ask') togglePanel(askPanel, btn);
    else if (act === 'faq') toggleFaq(btn);
    else if (act === 'infographic') toggleInfographic(btn);
  });

  var faqPanel = document.querySelector('.pt-faq-panel');
  var faqList = faqPanel ? faqPanel.querySelector('.pt-faq-list') : null;
  var faqLoaded = false;
  var igPanel = document.querySelector('.pt-infographic');
  var igCard = igPanel ? igPanel.querySelector('.pt-ig-card') : null;
  var igLoaded = false;

  function addFaqItem(f, aiTag) {
    var d = document.createElement('details'); d.className = 'pt-faq-item';
    var s = document.createElement('summary');
    s.textContent = f.q;
    if (aiTag) { var t = document.createElement('span'); t.className = 'pt-faq-ai'; t.textContent = 'AI'; s.appendChild(t); }
    var a = document.createElement('div'); a.className = 'pt-faq-ans'; a.textContent = f.a;
    d.appendChild(s); d.appendChild(a); faqList.appendChild(d);
  }
  function toggleFaq(btn) {
    if (!faqPanel) return;
    var willShow = faqPanel.hasAttribute('hidden');
    togglePanel(faqPanel, btn);
    if (willShow && !faqLoaded) {
      faqList.innerHTML = '<p class="pt-loading">Loading FAQs…</p>';
      post('pcpl_faqs', {}).then(function (res) {
        faqList.innerHTML = '';
        if (res && res.success) {
          (res.data.curated || []).forEach(function (f) { addFaqItem(f, false); });
          (res.data.ai || []).forEach(function (f) { addFaqItem(f, true); });
          if (!faqList.children.length) faqList.innerHTML = '<p class="pt-loading">No FAQs available.</p>';
          faqLoaded = true;
        } else { faqList.innerHTML = '<p class="pt-err-txt">' + ((res && res.data) ? res.data : 'FAQs unavailable.') + '</p>'; }
      }).catch(function () { faqList.innerHTML = '<p class="pt-err-txt">Network error.</p>'; });
    }
  }

  function renderInfographic(d) {
    igCard.innerHTML = '';
    var head = document.createElement('div'); head.className = 'pt-ig-head';
    var h = document.createElement('div'); h.className = 'pt-ig-headline'; h.textContent = d.headline || '';
    head.appendChild(h);
    if (d.summary) { var sub = document.createElement('div'); sub.className = 'pt-ig-sub'; sub.textContent = d.summary; head.appendChild(sub); }
    igCard.appendChild(head);
    if (d.stats && d.stats.length) {
      var sr = document.createElement('div'); sr.className = 'pt-ig-stats';
      d.stats.forEach(function (s) {
        var tile = document.createElement('div'); tile.className = 'pt-ig-stat';
        var v = document.createElement('div'); v.className = 'pt-ig-stat-v'; v.textContent = s.value;
        var l = document.createElement('div'); l.className = 'pt-ig-stat-l'; l.textContent = s.label;
        tile.appendChild(v); tile.appendChild(l); sr.appendChild(tile);
      });
      igCard.appendChild(sr);
    }
    var grid = document.createElement('div'); grid.className = 'pt-ig-grid';
    (d.takeaways || []).forEach(function (t, i) {
      var cell = document.createElement('div'); cell.className = 'pt-ig-cell';
      var n = document.createElement('div'); n.className = 'pt-ig-num'; n.textContent = (i + 1);
      var body = document.createElement('div'); body.className = 'pt-ig-cell-body';
      var ct = document.createElement('div'); ct.className = 'pt-ig-cell-t'; ct.textContent = t.title;
      var cx = document.createElement('div'); cx.className = 'pt-ig-cell-x'; cx.textContent = t.text;
      body.appendChild(ct); body.appendChild(cx);
      cell.appendChild(n); cell.appendChild(body); grid.appendChild(cell);
    });
    igCard.appendChild(grid);
    var foot = document.createElement('div'); foot.className = 'pt-ig-foot'; foot.textContent = 'Generated by PolicyCentral AI';
    igCard.appendChild(foot);
  }
  function toggleInfographic(btn) {
    if (!igPanel) return;
    var willShow = igPanel.hasAttribute('hidden');
    togglePanel(igPanel, btn);
    if (willShow && !igLoaded) {
      igCard.innerHTML = '<p class="pt-loading">Generating infographic…</p>';
      post('pcpl_infographic', {}).then(function (res) {
        if (res && res.success && res.data && res.data.takeaways) { renderInfographic(res.data); igLoaded = true; }
        else { igCard.innerHTML = '<p class="pt-err-txt">' + ((res && res.data) ? res.data : 'Infographic unavailable.') + '</p>'; }
      }).catch(function () { igCard.innerHTML = '<p class="pt-err-txt">Network error.</p>'; });
    }
  }

  function togglePanel(panel, btn) {
    if (!panel) return;
    var show = panel.hasAttribute('hidden');
    if (show) panel.removeAttribute('hidden'); else panel.setAttribute('hidden', '');
    if (btn) btn.classList.toggle('on', show);
    if (show) panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function toggleSummary(btn) {
    if (!summaryPanel) return;
    var willShow = summaryPanel.hasAttribute('hidden');
    togglePanel(summaryPanel, btn);
    if (willShow && !summaryLoaded) {
      summaryBody.innerHTML = '<p class="pt-loading">Generating summary…</p>';
      post('pcpl_ai_summary', {}).then(function (res) {
        if (res && res.success) { summaryBody.textContent = res.data.summary; summaryLoaded = true; }
        else { summaryBody.innerHTML = '<p class="pt-err-txt">' + ((res && res.data) ? res.data : 'Summary unavailable.') + '</p>'; }
      }).catch(function () { summaryBody.innerHTML = '<p class="pt-err-txt">Network error.</p>'; });
    }
  }

  /* ---- Listen (Web Speech API) ---- */
  var speaking = false;
  var synth = window.speechSynthesis;

  function stopSpeech() {
    if (synth && speaking) { synth.cancel(); }
    speaking = false;
    updateListenBtns(false);
  }
  function updateListenBtns(on) {
    Array.prototype.forEach.call(tb.querySelectorAll('.pt-tb-btn[data-act="listen"]'), function (b) {
      b.classList.toggle('on', on);
      var t = b.querySelector('.pt-listen-txt'); if (t) t.textContent = on ? 'Stop' : 'Listen';
    });
  }
  function chunkText(text) {
    var parts = text.replace(/\s+/g, ' ').match(/[^.!?।]+[.!?।]*/g) || [text];
    var out = [], buf = '';
    parts.forEach(function (s) {
      if ((buf + s).length > 220) { if (buf) out.push(buf.trim()); buf = s; }
      else buf += s;
    });
    if (buf.trim()) out.push(buf.trim());
    return out;
  }
  function toggleListen(btn) {
    if (!synth || typeof SpeechSynthesisUtterance === 'undefined') {
      setStatus('Audio is not supported in this browser.', 'err'); return;
    }
    if (speaking) { stopSpeech(); setStatus(''); return; }
    var text = doc.textContent || '';
    if (!text.trim()) return;
    var chunks = chunkText(text);
    speaking = true; updateListenBtns(true);
    setStatus('Reading aloud… press Stop to end.', 'busy');
    var i = 0;
    (function next() {
      if (!speaking || i >= chunks.length) { stopSpeech(); setStatus(''); return; }
      var u = new SpeechSynthesisUtterance(chunks[i++]);
      u.lang = currentBcp47;
      u.onend = next;
      u.onerror = function () { stopSpeech(); setStatus('Audio playback stopped.', 'err'); };
      synth.speak(u);
    })();
  }
  window.addEventListener('beforeunload', stopSpeech);

  /* ---- Ask AI ---- */
  if (askPanel) {
    var form = askPanel.querySelector('.pt-ask-form');
    var input = askPanel.querySelector('.pt-ask-q');
    var log = askPanel.querySelector('.pt-ask-log');
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var q = (input.value || '').trim();
      if (!q) return;
      var qEl = document.createElement('div'); qEl.className = 'pt-ask-q-row'; qEl.textContent = q;
      var aEl = document.createElement('div'); aEl.className = 'pt-ask-a-row pt-loading'; aEl.textContent = 'Thinking…';
      log.appendChild(qEl); log.appendChild(aEl);
      input.value = ''; input.disabled = true;
      aEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      post('pcpl_ask', { question: q }).then(function (res) {
        input.disabled = false; input.focus();
        aEl.classList.remove('pt-loading');
        if (res && res.success) { aEl.textContent = res.data.answer; }
        else { aEl.classList.add('pt-err-txt'); aEl.textContent = (res && res.data) ? res.data : 'Could not answer. Please try again.'; }
      }).catch(function () {
        input.disabled = false; aEl.classList.remove('pt-loading'); aEl.classList.add('pt-err-txt');
        aEl.textContent = 'Network error. Please try again.';
      });
    });
  }
})();
