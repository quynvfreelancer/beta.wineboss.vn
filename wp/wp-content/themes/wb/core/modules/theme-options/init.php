<?php
// Create settings page
if( ! function_exists('theme_option_settings_pages')){
    function theme_option_settings_pages( $settings_pages ){
        $settings_pages[] = array(
            'id'            => 'wb-options',
            'option_name'   => 'wb-options',
            'menu_title'    => 'Theme Options' ,
            'icon_url'      => 'dashicons-admin-generic',
            'style'         => 'boxes',
            'columns'       => 1,
            'tabs'          => array(
                'slide'              => 'Home - Slide',
                'banner_group_1'     => 'Home - 3 Banner cạnh slide',
                'banner_group_2'     => 'Home - Banner sau sản phẩm Bán Chạy',
                'brand_group'       => 'Home - Slide Thương hiệu',
            ),
        );

        $settings_pages[] = [
            'id'          => 'option_google_form',
            'option_name' => 'option_google_form',
            'menu_title'  => 'Cài đặt form',
            'parent'      => 'wb-options',
        ];

        $settings_pages[] = [
            'id'          => 'policy_options',
            'option_name' => 'policy_options',
            'menu_title'  => 'Chính sách bán hàng',
            'parent'      => 'wb-options',
        ];

        return $settings_pages;
    }
}
add_filter( 'mb_settings_pages', 'theme_option_settings_pages' );


// add metabox file
if( !function_exists('theme_option_meta_box')){
    function theme_option_meta_box( $meta_boxes ) {

        $meta_boxes[] = array(
            'title'          => __( 'Cài đặt slider' ),
            'settings_pages' => 'wb-options',
            'tab'            => 'slide',
            'fields'         => array(
                array(
                    'id'            => 'slide_group',
                    'type'          => 'group',
                    'collapsible'   => true,
                    'save_state'    => true,
                    'group_title'   => array( 'field' => 'slide_title' ),
                    'clone'         => true,
                    'sort_clone'    => true,
                    'add_button'    => __( 'Thêm slide', 'wb-options' ),
                    'fields'        => array(
                        array(
                            'name' => __( 'Tiêu đề', 'wb-options' ),
                            'id'   => 'slide_title',
                            'placeholder' =>'Tiêu đề',
                            'type' => 'text',
                            'size' => 80,
                        ),
                        array(
                            'name' => __( 'Link URL', 'wb-options' ),
                            'id'   => 'slide_url',
                            'placeholder' =>'Nhập đường link',
                            'size' => 80,
                            'type' => 'text',
                        ),
                        array(
                            'name' => __( 'Ảnh Slide', 'wb-options' ),
                            'id'   => 'slide_image',
                            'type' => 'image_advanced',
                            'max_file_uploads' => 1,
                            'desc' => 'Kích thước 730px * 275px'
                        ),
                    ),
                ),
            ),
        );

        $meta_boxes[] = array(
            'title'          => __( 'Cài đặt 3 banner quanh slide' ),
            'settings_pages' => 'wb-options',
            'tab'            => 'banner_group_1',
            'fields'         => array(
                // banner 1
                array(
                    'name' => __( 'Link banner 1', 'wb-options' ),
                    'id'   => 'banner_link_1',
                    'placeholder' =>'Nhập đường link',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner 1', 'wb-options' ),
                    'id'   => 'banner_image_1',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 365px * 130px'
                ),

                // banner 2
                array(
                    'name' => __( 'Link banner 2', 'wb-options' ),
                    'id'   => 'banner_link_2',
                    'placeholder' =>'Nhập đường link',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner 2', 'wb-options' ),
                    'id'   => 'banner_image_2',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 365px * 130px'
                ),

                // banner 3
                array(
                    'name' => __( 'Link banner 3', 'wb-options' ),
                    'id'   => 'banner_link_3',
                    'placeholder' =>'Nhập đường link',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner 3', 'wb-options' ),
                    'id'   => 'banner_image_3',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 1110px * 110px'
                ),
            ),
        );

        $meta_boxes[] = array(
            'title'          => __( 'Cài đặt banner dưới Sản phẩm nổi bật' ),
            'settings_pages' => 'wb-options',
            'tab'            => 'banner_group_2',
            'fields'         => array(
                // banner 4
                array(
                    'name' => __( 'Link banner 4', 'wb-options' ),
                    'id'   => 'banner_link_4',
                    'placeholder' =>'Nhập đường link',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner 4', 'wb-options' ),
                    'id'   => 'banner_image_4',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 540px * 285px'
                ),

                // banner 5
                array(
                    'name' => __( 'Link banner 5', 'wb-options' ),
                    'id'   => 'banner_link_5',
                    'placeholder' =>'Nhập đường link',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner 5', 'wb-options' ),
                    'id'   => 'banner_image_5',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 540px * 285px'
                ),
            ),
        );

        $meta_boxes[] = array(
            'title'          => __( 'Cài đặt logo các thương hiệu' ),
            'settings_pages' => 'wb-options',
            'tab'            => 'brand_group',
            'fields'         => array(
                array(
                    'id'            => 'brand_group',
                    'type'          => 'group',
                    'collapsible'   => true,
                    'save_state'    => true,
                    'clone'         => true,
                    'sort_clone'    => true,
                    'add_button'    => __( 'Thêm slide', 'wb-options' ),
                    'fields'        => array(
                        array(
                            'name' => __( 'Link brand', 'wb-options' ),
                            'id'   => 'brand_link',
                            'placeholder' =>'Nhập đường link',
                            'size' => 80,
                            'type' => 'text',
                        ),
                        array(
                            'name' => __( 'Ảnh brand', 'wb-options' ),
                            'id'   => 'brand_image',
                            'type' => 'image_advanced',
                            'max_file_uploads' => 1,
                            'desc' => 'Kích thước 150px * 40px - nền trắng hoặc không nền'
                        ),
                    ),
                ),
            ),
        );

        return $meta_boxes;
    }
}
add_filter( 'rwmb_meta_boxes', 'theme_option_meta_box' );


