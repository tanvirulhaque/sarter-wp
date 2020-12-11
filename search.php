<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			
			<?php if ( have_posts() ) { ?>
				
				<div class="row">
					<div class="column column-80 column-offset-10">

						<header class="page-header text-center">
							<h1 class="page-title">
								<?php
								printf( esc_html__( 'Search Results for: %s', 'starter' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</header>

						<?php
						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

						}

						the_posts_pagination();
						?>

					</div>
				</div>

				<?php get_template_part( 'template-parts/subscribe-newsletter' ) ?>

			<?php } else { ?>

				<div class="row">
					<div class="column column-50 column-offset-25 text-center">
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					</div>
				</div>

			<?php } ?>
			
		</div>
	</main>

<?php
get_footer();
