<?php
/**
 * Category Icons & Cover Art
 *
 * Central registry for per-category SVG icons and cover art. Keyed by
 * category slug. Used in:
 *  - Sidebar "Recent Posts" fallback thumbs
 *  - Blog card cover art fallback (when no featured image)
 *  - (Potentially) category page heros
 *
 * Design language matches the user's hand-illustrated blog images:
 *   dark navy gradient + subtle grid + corner brackets + category name
 *   badge + bright accent motif + watermark. Each category has its own
 *   dominant accent palette so cards feel distinct, not monotone.
 */

if (!defined('ABSPATH')) exit;

class PCB_Icons {

    /**
     * Master registry.
     * - `accents`: [bright, mid, dark] — used in motif
     * - `orbs`   : [teal, violet, warm] — always 3 for richness, hue mixed
     * - `label`  : monospace header on the cover card
     * - `motif`  : key for the motif render function
     */
    private static function registry() {
        return array(
            'policy-management-software' => array(
                'accents' => array('#5EEAD4', '#179D97', '#0F766E'),
                'orbs'    => array('#179D97', '#7C3AED', '#F59E0B'),
                'label'   => 'POLICY MANAGEMENT SOFTWARE',
                'motif'   => 'shield-doc',
            ),
            'hr-policy-management' => array(
                'accents' => array('#A78BFA', '#7C3AED', '#5B21B6'),
                'orbs'    => array('#7C3AED', '#179D97', '#F59E0B'),
                'label'   => 'HR POLICY MANAGEMENT',
                'motif'   => 'people-doc',
            ),
            'corporate-updates' => array(
                'accents' => array('#818CF8', '#4338CA', '#312E81'),
                'orbs'    => array('#4338CA', '#7C3AED', '#5EEAD4'),
                'label'   => 'CORPORATE UPDATES',
                'motif'   => 'megaphone',
            ),
            'product-information' => array(
                'accents' => array('#34D399', '#059669', '#047857'),
                'orbs'    => array('#059669', '#179D97', '#7C3AED'),
                'label'   => 'PRODUCT INFORMATION',
                'motif'   => 'package',
            ),
            'sops' => array(
                'accents' => array('#FCD34D', '#F59E0B', '#B45309'),
                'orbs'    => array('#F59E0B', '#059669', '#7C3AED'),
                'label'   => 'STANDARD OPERATING PROCEDURES',
                'motif'   => 'checklist',
            ),
            'branch-circulars' => array(
                'accents' => array('#FB7185', '#E11D48', '#9F1239'),
                'orbs'    => array('#E11D48', '#7C3AED', '#5EEAD4'),
                'label'   => 'BRANCH CIRCULARS',
                'motif'   => 'globe',
            ),
            'business-req-docs' => array(
                'accents' => array('#5EEAD4', '#179D97', '#0F766E'),
                'orbs'    => array('#179D97', '#059669', '#A78BFA'),
                'label'   => 'BUSINESS REQUIREMENTS',
                'motif'   => 'blueprint',
            ),
            'default' => array(
                'accents' => array('#5EEAD4', '#179D97', '#0F766E'),
                'orbs'    => array('#179D97', '#7C3AED', '#F59E0B'),
                'label'   => 'POLICYCENTRAL BLOG',
                'motif'   => 'default',
            ),
        );
    }

    /**
     * Small icon SVG for sidebar recent-post thumbs. Kept minimal (monoline).
     */
    public static function icon($category_slug) {
        $svgs = array(
            'policy-management-software' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 11h6M9 14h6"/></svg>',
            'hr-policy-management'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M3 21v-1a6 6 0 0 1 6-6"/><rect x="13" y="10" width="8" height="11" rx="1.5"/><path d="M15 14h4M15 17h4"/></svg>',
            'corporate-updates'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11v2a2 2 0 0 0 2 2h1l4 4V5L6 9H5a2 2 0 0 0-2 2z"/><path d="M15 8a5 5 0 0 1 0 8"/><path d="M19 5a9 9 0 0 1 0 14"/></svg>',
            'product-information'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9-4 9 4v10l-9 4-9-4V7z"/><path d="M3 7l9 4 9-4"/><path d="M12 11v10"/></svg>',
            'sops'                       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8l1.5 1.5L13 7"/><path d="M9 14l1.5 1.5L13 13"/><path d="M15.5 8.5h.01M15.5 14.5h.01"/></svg>',
            'branch-circulars'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18 14 14 0 0 1 0-18z"/></svg>',
            'business-req-docs'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 4v16M3 14h6M15 14h6"/></svg>',
            'default'                    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>',
        );
        return $svgs[$category_slug] ?? $svgs['default'];
    }

