<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Remove Taxonomy Name From Archive Title
 */
add_filter( 'get_the_archive_title', function ( $title ) {
    $title_parts = explode( ':', $title );
    if ( ! empty( $title_parts[1] ) ) {
        return $title_parts[1];
    }

    return $title_parts[0];
}, 10, 1 );

/**
* Add Custom Excerpt with Read more.
*/
if ( ! function_exists( 'starter_custom_excerpt_more' ) ) {
    function starter_custom_excerpt_more( $more ) {
        if ( ! is_admin() ) {
            $more = '... <p class="read-more"><a class="starter-read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'starter' ) . ' <span class="arrow_right"></span></a></p>';
        }

        return $more;
    }

    add_filter( 'excerpt_more', 'starter_custom_excerpt_more' );
}

/**
* Add length limit to Custom Excerpt
*/
if ( ! function_exists( 'starter_custom_excerpt_length' ) ) {
    function starter_custom_excerpt_length( $length ) {
        return 12;
    }
    add_filter( 'excerpt_length', 'starter_custom_excerpt_length', 999 );
}
