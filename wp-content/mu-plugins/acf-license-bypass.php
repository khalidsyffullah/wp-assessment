<?php
/**
 * Plugin Name: ACF Pro Dev License Bypass (MU)
 * Description: Must-Use plugin to force ACF Pro license active in local development only.
 * Version: 1.0
 * Author: Dev Tools
 */

// Only load in local dev
if ( strpos( home_url(), '.local' ) === false && ( ! defined('WP_ENVIRONMENT_TYPE') || WP_ENVIRONMENT_TYPE !== 'local' ) ) {
    return;
}

/**
 * Force license options so ACF Pro sees an active license.
 */
add_action('init', function() {
    // Store fake license option
    update_option('acf_pro_license', base64_encode( maybe_serialize([
        'key'    => 'dev-local-key-' . md5(home_url()),
        'url'    => home_url(),
    ])));
    // Store fake license status
    update_option('acf_pro_license_status', [
        'status'     => 'active',
        'created'    => time(),
        'expiry'     => strtotime('+100 years'),
        'name'       => 'Local Dev',
        'lifetime'   => true,
        'refunded'   => false,
        'next_check' => time() + YEAR_IN_SECONDS,
    ]);

    // Clear any stale transients
    delete_transient('acf_pro_validating_license');
    delete_transient('acf_pro_license_reactivated');
    delete_site_transient('update_plugins');
});

/**
 * Bypass all license checks in ACF Pro.
 */
add_filter('acf_pro_is_license_active', '__return_true');
add_filter('acf_pro_is_license_valid', '__return_true');
add_filter('acf_pro_get_license_status', function() {
    return [
        'status' => 'active',
        'name'   => 'Local Dev',
        'created'=> time(),
        'expiry' => strtotime('+100 years'),
    ];
});

/**
 * Block outgoing license calls to ACF servers.
 */
add_filter('pre_http_request', function($pre, $r, $url) {
    if ( strpos($url, 'advancedcustomfields.com') !== false ) {
        return new WP_Error('acf_blocked', 'ACF license call blocked in dev.');
    }
    return $pre;
}, 10, 3);

/**
 * Suppress admin notices related to license.
 */
add_action('admin_init', function() {
    remove_action('admin_notices', ['ACF_Admin_Updates', 'license_notice']);
}, 20);