<?php
$settings = get_option( 'product-options' );
if ( isset( $settings['vung_lam_vang'] ) ) {
	$vung_lam_vang_str =  $settings['vung_lam_vang'];
}
$vung_lam_vang = explode(', ', $vung_lam_vang_str);


add_filter( 'rwmb_meta_boxes', 'wb_product_meta_box' );
function wb_product_meta_box( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'   => 'Tuỳ chọn sản phẩm',
		'post_types' => 'product',
		'context'	=> 'side',
		'fields' => array(
			array(
				'name' => 'Sản phẩm nổi bật',
				'id'   => 'featured_product',
				'type'      => 'switch',
				'style'     => 'rounded',
				'on_label'  => 'Yes',
				'off_label' => 'No',
			),
			array(
				'name' => 'Còn hàng',
				'id'   => '_in_stock',
				'type'      => 'switch',
				'style'     => 'rounded',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'std'		=> 1
			),
		),
	);
	$meta_boxes[] = array(
		'title'   => 'Thông tin chung',
		'post_types' => 'product',
		'context'	=> 'advanced',
		'tabs'      => array(
			'product-general' => array(
				'label' => 'Thông tin sản phẩm',
				'icon'  => 'dashicons-media-text', 
			),
			'product-attribute'  => array(
				'label' => 'Thuộc tính sản phẩm',
				'icon'  => 'dashicons-share-alt', 
			),
		),
		'tab_style' => 'default',
		'tab_wrapper' => true,
		'fields' => array(
			array(
				'tab'  => 'product-general',
				'name' => 'Tên rút gọn (nếu có)',
				'id'   => 'product_short_name',
				'type' => 'text',
				'size'=> 50
			),			
			array(
				'tab'  => 'product-general',
				'type' => 'divider',
			),
			array(
				'tab'  => 'product-general',
				'name' => 'Mã sản phẩm',
				'id'   => 'product_sku',
				'required' => true,  
				'type' => 'text',
			),			
			array(
				'tab'  => 'product-general',
				'name' => 'Mô tả ngắn',
				'id'   => 'product_desc',
				'type' => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
				),
			),
			array(
				'tab'  => 'product-general',
				'type' => 'divider',
			),
			array(
				'tab'  => 'product-general',
				'name' => 'Giá',
				'id'   => '_regular_price',
				'type' => 'number',
				'required' => true,  
			),		
			array(
				'tab'  => 'product-general',
				'name' => 'Giá khuyến mãi',
				'id'   => '_sale_price',
				'type' => 'number',
			),
			
			array(
				'tab'  => 'product-general',
				'type' => 'divider',
			),			
			array(
				'tab'  => 'product-general',
				'id'               => 'product_image',
				'name'             => 'Ảnh sản phẩm',
				'type'             => 'image_advanced',
				'force_delete'     => false,
				'max_file_uploads' => 8,
				'max_status'       => 'false',
				'image_size'       => 'thumbnail',
				'required' 		   => true,  
			),
			array(
				'tab'  => 'product-attribute',
				'name' => 'Xuất xứ',
				'id'   => 'xuat_xu',
				'type' => 'select_advanced',
				'options'     => [
					'Ý'       => 'Ý',
					'Pháp' => 'Pháp',
					'Chile'   => 'Chile',
					'Canada'  => 'Canada',
					'Mỹ'      => 'Mỹ',
					'Tây Ban Nha'  => 'Tây Ban Nha',
					'Úc'      => 'Úc',
					'Newzeland'      => 'Newzeland',
					'Argentina'      => 'Argentina',
					'Bồ Đào Nha'      => 'Bồ Đào Nha',
					'Áo'      => 'Áo',
					'Đức'      => 'Đức',
				],
				'placeholder' => 'Chọn quốc gia',
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Dung tích',
				'id'   => 'dung_tich',
				'type' => 'text',

			),
			array(
				'tab'  => 'product-attribute',
				'name' => 'Nồng độ',
				'id'   => 'nong_do',
				'type' => 'text',
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Vùng làm vang',
				'id'   => 'vung_lam_vang',
				'type' => 'text',
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Giống nho',
				'id'   => 'giong_nho',
				'type' => 'text',
			),
			array(
				'tab'  => 'product-attribute',
				'type' => 'divider',
			),
		),
	);
	
	return $meta_boxes;
}