<?php
/**
 * SETUP CHILD | 1.0.0 | 210210 | inc/site-footer.php
 *
 * @package      Setup Child
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/


function setup_child_site_footer() {

	echo '<div class="module copyright">';
	echo '<div class="item logo"></div>';
	echo '<div class="item info">Copyright &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '®. All Rights Reserved | <a href="' . home_url( 'privacy-policy' ) . '">Privacy Policy</a> | <a href="' . home_url( 'terms' ) . '">Terms</a> | <a href="#main-content">Back To Top</a></div>';
	echo '</div>';

	echo '<div class="module credit">';
	echo '<div class="item info">Site Design by Mark Corpuz</div>';
	echo '</div>';

}
add_action( 'genesis_footer', 'setup_child_site_footer' );
remove_action( 'genesis_footer', 'genesis_do_footer' );