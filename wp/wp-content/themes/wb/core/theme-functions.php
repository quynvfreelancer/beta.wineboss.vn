<?php
/**
* ======================
* Define CONST for theme
*/
define( 'THEME_URI', get_template_directory_uri() );

/**
* Metabox IO Config
*/
define( 'MBAIO_DIR', get_template_directory() . '/core/extensions/meta-box/');
define( 'MBAIO_URL', get_template_directory_uri() . '/core/extensions/meta-box/');
require_once MBAIO_DIR . 'meta-box.php';
require_once MBAIO_DIR . 'extensions/mb-settings-page/mb-settings-page.php';
require_once MBAIO_DIR . 'extensions/meta-box-group/meta-box-group.php';
require_once MBAIO_DIR . 'extensions/meta-box-tabs/meta-box-tabs.php';
require_once MBAIO_DIR . 'extensions/meta-box-include-exclude/meta-box-include-exclude.php';

/**
* Require Module
*/
require_once dirname(__FILE__). '/modules/admin/init.php';
require_once dirname(__FILE__).'/modules/mega-menu/init.php';
require_once dirname(__FILE__). '/extensions/bootstrap-4-nav-walker/init.php';
require_once dirname(__FILE__). '/extensions/duplicate-post-type.php';
require_once dirname(__FILE__). '/modules/post-type/init.php';
require_once dirname(__FILE__).  '/modules/comment/init.php';
require_once dirname(__FILE__).  '/modules/theme-options/init.php';
require_once dirname(__FILE__).  '/modules/widget/init.php';
require_once dirname(__FILE__).  '/modules/shopping-cart/init.php';
//require_once dirname(__FILE__).  '/modules/product-sort/init.php';
/**
* Theme Init after setup
*/
if ( ! function_exists( 'wb_setup' ) ) :
	function wb_setup() {
		load_theme_textdomain( 'wb', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'wb_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		register_nav_menus(
			array(
				'top-menu' => esc_html__( 'Top Menu', 'wb' ),
				'primary-menu' => esc_html__( 'Primary Menu', 'wb' ),
				'product-menu' => esc_html__( 'Danh mục Sản phẩm', 'wb' ),
				'about-menu' => esc_html__( 'Về chúng tôi (Footer)', 'wb' ),
				'privacy-menu' => esc_html__( 'Chính sách (Footer)', 'wb' ),
				'support-menu' => esc_html__( 'Hỗ trợ KH (Footer)', 'wb' ),
				'sidebar-menu' => esc_html__( 'Hỗ trợ KH (Sidebar)', 'wb' ),
			)
		);
		add_filter( 'use_block_editor_for_post', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
		add_image_size( 'blog-size', 290, 175 ); 
	}
endif;
add_action( 'after_setup_theme', 'wb_setup' );

/**
* Disable the emoji's
*/
function wb_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
/**
* Clean Wp Head
*/

if ( ! function_exists( 'wb_cleanup_head' ) ) :
	function wb_cleanup_head() {
		add_filter( 'tiny_mce_plugins', 'wb_disable_emojis_tinymce');
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'rel_canonical', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_generator' );
	}
endif;
add_action( 'init', 'wb_cleanup_head' );

/**
* Remove Style Gutenberg Block CSS
*/
if ( ! function_exists( 'wb_deregister_block_styles' ) ) :
	function wb_deregister_block_styles() {
		wp_dequeue_style( 'wp-block-library');
	}
endif;
add_action( 'wp_print_styles', 'wb_deregister_block_styles', 100 );

/**
* Register widget area.
*/
function wb_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Homepage', 'wb' ),
		'id'            => 'sidebar-homepage',
		'description'   => esc_html__( 'Add widgets here.', 'wb' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Text Link', 'wb' ),
		'id'            => 'sidebar-text-link',
		'description'   => esc_html__( 'Add widgets here.', 'wb' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'wb' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here.', 'wb' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wb_widgets_init' );
// include custom jQuery
function wb_include_jquery() {
	if(!is_admin()){
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery.min.js', array(), null, true);
	}

}
add_action('wp_enqueue_scripts', 'wb_include_jquery');
/**
* Enqueue scripts and styles.
*/
function wb_scripts() {
	if(is_front_page() || is_singular('product')){
		wp_enqueue_style( 'slick', THEME_URI . '/assets/slick-1.6.0/slick.css' );
		wp_enqueue_style( 'slick-theme', THEME_URI . '/assets/slick-1.6.0/slick-theme.css' );
	}
	wp_enqueue_style( 'main', THEME_URI . '/css/styles.min.css');
	wp_enqueue_style( 'wb-style', get_stylesheet_uri());	
	if(!is_admin()){
		if(is_front_page()
			|| is_singular('product'))
		{
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick-1.6.0/slick.min.js', array(), '20151215', true );
		}
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.min.js', array(), '20151216', true );
		wp_localize_script('main-js', 'vmajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wb_scripts' );

/**
* =======================
*  Allows CTV upload image
*  ======================
*/
if ( current_user_can('contributor') && !current_user_can('upload_files') ){
	add_action('admin_init', 'allow_contributor_uploads');
}
if(!function_exists('allow_contributor_uploads')){
	function allow_contributor_uploads() {
		$contributor = get_role('contributor');
		$contributor->add_cap('upload_files');
	}
}
add_filter( 'get_the_archive_description', 'wb_trim_category_desc', 10, 2 );
function wb_trim_category_desc($desc) {
	$desc = preg_replace( '<!--more-->', 'a href="#" class="more-tag">Hiển thị nội dung</a', $desc);
	return $desc;
}
/**
 * Shopping Cart Ajax
 */
if(!function_exists('add_to_shopping_cart')){
	function add_to_shopping_cart(){
		if ($_POST['add_to_cart'] ) {
			$prod_id = $_POST['product_id'];
			$prod_price = $_POST['product_price'];
			$product_quantity = $_POST['product_quantity'];
			if ( !isset($_SESSION['shopping_cart']) ) {
				$_SESSION['shopping_cart'] = array();
			}
			if (!isset($_SESSION['shopping_cart'][$prod_id]) ) {
				if(isset($prod_id) && isset($prod_price)){
					$_SESSION['shopping_cart'][$prod_id] = array(
						'product_id' => $prod_id,
						'product_price' => $prod_price,
						'product_quantity' => $product_quantity,
					);
				}
			}
			else {
				$_SESSION['shopping_cart'][$prod_id]['product_quantity'] = $_SESSION['shopping_cart'][$prod_id]['product_quantity'] + $product_quantity;
			}
		}
		die();
	}
}
add_action( 'wp_ajax_nopriv_add_to_shopping_cart', 'add_to_shopping_cart' );
add_action( 'wp_ajax_add_to_shopping_cart', 'add_to_shopping_cart' );

if(!function_exists('remove_item_shopping_cart')){
	function remove_item_shopping_cart(){
		if ($_POST['product_id'] ) {
			$prod_id = $_POST['product_id'];
			unset($_SESSION['shopping_cart'][$prod_id]);
		}
		die();
	}
}
add_action( 'wp_ajax_nopriv_remove_item_shopping_cart', 'remove_item_shopping_cart' );
add_action( 'wp_ajax_remove_item_shopping_cart', 'remove_item_shopping_cart' );

// Checkout Cart
if(!function_exists('checkout_process')){
	function checkout_process(){
		unset($_SESSION['shopping_cart']);
		die();
	}
}
add_action( 'wp_ajax_nopriv_checkout_process', 'checkout_process' );
add_action( 'wp_ajax_checkout_process', 'checkout_process' );