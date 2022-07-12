<?php
add_filter( 'rwmb_meta_boxes', 'wb_product_meta_box' );
function wb_product_meta_box( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'   => 'Thông tin sản phẩm',
		'post_types' => 'product',
		'fields' => array(
			array(
				'name' => 'Tên rút gọn (nếu có)',
				'id'   => 'product_short_name',
				'type' => 'text',
				'size'=> 50
			),
			array(
				'name' => 'Sản phẩm nổi bật',
				'id'   => 'featured_product',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Sản phẩm mới',
				'id'   => 'new_product',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Sản phẩm khuyến mãi',
				'id'   => 'sale_product',
				'type' => 'checkbox',
			),
			array(
				'type' => 'divider',
			),

			array(
				'name' => 'Mã sản phẩm',
				'id'   => 'product_sku',
				'required' => true,  
				'type' => 'text',
			),			
			array(
				'name' => 'Mô tả ngắn',
				'id'   => 'product_desc',
				'type' => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
				),
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Giá',
				'id'   => 'product_normal_price',
				'type' => 'number',
				'required' => true,  
			),		
			array(
				'name' => 'Giá khuyến mãi',
				'id'   => 'product_sale_price',
				'type' => 'number',
			),
			

			
			array(
				'type' => 'divider',
			),			
			array(
				'id'               => 'product_image',
				'name'             => 'Ảnh sản phẩm',
				'type'             => 'image_advanced',
				'force_delete'     => false,
				'max_file_uploads' => 8,
				'max_status'       => 'false',
				'image_size'       => 'thumbnail',
				'required' 		   => true,  
			),
		),
	);
	
	return $meta_boxes;
}