<?php
/**
 * Blog Content Enhancements
 *
 * Post-content transformations applied via the_content filter on blog posts:
 *
 *  1. Add id="..." anchors to <h2> tags so the sidebar TOC can jump-link
 *  2. Inject the middle CTA panel after the 3rd <h2>
 *  3. Provide pcb_reading_time() helper for templates
 *  4. Provide pcb_build_toc() helper for templates
 *
 * All transformations run ONLY on single blog post views to avoid affecting
 * pages, archives, or excerpts.
 */

if (!defined('ABSPATH')) exit;

class PCB_Content {

    public static function register() {
        add_filter('the_content', array(__CLASS__, 'enhance_content'), 20);
        add_action('wp_head', array(__CLASS__, 'faq_jsonld'), 30);
    }

    /**
     * Main content filter: adds H2 anchors + injects middle CTA + transforms FAQ.
     */
    public static function enhance_content($content) {
        if (!is_singular('post') || !in_the_loop() || !is_main_query()) {
            return $content;
        }

        // Step 1: Transform FAQ section into accordion (do first — before
        // H2 anchoring so the FAQ H2 still gets anchored normally)
        $content = self::transform_faq_section($content);

        // Step 2: Add id="..." to each <h2>
        $content = self::add_h2_anchors($content);

        // Step 3: Inject middle CTA after the 3rd </h2>...</p> block
        $content = self::inject_middle_cta($content);

        return $content;
    }

    /**
     * Detect a "Frequently Asked Questions" H2 (case-insensitive) and convert
     * the following Q&A paragraphs into an accordion.
     *
     * Q&A paragraph pattern:  <p><strong>Question?</strong> Answer text...</p>
     * Stops when it hits another H2/H3 or a paragraph that doesn't start with <strong>.
     */
    public static function transform_faq_section($content) {
        if (!preg_match('#<h2[^>]*>\s*(?:<strong>)?\s*Frequently Asked Questions\s*(?:</strong>)?\s*</h2>#i', $content, $m, PREG_OFFSET_CAPTURE)) {
            return $content;
        }

        $h2_match   = $m[0][0];
        $h2_offset  = $m[0][1];
        $after_h2   = $h2_offset + strlen($h2_match);

        // Scan forward, collecting Q&A paragraphs
        $rest = substr($content, $after_h2);
        $qa_pattern = '#^\s*<p>\s*<strong>(.+?)</strong>\s*(.*?)</p>#is';
        $items = array();
        $consumed = 0;

        while (preg_match($qa_pattern, $rest, $qm)) {
            $q = trim($qm[1]);
            $a = trim($qm[2]);
            // strip leading punctuation/space from answer
            $a = preg_replace('#^[:\s]+#u', '', $a);
            if ($q && $a) {
                $items[] = array('q' => $q, 'a' => $a);
            }
            $match_len = strlen($qm[0]);
            $consumed += $match_len;
            $rest = substr($rest, $match_len);
            // Stop if next thing isn't another Q&A paragraph
            if (!preg_match('#^\s*<p>\s*<strong>#is', $rest)) break;
        }

        if (empty($items)) return $content;

        // Stash items for the JSON-LD emitter
        self::$faq_items = $items;

        $accordion = self::render_faq_accordion($items);
        // Replace the FAQ H2 + the consumed Q&A block with H2 + accordion
        return substr($content, 0, $after_h2) . $accordion . substr($content, $after_h2 + $consumed);
    }

    private static $faq_items = array();

