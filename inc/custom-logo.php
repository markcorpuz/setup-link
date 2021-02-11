<?php
/**
 * SETUP CHILD | 1.0.0 | 210210 | inc/custom-logo.php
 *
 * @package      Setup Child
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Adding Custom Logo support to your Theme
 * 
 */
function setup_child_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'setup_child_custom_logo_setup' );

/**
 * Displaying Custom Logo to your Theme
 * 
 */
function setup_child_custom_logo_display() {
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
}
add_action( 'genesis_site_title', 'setup_child_custom_logo_display', 9 );
add_action( 'genesis_footer', 'setup_child_custom_logo_display' );