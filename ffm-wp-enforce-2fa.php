<?php
/*
Plugin Name: Faith FM - Enforce Two-Factor Authentication
Plugin URI: https://github.com/faithfm/ffm-wp-enforce-2fa
Description: Redirects users without 2FA enabled to their profile page to set it up.  (Note: This plugin assumes the "Two-Factor" plugin is installed and activated - https://github.com/WordPress/two-factor.)
Version: 0.1
Author: Faith FM / Michael Engelbrecht
Author URI: https://faithfm.com.au
License: MIT
*/

// Hook into the 'init' action to enforce 2FA.
add_action('init', 'enforce_2fa_for_users');

function enforce_2fa_for_users() {
    // Only proceed if the user is logged in
    if ( is_user_logged_in() ) {
        $user = wp_get_current_user();

        // Exclude administrators if desired
        if ( in_array( 'administrator', (array) $user->roles ) ) {
            return;
        }

        // Check if this is an AJAX or REST API request
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }
        if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
            return;
        }

        // Check if the user has 2FA enabled
        $enabled_providers = get_user_meta( $user->ID, '_two_factor_enabled_providers', true );

        if ( empty( $enabled_providers ) ) {
            $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $profile_url = get_edit_profile_url( $user->ID );

            // Allow access to the profile page
            if ( $current_url !== $profile_url ) {
                wp_redirect( $profile_url );
                exit;
            }
        }
    }
}

// Add an admin notice on the profile page to inform users about enabling 2FA.
add_action( 'admin_notices', 'enforce_2fa_admin_notice' );

function enforce_2fa_admin_notice() {
    if ( is_profile_page() && is_user_logged_in() ) {
        $user = wp_get_current_user();
        $enabled_providers = get_user_meta( $user->ID, '_two_factor_enabled_providers', true );

        if ( empty( $enabled_providers ) ) {
            echo '<div class="notice notice-warning"><p>Please enable Two-Factor Authentication to continue using the site.</p></div>';
        }
    }
}
