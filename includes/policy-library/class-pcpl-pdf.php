<?php
/**
 * Policy Library — PDF renderer (personalized policy template).
 *
 * Uses the vendored FPDF to lay out a policy's title, byline, document body
 * (parsed from the stored section HTML) and FAQs, with the [Company Name]
 * placeholder swapped for the requester's company.
 */
defined('ABSPATH') || exit;

require_once PCPL_DIR . '/vendor/fpdf.php';

class PCPL_PDF extends FPDF {

    public $doc_title = '';

    function Header() {
        $this->SetFillColor(15, 118, 110);
        $this->Rect(0, 0, 210, 16, 'F');
        $this->SetFont('Helvetica', 'B', 12);
        $this->SetTextColor(255, 255, 255);
        $this->SetXY(14, 4.5);
        $this->Cell(0, 7, 'PolicyCentral.ai', 0, 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->SetXY(0, 5);
        $this->Cell(196, 7, 'Policy Template', 0, 0, 'R');
        $this->SetY(26);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'I', 7.5);
        $this->SetTextColor(150, 150, 150);
        $this->MultiCell(0, 4,
            self::latin1('This template is provided by PolicyCentral.ai as a starting point and is not legal advice. Review and adapt it with your compliance/legal team. Page ') . $this->PageNo(),
            0, 'C');
    }