if( !function_exists('form_option_meta_box')){
    function form_option_meta_box( $meta_boxes ) {
        $meta_boxes[] = array(
            'title'          => 'Cài đặt form Đăng Ký tư vấn - Chi tiết sản phẩm',
            'settings_pages' => 'option_google_form',
            'fields'         => array(
                array(
                    'name' => 'Url action',
                    'id'   => 'action_url_form_register',
                    'type' => 'text',
                    'placeholder' => 'https://docs.google.com/forms/u/2/d/e/.../formResponse',
                    'size' => 100,
                ),
                array(
                    'name' => 'Entry phone',
                    'id'   => 'entry_phone_form_register',
                    'type' => 'text',
                    'placeholder' => 'entry.2130082295',
                ),
                array(
                    'name' => 'Entry product title',
                    'id'   => 'entry_product_form_register',
                    'type' => 'text',
                    'placeholder' => 'entry.2130082295',
                ),
                array(
                    'name' => 'Entry url',
                    'id'   => 'entry_url_form_register',
                    'type' => 'text',
                    'placeholder' => 'entry.383052786',
                ),
                array(
                    'name' => 'Entry url 2',
                    'id'   => 'entry_url_referrer_form_register',
                    'type' => 'text',
                    'placeholder' => 'entry.383052786',
                ),
            ),
        );
        $meta_boxes[] = array(
            'title'          => 'Cài đặt form liên hệ',
            'settings_pages' => 'option_google_form',
            'fields'         => array(
                array(
                    'name' => 'Url action',
                    'id'   => 'action_url_form_contact',
                    'type' => 'text',
                    'placeholder' => 'https://docs.google.com/forms/u/2/d/e/.../formResponse',
                    'size' => 100,
                ),
                array(
                    'name' => 'Entry fullname',
                    'id'   => 'entry_fullname_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.145281139',
                ),
                array(
                    'name' => 'Entry Email',
                    'id'   => 'entry_email_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.2130082295',
                ),
                array(
                    'name' => 'Entry phone',
                    'id'   => 'entry_phone_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.2130082295',
                ),
                array(
                    'name' => 'Entry nội dung',
                    'id'   => 'entry_content_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.383052786',
                ),
                array(
                    'name' => 'Entry url',
                    'id'   => 'entry_url_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.383052786',
                ),
                array(
                    'name' => 'Entry url 2',
                    'id'   => 'entry_url_referrer_form_contact',
                    'type' => 'text',
                    'placeholder' => 'entry.383052786',
                ),
            ),
        );
        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'form_option_meta_box' );
}


if( !function_exists('policy_option_meta_box')){
    function policy_option_meta_box( $meta_boxes ) {
        $meta_boxes[] = array(
            'title'          => 'Chính sách bán hàng - Chi tiết sản phẩm',
            'settings_pages' => 'policy_options',
            'fields'         => array(
                array(
                    'id'            => 'policy_product_group',
                    'type'          => 'group',
                    'collapsible'   => true,
                    'save_state'    => true,
                    'clone'         => true,
                    'sort_clone'    => true,
                    'group_title'   => array( 'field' => 'policy' ),
                    'fields'        => array(
                        array(
                            'name' => __( 'Nội dung', 'wb-options' ),
                            'id'   => 'policy',
                            'size' => 80,
                            'type' => 'text',
                        ),
                    ),
                ),
            ),
        );
        $meta_boxes[] = array(
            'title'          => 'Ảnh banner',
            'settings_pages' => 'policy_options',
            'fields'         => array(
                array(
                	'name' => __( 'Nội dung', 'wb-options' ),
                    'id'   => 'url_policy_image',
                    'size' => 80,
                    'type' => 'text',
                ),
                array(
                    'name' => __( 'Ảnh banner', 'wb-options' ),
                    'id'   => 'policy_image',
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'desc' => 'Kích thước 340px * 175px'
                ),
            ),
        );
        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'policy_option_meta_box' );
}