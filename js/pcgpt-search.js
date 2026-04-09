/**
 * PolicyGPT Search — Public Page JS
 * Connects to WP AJAX proxy for Anthropic API calls
 */
(function() {
  'use strict';

  let history = [];
  let isLoading = false;
  let queryCount = 0;

  const quips = [
    '"I\'ve read 247 policies so you don\'t have to.<br><span>Ask me anything. I have nowhere else to be.</span>"',
    '"Query received. Cross-referencing 247 policies...<br><span>Results will be more accurate than your last audit.</span>"',
    '"Processing. This is faster than your team reading<br><span>a 40-page leave policy, I promise.</span>"',
    '"Another query. Excellent.<br><span>I am never going home. I live here now.</span>"',
    '"Query resolved. Filing to knowledge base.<br><span>Unlike your expense reports, this will not be lost.</span>"',
  ];

  // Animate kb fill on load
  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
      var el = document.getElementById('kbFill');
      if (el) el.style.width = '100%';
    }, 800);

    // Bind events
    var sendBtn = document.getElementById('sendBtn');
    if (sendBtn) sendBtn.addEventListener('click', sendMessage);

    var queryInput = document.getElementById('queryInput');
    if (queryInput) queryInput.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') { e.preventDefault(); sendMessage(); }
    });

    var stickyInput = document.getElementById('stickyInput');
    if (stickyInput) stickyInput.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') { e.preventDefault(); sendFromSticky(); }
    });

    var stickySendBtn = document.getElementById('stickySendBtn');
    if (stickySendBtn) stickySendBtn.addEventListener('click', sendFromSticky);

    var shareBtn = document.getElementById('shareBtn');
    if (shareBtn) shareBtn.addEventListener('click', toggleShare);

    // Chips
    document.querySelectorAll('.pcgpt-wrap .chip').forEach(function(chip) {
      chip.addEventListener('click', function() {
        document.getElementById('queryInput').value = this.textContent.trim();
        sendMessage();
      });
    });

    // Share options
    document.querySelectorAll('.share-option').forEach(function(opt) {
      opt.addEventListener('click', function() {
        shareChat(this.dataset.type);
      });
    });

    // Close share dropdown on outside click
    document.addEventListener('click', function(e) {
      var dropdown = document.getElementById('shareDropdown');
      var btn = document.getElementById('shareBtn');
      if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
      }
    });
  });

  function setQueryStatus(state) {
    var box = document.getElementById('queryStatusBox');
    var icon = document.getElementById('qsIcon');
    var label = document.getElementById('qsLabel');
    var sub = document.getElementById('qsSub');
    if (!box) return;

    if (state === 'processing') {
      box.style.background = 'rgba(6,148,162,.04)';
      box.style.borderColor = 'rgba(6,148,162,.25)';
      icon.style.background = 'var(--teal)';
      icon.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>';
      label.style.color = 'var(--teal)';
      label.textContent = 'PROCESSING';
      sub.style.color = 'var(--teal)';
      sub.textContent = 'Routing to PolicyGPT...';
    } else if (state === 'resolved') {
      box.style.background = 'var(--em-lt)';
      box.style.borderColor = 'rgba(5,150,105,.3)';
      icon.style.background = 'var(--emerald)';
      icon.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
      label.style.color = 'var(--emerald)';
      label.textContent = 'RESOLVED';
      sub.style.color = 'var(--emerald)';
      sub.style.opacity = '.7';
      sub.textContent = 'Query #' + String(queryCount).padStart(4, '0') + ' filed \u2713';
    }
  }

  function renderMarkdown(raw) {
    return raw
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
      .replace(/\*([^*\n]+?)\*/g, '<em>$1</em>')
      .replace(/`([^`]+?)`/g, '<code>$1</code>')
      .replace(/^#{1,3} (.+)$/gm, '<strong>$1</strong>')
      .replace(/^[•\-] (.+)$/gm, '<li>$1</li>')
      .replace(/^\d+\. (.+)$/gm, '<li>$1</li>')
      .replace(/((?:<li>[^]*?<\/li>\n?)+)/g, '<ul>$1</ul>')
      // Fix: clean up newlines inside <ul> before they become <br>
      .replace(/<\/li>\n<li>/g, '</li><li>')
      .replace(/<\/li>\n<\/ul>/g, '</li></ul>')
      .replace(/<ul>\n/g, '<ul>')
      .replace(/\n{2,}/g, '</p><p>')
      .replace(/\n/g, '<br>')
      .replace(/^(?!<[uopbl])(.+)$/gm, '<p>$1</p>');
  }

  async function sendMessage() {
    if (isLoading) return;
    var input = document.getElementById('queryInput');
    var text = input.value.trim();
    if (!text) return;

    input.value = '';
    isLoading = true;
    queryCount++;
    document.getElementById('sendBtn').disabled = true;
    document.getElementById('emptyState').style.display = 'none';

    setQueryStatus('processing');
    document.getElementById('dcUrl').textContent = 'policycentral.ai/search \u00b7 QRY-' + String(queryCount).padStart(4, '0');

    history.push({ role: 'user', content: text });
    var conv = document.getElementById('conversation');

    var pair = document.createElement('div');
    pair.className = 'q-pair';
    pair.innerHTML =
      '<div class="query-pill">' +
        '<div class="query-bubble">' + text.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>' +
      '</div>' +
      '<div class="answer-wrap">' +
        '<div class="answer-icon">' +
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' +
        '</div>' +
        '<div class="answer-body">' +
          '<div class="answer-meta">' +
            '<span class="answer-from">PolicyGPT</span>' +
            '<span class="answer-ref mono">QRY-' + String(queryCount).padStart(4, '0') + ' \u00b7 Processing\u2026</span>' +
          '</div>' +
          '<div class="answer-bubble" id="activeBubble">' +
            '<div class="typing"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div>' +
          '</div>' +
        '</div>' +
      '</div>';
    conv.appendChild(pair);
    pair.scrollIntoView({ behavior: 'smooth', block: 'start' });

    var bubble = pair.querySelector('#activeBubble');
    var refEl = pair.querySelector('.answer-ref');

    try {
      // Build form data for WP AJAX
      var params = new URLSearchParams();
      params.append('action', 'pcgpt_search');
      params.append('nonce', PCGPT.nonce);
      params.append('query', text);
      params.append('history', JSON.stringify(history.slice(0, -1))); // exclude current query, server adds it
      params.append('session_id', PCGPT.session_id);

      var res = await fetch(PCGPT.ajax_url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params.toString()
      });

      if (!res.ok) throw new Error('Error ' + res.status);

      var reader = res.body.getReader();
      var decoder = new TextDecoder();
      var buf = '', fullText = '';
      bubble.innerHTML = '<span class="cursor"></span>';

      while (true) {
        var result = await reader.read();
        if (result.done) break;
        buf += decoder.decode(result.value, { stream: true });
        var lines = buf.split('\n');
        buf = lines.pop();
        for (var i = 0; i < lines.length; i++) {
          var line = lines[i];
          if (line.indexOf('data: ') !== 0) continue;
          var d = line.slice(6).trim();
          if (!d || d === '[DONE]') continue;
          try {
            var p = JSON.parse(d);
            if (p.type === 'content_block_delta' && p.delta && p.delta.type === 'text_delta') {
              fullText += p.delta.text;
              bubble.innerHTML = renderMarkdown(fullText) + '<span class="cursor"></span>';
              // No auto-scroll during streaming — let user read naturally
            }
          } catch(e) {}
        }
      }

      bubble.innerHTML = renderMarkdown(fullText);
      bubble.id = '';

      // Add "filed" footer
      pair.querySelector('.answer-body').insertAdjacentHTML('beforeend',
        '<div class="answer-filed">' +
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>' +
          'Filed to knowledge base &nbsp;\u00b7&nbsp; <span class="mono" style="font-size:9px">' + new Date().toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}) + '</span>' +
        '</div>');

      refEl.textContent = 'QRY-' + String(queryCount).padStart(4, '0') + ' \u00b7 Resolved';
      history.push({ role: 'assistant', content: fullText });

      document.getElementById('resolvedCount').textContent = queryCount;
      setQueryStatus('resolved');
      var botQuip = document.getElementById('botQuip');
      if (botQuip) botQuip.innerHTML = quips[Math.min(queryCount, quips.length - 1)];

    } catch (err) {
      bubble.innerHTML = '<span style="color:var(--rose)">Query failed: ' + err.message + '. Please try again.</span>';
      bubble.id = '';
    } finally {
      isLoading = false;
      document.getElementById('sendBtn').disabled = false;
      var stickySendBtn = document.getElementById('stickySendBtn');
      if (stickySendBtn) stickySendBtn.disabled = false;
      showStickyBar();
      var stickyInput = document.getElementById('stickyInput');
      if (stickyInput) stickyInput.focus();
    }
  }

  function showStickyBar() {
    var bar = document.getElementById('stickyBar');
    if (bar && !bar.classList.contains('visible')) {
      bar.classList.add('visible');
      document.body.classList.add('has-sticky');
    }
  }

  function sendFromSticky() {
    var sticky = document.getElementById('stickyInput');
    var main = document.getElementById('queryInput');
    main.value = sticky.value;
    sticky.value = '';
    sendMessage();
    setTimeout(function() {
      var conv = document.getElementById('conversation');
      var last = conv.lastElementChild;
      if (last) last.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
  }

  function toggleShare(e) {
    e.stopPropagation();
    document.getElementById('shareDropdown').classList.toggle('open');
  }

  function buildChatText() {
    var text = 'PolicyCentral.ai \u2014 Chat Summary\n';
    text += '================================\n\n';
    for (var i = 0; i < history.length; i += 2) {
      if (history[i]) text += '\u2753 ' + history[i].content + '\n\n';
      if (history[i + 1]) text += '\ud83d\udca1 ' + history[i + 1].content + '\n\n';
      text += '---\n\n';
    }
    text += 'Learn more: https://www.policycentral.ai\n';
    text += 'Contact: Kaizad Shroff \u00b7 +91 98909 88498 \u00b7 contact@policycentral.ai';
    return text;
  }

  function shareChat(type) {
    document.getElementById('shareDropdown').classList.remove('open');
    var text = buildChatText();
    if (type === 'whatsapp') {
      window.open('https://wa.me/?text=' + encodeURIComponent(text), '_blank');
    } else {
      var subject = 'PolicyCentral.ai \u2014 Chat Summary';
      window.location.href = 'mailto:?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(text);
    }
  }

})();
