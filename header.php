<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'starter' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="container">
            <div class="row">
                <div class="column">
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </div>
                </div>
                <div class="column column-75">
                    <nav id="site-navigation" class="main-navigation float-right">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'starter' ); ?></button>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'menu_id'        => 'main-menu',
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
	</header>
