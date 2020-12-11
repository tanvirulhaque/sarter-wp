<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
				<div class="column column-80 column-offset-10">

					<header class="page-header text-center">
						<h1 class="page-title"><?php esc_html_e( 'Articles', 'starter' ); ?></h1>
					</header>

					<?php if ( have_posts() ) { 

						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

						}

						the_posts_pagination();

					} else {

						get_template_part( 'template-parts/content', 'none' );

					}
					?>

				</div>
			</div>

			<?php get_template_part( 'template-parts/subscribe-newsletter' ) ?>
			
		</div>
	</main>

<?php
get_footer();
