<?php
/**
 * Elegant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elegant
 */

if ( ! function_exists( 'elegant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function elegant_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Elegant, use a find and replace
		 * to change 'elegant' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'elegant', get_template_directory() . '/languages' );

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
			'header_menu' => esc_html__( 'Header menu', 'elegant' ),
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
		add_theme_support( 'custom-background', apply_filters( 'elegant_custom_background_args', array(
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'elegant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elegant_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'elegant_content_width', 640 );
}
add_action( 'after_setup_theme', 'elegant_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elegant_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Main', 'elegant' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Add widgets here.', 'elegant' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Simple', 'elegant' ),
		'id'            => 'sidebar-simple',
		'description'   => esc_html__( 'Add widgets here.', 'elegant' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'elegant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function elegant_scripts() {
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/styles/main.css', array(), '1.0' );

	wp_enqueue_script( 'elegant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'elegant-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0');

	// отменяем зарегистрированный jQuery
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery');

	// регистрируем
	wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true );
	wp_register_script( 'jquery', false, array('jquery-core'), null, true );

	// подключаем
	wp_enqueue_script( 'jquery' );
		
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if (get_post_type() === 'work') {
		// wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.0');
		wp_enqueue_script( 'masonary', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '1.0');
	}
}
add_action( 'wp_enqueue_scripts', 'elegant_scripts' );

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

/* 
*	Add my code
*/
define( 'ELEGANT_PATH', get_template_directory() );
define( 'ELEGANT_URL', get_template_directory_uri() );

require_once 'inc/init.php';


function p($obj, $text = '') {
	?>
	<pre class="debug-code" style="
		position: fixed;
		left: 100px;
		top: 100px;
		background: #fff;
		color: #000;
		z-index: 10000;
		padding: 10px;
		border: 2px dotted green;
		overflow: scroll;
		max-height: 80%;
		max-width: 80%;
		min-width: 300px;
		text-align: left">
	<?php echo ' --'. $text .'-- <br>'; print_r($obj); ?>
	</pre>
	<script>
		var pre = document.querySelectorAll('.debug-code');
			
		console.log(pre);
		
		pre.forEach(function(obj) {
			obj.addEventListener('dblclick', function() {
				this.style.opacity = '0.0';
				this.style.visibility = "hidden";
			
		}, false);
		});
	</script>

	<?php
}

 /* 
 *	-------------------------------------------------------------------------------------
 *		Для работы скрипта на странице work
 *	
 *		Функция собирает данные из цикла и сохраняет в переменной works во фронтенде
 *
 * 	------------------------------------------------------------------------------------- 
 */
$works = array();
function save_data_post($comand = '') {
	global $works;	

	$stack_ID_images = get_post_meta( get_the_ID(), 'images');
	 if ( $stack_ID_images ):
		foreach ($stack_ID_images as $ID_img) {
			$stack_img[ $ID_img ] = [
				'id'  => $ID_img,
				'url' => wp_get_attachment_image_url($ID_img, 'large'), //wp_get_attachment_image( $ID_img, 'large' ); 			
			];
		}
	endif; 
	
	$stack_img['thumbnail'] = [
		'id' => 'thumbnail',
		'url' =>  get_the_post_thumbnail_url( get_the_ID(), 'large' ),
	];

	$works['post-'.get_the_ID()] = [
		'title' 	=> get_the_title(),
		'content'	=> get_the_content(),
		//'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'large' ),//get_the_post_thumbnail( get_the_ID(), 'large', array('class'=>'img-fluid')),
		'stack_img' => $stack_img,
	];

	if ($comand === 'convert_json') {
		return json_encode($works);
	}

}