<?php
/**
 * Template Part: Social Share Buttons
 *
 * LinkedIn, X (Twitter), and Email share links for the current post.
 * Uses server-side URL construction — no JS libs, no third-party pixels.
 */

if (!defined('ABSPATH')) exit;

$url   = rawurlencode(get_permalink());
$title = rawurlencode(get_the_title());

$linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url;
$twitter_url  = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title;
$email_url    = 'mailto:?subject=' . $title . '&body=' . $title . '%0A%0A' . $url;
?>
<div class="pcb-share" role="group" aria-label="Share this article">
  <span class="pcb-share-label">Share</span>
  <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn" class="pcb-share-btn pcb-share-btn--linkedin">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3A2 2 0 0 1 21 5V19A2 2 0 0 1 19 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H19M18.5 18.5V13.2A3.26 3.26 0 0 0 15.24 9.94C14.39 9.94 13.4 10.46 12.92 11.24V10.13H10.13V18.5H12.92V13.57C12.92 12.8 13.54 12.17 14.31 12.17A1.4 1.4 0 0 1 15.71 13.57V18.5H18.5M6.88 8.56A1.68 1.68 0 0 0 8.56 6.88C8.56 5.95 7.81 5.19 6.88 5.19A1.69 1.69 0 0 0 5.19 6.88C5.19 7.81 5.95 8.56 6.88 8.56M8.27 18.5V10.13H5.5V18.5H8.27Z"/></svg>
    <span>LinkedIn</span>
  </a>
  <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener" aria-label="Share on X (Twitter)" class="pcb-share-btn pcb-share-btn--twitter">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
    <span>X</span>
  </a>
  <a href="<?php echo esc_url($email_url); ?>" aria-label="Share by email" class="pcb-share-btn pcb-share-btn--email">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    <span>Email</span>
  </a>
</div>
