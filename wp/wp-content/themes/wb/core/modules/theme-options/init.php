<?php
add_filter( 'mb_settings_pages', 'wb_settings_pages' );
function wb_settings_pages( $settings_pages ){
	$settings_pages[] = array(
		'id'            => 'wb-options',
		'option_name'   => 'wb-options',
		'menu_title'    => __( 'Theme Options', 'wb' ),
		'icon_url'      => 'dashicons-admin-generic',
	);
	return $settings_pages;
}
add_filter( 'rwmb_meta_boxes', 'wb_settings_meta_box' );
function wb_settings_meta_box( $meta_boxes ) {
	
	$meta_boxes[] = array(
		'title'  => __( 'Cài đặt slider' ),
		'settings_pages' => 'wb-options',
		'fields' => array(
			array(
				'id'     => 'slide-item',
				'type'   => 'group',
				'collapsible' => true,
				'save_state' => true,
				'group_title' => array( 'field' => 'slide-title' ),
				'clone'  => true,
				'sort_clone' => true,
				'add_button' => __( 'Thêm slide', 'wb' ),
				'fields' => array(
					array(
						'name' => __( 'Tiêu đề', 'wb' ),
						'id'   => 'slide-title',
						'placeholder' =>'Tiêu đề',
						'type' => 'text',
						'size' => 80,
					),
					array(
						'name' => __( 'Link URL', 'wb' ),
						'id'   => 'slide-url',
						'placeholder' =>'Nhập đường link',
						'size' => 80,
						'type' => 'url',
					),
					array(
						'name' => __( 'Ảnh Desktop', 'wb' ),
						'id'   => 'slide-image-desktop',
						'type' => 'image_advanced',
						'max_file_uploads' => 1,
						'desc' => 'Kích thước 735x245px'
					),
					array(
						'name' => __( 'Ảnh mobile', 'wb' ),
						'id'   => 'slide-image-mobile',
						'type' => 'image_advanced',
						'max_file_uploads' => 1,
						'desc' => 'Kích thước 575x225px'
					),
				),
			),
		),
	);
	
	$meta_boxes[] = array(
		'title'          => 'Cài đặt Banner (dưới slider)',
		'settings_pages' => 'wb-options',
		'fields' => array(
			array(
				'name' => 'Bật/Tắt Banner 1',
				'id'   => 'banner_middle_1_status',
				'type' => 'checkbox',
				'std'  => 1
			),

			array(
				'name' => 'Ảnh Banner 1',
				'id'   => 'banner_middle_1_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status'       => 'false',
			),			
			array(
				'name' => 'Link đích banner 1',
				'id'   => 'banner_middle_1_link',
				'type' => 'url',
				'size' => 100
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Bật/Tắt Banner 2',
				'id'   => 'banner_middle_2_status',
				'type' => 'checkbox',
				'std'  => 1
			),

			array(
				'name' => 'Ảnh Banner 2',
				'id'   => 'banner_middle_2_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status'       => 'false',
			),			
			array(
				'name' => 'Link đích banner 2',
				'id'   => 'banner_middle_2_link',
				'type' => 'url',
				'size' => 100
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Bật/Tắt Banner',
				'id'   => 'banner_wide_status',
				'type' => 'checkbox',
				'std'  => 1
			),

			array(
				'name' => 'Ảnh Banner Wide',
				'id'   => 'banner_wide_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status'       => 'false',
			),			
			array(
				'name' => 'Link đích',
				'id'   => 'banner_wide_link',
				'type' => 'url',
				'size' => 100
			),
		),
	);
	$meta_boxes[] = array(
		'title'          => 'Cài đặt Banner Sidebar',
		'settings_pages' => 'wb-options',
		'fields' => array(
			array(
				'name' => 'Banner Sidebar',
				'id'   => 'banner-sidebar-image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status'       => 'false',
			),			
			array(
				'name' => 'Banner Sidebar Link',
				'id'   => 'banner-sidebar-link',
				'type' => 'url',
				'size' => 100
			),
		),
	);
	
	$meta_boxes[] = array(
		'title'          => 'Cài đặt Hotline / Social / Bản đồ',
		'settings_pages' => 'wb-options',
		'fields' => array(
			array(
				'name' => 'Địa chỉ',
				'id'   => 'address',
				'type' => 'text',

			),
			array(
				'name' => 'SĐT',
				'id'   => 'numberphone',
				'type' => 'text',

			),
			array(
				'name' => 'Hotline',
				'id'   => 'hotline',
				'type' => 'text',

			),
			array(
				'name' => 'Email',
				'id'   => 'email',
				'type' => 'text',

			),			
			array(
				'name' => 'Link Zalo',
				'id'   => 'zalo',
				'type' => 'url',
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Link Facebook Page',
				'id'   => 'facebook',
				'type' => 'url',
				'size' => 100
			),
			array(
				'name' => 'Link Messenger',
				'id'   => 'messenger',
				'type' => 'url',
				'size' => 100
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Link Twitter',
				'id'   => 'twitter',
				'type' => 'url',
				'size' => 100
			),
			array(
				'name' => 'Link Instagram',
				'id'   => 'instagram',
				'type' => 'url',
				'size' => 100
			),
			array(
				'name' => 'Link Pinterest',
				'id'   => 'pinterest',
				'type' => 'url',
				'size' => 100
			),
			array(
				'name' => 'Link Youtube',
				'id'   => 'youtube',
				'type' => 'url',
				'size' => 100
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Bản đồ',
				'id'   => 'google_maps',
				'type' => 'url',
				'size' => 100
			),
		),
	);
	return $meta_boxes;
}