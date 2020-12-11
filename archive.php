<?php
/**
 * The template for displaying archive pages
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

			<?php if ( have_posts() ) { ?>

				<div class="row">
					<div class="column column-80 column-offset-10">

						<header class="page-header text-center">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description(  );
							?>
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
