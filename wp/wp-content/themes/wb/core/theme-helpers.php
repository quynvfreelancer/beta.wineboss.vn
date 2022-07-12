<?php
function wb_post_excerpt($number_word){
	$post_excerpt = get_the_content();
	if(str_word_count($post_excerpt) > $number_word){
		$post_excerpt = wp_trim_words($post_excerpt,$number_word,'...');
	}
	return $post_excerpt;
}
function wb_short_title($number_word){
	$post_title =  get_the_title();
	if(str_word_count($post_title) > $number_word){
		$post_title = wp_trim_words($post_title,$number_word,'...');
	}
	return $post_title;
}
function wb_pagination(){
	?>
	<div class="pagination-nav">
		<ul class="pagination " role="navigation">
			<?php
			global $wp_query;
			$big = 999999999;
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'prev_text' => __('« Trước'),
				'next_text' => __('Sau »'),
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
			) );
			?>
		</ul>
	</div>
	<?php
}

function wb_get_primary_term($post_id,$taxonomy){
	$terms = get_the_terms($post_id,$taxonomy);
	if ($terms){		
		if ( class_exists('WPSEO_Primary_Term') ){
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term,$taxonomy );
			if (is_wp_error($term)) { 
				$term_primary = $terms[0]->slug;
			} else {
				$term_primary = $term->slug;
			}
		} 
		else {
			$term_primary = $terms[0]->slug;
		}
	}
	return $term_primary;
}
function wb_get_post_by_slug( $slug, $post_type = 'post', $unique = true ){
	$args=array(
		'name' => $slug,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => 1
	);
	$my_posts = get_posts( $args );
	if( $my_posts ) {
		if( $unique ){
			return $my_posts[ 0 ];
		}else{
			return $my_posts;
		}
	}
	return false;
}
function wb_makeslug($str) {
	$str = trim(mb_strtolower($str));
	$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
	$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
	$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
	$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
	$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
	$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
	$str = preg_replace('/(đ)/', 'd', $str);
	$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
	$str = preg_replace('/([\s]+)/', '-', $str);
	return $str;
}

function is_child_term_featured($term_id){
	$is_featured = false;
	$featured_child = get_term_meta( $term_id, 'featured-child-term', true );
	if(isset($featured_child) && $featured_child ==1){
		$is_featured = true;
	}
	return $is_featured;
}
function get_yoast_seo_title($post_id) {
	$yoast_title = get_post_meta($post_id, '_yoast_wpseo_title', true);
	return $yoast_title;
}

function wb_get_popular_post($number_post,$post_not_in){
	$args_popular = array(
		'post_type' => 'post',
		'orderby' =>'date',
		'order' => 'DESC',
		'post__not_in' => $post_not_in,
		'posts_per_page' => $number_post,
		'orderby'  => array( 'meta_value_num' => 'DESC','title' => 'ASC'),
		'meta_key' =>  'wb-post-views',
	);
	$popular_post = new WP_Query($args_popular);
	return $popular_post;
}
function wb_get_value_setting($key, $setting){
	if(isset($setting[$key]) && $setting[$key] != ''){
		return $setting[$key];
	}else{
		return '';
	}
}