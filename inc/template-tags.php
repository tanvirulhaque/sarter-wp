<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'starter_posted_in' ) ) {
	/**
	 * Prints HTML with meta information for categories.
	 */
	function starter_posted_in() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'starter' ) );
			if ( $categories_list ) {
				echo '<span class="post-category">' . $categories_list . '</span>';
			}
		}
	}
}

if ( ! function_exists( 'starter_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function starter_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'starter_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function starter_posted_by() {
		$author_id     = get_the_author_meta( 'ID' );
		$author_link   = esc_url( get_author_posts_url( $author_id ) );
		$author_avatar = get_avatar( $author_id, '30' );
		$first_name    = get_user_meta( $author_id, 'first_name', true );
		$last_name     = get_user_meta( $author_id, 'last_name', true );
		$byline        = '<span class="author vcard"><a href="' . $author_link . '" class="author_avatar">' . $author_avatar . '</a> <a class="url fn n" href="' . $author_link . '">' . esc_html( $first_name .' '. $last_name ) . '</a></span>';

		echo '<span class="byline"> ' . $byline . '</span><span class="sep">|</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'starter_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function starter_entry_footer() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'starter' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'starter' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'starter' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'starter' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'starter_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function starter_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) { ?>

			<figure class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure>

		<?php } else { ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<figure>
					<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
					?>
				</figure>
			</a>

		<?php
		}
	}
}

if ( ! function_exists( 'starter_post_reading_time' ) ) {
	/**
	 * Displays post reading estimated time
	 */
	function starter_post_reading_time() {
	    $words = str_word_count( strip_tags( get_the_content() ) );
	    $minutes = ceil( $words / 250 );

	    $estimated_time = $minutes . ' min' . ( $minutes == 1 ? '' : 's' ) .' read';

	    echo '<span class="sep">|</span><span class="read-time"> ' . $estimated_time . '</span>';
	}
}

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