    /** Output FAQPage JSON-LD for SEO when the current post has an FAQ section. */
    public static function faq_jsonld() {
        if (!is_singular('post')) return;

        // Trigger the filter side-effect (populates self::$faq_items)
        // by running the transform on the raw post content.
        $post = get_post();
        if (!$post) return;
        self::$faq_items = array();
        self::transform_faq_section($post->post_content);

        if (empty(self::$faq_items)) return;

        $entities = array();
        foreach (self::$faq_items as $qa) {
            $entities[] = array(
                '@type' => 'Question',
                'name'  => wp_strip_all_tags($qa['q']),
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => wp_strip_all_tags($qa['a']),
                ),
            );
        }
        $data = array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $entities,
        );
        echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
    }

    private static function render_faq_accordion($items) {
        ob_start();
        ?>
<div class="pcb-faq">
<?php foreach ($items as $i => $qa) : ?>
  <details class="pcb-faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
    <summary class="pcb-faq-q">
      <span class="pcb-faq-q-text"><?php echo wp_kses_post($qa['q']); ?></span>
      <span class="pcb-faq-q-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </span>
    </summary>
    <div class="pcb-faq-a"><p><?php echo wp_kses_post($qa['a']); ?></p></div>
  </details>
<?php endforeach; ?>
</div>
        <?php
        return ob_get_clean();
    }

    /**
     * Adds unique id="..." attributes to all <h2> tags in the content.
     * Slug is derived from the heading text.
     */
    public static function add_h2_anchors($content) {
        $used_slugs = array();

        return preg_replace_callback(
            '#<h2([^>]*)>(.*?)</h2>#is',
            function($m) use (&$used_slugs) {
                $attrs = $m[1];
                $inner = $m[2];

                // If there's already an id, leave it alone
                if (preg_match('/\sid\s*=/i', $attrs)) return $m[0];

                $text = trim(wp_strip_all_tags($inner));
                $slug = sanitize_title($text);
                if (!$slug) $slug = 'section';

                // Ensure uniqueness
                $base = $slug; $i = 2;
                while (in_array($slug, $used_slugs, true)) {
                    $slug = $base . '-' . $i++;
                }
                $used_slugs[] = $slug;

                return '<h2 id="' . esc_attr($slug) . '"' . $attrs . '>' . $inner . '</h2>';
            },
            $content
        );
    }

    /**
     * Finds the 3rd </h2> tag and injects the CTA panel before the next </p>
     * (so the CTA appears after the H2 + its following paragraph).
     * If there are fewer than 3 H2s, injects before the last </h2> section,
     * or skips gracefully if the post is very short.
     */
    public static function inject_middle_cta($content) {
        $cta_html = self::render_middle_cta();

        // Find all </h2> positions
        preg_match_all('#</h2>#i', $content, $matches, PREG_OFFSET_CAPTURE);
        if (empty($matches[0])) return $content;

        $h2_count = count($matches[0]);

        // Target: after the 3rd H2, or roughly the middle if fewer exist
        if ($h2_count >= 3) {
            $target_h2_end = $matches[0][2][1] + strlen($matches[0][2][0]);
        } elseif ($h2_count >= 2) {
            $target_h2_end = $matches[0][1][1] + strlen($matches[0][1][0]);
        } else {
            // Only 1 H2 — post is short, skip middle CTA (end CTA still shows)
            return $content;
        }

        // Find the first </p> after this H2 end
        $next_p_pos = stripos($content, '</p>', $target_h2_end);
        if ($next_p_pos === false) {
            // No following paragraph — inject right after the H2
            return substr($content, 0, $target_h2_end) . $cta_html . substr($content, $target_h2_end);
        }

        $inject_at = $next_p_pos + strlen('</p>');
        return substr($content, 0, $inject_at) . $cta_html . substr($content, $inject_at);
    }

    /**
     * Middle CTA HTML (reused by inject_middle_cta).
     * Styled in blog-style.css under .pcb-cta-mid
     */
    public static function render_middle_cta() {
        $contact = esc_url(home_url('/contact/'));
        ob_start();
        ?>
<div class="pcb-cta-mid" role="complementary" aria-label="See PolicyCentral in action">
  <div class="pcb-cta-mid-inner">
    <div class="pcb-cta-mid-icon" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
    </div>
    <div class="pcb-cta-mid-body">
      <div class="pcb-cta-mid-eyebrow">See it in action</div>
      <h3 class="pcb-cta-mid-title">Policies, simplified with <span class="g-text">AI-powered</span> automation</h3>
      <p class="pcb-cta-mid-sub">Book a 20-minute demo to see how PolicyCentral.ai streamlines policy creation, distribution, and compliance across your enterprise.</p>
      <a href="<?php echo $contact; ?>" class="btn btn-primary pcb-cta-mid-btn">Book a Demo
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
  </div>
</div>
        <?php
        return ob_get_clean();
    }

    /**
     * Calculate estimated reading time in minutes.
     * Based on 200 words per minute (industry standard).
     */
    public static function reading_time($content = null, $post_id = null) {
        if ($content === null) {
            if ($post_id === null) $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);
        }
        $text = wp_strip_all_tags($content);
        $word_count = str_word_count($text);
        $minutes = max(1, (int) ceil($word_count / 200));
        return $minutes;
    }

    /**
     * Build a TOC array from the post content by finding all <h2>s.
     * Returns array of ['id' => '...', 'text' => '...'].
     */
    public static function build_toc($content = null, $post_id = null) {
        if ($content === null) {
            if ($post_id === null) $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);
        }

        // Apply our anchor filter first so we have IDs to link to
        $content = self::add_h2_anchors($content);

        preg_match_all('#<h2[^>]*\sid\s*=\s*["\']([^"\']+)["\'][^>]*>(.*?)</h2>#is', $content, $m);

        $toc = array();
        if (!empty($m[1])) {
            foreach ($m[1] as $i => $id) {
                $toc[] = array(
                    'id'   => $id,
                    'text' => wp_strip_all_tags($m[2][$i]),
                );
            }
        }
        return $toc;
    }
}

/* ──────────── Convenience template functions ──────────── */

function pcb_reading_time($post_id = null) {
    return PCB_Content::reading_time(null, $post_id);
}

function pcb_build_toc($post_id = null) {
    return PCB_Content::build_toc(null, $post_id);
}

function pcb_end_cta() {
    $contact = esc_url(home_url('/contact/'));
    ob_start();
    ?>
<aside class="pcb-cta-end" aria-label="Contact PolicyCentral">
  <div class="pcb-cta-end-grid">
    <div class="pcb-cta-end-left">
      <div class="pcb-cta-end-eyebrow">Ready to see PolicyCentral in action?</div>
      <h3 class="pcb-cta-end-title">Transform how your enterprise manages <span class="g-text">policies</span></h3>
      <p class="pcb-cta-end-sub">Join leading BFSI &amp; enterprise teams using PolicyCentral.ai for compliant, AI-powered policy distribution.</p>
      <div class="pcb-cta-end-actions">
        <a href="<?php echo $contact; ?>" class="btn btn-primary">Book a Demo
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <a href="<?php echo esc_url(home_url('/features/')); ?>" class="btn btn-secondary">Explore Features</a>
      </div>
    </div>
    <div class="pcb-cta-end-right" aria-hidden="true">
      <div class="pcb-cta-end-orb">
        <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
          <rect x="10" y="8" width="44" height="48" rx="4"/>
          <line x1="18" y1="20" x2="46" y2="20"/>
          <line x1="18" y1="30" x2="46" y2="30"/>
          <line x1="18" y1="40" x2="36" y2="40"/>
          <circle cx="46" cy="46" r="10" fill="#fff" stroke="currentColor"/>
          <polyline points="42 46 45 49 51 43"/>
        </svg>
      </div>
    </div>
  </div>
</aside>
    <?php
    return ob_get_clean();
}
