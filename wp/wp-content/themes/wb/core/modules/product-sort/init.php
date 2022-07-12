<?php
function wb_product_sort_scripts() {	
	global $wp_query;
	if(is_taxonomy( 'product_cat' )){
		wp_register_script( 'sort', THEME_URI . '/js/product-sort.js', array('jquery') );
		wp_localize_script( 'sort', 'sort_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'posts' => json_encode( $wp_query->query_vars ),
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,

		) );		
		wp_enqueue_script( 'sort' );
	}
}
add_action( 'wp_enqueue_scripts', 'wb_product_sort_scripts' );
function product_sort_ajax_handler(){
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$fillter = $_POST['fillter'];

	switch ($fillter) {
		case 'featured':
		$meta_query = array(
			array(
				'key' => 'featured_product',
				'value' => 1,
				'compare' => '=',
			)
		);
		$args['meta_query'] = $meta_query;
		break;
		case 'promotion':
		$meta_query = array(
			array(
				'key' => 'sale_product',
				'value' => 1,
				'compare' => '=',
			)
		);
		$args['meta_query'] = $meta_query;
		break;
	}
	$args['post_status'] = 'publish';
	query_posts( $args );
	if( have_posts() ) :
		while( have_posts() ): the_post();
			get_template_part( 'template-parts/content', 'product-archive' );
		endwhile;
	endif;
	die;
}
add_action('wp_ajax_product_sort', 'product_sort_ajax_handler'); 
add_action('wp_ajax_nopriv_product_sort', 'product_sort_ajax_handler');


function product_sort_price_ajax_handler(){
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$sort = $_POST['sort'];
	switch ($sort) {
		case 'price-asc':
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'product_normal_price';
		break;
		case 'price-desc':
		$args['order'] = 'DESC';
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'product_normal_price';
		break;
		case 'date-desc':
		$args['order'] = 'DESC';
		$args['orderby'] = 'date';
		break;
	}
	$args['post_status'] = 'publish';
	
	query_posts( $args );
	if( have_posts() ) :
		while( have_posts() ): the_post();
			get_template_part( 'template-parts/content', 'product-archive' );
		endwhile;
	endif;
	die;
}
add_action('wp_ajax_product_sort_price', 'product_sort_price_ajax_handler'); 
add_action('wp_ajax_nopriv_product_sort_price', 'product_sort_price_ajax_handler');