<?php
add_filter( 'rwmb_meta_boxes', 'wb_post_meta_box' );
function wb_post_meta_box( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'   => 'Tùy chọn hiển thị',
		'fields' => array(
			array(
				'name' => 'Tin Nổi bật (sidebar)',
				'id'   => 'featured_post',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Tin nổi bật chuyên mục',
				'id'   => 'featured_post_cat',
				'type' => 'checkbox',
			),
		),
	);
	return $meta_boxes;
}