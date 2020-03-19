<?php
/**
 * KateSlava functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KateSlava
 */

if ( ! function_exists( 'kateslava_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kateslava_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on KateSlava, use a find and replace
		 * to change 'kateslava' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kateslava', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'kateslava' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kateslava_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 177,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'kateslava_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kateslava_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'kateslava_content_width', 640 );
}
add_action( 'after_setup_theme', 'kateslava_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kateslava_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kateslava' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kateslava' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kateslava_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kateslava_scripts() {
	wp_enqueue_style( 'kateslava-style', get_stylesheet_uri(), array(), '20200317' );
	
	wp_enqueue_style( 'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic' );

	wp_enqueue_script( 'kateslava-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20200318', true );

	wp_enqueue_script( 'kateslava-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if (is_page_template('portfolio.php')) {
		wp_enqueue_script( 'kateslava-ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '20200312', true );
		wp_localize_script('kateslava-ajax', 'ajaxLoad', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
		wp_enqueue_script( 'kateslava-anim', get_template_directory_uri() . '/js/anim.js', array(), '20200315', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kateslava_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Добавляем социальные ссылки и приветственное слово

add_action( 'admin_init', 'social_settings_api_init' );

function social_settings_api_init() {
	register_setting( 'general', 'phone', 'sanitize_text_field' );

	add_settings_field(
		'phone',
		'<label for="phone">Телефон</label>',
		'phone_field_html',
		'general'
	);

	register_setting( 'general', 'vk', 'sanitize_text_field' );

	add_settings_field(
		'vk',
		'<label for="vk">Вконтакте</label>',
		'vk_field_html',
		'general'
	);

	register_setting( 'general', 'email', 'sanitize_text_field' );

	add_settings_field(
		'email',
		'<label for="email">Электронная почта</label>',
		'email_field_html',
		'general'
	);

	register_setting( 'general', 'facebook', 'sanitize_text_field' );

	add_settings_field(
		'facebook',
		'<label for="facebook">Facebook</label>',
		'facebook_field_html',
		'general'
	);

	register_setting( 'general', 'instagram', 'sanitize_text_field' );

	add_settings_field(
		'instagram',
		'<label for="instagram">Instagram</label>',
		'instagram_field_html',
		'general'
	);

	register_setting( 'general', 'welcome', 'sanitize_text_field' );

	add_settings_field(
		'welcom-word',
		'<label for="welcome">Описание сайта для блока на главной странице</label>',
		'welcome_field_html',
		'general'
	);
}

function phone_field_html() {
	$value = get_option( 'phone', '' );
	printf( '<input type="text" id="phone" name="phone" value="%s" />', esc_attr( $value ) );
}

function vk_field_html() {
	$value = get_option( 'vk', '' );
	printf( '<span>https://vk.com/</span><input type="text" id="vk" name="vk" value="%s" />', esc_attr( $value ) );
}

function email_field_html() {
	$value = get_option( 'email', '' );
	printf( '<input type="text" id="email" name="email" value="%s" />', esc_attr( $value ) );
}

function facebook_field_html() {
	$value = get_option( 'facebook', '' );
	printf( '<span>https://www.facebook.com/</span><input type="text" id="facebook" name="facebook" value="%s" />', esc_attr( $value ) );
}

function instagram_field_html() {
	$value = get_option( 'instagram', '' );
	printf( '<span>https://www.instagram.com/</span><input type="text" id="instagram" name="instagram" value="%s" />', esc_attr( $value ) );
}

function welcome_field_html() {
	$value = get_option( 'welcome', '' );
	printf( '<textarea id="welcome" name="welcome" rows="10" cols="45"/>%s</textarea>', esc_attr( $value ) );
}


add_action( 'init', 'create_taxonomy_usedapp' );
function create_taxonomy_usedapp(){

	register_taxonomy('app', array('post'), array(
		'hierarchical'          => false,
		'labels'                => array(
			'name'              => 'Программы',
			'singular_name'     => 'Программа',
			'search_items'      => 'Поиск по программам',
			'all_items'         => 'Все программы',
			'view_item '        => 'Посмотреть по программе',
			'parent_item'       => null,
			'parent_item_colon' => null,
			'edit_item'         => 'Редактировать программу',
			'update_item'       => 'Обновить программу',
			'add_new_item'      => 'Добавить новую программу',
			'new_item_name'     => 'Добавить новое название программы',
			'menu_name'         => 'Программы',
		),
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite' 				=> array('slug' => 'app')
	) );
}

add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

// AJAX for loadmore button

add_action('wp_ajax_loadmore', 'loadmore');
add_action('wp_ajax_nopriv_loadmore', 'loadmore');

function loadmore() {
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );
	if( have_posts() ) {
		while( have_posts() ){
			the_post();
			get_template_part( 'template-parts/content', 'portfolio' );
		} 
	}
	wp_die();
}
