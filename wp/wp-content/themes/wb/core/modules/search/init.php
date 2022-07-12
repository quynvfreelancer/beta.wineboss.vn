<?php 
function add_search_product_template($template) {    
	global $wp_query;   
	$post_type = get_query_var('post_type');   
	if( $wp_query->is_search && $post_type == 'product' )   
	{
return locate_template('search-product.php');  //  redirect to archive-search.php
}   
return $template;   
}
add_filter('template_include', 'add_search_product_template'); 

function wb_register_query_vars( $vars ) {
	$vars[] = 'product_size';
	$vars[] = 'product_style';
	$vars[] = 'product_price';

	return $vars;
}
add_filter( 'query_vars', 'wb_register_query_vars' );


function custom_search_pre_get_posts( $query ) {

	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}
	if ( !is_post_type_archive( 'product' ) ){
		return;
	}

	$meta_query = array();
	// $tax_query = array();

	
	$product_size =  get_query_var( 'product_size' ) ;
	$product_style =  get_query_var( 'product_style' ) ;
	$product_cat =  get_query_var( 'product_cat' ) ;
	$product_price =  get_query_var( 'product_price' ) ;

	// tax query 
	if(isset($product_cat) && $product_cat !=''){
		$tax_query = array(
			'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' => $product_cat
		);
		$query->set( 'tax_query', array( 'relation' => 'OR', $tax_query) );
	}


    // add meta_query elements
	if( !empty( get_query_var( 'product_size' ) ) ){
		$meta_query[] = array( 'key' => 'product_size', 'value' => get_query_var( 'product_size' ), 'compare' => '=' );
	}

	if( !empty( get_query_var( 'product_style' ) ) ){
		$meta_query[] = array( 'key' => 'product_style', 'value' => get_query_var( 'product_style' ), 'compare' => '=' );
	}
	if( !empty( get_query_var( 'product_price' ) && $product_price !='' ) ){
		$arr = explode('-',$product_price);
		$first = (int) $arr[0];
		$second = (int) $arr[1];
		$arr_between = array();
		$arr_between[] = $first;
		$arr_between[] = $second;
		$meta_query[] = array( 'key' => 'product_normal_price', 'value' => $arr_between, 'type' => 'numeric', 'compare' => 'BETWEEN' );
	}

	if( count( $meta_query ) > 1 ){
		$meta_query['relation'] = 'AND';
	}

	if( count( $meta_query ) > 0 ){
		$query->set( 'meta_query', $meta_query );
	}
}
add_action( 'pre_get_posts', 'custom_search_pre_get_posts', 1 );