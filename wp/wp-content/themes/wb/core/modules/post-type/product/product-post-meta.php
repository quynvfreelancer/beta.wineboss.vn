<?php
add_filter( 'rwmb_meta_boxes', 'wb_product_meta_box' );
function wb_product_meta_box( $meta_boxes ) {
	$settings = get_option( 'product-options' );
	$dung_tich = array();
	$vung_lam_vang = array();
	$xuat_xu = array();
	$giong_nho = array();
	$hang_san_xuat = array();
	$nong_do = array();
	$quy_cach = array();

	if ( isset( $settings['dung_tich'] ) ) {
		$dung_tich_str =  $settings['dung_tich'];
		$dung_tich = explode(', ', $dung_tich_str);
	}
	
	if ( isset( $settings['xuat_xu'] ) ) {
		$xuat_xu_str =  $settings['xuat_xu'];
		$xuat_xu = explode(', ', $xuat_xu_str);
	}
	if ( isset( $settings['vung_lam_vang'] ) ) {
		$vung_lam_vang_str =  $settings['vung_lam_vang'];
		$vung_lam_vang = explode(', ', $vung_lam_vang_str);
		
	}
	if ( isset( $settings['hang_san_xuat'] ) ) {
		$hang_san_xuat_str =  $settings['hang_san_xuat'];
		$hang_san_xuat = explode(', ', $hang_san_xuat_str);
		
	}
	if ( isset( $settings['giong_nho'] ) ) {
		$giong_nho_str =  $settings['giong_nho'];
		$giong_nho = explode(', ', $giong_nho_str);
		
	}
	if ( isset( $settings['nong_do'] ) ) {
		$nong_do_str =  $settings['nong_do'];
		$nong_do = explode(', ', $nong_do_str);
		
	}
	if ( isset( $settings['quy_cach'] ) ) {
		$quy_cach_str =  $settings['quy_cach'];
		$quy_cach = explode(', ', $quy_cach_str);
		
	}

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
			
		),
	);
	$meta_boxes[] = array(
		'title'   => 'Dữ liệu sản phẩm',
		'post_types' => 'product',
		'context'	=> 'advanced',
		'tabs'      => array(
			'product-general' => array(
				'label' => 'Thông tin chung',
				'icon'  => 'dashicons-admin-tools', 
			),
			'product-attribute'  => array(
				'label' => 'Các thuộc tính',
				'icon'  => 'dashicons-share-alt', 
			),
			'product-stock'  => array(
				'label' => 'Kiểm kê kho',
				'icon'  => 'dashicons-media-text', 
			),
			'product-gallery'  => array(
				'label' => 'Ảnh sản phẩm',
				'icon'  => 'dashicons-images-alt2', 
			),
		),
		'tab_style' => 'left',
		'tab_wrapper' => true,
		'fields' => array(
			array(
				'tab'  => 'product-general',
				'name' => 'Tên rút gọn (nếu có)',
				'id'   => 'product_short_name',
				'type' => 'text',
				'size'=> 80
			),			
			array(
				'tab'  => 'product-general',
				'type' => 'divider',
			),
			array(
				'tab'  => 'product-stock',
				'name' => 'Mã sản phẩm',
				'id'   => 'product_sku',
				'required' => true,  
				'type' => 'text',
			),
			array(
				'tab'  => 'product-stock',
				'name' => 'Còn hàng',
				'id'   => '_in_stock',
				'type'      => 'switch',
				'style'     => 'rounded',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'std'		=> 1
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
				'tab'  => 'product-gallery',
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
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'xuat_xu_datalist',
					'options' => $xuat_xu,
				],
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Dung tích',
				'id'   => 'dung_tich',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'dung_tich_datalist',
					'options' => $dung_tich,
				],
			),
			array(
				'tab'  => 'product-attribute',
				'name' => 'Nồng độ',
				'id'   => 'nong_do',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'nong_do_datalist',
					'options' => $nong_do,
				],
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Vùng làm vang',
				'id'   => 'vung_lam_vang',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'vung_lam_vang_datalist',
					'options' => $vung_lam_vang,
				],
			),	
			array(
				'tab'  => 'product-attribute',
				'name' => 'Giống nho',
				'id'   => 'giong_nho',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'giong_nho_datalist',
					'options' => $giong_nho,
				],
			),
			array(
				'tab'  => 'product-attribute',
				'name' => 'Hãng sản xuất',
				'id'   => 'hang_san_xuat',
				'desc'        => 'Hãng sản xuất /  Thương hiệu',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'hang_san_xuat_datalist',
					'options' => $hang_san_xuat,
				],
			),
			array(
				'tab'  => 'product-attribute',
				'name' => 'Quy cách',
				'id'   => 'quy_cach',
				'type'        => 'text',
				'datalist'    => [
					'id'      => 'quy_cach_datalist',
					'options' => $quy_cach,
				],
			),
			array(
				'tab'  => 'product-attribute',
				'type' => 'divider',
			),
		),
	);

return $meta_boxes;
}