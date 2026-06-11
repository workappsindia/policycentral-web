<?php
/**
 * Migration 059: Seed Compliance Intelligence 'theme' taxonomy terms
 *
 * Inserts the 8 theme terms (one per hub page). Theme slugs map 1:1 to the
 * /compliance/{theme} hub URLs and to the `themes` values in the enforcement
 * data, so PCC_Rewrite can validate hub routes and Phase 3 can filter by theme.
 *
 * Idempotent: wp_insert_term is a no-op when the slug already exists.
 */

function pcgpt_migration_059_seed_compliance_theme_terms() {
    if (!taxonomy_exists('theme')) {
        // Taxonomy is registered on 'init' by includes/compliance/ before
        // admin_init; bail safely if somehow not yet available.
        return;
    }

    $themes = array(
        'internal-ombudsman'    => 'Internal Ombudsman & Grievance Redress',
        'kyc-ckycr'             => 'KYC & CKYCR Compliance',
        'customer-protection'   => 'Customer Protection & Conduct',
        'prudential-governance' => 'Prudential, Governance & Reporting',
        'fair-practices'        => 'Fair Practices Code (NBFC)',
        'change-of-control'     => 'Prior Approval for Change of Control',
        'credit-reporting'      => 'Credit Information Reporting',
        'outsourcing'           => 'Outsourcing of Financial Services',
    );

    foreach ($themes as $slug => $name) {
        if (!term_exists($slug, 'theme')) {
            wp_insert_term($name, 'theme', array('slug' => $slug));
        }
    }
}
