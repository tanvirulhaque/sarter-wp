<?php
/**
 * starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package starter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'starter_setup' ) ) {
    function starter_setup() {

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'customize-selective-refresh-widgets' );
	    add_theme_support( 'responsive-embeds' );
        add_theme_support( 'gutenberg', array( 'wide-images' => true ) );
        add_theme_support( 'align-wide' );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        register_nav_menus(
            array(
                'main-menu' => esc_html__( 'Main Menu', 'starter' ),
            )
        );
    }
}
add_action( 'after_setup_theme', 'starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starter_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'starter_content_width', 825 );
}

add_action( 'after_setup_theme', 'starter_content_width', 0 );

/**
 * Register widget area.
 */
function starter_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'starter' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'starter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widgets', 'starter' ),
            'id'            => 'footer-widgets',
            'description'   => esc_html__( 'Add footer widgets here.', 'starter' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s column column-25">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
}

add_action( 'widgets_init', 'starter_widgets_init' );


/**
 * Enqueue Google Fonts
 * @return string
 */
function starter_google_fonts_url() {

	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Open Sans:300,400,600,700,800';
	$font_families[] = 'Titillium Web:400,600,700,900';

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles.
 */
function starter_scripts() {
	wp_enqueue_style( 'google-fonts', starter_google_fonts_url(), array(), null );
    wp_enqueue_style( 'starter-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'et-line-font', get_template_directory_uri() . '/assets/fonts/et-line.css', array(), '1.0.0' );
    wp_enqueue_style( 'elegant-icons', get_template_directory_uri() . '/assets/fonts/elegant-icons.css', array(), '1.0.0' );
    wp_enqueue_style( 'milligram', get_template_directory_uri() . '/assets/css/milligram.css', array(), '1.4.1' );
    wp_enqueue_style( 'starter-default-style', get_template_directory_uri() . '/assets/css/default.css', array(), _S_VERSION );

    wp_enqueue_script( 'starter-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'starter_scripts' );


require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/extra-functions.php';
require get_template_directory() . '/inc/customizer.php';



