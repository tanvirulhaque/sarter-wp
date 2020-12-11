<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="column column-60 column-offset-20">
					<?php
					while ( have_posts() ) {
						the_post();

						// if ( 'post' === get_post_type() && is_single() ) {
						// 	get_template_part( 'template-parts/content-single');
						// }

						get_template_part( 'template-parts/content-single');

						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					}
					?>
				</div>
			</div>

			<?php get_template_part( 'template-parts/subscribe-newsletter' ) ?>

		</div>
	</main>

<?php
get_footer();