    /**
     * Full-bleed cover art — dark editorial composition matching the
     * user's hand-illustrated blog hero images.
     */
    public static function cover($category_slug) {
        $r = self::registry();
        $conf = $r[$category_slug] ?? $r['default'];

        // Unique suffix per render to avoid gradient/pattern ID collisions
        // on a page with multiple covers
        $u = 'c' . substr(md5($category_slug . mt_rand() . microtime(true)), 0, 7);

        $a = $conf['accents'];   // [bright, mid, dark]
        $o = $conf['orbs'];      // [primary, accent, warm]
        $label = esc_html($conf['label']);
        $motif = self::render_motif($conf['motif'], $a, $u);

        ob_start(); ?>
<svg class="pcb-cover-svg" viewBox="0 0 640 360" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" role="presentation" aria-hidden="true">
  <defs>
    <linearGradient id="<?php echo $u; ?>-bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%"   stop-color="#0a1a33"/>
      <stop offset="55%"  stop-color="#1a1b4d"/>
      <stop offset="100%" stop-color="#2d1a56"/>
    </linearGradient>
    <pattern id="<?php echo $u; ?>-grid" width="26" height="26" patternUnits="userSpaceOnUse">
      <path d="M 26 0 L 0 0 0 26" fill="none" stroke="<?php echo esc_attr($a[0]); ?>" stroke-width="0.3" opacity=".2"/>
    </pattern>
    <radialGradient id="<?php echo $u; ?>-o1" cx="50%" cy="50%" r="50%">
      <stop offset="0%" stop-color="<?php echo esc_attr($o[0]); ?>" stop-opacity=".55"/>
      <stop offset="100%" stop-color="<?php echo esc_attr($o[0]); ?>" stop-opacity="0"/>
    </radialGradient>
    <radialGradient id="<?php echo $u; ?>-o2" cx="50%" cy="50%" r="50%">
      <stop offset="0%" stop-color="<?php echo esc_attr($o[1]); ?>" stop-opacity=".5"/>
      <stop offset="100%" stop-color="<?php echo esc_attr($o[1]); ?>" stop-opacity="0"/>
    </radialGradient>
    <radialGradient id="<?php echo $u; ?>-o3" cx="50%" cy="50%" r="50%">
      <stop offset="0%" stop-color="<?php echo esc_attr($o[2]); ?>" stop-opacity=".35"/>
      <stop offset="100%" stop-color="<?php echo esc_attr($o[2]); ?>" stop-opacity="0"/>
    </radialGradient>
  </defs>

  <!-- Background + grid -->
  <rect width="640" height="360" fill="url(#<?php echo $u; ?>-bg)"/>
  <rect width="640" height="360" fill="url(#<?php echo $u; ?>-grid)"/>

  <!-- Ambient color orbs (3, category-colored) -->
  <circle cx="80"  cy="70"  r="190" fill="url(#<?php echo $u; ?>-o1)"/>
  <circle cx="560" cy="300" r="220" fill="url(#<?php echo $u; ?>-o2)"/>
  <circle cx="510" cy="60"  r="120" fill="url(#<?php echo $u; ?>-o3)"/>

  <!-- Corner brackets -->
  <path d="M 40 32 L 40 48 L 56 48" fill="none" stroke="<?php echo esc_attr($a[0]); ?>" stroke-width="1.5" opacity=".85"/>
  <path d="M 600 328 L 600 312 L 584 312" fill="none" stroke="<?php echo esc_attr($o[1]); ?>" stroke-width="1.5" opacity=".75"/>

  <!-- Left accent stripe (3-color) -->
  <rect x="24" y="32" width="3" height="96"  rx="1.5" fill="<?php echo esc_attr($a[0]); ?>"/>
  <rect x="24" y="132" width="3" height="96" rx="1.5" fill="<?php echo esc_attr($o[1]); ?>" opacity=".85"/>
  <rect x="24" y="232" width="3" height="96" rx="1.5" fill="<?php echo esc_attr($o[2]); ?>" opacity=".7"/>

  <!-- Top monospace label -->
  <text x="60" y="50" font-family="'Courier New', monospace" font-size="10" fill="<?php echo esc_attr($a[0]); ?>" opacity=".9" letter-spacing="2" font-weight="700"><?php echo $label; ?></text>

  <!-- Motif -->
  <?php echo $motif; ?>

  <!-- Watermark -->
  <text x="604" y="344" font-family="'Courier New', monospace" font-size="9" fill="<?php echo esc_attr($a[0]); ?>" opacity=".55" text-anchor="end" letter-spacing="2">POLICYCENTRAL.AI</text>
</svg>
<?php
        return ob_get_clean();
    }

