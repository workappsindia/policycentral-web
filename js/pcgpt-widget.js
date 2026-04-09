/**
 * PolicyGPT Floating Chat Widget
 * Intercom-style chat widget for PolicyCentral.ai
 * Self-contained IIFE — no globals created
 */
(function() {
  'use strict';

  var history = [];
  var isLoading = false;

  // --- DOM refs (bound on DOMContentLoaded) ---
  var trigger, panel, closeBtn, messages, input, sendBtn;

  // --- Markdown renderer (matches pcgpt-search.js with list spacing fix) ---
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

  // --- Auto-scroll (only if user is near bottom) ---
  function autoScroll() {
    if (!messages) return;
    var threshold = 80;
    var atBottom = messages.scrollHeight - messages.scrollTop - messages.clientHeight < threshold;
    if (atBottom) {
      messages.scrollTop = messages.scrollHeight;
    }
  }

  // --- Open / Close panel ---
  function openPanel() {
    panel.classList.add('open');
    trigger.classList.add('hidden');
    input.focus();
  }

  function closePanel() {
    panel.classList.remove('open');
    trigger.classList.remove('hidden');
  }

  function togglePanel() {
    if (panel.classList.contains('open')) {
      closePanel();
    } else {
      openPanel();
    }
  }

  // --- Star SVG for bot icon ---
  var starSVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';

  // --- Send message ---
  async function sendMessage() {
    if (isLoading) return;
    var text = input.value.trim();
    if (!text) return;

    input.value = '';
    isLoading = true;
    sendBtn.disabled = true;

    // Add to conversation history
    history.push({ role: 'user', content: text });

    // Append user message + bot placeholder
    var userHTML =
      '<div class="pw-msg pw-msg-user">' +
        '<div class="pw-msg-bubble pw-user-bubble">' + text.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>' +
      '</div>';

    var botHTML =
      '<div class="pw-msg pw-msg-bot">' +
        '<div class="pw-msg-icon">' + starSVG + '</div>' +
        '<div class="pw-msg-bubble pw-bot-bubble" id="pw-active-bubble">' +
          '<div class="pw-typing">...</div>' +
        '</div>' +
      '</div>';

    messages.insertAdjacentHTML('beforeend', userHTML + botHTML);
    autoScroll();

    var bubble = document.getElementById('pw-active-bubble');

    try {
      // Build form data for WP AJAX
      var params = new URLSearchParams();
      params.append('action', 'pcgpt_search');
      params.append('nonce', PCGPT.nonce);
      params.append('query', text);
      params.append('history', JSON.stringify(history.slice(0, -1)));
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
      bubble.innerHTML = '<span class="pw-cursor"></span>';

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
              bubble.innerHTML = renderMarkdown(fullText) + '<span class="pw-cursor"></span>';
              autoScroll();
            }
          } catch(e) {}
        }
      }

      // Finalize
      bubble.innerHTML = renderMarkdown(fullText);
      bubble.removeAttribute('id');
      history.push({ role: 'assistant', content: fullText });

    } catch (err) {
      bubble.innerHTML = '<span style="color:#ef4444">Failed: ' + err.message + '. Please try again.</span>';
      bubble.removeAttribute('id');
    } finally {
      isLoading = false;
      sendBtn.disabled = false;
      input.focus();
      autoScroll();
    }
  }

  // --- Init on DOMContentLoaded ---
  document.addEventListener('DOMContentLoaded', function() {
    trigger  = document.getElementById('pcgpt-widget-trigger');
    panel    = document.getElementById('pcgpt-widget-panel');
    closeBtn = document.getElementById('pcgpt-widget-close');
    messages = document.getElementById('pcgpt-widget-messages');
    input    = document.getElementById('pcgpt-widget-input');
    sendBtn  = document.getElementById('pcgpt-widget-send');

    // If widget elements are not present (e.g. search page), bail out
    if (!trigger || !panel) return;

    // Toggle panel
    trigger.addEventListener('click', togglePanel);

    // Close button
    if (closeBtn) closeBtn.addEventListener('click', closePanel);

    // Send on click
    if (sendBtn) sendBtn.addEventListener('click', sendMessage);

    // Send on Enter
    if (input) input.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
      }
    });

    // ESC closes panel
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && panel.classList.contains('open')) {
        closePanel();
      }
    });

    // Click outside closes panel
    document.addEventListener('click', function(e) {
      if (
        panel.classList.contains('open') &&
        !panel.contains(e.target) &&
        !trigger.contains(e.target)
      ) {
        closePanel();
      }
    });
  });

})();
