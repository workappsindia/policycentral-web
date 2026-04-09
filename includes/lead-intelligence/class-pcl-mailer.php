<?php
/**
 * PCL_Mailer — Email templates for Lead Intelligence
 *
 * - send_user_confirmation($lead_obj) → reuses existing pc_build_user_email() from functions.php
 * - send_admin_notification($lead_obj, $intel_obj|null) → enriched admin email with intelligence block
 *
 * Design: light theme, teal/indigo/purple gradient, matches PolicyCentral's existing brand voice.
 * Uses Plus Jakarta Sans fallback (system font stack for email client compatibility).
 */

defined('ABSPATH') || exit;

class PCL_Mailer {

    /**
     * Send user confirmation email.
     * Reuses the theme's existing pc_build_user_email() + mail routing.
     */
    public static function send_user_confirmation($lead) {
        if (!$lead || empty($lead->email)) return false;

        $first_name = $lead->first_name ?: strtok(trim($lead->full_name), ' ');
        $subject    = "We've got your message, {$first_name}! Our policy? Reply fast.";

        // Reuse the theme's existing user email template
        $body = pc_build_user_email($first_name);

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: PolicyCentral.ai <marketing@policycentral.ai>',
            'Reply-To: ' . $lead->email,
        );

        return wp_mail($lead->email, $subject, $body, $headers);
    }

    /**
     * Send admin notification email.
     * If $intel is provided, includes the enriched intelligence block.
     * If $intel is null (Claude failed), sends basic notification only.
     */
    public static function send_admin_notification($lead, $intel = null) {
        if (!$lead) return false;

        $admin_email = function_exists('pc_get_admin_lead_email')
            ? pc_get_admin_lead_email()
            : get_option('admin_email');

        if (empty($admin_email)) return false;

        $subject = sprintf(
            '[%s] New Lead: %s · %s%s',
            $lead->reference_id ?: 'PC-UNKNOWN',
            $lead->full_name ?: 'Unknown',
            $lead->company ?: 'No company',
            $intel ? ' · ' . (int) $intel->overall_confidence . '% confidence' : ''
        );

        $body = self::build_admin_html($lead, $intel);

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: PolicyCentral.ai <marketing@policycentral.ai>',
            'Reply-To: ' . ($lead->full_name ? "{$lead->full_name} <{$lead->email}>" : $lead->email),
        );

        return wp_mail($admin_email, $subject, $body, $headers);
    }

    /**
     * Build the full admin email HTML.
     */
    private static function build_admin_html($lead, $intel) {
        $ref    = esc_html($lead->reference_id ?: 'PC-UNKNOWN');
        $name   = esc_html($lead->full_name ?: '—');
        $first  = esc_html($lead->first_name ?: strtok(trim($lead->full_name), ' '));
        $co     = esc_html($lead->company ?: '—');
        $email  = esc_html($lead->email ?: '');
        $phone  = esc_html($lead->phone ?: '');
        $msg    = esc_html($lead->message ?: '');
        $ip     = esc_html($lead->ip_address ?: '');
        $ua     = esc_html($lead->user_agent ?: '');
        $os     = esc_html($lead->os ?: '');
        $browser= esc_html($lead->browser ?: '');
        $device = esc_html($lead->device_type ?: '');
        $geo    = esc_html(trim(implode(', ', array_filter(array(
            $lead->geo_city ?? '', $lead->geo_region ?? '', $lead->geo_country ?? ''
        )))));
        $referrer = esc_html($lead->referrer ?: '');
        $page_url = esc_html($lead->page_url ?: '');
        $ts = esc_html($lead->submitted_at ?: current_time('mysql'));

        $phone_raw = preg_replace('/\D/', '', (string) $lead->phone);
        $wa_msg = rawurlencode("Hi {$first}, this is PolicyCentral.ai. We received your enquiry (Ref: {$lead->reference_id}). When's a good time to connect?");

        $intel_html = self::build_intel_section($intel);
        $msg_html = '';
        if (!empty($msg)) {
            $msg_html = '<tr><td style="padding:0 32px 16px;">
                <div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:8px;">Their Message</div>
                <div style="background:#F9FAFB;border-left:3px solid #0694A2;border-radius:0 10px 10px 0;padding:14px 18px;font-size:14px;color:#4B5563;line-height:1.7;">' . $msg . '</div>
            </td></tr>';
        }

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#F3F4F6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F3F4F6;">
<tr><td align="center" style="padding:32px 16px;">
<table role="presentation" width="680" cellpadding="0" cellspacing="0" style="max-width:680px;width:100%;background:#FFFFFF;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.06);">

  <!-- Gradient header -->
  <tr><td style="background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);padding:24px 32px;">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="color:#fff;">
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.75);margin-bottom:4px;">Internal · Lead Alert</div>
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:900;color:#fff;letter-spacing:-.02em;">New Lead Received</div>
        </td>
        <td align="right" style="vertical-align:top;">
          <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#fff;background:rgba(255,255,255,.18);padding:6px 12px;border-radius:20px;font-weight:700;">{$ref}</div>
          <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:rgba(255,255,255,.6);margin-top:6px;">{$ts}</div>
        </td>
      </tr>
    </table>
  </td></tr>

  <!-- Alert banner -->
  <tr><td style="background:#FEF3C7;border-bottom:1px solid #FDE68A;padding:10px 32px;">
    <table width="100%" cellpadding="0" cellspacing="0"><tr>
      <td style="font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:#92400E;letter-spacing:.1em;text-transform:uppercase;">
        ● New Enquiry · Action Required
      </td>
      <td align="right">
        <span style="background:#D97706;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;padding:3px 10px;border-radius:4px;text-transform:uppercase;letter-spacing:.06em;">Respond Within 24h</span>
      </td>
    </tr></table>
  </td></tr>

  <!-- Lead at a glance -->
  <tr><td style="padding:28px 32px 16px;">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">Lead at a Glance</div>
    <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #E5E7EB;border-radius:12px;overflow:hidden;">
      <tr>
        <td width="50%" style="background:#F9FAFB;border-right:1px solid #E5E7EB;padding:14px 18px;vertical-align:top;">
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Contact</div>
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;color:#111827;line-height:1.3;">{$name}</div>
          <div style="font-size:12px;color:#6B7280;margin-top:2px;">{$email}</div>
          <div style="font-size:12px;color:#6B7280;">{$phone}</div>
        </td>
        <td width="50%" style="background:#F9FAFB;padding:14px 18px;vertical-align:top;">
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Company</div>
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;color:#0694A2;line-height:1.3;">{$co}</div>
          <div style="font-size:12px;color:#6B7280;margin-top:2px;">{$geo}</div>
        </td>
      </tr>
    </table>
  </td></tr>

  <!-- Quick actions -->
  <tr><td style="padding:0 32px 20px;">
    <table cellpadding="0" cellspacing="0">
      <tr>
        <td style="padding-right:8px;"><a href="tel:{$phone}" style="display:inline-block;padding:10px 18px;background:#F3F4F6;border:1px solid #E5E7EB;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;color:#0694A2;text-decoration:none;">📞 Call {$first}</a></td>
        <td style="padding-right:8px;"><a href="mailto:{$email}?subject=Re:%20Your%20PolicyCentral.ai%20Enquiry%20-%20{$ref}" style="display:inline-block;padding:10px 18px;background:#F3F4F6;border:1px solid #E5E7EB;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;color:#0694A2;text-decoration:none;">✉️ Email</a></td>
        <td><a href="https://wa.me/{$phone_raw}?text={$wa_msg}" style="display:inline-block;padding:10px 18px;background:#F3F4F6;border:1px solid #E5E7EB;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;color:#25D366;text-decoration:none;">WhatsApp</a></td>
      </tr>
    </table>
  </td></tr>

  {$msg_html}

  <!-- Divider -->
  <tr><td style="padding:0 32px;"><div style="height:1px;background:#E5E7EB;"></div></td></tr>

  <!-- Intelligence section (or fallback message) -->
  {$intel_html}

  <!-- Divider -->
  <tr><td style="padding:0 32px;"><div style="height:1px;background:#E5E7EB;"></div></td></tr>

  <!-- Full details -->
  <tr><td style="padding:24px 32px 16px;">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">Session &amp; Tracking</div>
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;overflow:hidden;">
      <tr>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;width:140px;">IP Address</td>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:12px;color:#4B5563;">{$ip}</td>
      </tr>
      <tr>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;">Device</td>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:12px;color:#4B5563;">{$browser} · {$os} · {$device}</td>
      </tr>
      <tr>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">Page URL</td>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#2563EB;word-break:break-all;">{$page_url}</td>
      </tr>
      <tr>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">Referrer</td>
        <td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#2563EB;word-break:break-all;">{$referrer}</td>
      </tr>
      <tr>
        <td style="padding:10px 16px;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">User-Agent</td>
        <td style="padding:10px 16px;font-family:'JetBrains Mono',monospace;font-size:10px;color:#6B7280;word-break:break-all;line-height:1.5;">{$ua}</td>
      </tr>
    </table>
  </td></tr>

  <!-- Footer -->
  <tr><td style="background:#F9FAFB;padding:16px 32px;text-align:center;border-top:1px solid #E5E7EB;">
    <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#9CA3AF;margin-bottom:4px;">{$ref} · CONFIDENTIAL · INTERNAL</div>
    <div style="font-size:11px;color:#9CA3AF;">© 2026 PolicyCentral.ai · Do not forward</div>
  </td></tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;
    }

    /**
     * Build the intelligence section. Falls back gracefully if $intel is null.
     */
    private static function build_intel_section($intel) {
        if (!$intel) {
            return '<tr><td style="padding:20px 32px;">
                <div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:8px;">Lead Intelligence</div>
                <div style="background:#FEF3C7;border:1px solid #FDE68A;border-radius:10px;padding:14px 18px;font-size:13px;color:#92400E;line-height:1.6;">
                    <strong>Intelligence unavailable.</strong> Claude enrichment failed or is still running. Check the <a href="' . esc_url(admin_url('admin.php?page=pc-lead-intelligence')) . '" style="color:#92400E;">admin dashboard</a> for updates.
                </div>
            </td></tr>';
        }

        $confidence = (int) $intel->overall_confidence;
        $conf_color = $confidence >= 75 ? '#059669' : ($confidence >= 45 ? '#D97706' : '#DC2626');
        $conf_bg    = $confidence >= 75 ? '#D1FAE5' : ($confidence >= 45 ? '#FEF3C7' : '#FEE2E2');

        // Person block
        $p_name = esc_html($intel->person_designation ?: 'Designation unknown');
        $p_role = esc_html($intel->person_role_type ?: '');
        $p_linkedin = $intel->person_linkedin_url
            ? '<a href="' . esc_url($intel->person_linkedin_url) . '" style="color:#0694A2;text-decoration:none;font-weight:600;">View LinkedIn →</a>'
            : ($intel->person_found ? 'Profile found · URL unavailable' : 'No public profile found');
        $p_acc = (int) $intel->person_accuracy;
        $p_acc_color = $p_acc >= 75 ? '#059669' : ($p_acc >= 45 ? '#D97706' : '#DC2626');

        // Company block
        $c_name = esc_html($intel->company_name ?: '—');
        $c_industry = esc_html($intel->company_industry ?: '');
        $c_size = esc_html($intel->company_size ?: '');
        $c_count = esc_html($intel->company_employee_count ?: '');
        $c_hq = esc_html($intel->company_hq ?: '');
        $c_founded = esc_html($intel->company_founded ?: '');
        $c_desc = esc_html($intel->company_description ?: '');
        $c_meta = implode(' · ', array_filter(array(
            $c_industry, $c_size, $c_count ? '~' . $c_count . ' employees' : '', $c_hq, $c_founded ? 'Est. ' . $c_founded : ''
        )));
        $c_acc = (int) $intel->company_accuracy;

        // Tech stack
        $tech_stack = array();
        if (!empty($intel->tech_stack)) {
            $decoded = json_decode($intel->tech_stack, true);
            if (is_array($decoded)) $tech_stack = $decoded;
        }
        $tech_html = '';
        if (!empty($tech_stack) || !empty($intel->hr_systems)) {
            $tech_html = '<div style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;padding:12px 16px;margin-bottom:12px;">';
            $tech_html .= '<div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;margin-bottom:6px;">Tech Stack Signals</div>';
            if (!empty($intel->hr_systems)) {
                $tech_html .= '<div style="font-size:12px;color:#4B5563;margin-bottom:4px;"><strong>HR/Intranet:</strong> ' . esc_html($intel->hr_systems) . '</div>';
            }
            if (!empty($tech_stack)) {
                $tech_html .= '<div style="font-size:12px;color:#4B5563;"><strong>Systems:</strong> ' . esc_html(implode(', ', $tech_stack)) . '</div>';
            }
            $tech_html .= '</div>';
        }

        // Funding
        $funding_html = '';
        if ($intel->funding_found) {
            $investors = json_decode($intel->funding_investors ?? '[]', true) ?: array();
            $funding_html = '<div style="background:#D1FAE5;border:1px solid #6EE7B7;border-radius:10px;padding:12px 16px;margin-bottom:12px;">
                <div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#059669;margin-bottom:4px;">Funding Found</div>
                <div style="font-size:14px;font-weight:800;color:#065F46;">' . esc_html($intel->funding_latest_round ?: 'Funded') . ($intel->funding_amount ? ' · ' . esc_html($intel->funding_amount) : '') . '</div>';
            if (!empty($intel->funding_summary)) {
                $funding_html .= '<div style="font-size:12px;color:#047857;margin-top:4px;line-height:1.5;">' . esc_html($intel->funding_summary) . '</div>';
            }
            if (!empty($investors)) {
                $funding_html .= '<div style="font-size:11px;color:#065F46;margin-top:4px;">Investors: ' . esc_html(implode(', ', $investors)) . '</div>';
            }
            $funding_html .= '</div>';
        }

        // News
        $news = json_decode($intel->news_items ?? '[]', true) ?: array();
        $news_html = '';
        if (!empty($news)) {
            $news_html = '<div style="margin-bottom:12px;"><div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;margin-bottom:8px;">Recent News</div>';
            foreach (array_slice($news, 0, 3) as $item) {
                $headline = esc_html($item['headline'] ?? '');
                $date = esc_html($item['date'] ?? '');
                $relevance = esc_html($item['relevance'] ?? '');
                $news_html .= '<div style="padding:8px 0;border-bottom:1px solid #E5E7EB;">
                    <div style="font-size:13px;font-weight:700;color:#111827;margin-bottom:2px;">• ' . $headline . '</div>
                    <div style="font-size:11px;color:#9CA3AF;">' . $date . '</div>
                    <div style="font-size:11px;color:#6B7280;font-style:italic;margin-top:2px;">' . $relevance . '</div>
                </div>';
            }
            $news_html .= '</div>';
        }

        // Pain points
        $pain_points = json_decode($intel->pain_points ?? '[]', true) ?: array();
        $pain_html = '';
        if (!empty($pain_points)) {
            $pain_html = '<div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:10px;padding:12px 16px;margin-bottom:12px;">
                <div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#DC2626;margin-bottom:6px;">Likely Pain Points</div>';
            foreach (array_slice($pain_points, 0, 3) as $pain) {
                $pain_html .= '<div style="font-size:12px;color:#7F1D1D;margin-bottom:4px;">• ' . esc_html($pain) . '</div>';
            }
            $pain_html .= '</div>';
        }

        // Conversation starters
        $starters = json_decode($intel->conversation_starters ?? '[]', true) ?: array();
        $starters_html = '';
        if (!empty($starters)) {
            $starters_html = '<div style="background:linear-gradient(135deg,rgba(6,148,162,.06),rgba(67,56,202,.06));border-left:4px solid #0694A2;border-radius:0 10px 10px 0;padding:14px 18px;margin-bottom:12px;">
                <div style="font-family:\'Plus Jakarta Sans\',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#0694A2;margin-bottom:10px;">Conversation Starters for Your Call</div>';
            foreach (array_slice($starters, 0, 3) as $i => $s) {
                $num = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                $starters_html .= '<div style="display:flex;gap:10px;margin-bottom:8px;">
                    <div style="font-family:\'JetBrains Mono\',monospace;font-size:11px;color:#0694A2;font-weight:800;min-width:20px;">' . $num . '</div>
                    <div style="font-size:13px;color:#374151;line-height:1.6;">' . esc_html($s) . '</div>
                </div>';
            }
            $starters_html .= '</div>';
        }

        $research_note = esc_html($intel->research_note ?: 'Compiled from public web sources via Claude.');

        return <<<HTML
<tr><td style="padding:24px 32px 20px;">
  <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
    <tr>
      <td style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;">
        Lead Intelligence Report
      </td>
      <td align="right">
        <span style="background:{$conf_bg};color:{$conf_color};font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:800;padding:4px 12px;border-radius:20px;">
          {$confidence}% confidence
        </span>
      </td>
    </tr>
  </table>

  <!-- Person + Company side by side -->
  <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:12px;">
    <tr>
      <td width="49%" style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;padding:12px 14px;vertical-align:top;">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Person</div>
        <div style="font-size:14px;font-weight:800;color:#111827;margin-bottom:3px;">{$p_name}</div>
        <div style="font-size:11px;color:#6B7280;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px;">{$p_role}</div>
        <div style="font-size:12px;">{$p_linkedin}</div>
      </td>
      <td width="2%"></td>
      <td width="49%" style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;padding:12px 14px;vertical-align:top;">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Company</div>
        <div style="font-size:14px;font-weight:800;color:#111827;margin-bottom:3px;">{$c_name}</div>
        <div style="font-size:11px;color:#6B7280;">{$c_meta}</div>
      </td>
    </tr>
  </table>

  {$tech_html}
  {$funding_html}
  {$news_html}
  {$pain_html}
  {$starters_html}

  <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#9CA3AF;border-top:1px solid #E5E7EB;padding-top:8px;margin-top:8px;">Note: {$research_note}</div>
</td></tr>
HTML;
    }
}
