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

    public static function build($policy, $company) {
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

        if (!empty($policy['faqs'])) {
            $pdf->h2('Frequently Asked Questions');
            foreach ($policy['faqs'] as $f) {
                $q = isset($f['q']) ? $swap($f['q']) : '';
                $a = isset($f['a']) ? $swap($f['a']) : '';
                if ($q === '') continue;
                $pdf->SetFont('Helvetica', 'B', 10.5);
                $pdf->SetTextColor(31, 41, 55);
                $pdf->MultiCell(0, 5.6, self::latin1($q), 0, 'L');
                $pdf->SetFont('Helvetica', '', 10.5);
                $pdf->SetTextColor(75, 85, 99);
                $pdf->MultiCell(0, 5.6, self::latin1($a), 0, 'L');
                $pdf->Ln(2.5);
            }
        }

        return $pdf->Output('S');
    }
}
