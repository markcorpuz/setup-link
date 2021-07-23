<?php
/**
 * SETUP LINK | 1.0.0 | 210722 | inc/items-link.php
 *
 * @package      Setup Link
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/


/**
 * DISPLAY CATEGORIES
 * Ref: https://developer.wordpress.org/reference/functions/get_the_category/
 * 
 */

function setup_link_display_categories() {
	$cats = array();
	foreach (get_the_category($post_id) as $c) {
		$cat = get_category($c);
		array_push($cats, $cat->name);
	}

	if (sizeOf($cats) > 0) {
		$post_categories = implode(', ', $cats);
		echo '<div>' . $post_categories . '</div>';
	} else {
		//$post_categories = 'No Categories';
	}
}


/**
 * DISPLAY CATEGORIES LIST
 * Ref: https://developer.wordpress.org/reference/functions/get_the_category_list/
 * 
 */

function setup_link_display_categories_list() {
	echo get_the_category_list();
}


/**
 * DISPLAY CATEGORIES
 * Ref: https://wordpress.stackexchange.com/questions/249463/list-categories-assigned-to-a-post
 * 
 */

function setup_link_display_categories_v2() {
	$categories = get_the_category();
	foreach( $categories as $category) {
	    $name = $category->name;
	    $category_link = get_category_link( $category->term_id );

	    echo "<a href='$category_link'>
	            <span class=" . esc_attr( $name) . "></span>
	         </a>";
	}
}


/**
 * DISPLAY TAGS LIST
 * Ref: https://developer.wordpress.org/reference/functions/get_the_tag_list/
 * 
 */

function setup_link_display_tags_list() {
	//echo get_the_tag_list( sprintf( '<p>%s: ', __( 'Tags', 'textdomain' ) ), ', ', '</p>' );
	echo get_the_tag_list();
}