    /**
     * Motif renderer. Each motif is a vibrant editorial composition positioned
     * roughly center-right of the 640x360 viewBox, with the top-left reserved
     * for the category label and decorative brackets.
     *
     * @param string $key    motif key
     * @param array  $a      accents [bright, mid, dark]
     * @param string $u      unique id suffix for gradient refs
     */
    private static function render_motif($key, $a, $u) {
        $A0 = esc_attr($a[0]); // bright
        $A1 = esc_attr($a[1]); // mid
        // $a[2] reserved for future use
        switch ($key) {

            case 'shield-doc':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="1">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="{$A1}"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <!-- Big heading -->
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">ENTERPRISE</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">POLICY CORE</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">End-to-end policy lifecycle management</text>
</g>
<!-- Shield + doc motif (right) -->
<g transform="translate(430, 90)">
  <path d="M60 0 L120 22 V84 C120 124 60 156 60 156 C60 156 0 124 0 84 V22 Z" fill="rgba(94,234,212,0.08)" stroke="{$A0}" stroke-width="2.5" stroke-linejoin="round"/>
  <rect x="28" y="42" width="64" height="54" rx="4" fill="#0a1a33" stroke="{$A0}" stroke-width="2"/>
  <line x1="38" y1="58" x2="82" y2="58" stroke="{$A0}" stroke-width="2" stroke-linecap="round"/>
  <line x1="38" y1="70" x2="82" y2="70" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".7"/>
  <line x1="38" y1="82" x2="68" y2="82" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".5"/>
  <circle cx="60" cy="116" r="10" fill="{$A1}"/>
  <path d="M54 116 L58 120 L66 112" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</g>
SVG;

            case 'people-doc':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#F59E0B"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">HR POLICIES</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">FOR HUMANS</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Compliant, clear, and every employee reads them</text>
</g>
<g transform="translate(440, 110)">
  <!-- Three avatars -->
  <circle cx="30" cy="30" r="22" fill="rgba(167,139,250,0.15)" stroke="{$A0}" stroke-width="2"/>
  <circle cx="30" cy="22" r="8" fill="{$A0}"/>
  <path d="M12 46 Q12 34 30 34 Q48 34 48 46" fill="{$A0}" opacity=".3"/>
  <circle cx="82" cy="36" r="24" fill="rgba(245,158,11,0.15)" stroke="#F59E0B" stroke-width="2"/>
  <circle cx="82" cy="28" r="8" fill="#F59E0B"/>
  <path d="M62 54 Q62 40 82 40 Q102 40 102 54" fill="#F59E0B" opacity=".3"/>
  <circle cx="140" cy="42" r="22" fill="rgba(94,234,212,0.15)" stroke="#5EEAD4" stroke-width="2"/>
  <circle cx="140" cy="34" r="8" fill="#5EEAD4"/>
  <path d="M122 58 Q122 46 140 46 Q158 46 158 58" fill="#5EEAD4" opacity=".3"/>
  <!-- Doc behind -->
  <rect x="0" y="90" width="160" height="56" rx="5" fill="rgba(167,139,250,0.08)" stroke="{$A0}" stroke-width="1.5"/>
  <line x1="16" y1="108" x2="120" y2="108" stroke="{$A0}" stroke-width="2" stroke-linecap="round"/>
  <line x1="16" y1="122" x2="100" y2="122" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".7"/>
  <circle cx="140" cy="118" r="8" fill="#F59E0B"/>
  <path d="M136 118 L139 121 L144 115" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</g>
SVG;

            case 'megaphone':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#7C3AED"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">LEADERSHIP</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">TO EVERY DESK</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Board updates. Strategy notes. Announcements.</text>
</g>
<g transform="translate(440, 105)">
  <!-- Megaphone -->
  <path d="M0 60 V100 Q0 110 10 110 H30 L100 150 V20 L30 60 H10 Q0 60 0 70 Z" fill="rgba(129,140,248,0.12)" stroke="{$A0}" stroke-width="2.5" stroke-linejoin="round"/>
  <!-- Broadcast arcs -->
  <path d="M110 65 Q140 90 110 115" fill="none" stroke="#5EEAD4" stroke-width="2.5" stroke-linecap="round"/>
  <path d="M125 48 Q165 90 125 132" fill="none" stroke="#A78BFA" stroke-width="2.5" stroke-linecap="round" opacity=".85"/>
  <path d="M140 30 Q190 90 140 150" fill="none" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round" opacity=".7"/>
  <!-- Badge on handle -->
  <circle cx="20" cy="140" r="14" fill="#F59E0B"/>
  <text x="20" y="145" text-anchor="middle" font-family="'Courier New', monospace" font-size="14" font-weight="700" fill="#0a1a33">!</text>
</g>
SVG;

            case 'package':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#179D97"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">SHIP &amp; SHARE</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">PRODUCT DOCS</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Release notes, specs, and guidelines in one place</text>
</g>
<g transform="translate(440, 90)">
  <!-- Isometric-ish package -->
  <path d="M80 0 L160 40 V130 L80 170 L0 130 V40 Z" fill="rgba(52,211,153,0.12)" stroke="{$A0}" stroke-width="2.5" stroke-linejoin="round"/>
  <path d="M0 40 L80 80 L160 40" fill="none" stroke="{$A0}" stroke-width="2.5" stroke-linejoin="round"/>
  <path d="M80 80 V170" fill="none" stroke="{$A0}" stroke-width="2.5" opacity=".7"/>
  <!-- Tape -->
  <rect x="40" y="20" width="80" height="12" fill="#F59E0B" opacity=".9" transform="rotate(-3 80 26)"/>
  <text x="80" y="30" text-anchor="middle" font-family="'Courier New', monospace" font-size="8" font-weight="700" fill="#0a1a33" letter-spacing="1">SHIP v2.1</text>
  <!-- Sparkle -->
  <path d="M140 70 L143 78 L151 81 L143 84 L140 92 L137 84 L129 81 L137 78 Z" fill="#5EEAD4"/>
</g>
SVG;

            case 'checklist':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#F59E0B"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">STANDARD</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">OPERATING</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Every step documented. Every outcome repeatable.</text>
</g>
<g transform="translate(440, 90)">
  <!-- Clipboard -->
  <rect x="10" y="20" width="160" height="220" rx="8" fill="rgba(252,211,77,0.10)" stroke="{$A0}" stroke-width="2.5"/>
  <rect x="62" y="10" width="56" height="22" rx="4" fill="#F59E0B"/>
  <text x="90" y="26" text-anchor="middle" font-family="'Courier New', monospace" font-size="10" font-weight="700" fill="#0a1a33" letter-spacing="2">SOP-042</text>
  <!-- Items -->
  <g transform="translate(28, 56)">
    <rect x="0" y="0" width="16" height="16" rx="3" fill="#5EEAD4"/>
    <path d="M4 8 L7 11 L13 5" fill="none" stroke="#0a1a33" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    <line x1="26" y1="8" x2="120" y2="8" stroke="{$A0}" stroke-width="2" stroke-linecap="round"/>
  </g>
  <g transform="translate(28, 90)">
    <rect x="0" y="0" width="16" height="16" rx="3" fill="#A78BFA"/>
    <path d="M4 8 L7 11 L13 5" fill="none" stroke="#0a1a33" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    <line x1="26" y1="8" x2="110" y2="8" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".8"/>
  </g>
  <g transform="translate(28, 124)">
    <rect x="0" y="0" width="16" height="16" rx="3" fill="none" stroke="{$A0}" stroke-width="2"/>
    <line x1="26" y1="8" x2="100" y2="8" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".55"/>
  </g>
  <g transform="translate(28, 158)">
    <rect x="0" y="0" width="16" height="16" rx="3" fill="none" stroke="{$A0}" stroke-width="2" opacity=".7"/>
    <line x1="26" y1="8" x2="80" y2="8" stroke="{$A0}" stroke-width="2" stroke-linecap="round" opacity=".4"/>
  </g>
</g>
SVG;

            case 'globe':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#A78BFA"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">BRANCH</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">CIRCULARS</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Region-specific notices, instantly targeted</text>
</g>
<g transform="translate(440, 70)">
  <circle cx="100" cy="100" r="90" fill="rgba(251,113,133,0.10)" stroke="{$A0}" stroke-width="2.5"/>
  <ellipse cx="100" cy="100" rx="90" ry="36" fill="none" stroke="{$A0}" stroke-width="1.5" opacity=".55"/>
  <ellipse cx="100" cy="100" rx="36" ry="90" fill="none" stroke="{$A0}" stroke-width="1.5" opacity=".55"/>
  <line x1="10" y1="100" x2="190" y2="100" stroke="{$A0}" stroke-width="1.5" opacity=".4"/>
  <!-- Pins -->
  <circle cx="58"  cy="62"  r="7" fill="#5EEAD4"/>
  <circle cx="58"  cy="62"  r="3" fill="#0a1a33"/>
  <circle cx="140" cy="80"  r="7" fill="#F59E0B"/>
  <circle cx="140" cy="80"  r="3" fill="#0a1a33"/>
  <circle cx="110" cy="150" r="7" fill="#A78BFA"/>
  <circle cx="110" cy="150" r="3" fill="#0a1a33"/>
  <circle cx="78"  cy="128" r="7" fill="#34D399"/>
  <circle cx="78"  cy="128" r="3" fill="#0a1a33"/>
</g>
SVG;

            case 'blueprint':
                return <<<SVG
<defs>
  <linearGradient id="{$u}-ms" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{$A0}"/>
    <stop offset="100%" stop-color="#34D399"/>
  </linearGradient>
</defs>
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">BUSINESS</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="url(#{$u}-ms)" letter-spacing="-0.5">BLUEPRINTS</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Specs, requirements, and project documentation</text>
</g>
<g transform="translate(430, 80)">
  <rect x="0" y="0" width="200" height="200" rx="6" fill="rgba(94,234,212,0.08)" stroke="{$A0}" stroke-width="2.5"/>
  <!-- Grid -->
  <line x1="0" y1="50"  x2="200" y2="50"  stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <line x1="0" y1="100" x2="200" y2="100" stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <line x1="0" y1="150" x2="200" y2="150" stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <line x1="50"  y1="0" x2="50"  y2="200" stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <line x1="100" y1="0" x2="100" y2="200" stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <line x1="150" y1="0" x2="150" y2="200" stroke="{$A0}" stroke-width="1" opacity=".4"/>
  <!-- Highlighted cells -->
  <rect x="0"   y="0"   width="50" height="50" fill="{$A0}" opacity=".25"/>
  <rect x="100" y="50"  width="50" height="50" fill="#34D399" opacity=".35"/>
  <rect x="50"  y="100" width="50" height="50" fill="#A78BFA" opacity=".35"/>
  <rect x="150" y="150" width="50" height="50" fill="#F59E0B" opacity=".35"/>
  <!-- Connect lines -->
  <path d="M25 25 L125 75 L75 125 L175 175" fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="4 4" opacity=".85"/>
  <circle cx="25"  cy="25"  r="5" fill="{$A0}"/>
  <circle cx="125" cy="75"  r="5" fill="#34D399"/>
  <circle cx="75"  cy="125" r="5" fill="#A78BFA"/>
  <circle cx="175" cy="175" r="5" fill="#F59E0B"/>
</g>
SVG;

            default:
                return <<<SVG
<g transform="translate(92, 96)">
  <text x="0" y="40" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="#ffffff" letter-spacing="-0.5">POLICYCENTRAL</text>
  <text x="0" y="78" font-family="'Courier New', monospace" font-size="34" font-weight="700" fill="{$A0}" letter-spacing="-0.5">THE BLOG</text>
  <text x="0" y="108" font-family="'Courier New', monospace" font-size="11" fill="{$A0}" opacity=".85" letter-spacing="1">Insights for policy teams across BFSI &amp; enterprise</text>
</g>
<g transform="translate(440, 90)">
  <rect x="0" y="0" width="160" height="200" rx="6" fill="rgba(94,234,212,0.08)" stroke="{$A0}" stroke-width="2.5"/>
  <line x1="20" y1="40"  x2="140" y2="40"  stroke="{$A0}" stroke-width="2.5"/>
  <line x1="20" y1="70"  x2="140" y2="70"  stroke="{$A0}" stroke-width="2" opacity=".75"/>
  <line x1="20" y1="100" x2="120" y2="100" stroke="{$A0}" stroke-width="2" opacity=".55"/>
  <line x1="20" y1="130" x2="130" y2="130" stroke="{$A0}" stroke-width="2" opacity=".35"/>
  <circle cx="140" cy="165" r="14" fill="#F59E0B"/>
  <path d="M134 165 L138 169 L146 161" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
</g>
SVG;
        }
    }
}
