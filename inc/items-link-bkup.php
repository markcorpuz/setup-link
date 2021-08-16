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
function removeUncategorize($category_details) {
	$uncategorized_id = get_cat_ID('Uncategorized');
	if (is_array($category_details)) {
		foreach ($category_details as $key => $value) {
			if ($value->cat_ID==$uncategorized_id || $value->category_parent == $uncategorized_id) {
				unset($category_details[$key]);
			}
		}
	}
	return $category_details;
}

function insertTaxLink($arr) {
	if (is_array($arr)) {
		foreach ($arr as $key => $value) {
			$arr[$key]->taxonomy_link = get_term_link( $value->term_id, $value->taxonomy );
		}
	}
	return $arr;
}

function getPostTaxonomies($str='') {

	$showAll = false;
	if ($str=='') {
		$showAll = true;
		$includeTax = [];
	}
	else {
		$includeTax = explode(',', $str);
	}

	$terms =  get_post_taxonomies(get_the_ID());

	$taxs = [];

	foreach ($terms as $key => $value) {
		if (in_array($value, $includeTax) || $showAll) {
			$taxs[$value] = insertTaxLink(get_the_terms( get_the_ID(), $value));
		}
	}
	return array_filter($taxs);
}

function setup_link_display_categories_list() {

	echo '<hr /><br /><br /><br />';

	$category_details = get_the_category( get_the_ID() );
	$category_details = removeUncategorize($category_details);

	if (is_array($category_details) && count($category_details)) {
		$className = 'module_category';
		echo "<ul class={$className} >";
		foreach ($category_details as $key => $value) {
			$catLink = get_category_link($value->term_id);
			echo "<li><a href='{$catLink}'>{$value->name}</a></li>";
		}
		echo "</ul>";
	}

	echo '<hr /><br /><br /><br />';

	$tag_details = get_the_tags( get_the_ID() );
	if (is_array($tag_details)) {
		$className = 'module_tag';
		echo "<ul class={$className} >";
		foreach ($tag_details as $key => $value) {
			$catLink = get_tag_link($value->term_id);
			echo "<li><a href='{$catLink}'>{$value->name}</a></li>";
		}
		echo "</ul>";
	}

	echo '<hr /><br /><br /><br />';
	echo '<h2>TAXONOMY</h2>';
	$taxonomies = getPostTaxonomies('cat_tax,category');

	if (is_array($taxonomies) && count($taxonomies)) {
		$lis = [];
		foreach ($taxonomies as $key => $items) {
			if (is_array($items) && count($items)) {
				foreach ($items as $key => $value) {
					$taxLink = $value->taxonomy_link;
					$lis[] = "<li><a href='{$taxLink}'>{$value->name}</a></li>";
				}
			}
		}
		if (is_array($lis) && count($lis)) {
			echo "<ul class={$className}>".implode('', $lis)."</ul>";
		}
	}
	echo '<hr /><br /><br /><br />';
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
