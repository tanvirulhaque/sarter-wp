<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found text-center">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'starter' ); ?></h1>

		<?php if ( is_search() ) { ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'starter' ); ?></p>
			<?php
			get_search_form();

		} else { ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help you.', 'starter' ); ?></p>
			<?php
			get_search_form();

		}
		?>
	</header>
</section>
