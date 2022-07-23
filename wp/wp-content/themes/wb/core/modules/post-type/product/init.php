<?php
/**
 * Requite Product Metabox
 */
require_once dirname(__FILE__). '/product-post-meta.php';
/**
 * Register Product Post
 * @return [Sản phẩm]
 */
function wb_create_product_type() {
	$labels = array(
		'name'                  => _x( 'Sản phẩm', 'Post Type General Name', 'apc' ),
		'singular_name'         => _x( 'Sản phẩm', 'Post Type Singular Name', 'apc' ),
		'menu_name'             => __( 'Sản phẩm', 'apc' ),
		'name_admin_bar'        => __( 'Sản phẩm', 'apc' ),
		'archives'              => __( 'Tất cả Sản phẩm', 'apc' ),
		'attributes'            => __( 'Item Attributes', 'apc' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apc' ),
		'all_items'             => __( 'Sản phẩm', 'apc' ),
		'add_new_item'          => __( 'Thêm Sản phẩm', 'apc' ),
		'add_new'               => __( 'Thêm mới', 'apc' ),
		'new_item'              => __( 'Sản phẩm mới', 'apc' ),
		'edit_item'             => __( 'Chỉnh sửa', 'apc' ),
		'update_item'           => __( 'Cập nhật', 'apc' ),
		'view_item'             => __( 'Xem', 'apc' ),
		'view_items'            => __( 'Xem', 'apc' ),
		'search_items'          => __( 'Tìm kiếm', 'apc' ),
		'not_found'             => __( 'Không tìm thấy', 'apc' ),
		'not_found_in_trash'    => __( 'Không có trong thùng rác', 'apc' ),
		'featured_image'        => __( 'Ảnh đại diện', 'apc' ),
		'set_featured_image'    => __( 'Chọn ảnh đại diện', 'apc' ),
		'remove_featured_image' => __( 'Xóa ảnh đại diện', 'apc' ),
		'use_featured_image'    => __( 'Sử dụng ảnh', 'apc' ),
		'insert_into_item'      => __( 'Chèn', 'apc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'apc' ),
		'items_list'            => __( 'Items list', 'apc' ),
		'items_list_navigation' => __( 'Items list navigation', 'apc' ),
		'filter_items_list'     => __( 'Filter items list', 'apc' ),
	);
	$rewrite = array(
		'slug'                  => 'san-pham',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Sản phẩm', 'apc' ),
		'description'           => __( 'Sản phẩm rươụ vang nhập khẩu chính hãng', 'apc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','author', 'thumbnail', 'comments', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-products',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'san-pham',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'product', $args );

}
add_action( 'init', 'wb_create_product_type', 0 );

if ( ! function_exists( 'wb_create_product_cat' ) ) {

	// Register Product Categories
	function wb_create_product_cat() {
		$labels = array(
			'name'                       => _x( 'Danh mục sản phẩm', 'Taxonomy General Name', 'apc' ),
			'singular_name'              => _x( 'Danh mục sản phẩm', 'Taxonomy Singular Name', 'apc' ),
			'menu_name'                  => __( 'Danh mục sản phẩm', 'apc' ),
			'all_items'                  => __( 'Tất cả danh mục', 'apc' ),
			'parent_item'                => __( 'Danh mục cha', 'apc' ),
			'parent_item_colon'          => __( 'Danh mục cha:', 'apc' ),
			'new_item_name'              => __( 'Thêm danh mục', 'apc' ),
			'add_new_item'               => __( 'Thêm mới danh mục', 'apc' ),
			'edit_item'                  => __( 'Chỉnh sửa', 'apc' ),
			'update_item'                => __( 'Cập nhật', 'apc' ),
			'view_item'                  => __( 'Xem danh mục sản phẩm', 'apc' ),
			'separate_items_with_commas' => __( 'Tìm kiếm danh mục sản phẩm', 'apc' ),
			'add_or_remove_items'        => __( 'Thêm hoặc xóa danh mục', 'apc' ),
			'choose_from_most_used'      => __( 'Được lựa chọn nhiều', 'apc' ),
			'popular_items'              => __( 'Popular Items', 'apc' ),
			'search_items'               => __( 'Tìm kiếm danh mục', 'apc' ),
			'not_found'                  => __( 'Không tim thấy', 'apc' ),
			'no_terms'                   => __( 'Không có danh mục nào', 'apc' ),
			'items_list'                 => __( 'Items list', 'apc' ),
			'items_list_navigation'      => __( 'Items list navigation', 'apc' ),
		);
		$rewrite = array(
			'slug'                       => 'danh-muc-san-pham',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'product_cat', array( 'product' ), $args );
	}
	add_action( 'init', 'wb_create_product_cat', 0 );
}
// create product settings page
add_filter( 'mb_settings_pages', 'wb_product_settings_pages' );
function wb_product_settings_pages( $settings_pages ){
	$settings_pages[] = array(
		'id'            => 'product-options',
		'option_name'   => 'product-options',
		'menu_title'    => __( 'Cài đặt', 'wb' ),
		'icon_url'      => 'dashicons-admin-generic',
		'parent'      => 'edit.php?post_type=product',
	);
	return $settings_pages;
}
add_filter( 'rwmb_meta_boxes', 'wb_product_settings_meta_box' );
function wb_product_settings_meta_box( $meta_boxes ) {	
	$meta_boxes[] = array(
		'title'          => 'Cấu hình thuộc tính',
		'settings_pages' => 'product-options',
		'fields' => array(			
			array(
				'name' => 'Xuất xứ',
				'id'   => 'xuat_xu',
				'type' => 'textarea',
				'size' => 100
			),
			array(
				'name' => 'Dung tích',
				'id'   => 'dung_tich',
				'type' => 'textarea',
				'size' => 100
			),
			array(
				'name' => 'Giống nho',
				'id'   => 'giong_nho',
				'type' => 'textarea',
				'size' => 100
			),
			array(
				'name' => 'Nồng độ',
				'id'   => 'nong_do',
				'type' => 'textarea',
				'size' => 100
			),
			array(
				'name' => 'Hãng sản xuất',
				'id'   => 'hang_san_xuat',
				'type' => 'textarea',
				'size' => 100
			),
			array(
				'name' => 'Quy cách đóng gói',
				'id'   => 'quy_cach',
				'type' => 'textarea',
				'size' => 100
			),
		),
	);	
	return $meta_boxes;
}