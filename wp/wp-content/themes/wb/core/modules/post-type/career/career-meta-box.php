<?php
add_filter( 'rwmb_meta_boxes', 'wb_career_meta_box' );
function wb_career_meta_box( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'   => 'Thông tin tuyển dụng',
		'post_types' => 'career',
		'fields' => array(
			array(
				'name'    => 'Tóm tắt Mô tả công việc',
				'id'      => 'career_desc',
				'type'    => 'wysiwyg',
				'raw'     => false,
				'options' => array(
					'textarea_rows' => 3,
					'teeny'         => true,
				),
			),
			array(
				'name'            => 'Hình thức làm việc',
				'id'              => 'career_ht',
				'type'            => 'select_advanced',
				'options'         => array(
					'Toàn thời gian'       	=> 'Toàn thời gian',
					'Bán thời gian' 		=> 'Bán thời gian',
					'Lao động phổ thông'    => 'Lao động phổ thông',
					'Lao động thời vụ'     	=> 'Lao động thời vụ',
					'Theo công trình/dự án' => 'Theo công trình / Dự án',
					'Linh hoạt'     		=> 'Linh hoạt',
					'Tự do'      			=> 'Tự do',
					'Làm việc từ xa'     	=> 'Làm việc từ xa',
					'Khác'					=> 'Khác'
				),
				'multiple'        => false,
				'placeholder'     => 'Lựa chọn',
				'select_all_none' => false,
			),
			array(
				'type' => 'divider',
			),
			array(
				'name' => 'Mức lương',
				'id'   => 'career_salary',
				'type' => 'text',
				'size' => 80
			),
			array(
				'name' => 'Địa điểm làm việc',
				'id'   => 'career_location',
				'type' => 'text',
				'size' => 80
			),
			
			array(
				'name' => 'Hạn nộp hồ sơ / CV ứng tuyển',
				'id'         => 'exprire_date',
				'type'       => 'date',
				'js_options' => array(
					'dateFormat'      => 'dd-mm-yy',
					'showButtonPanel' => false,
				),
				'inline' => false,
				'timestamp' => false,
			),
			
			
		),
	);
	return $meta_boxes;
}