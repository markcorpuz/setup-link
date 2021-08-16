<?php
/**
 * SETUP LINK | 1.0.0 | 210731 | partials/displayposts/template.php
 *
 * @package      Setup Child
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="post-summary small">';

	setup_child_title();
    echo '<h5>DISPLAY POSTS TEMPLATE</h5>';

    echo '<h2 class="entry-title"><a href="'.get_the_permalink( get_the_ID() ).'">' .get_the_title( get_the_ID() ).'</a></h2>';
    

    ?><h5>Custom Fields</h5><?php


    // LINK
    $link_entry = get_field( 'entry', get_the_ID() );
    if( !empty( $link_entry ) ) :
        
        // check the target
        if( array_key_exists( 'target', $link_entry ) && !empty( $link_entry[ 'target' ] ) ) {
            $link_target = ' target="_blank"';
        } else {
            $link_target = '';
        }

        echo '<h5 class="entry-link">LINK: <a href="'.$link_entry[ "url" ].'"'.$link_target.'>'. $link_entry[ "title" ] .'</a></h5>';

    endif;


    // URL
    $link_url = get_field( 'url', get_the_ID() );
    if( !empty( $link_url ) ) :
        echo '<h5 class="entry-url">URL: <a href="'.$link_url.'" target="_blank">'.$link_url.'</a></h5>';
    endif;


    // LABEL
    $link_label = get_field( 'label', get_the_ID() );
    if( !empty( $link_label ) ) :
        echo '<h5 class="entry-label">'.$link_label.'</h5>';
    endif;

echo '</article>';