/**
 * PolicyGPT Admin JS
 * Handles Knowledge Base editor, Bot Config, and Query Insights
 */
(function($) {
  'use strict';

  // ═══════════════════════════════════════════
  // KNOWLEDGE BASE
  // ═══════════════════════════════════════════

  // Tab switching
  $(document).on('click', '.pcgpt-kb-tab', function(e) {
    e.preventDefault();
    var cat = $(this).data('cat');

    // Highlight active tab
    $('.pcgpt-kb-tab').css({ background: '', fontWeight: '' });
    $(this).css({ background: '#E0F5F7', fontWeight: '600' });

    // Show panel
    $('.pcgpt-kb-panel').hide();
    $('#panel-' + cat).show();
  });

  // Load knowledge on page load (if on KB page)
  if ($('#pcgpt-kb-wrap').length) {
    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_get_knowledge',
      nonce: PCGPT_ADMIN.nonce
    }, function(res) {
      if (res.success) {
        $.each(res.data, function(cat, info) {
          $('textarea[data-cat="' + cat + '"]').val(info.content);
        });
      }
      // Click first tab
      $('.pcgpt-kb-tab').first().trigger('click');
    });
  }

  // Save knowledge category
  $(document).on('click', '.pcgpt-kb-save', function() {
    var cat = $(this).data('cat');
    var content = $('textarea[data-cat="' + cat + '"]').val();
    var statusEl = $('.pcgpt-save-status[data-cat="' + cat + '"]');
    var btn = $(this);

    btn.prop('disabled', true).text('Saving...');

    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_save_knowledge',
      nonce: PCGPT_ADMIN.nonce,
      category_id: cat,
      content: content
    }, function(res) {
      btn.prop('disabled', false).text('Save Changes');
      if (res.success) {
        statusEl.text('Saved ✓').show();
        setTimeout(function() { statusEl.fadeOut(); }, 3000);
      } else {
        alert('Error saving: ' + (res.data || 'Unknown error'));
      }
    }).fail(function() {
      btn.prop('disabled', false).text('Save Changes');
      alert('Network error. Please try again.');
    });
  });


  // ═══════════════════════════════════════════
  // BOT CONFIG
  // ═══════════════════════════════════════════

  // Load config on page load (if on config page)
  if ($('#pcgpt-save-contact').length) {
    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_get_config',
      nonce: PCGPT_ADMIN.nonce
    }, function(res) {
      if (res.success) {
        var c = res.data.contact || {};
        $('#pcgpt-contact-name').val(c.name || '');
        $('#pcgpt-contact-role').val(c.role || '');
        $('#pcgpt-contact-phone').val(c.phone || '');
        $('#pcgpt-contact-email').val(c.email || '');
        $('#pcgpt-contact-web').val(c.web || '');
        $('#pcgpt-contact-wa').val(c.wa || '');

        var b = res.data.behaviour || {};
        $('#pcgpt-behaviour-name').val(b.name || '');
        $('#pcgpt-behaviour-tone').val(b.tone || 'confident_witty');
        $('#pcgpt-behaviour-length').val(b.length || 'balanced');
        $('#pcgpt-behaviour-pricing').val(b.pricing || 'deflect');
        $('#pcgpt-behaviour-custom').val(b.custom || '');
        $('#pcgpt-behaviour-avoid').val(b.avoid || '');
      }
    });
  }

  // Save contact
  $(document).on('click', '#pcgpt-save-contact', function() {
    var btn = $(this);
    btn.prop('disabled', true).text('Saving...');

    var data = {
      name: $('#pcgpt-contact-name').val(),
      role: $('#pcgpt-contact-role').val(),
      phone: $('#pcgpt-contact-phone').val(),
      email: $('#pcgpt-contact-email').val(),
      web: $('#pcgpt-contact-web').val(),
      wa: $('#pcgpt-contact-wa').val()
    };

    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_save_config',
      nonce: PCGPT_ADMIN.nonce,
      config_key: 'contact',
      config_value: JSON.stringify(data)
    }, function(res) {
      btn.prop('disabled', false).text('Save Contact Info');
      if (res.success) {
        $('#pcgpt-contact-status').show();
        setTimeout(function() { $('#pcgpt-contact-status').fadeOut(); }, 3000);
      } else {
        alert('Error: ' + (res.data || 'Unknown'));
      }
    }).fail(function() {
      btn.prop('disabled', false).text('Save Contact Info');
      alert('Network error.');
    });
  });

  // Save behaviour
  $(document).on('click', '#pcgpt-save-behaviour', function() {
    var btn = $(this);
    btn.prop('disabled', true).text('Saving...');

    var data = {
      name: $('#pcgpt-behaviour-name').val(),
      tone: $('#pcgpt-behaviour-tone').val(),
      length: $('#pcgpt-behaviour-length').val(),
      pricing: $('#pcgpt-behaviour-pricing').val(),
      custom: $('#pcgpt-behaviour-custom').val(),
      avoid: $('#pcgpt-behaviour-avoid').val()
    };

    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_save_config',
      nonce: PCGPT_ADMIN.nonce,
      config_key: 'behaviour',
      config_value: JSON.stringify(data)
    }, function(res) {
      btn.prop('disabled', false).text('Save Behaviour');
      if (res.success) {
        $('#pcgpt-behaviour-status').show();
        setTimeout(function() { $('#pcgpt-behaviour-status').fadeOut(); }, 3000);
      } else {
        alert('Error: ' + (res.data || 'Unknown'));
      }
    }).fail(function() {
      btn.prop('disabled', false).text('Save Behaviour');
      alert('Network error.');
    });
  });


  // ═══════════════════════════════════════════
  // QUERY INSIGHTS
  // ═══════════════════════════════════════════

  var currentPage = 1;

  function loadQueries(page, search) {
    page = page || 1;
    search = search || '';
    currentPage = page;

    $.post(PCGPT_ADMIN.ajax_url, {
      action: 'pcgpt_get_queries',
      nonce: PCGPT_ADMIN.nonce,
      page: page,
      search: search
    }, function(res) {
      if (!res.success) return;

      var data = res.data;

      // Stats
      $('#pcgpt-stat-total').text(data.stats.total_all);
      $('#pcgpt-stat-today').text(data.stats.total_today);
      $('#pcgpt-stat-unique').text(data.stats.unique);
      $('#pcgpt-stat-topcat').text(data.stats.top_category);

      // Table
      var tbody = $('#pcgpt-queries-body');
      tbody.empty();

      if (data.queries.length === 0) {
        tbody.html('<tr><td colspan="4" style="text-align:center;padding:20px;color:#999;">No queries found.</td></tr>');
        return;
      }

      data.queries.forEach(function(q) {
        var row = '<tr>' +
          '<td>' + escHtml(q.query) + '</td>' +
          '<td><span style="background:#E0F5F7;color:#0694A2;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">' + escHtml(q.category || 'General') + '</span></td>' +
          '<td style="font-size:12px;color:#666;">' + escHtml(q.ip_address) + '</td>' +
          '<td style="font-size:12px;color:#666;">' + formatDate(q.created_at) + '</td>' +
        '</tr>';
        tbody.append(row);
      });

      // Pagination
      var pag = $('#pcgpt-pagination');
      pag.empty();
      if (data.pages > 1) {
        for (var i = 1; i <= data.pages; i++) {
          var cls = i === page ? 'button button-primary' : 'button';
          pag.append('<button class="' + cls + ' pcgpt-page-btn" data-page="' + i + '" style="margin-right:4px;">' + i + '</button>');
        }
      }
    });
  }

  // Load queries on page load (if on insights page)
  if ($('#pcgpt-queries-table').length) {
    loadQueries(1);
  }

  // Pagination
  $(document).on('click', '.pcgpt-page-btn', function() {
    loadQueries($(this).data('page'), $('#pcgpt-query-search').val());
  });

  // Search
  var searchTimeout;
  $(document).on('input', '#pcgpt-query-search', function() {
    clearTimeout(searchTimeout);
    var val = $(this).val();
    searchTimeout = setTimeout(function() {
      loadQueries(1, val);
    }, 400);
  });

  // Export CSV
  $(document).on('click', '#pcgpt-export-csv', function() {
    window.location.href = PCGPT_ADMIN.ajax_url + '?action=pcgpt_export_queries&nonce=' + PCGPT_ADMIN.nonce;
  });

  // Helpers
  function escHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  function formatDate(dateStr) {
    if (!dateStr) return '';
    var d = new Date(dateStr);
    return d.toLocaleDateString() + ' ' + d.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
  }

})(jQuery);