    public static function latin1($s) {
        $s = str_replace(
            array('“', '”', '‘', '’', '–', '—', '•', '₹', '…', "\xc2\xa0"),
            array('"', '"', "'", "'", '-', '-', '-', 'Rs ', '...', ' '),
            (string) $s
        );
        $out = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $s);
        return $out === false ? preg_replace('/[^\x20-\x7E]/', '', $s) : $out;
    }

    private function h2($text) {
        $this->Ln(3);
        $this->SetFont('Helvetica', 'B', 13);
        $this->SetTextColor(17, 24, 39);
        $this->MultiCell(0, 7, self::latin1($text), 0, 'L');
        $this->SetDrawColor(23, 157, 151);
        $this->SetLineWidth(0.5);
        $y = $this->GetY();
        $this->Line(14, $y + 1, 60, $y + 1);
        $this->Ln(4);
    }

    private function para($text) {
        $this->SetFont('Helvetica', '', 10.5);
        $this->SetTextColor(55, 65, 81);
        $this->MultiCell(0, 5.6, self::latin1($text), 0, 'L');
        $this->Ln(1.5);
    }

    private function bullet($text) {
        $this->SetFont('Helvetica', '', 10.5);
        $x = $this->GetX();
        $this->SetTextColor(23, 157, 151);
        $this->Cell(5, 5.6, self::latin1('-'), 0, 0);
        $this->SetTextColor(55, 65, 81);
        $this->MultiCell(0, 5.6, self::latin1($text), 0, 'L');
        $this->SetX($x);
    }

    /** Number of lines a string of the current font wraps to at width $w (mm). */
    private function NbLines($w, $txt) {
        $cw = $this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string) $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] === "\n") $nb--;
        $sep = -1; $i = 0; $j = 0; $l = 0; $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") { $i++; $sep = -1; $j = $i; $l = 0; $nl++; continue; }
            if ($c === ' ') $sep = $i;
            $l += isset($cw[$c]) ? $cw[$c] : 0;
            if ($l > $wmax) {
                if ($sep == -1) { if ($i == $j) $i++; } else { $i = $sep + 1; }
                $sep = -1; $j = $i; $l = 0; $nl++;
            } else { $i++; }
        }
        return $nl;
    }

    /** Closing CTA panel: platform capabilities + clickable link + QR to the policy page. */
    private function platform_panel($url, $qr_path) {
        $x = 14; $w = 182; $pad = 5; $accent = 2; $qr = 30; $gap = 6;
        $qx = $x + $w - $pad - $qr;                 // QR left edge
        $tx = $x + $accent + $pad;                  // text left
        $textW = ($qx - $gap) - $tx;                // text column width

        $title  = 'Do more with this policy on PolicyCentral.ai';
        $intro  = 'This template is a static starting point. On the platform, a policy like this becomes living:';
        $bullets = array(
            'Translate into 11 languages: English, Hindi, Marathi, Gujarati, Punjabi, Tamil, Telugu, Bengali, Kannada, Malayalam, Urdu',
            'Listen to an audio version and read the transcript',
            'Ask questions and get instant answers with AI (PolicyGPT)',
            'Auto-generate summaries, FAQs and infographics',
            'Distribute, version and track acknowledgement across your workforce',
        );

        // Measure text height.
        $this->SetFont('Helvetica', 'B', 12); $tL = $this->NbLines($textW, self::latin1($title));
        $this->SetFont('Helvetica', '', 9);   $iL = $this->NbLines($textW, self::latin1($intro));
        $bL = 0; foreach ($bullets as $b) $bL += $this->NbLines($textW - 4, self::latin1($b));
        $textH = $tL * 5.5 + 1.5 + $iL * 4.6 + 1 + $bL * 4.6 + 2 + 5;
        $H = $pad + max($textH, $qr + 4) + $pad + 1;

        $this->Ln(4);
        if ($this->GetY() + $H > $this->PageBreakTrigger) $this->AddPage();
        $y0 = $this->GetY();

        $this->SetFillColor(248, 250, 252);
        $this->SetDrawColor(15, 118, 110);
        $this->SetLineWidth(0.4);
        $this->Rect($x, $y0, $w, $H, 'FD');
        $this->SetFillColor(15, 118, 110);
        $this->Rect($x, $y0, $accent, $H, 'F');

        if ($qr_path && file_exists($qr_path)) {
            $qy = $y0 + $pad;
            $this->Image($qr_path, $qx, $qy, $qr, $qr, 'PNG');
            $this->SetFont('Helvetica', '', 7); $this->SetTextColor(107, 114, 128);
            $this->SetXY($qx, $qy + $qr + 0.5); $this->Cell($qr, 3, self::latin1('Scan to open'), 0, 0, 'C');
        }

        $this->SetXY($tx, $y0 + $pad);
        $this->SetFont('Helvetica', 'B', 12); $this->SetTextColor(17, 24, 39);
        $this->MultiCell($textW, 5.5, self::latin1($title), 0, 'L');
        $this->SetX($tx);
        $this->SetFont('Helvetica', '', 9); $this->SetTextColor(75, 85, 99);
        $this->MultiCell($textW, 4.6, self::latin1($intro), 0, 'L');
        $this->Ln(1);
        foreach ($bullets as $b) {
            $this->SetX($tx);
            $this->SetTextColor(15, 118, 110); $this->SetFont('Helvetica', 'B', 9);
            $this->Cell(4, 4.6, self::latin1('>'), 0, 0);
            $this->SetTextColor(55, 65, 81); $this->SetFont('Helvetica', '', 9);
            $this->MultiCell($textW - 4, 4.6, self::latin1($b), 0, 'L');
        }
        $this->Ln(1.5);
        $this->SetX($tx);
        $this->SetFont('Helvetica', 'B', 9); $this->SetTextColor(15, 118, 110);
        $this->Cell($textW, 5, self::latin1('Open this policy on PolicyCentral.ai  >'), 0, 1, 'L', false, $url);

        $this->SetY($y0 + $H);
        $this->Ln(2);
    }

    /** Tinted "PolicyCentral AI Enhancement" panel: eyebrow label + body text. */
    private function ai_panel($eyebrow, $text) {
        $x = 14; $w = 182; $pad = 4; $accent = 1.6;
        $innerW = $w - 2 * $pad - $accent;

        $this->SetFont('Helvetica', 'B', 7.5);
        $ebLines = $this->NbLines($innerW, self::latin1($eyebrow));
        $this->SetFont('Helvetica', '', 10);
        $txtLines = $this->NbLines($innerW, self::latin1($text));
        $ebH = $ebLines * 4.4; $txtH = $txtLines * 5.4;
        $H = $pad + $ebH + 1.5 + $txtH + $pad;

        $this->Ln(3);
        if ($this->GetY() + $H > $this->PageBreakTrigger) $this->AddPage();
        $y0 = $this->GetY();

        $this->SetFillColor(224, 247, 246);           // teal-lt background
        $this->Rect($x, $y0, $w, $H, 'F');
        $this->SetFillColor(15, 118, 110);            // teal accent bar
        $this->Rect($x, $y0, $accent, $H, 'F');

        $this->SetXY($x + $accent + $pad, $y0 + $pad);
        $this->SetFont('Helvetica', 'B', 7.5);
        $this->SetTextColor(15, 118, 110);
        $this->MultiCell($innerW, 4.4, self::latin1($eyebrow), 0, 'L');

        $this->SetX($x + $accent + $pad);
        $this->SetFont('Helvetica', '', 10);
        $this->SetTextColor(55, 65, 81);
        $this->MultiCell($innerW, 5.4, self::latin1($text), 0, 'L');

        $this->SetY($y0 + $H);
        $this->Ln(4);
    }

    public static function build($policy, $company, $enh = array()) {
        $company = trim((string) $company) !== '' ? $company : '[Company Name]';
        $swap = function ($t) use ($company) {
            return str_replace('[Company Name]', $company, (string) $t);
        };

        $pdf = new self();
        $pdf->doc_title = $policy['title'];
        $pdf->SetTitle($policy['title']);
        $pdf->SetAuthor('PolicyCentral.ai');
        $pdf->SetMargins(14, 26, 14);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->AddPage();

        $pdf->SetFont('Helvetica', 'B', 20);
        $pdf->SetTextColor(17, 24, 39);
        $pdf->MultiCell(0, 9, self::latin1($policy['title']), 0, 'L');
        $pdf->Ln(1);
        if (!empty($policy['byline'])) {
            $pdf->SetFont('Helvetica', '', 10.5);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->MultiCell(0, 5.4, self::latin1($swap($policy['byline'])), 0, 'L');
        }
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'I', 9);
        $pdf->SetTextColor(15, 118, 110);
        $pdf->Cell(0, 6, self::latin1('Prepared for: ' . $company), 0, 1, 'L');
        $pdf->SetDrawColor(229, 231, 235);
        $pdf->SetLineWidth(0.3);
        $pdf->Line(14, $pdf->GetY() + 1, 196, $pdf->GetY() + 1);
        $pdf->Ln(5);

        // AI Summary panel (PolicyCentral AI Enhancement), if generated.
        if (!empty($enh['summary'])) {
            $pdf->ai_panel(
                'PolicyCentral AI Enhancement  ·  Summary',
                $swap($enh['summary'])
            );
        }

        $body = $swap($policy['body']);
        if (preg_match_all('#<section[^>]*>(.*?)</section>#is', $body, $secs)) {
            foreach ($secs[1] as $sec) {
                if (preg_match('#<h2[^>]*>(.*?)</h2>#is', $sec, $h)) {
                    $pdf->h2(html_entity_decode(wp_strip_all_tags($h[1]), ENT_QUOTES, 'UTF-8'));
                }
                if (preg_match_all('#<(p|li)[^>]*>(.*?)</\1>#is', $sec, $els, PREG_SET_ORDER)) {
                    foreach ($els as $el) {
                        $txt = trim(html_entity_decode(wp_strip_all_tags($el[2]), ENT_QUOTES, 'UTF-8'));
                        if ($txt === '') continue;
                        if (strtolower($el[1]) === 'li') $pdf->bullet($txt);
                        else $pdf->para($txt);
                    }
                }
            }
        }

        $ai_faqs = !empty($enh['ai_faqs']) && is_array($enh['ai_faqs']) ? $enh['ai_faqs'] : array();
        if (!empty($policy['faqs']) || $ai_faqs) {
            $pdf->h2('Frequently Asked Questions');
            $render_faq = function ($f) use ($pdf, $swap) {
                $q = isset($f['q']) ? $swap($f['q']) : '';
                $a = isset($f['a']) ? $swap($f['a']) : '';
                if ($q === '') return;
                $pdf->SetFont('Helvetica', 'B', 10.5);
                $pdf->SetTextColor(31, 41, 55);
                $pdf->MultiCell(0, 5.6, self::latin1($q), 0, 'L');
                $pdf->SetFont('Helvetica', '', 10.5);
                $pdf->SetTextColor(75, 85, 99);
                $pdf->MultiCell(0, 5.6, self::latin1($a), 0, 'L');
                $pdf->Ln(2.5);
            };
            foreach (($policy['faqs'] ?? array()) as $f) $render_faq($f);

            if ($ai_faqs) {
                $pdf->Ln(1);
                $pdf->SetFont('Helvetica', 'B', 8);
                $pdf->SetTextColor(15, 118, 110);
                $pdf->Cell(0, 5, self::latin1('PolicyCentral AI Enhancement  ·  More questions, answered'), 0, 1, 'L');
                $pdf->Ln(1.5);
                foreach ($ai_faqs as $f) $render_faq($f);
            }
        }

        if (!empty($enh['policy_url'])) {
            $pdf->platform_panel($enh['policy_url'], isset($enh['qr_path']) ? $enh['qr_path'] : '');
        }

        return $pdf->Output('S');
    }
}
