<?php
/**
 * Requite Product Metabox
 */
require_once dirname(__FILE__). '/career-meta-box.php';
require_once dirname(__FILE__). '/schema.php';


/**
 * Register career Post
 * @return [Tuyển dụng]
 */
function wb_create_career_type() {
	$labels = array(
		'name'                  => _x( 'Tuyển dụng', 'Post Type General Name', 'apc' ),
		'singular_name'         => _x( 'Tuyển dụng', 'Post Type Singular Name', 'apc' ),
		'menu_name'             => __( 'Tuyển dụng', 'apc' ),
		'name_admin_bar'        => __( 'Tuyển dụng', 'apc' ),
		'archives'              => __( 'Tất cả Tuyển dụng', 'apc' ),
		'attributes'            => __( 'Item Attributes', 'apc' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apc' ),
		'all_items'             => __( 'Tuyển dụng', 'apc' ),
		'add_new_item'          => __( 'Thêm Tuyển dụng', 'apc' ),
		'add_new'               => __( 'Thêm mới', 'apc' ),
		'new_item'              => __( 'Tuyển dụng mới', 'apc' ),
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
		'slug'                  => 'tuyen-dung',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Tuyển dụng', 'apc' ),
		'description'           => __( 'Tuyển dụng thi công nhôm kính', 'apc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','author', 'thumbnail', 'comments', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-vault',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'tuyen-dung',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'career', $args );

}
add_action( 'init', 'wb_create_career_type', 0 );