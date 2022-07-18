<?php 
require_once dirname(__FILE__). '/simple-link-list/simple-link-list-widget.php';
// Enqueue additional admin scripts
add_action('admin_enqueue_scripts', 'wb_add_widget_script');
function wb_add_widget_script() {
	wp_enqueue_media();
	wp_enqueue_script('widget_script', get_template_directory_uri() . '/core/modules/widget/js/widget.js', false, '1.0.0', true);
}
/**
* Sản phẩm trang chủ
*/
class Widget_Product extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_product',
			'description' => 'List sp trang chủ',
		);
		parent::__construct( 'widget_product', 'Sản phẩm - Grid', $widget_ops );
	}
	public function widget( $args, $instance ) {
		extract( $args );
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}	
		if ( ! empty( $instance['css_class'] ) ) {
			$css_class = $instance['css_class'];
		}else{
			$css_class = '';
		}
		if ( ! empty( $instance['number_post'] ) ) {
			$number_post = $instance['number_post'];
		}
		if ( ! empty( $instance['category'] ) ) {
			$category = $instance['category'];
		}
		if ( ! empty( $instance['sub_menu'] ) ) {
			$sub_menu = $instance['sub_menu'];
		}else{
			$sub_menu = '';
		}

		$idObj = get_term_by('slug',$category, 'product_cat');
		$cat_id = $idObj->term_id;
		$category_link = get_term_link( $idObj,'product_cat');
		$agrs_product = array(
			'post_type' => 'product',
			'posts_per_page' => $number_post,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $category)
			)
		);
		$list_product = new WP_Query($agrs_product);
		$total = $idObj->count;
		?>
		<div class="widget widget-product">
			<div class="widget-header">
				<h2 class="widget-title">
					<a href="<?php echo $category_link;?>">
						<?php 
						if ( ! empty( $instance['title'] ) ) {
							echo  apply_filters( 'widget_title', $instance['title'] ) ;
						}
						?>
					</a>
				</h2>				
				<?php 
				if($sub_menu !=''){
					wp_nav_menu(
						array(
							'menu'			  => $sub_menu,
							'container'       => '',
							'container_id'    => '',
							'container_class' => '',
							'menu_id'         => false,
							'menu_class'      => 'child-cat product-child-cat',
							'depth'           => 1,

						)
					);
				}
				?>
				<a href="<?php echo $category_link;?>" class="readmore <?php if($sub_menu =='') echo 'ml-auto'; ?>">
					Xem thêm
				</a>
			</div>
			<div class="widget-content">
				<div class="list-product row">
					<?php

					if ($list_product->have_posts()):
						while ($list_product->have_posts()):$list_product->the_post();
							get_template_part( 'template-parts/content', 'product-widget');
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
	}
	public function form( $instance ) {
		$defaults = array( 
			'title' => __( 'Chuyên mục', 'apc' ),
			'css_class' => '',
			'number_post' => 12,
			'category' => 'uncategorized',
			'sub_menu' => ''
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Chuyên mục', 'apc' );
		$css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';
		$product_cover = ! empty( $instance['product_cover'] ) ? $instance['product_cover'] : '';
		$number_post = ! empty( $instance['number_post'] ) ? $instance['number_post'] : esc_html__( '12', 'apc' );
		$category = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( 'uncategorized', 'apc' );
		$sub_menu = ! empty( $instance['sub_menu'] ) ? $instance['sub_menu'] : esc_html__( '', 'apc' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Tiêu đề:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<?php 
			$menus =  wp_get_nav_menus();

			?>
			<label for="<?php echo $this->get_field_id('sub_menu'); ?>">Lựa chọn Menu danh mục: 
				<select class='widefat' id="<?php echo $this->get_field_id('sub_menu'); ?>"
					name="<?php echo $this->get_field_name('sub_menu'); ?>" type="text">
					<option value='' <?php echo ($sub_menu=='')?'selected':''; ?>>
						Chọn menu
					</option>
					<?php 
					if(!empty($menus)){
						foreach ($menus as  $menu) {
							?>
							<option value='<?php echo $menu->term_id;?>'<?php echo ($sub_menu==$menu->term_id)?'selected':''; ?>>
								<?php echo $menu->name; ?>
							</option>
							<?php
						}
					}
					?>
				</select>                
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>"><?php esc_attr_e( 'CSS Class:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_class' ) ); ?>" type="text" value="<?php echo esc_attr( $css_class ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>">
				<?php esc_attr_e( 'Số sp hiển thị:', 'apc' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_post' ) ); ?>" type="text" value="<?php echo esc_attr( $number_post ); ?>">
		</p>
		<p>Chọn danh mục:
			<select name="<?php echo $this->get_field_name('category') ?>" class="widefat">
				<?php
				$taxonomies = array(
					'product_cat',
				);
				$args = array(
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => true,
					'exclude' => array(),
					'exclude_tree' => array(),
					'include' => array(),
					'fields' => 'all',
					'hierarchical' => true,
					'child_of' => 0,
					'pad_counts' => false,
				);
				$cats = get_terms($taxonomies, $args);
				foreach ($cats as $cat) {
					?>
					<option value="<?php echo $cat->slug ?>" <?php if ($category == $cat->slug) echo 'selected' ?>>
						<?php echo $cat->name ?>
					</option>
					<?php
				}
				?>
			</select>
		</p>

		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['css_class'] = ( ! empty( $new_instance['css_class'] ) ) ? strip_tags( $new_instance['css_class'] ) : '';
		$instance['number_post'] = ( ! empty( $new_instance['number_post'] ) ) ? strip_tags( $new_instance['number_post'] ) : '';
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance[ 'sub_menu' ] = $new_instance[ 'sub_menu' ];
		return $instance;
	}
}
add_action( 'widgets_init', function(){
	register_widget( 'Widget_Product' );
});
class Widget_Product_Slide extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_product_slide',
			'description' => 'List sp trang chủ (slide)',
		);
		parent::__construct( 'widget_product_slide', 'Sản phẩm - Slide', $widget_ops );
	}
	public function widget( $args, $instance ) {
		extract( $args );
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}	
		if ( ! empty( $instance['css_class'] ) ) {
			$css_class = $instance['css_class'];
		}else{
			$css_class = '';
		}
		if ( ! empty( $instance['number_post'] ) ) {
			$number_post = $instance['number_post'];
		}
		if ( ! empty( $instance['category'] ) ) {
			$category = $instance['category'];
		}
		if ( ! empty( $instance['sub_menu'] ) ) {
			$sub_menu = $instance['sub_menu'];
		}else{
			$sub_menu = '';
		}

		$idObj = get_term_by('slug',$category, 'product_cat');
		$cat_id = $idObj->term_id;
		$category_link = get_term_link( $idObj,'product_cat');
		$agrs_product = array(
			'post_type' => 'product',
			'posts_per_page' => $number_post,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $category)
			)
		);
		$list_product = new WP_Query($agrs_product);
		
		?>
		<div class="widget-product widget-product-slide">
			<div class="widget-header">
				<h2 class="widget-title">
					<a href="<?php echo $category_link;?>">
						<?php 
						if ( ! empty( $instance['title'] ) ) {
							echo  apply_filters( 'widget_title', $instance['title'] ) ;
						}
						?>
					</a>
				</h2>				
				<?php 
				if($sub_menu !=''){
					wp_nav_menu(
						array(
							'menu'			  => $sub_menu,
							'container'       => '',
							'container_id'    => '',
							'container_class' => '',
							'menu_id'         => false,
							'menu_class'      => 'child-cat',
							'depth'           => 1,

						)
					);
				}
				?>
				<a href="<?php echo $category_link;?>" class="readmore <?php if($sub_menu =='') echo 'ml-auto'; ?>">
					Xem thêm
				</a>
			</div>
			<div class="widget-content">
				<div class="list-product row">
					<?php

					if ($list_product->have_posts()):
						while ($list_product->have_posts()):$list_product->the_post();
							get_template_part( 'template-parts/content', 'product-widget');
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
	}
	public function form( $instance ) {
		$defaults = array( 
			'title' => __( 'Chuyên mục', 'apc' ),
			'css_class' => '',
			'number_post' => 10,
			'category' => 'uncategorized',
			'sub_menu' => ''
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Chuyên mục', 'apc' );
		$css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';
		$product_cover = ! empty( $instance['product_cover'] ) ? $instance['product_cover'] : '';
		$number_post = ! empty( $instance['number_post'] ) ? $instance['number_post'] : esc_html__( '10', 'apc' );
		$category = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( 'uncategorized', 'apc' );
		$sub_menu = ! empty( $instance['sub_menu'] ) ? $instance['sub_menu'] : esc_html__( '', 'apc' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Tiêu đề:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<?php 
			$menus =  wp_get_nav_menus();

			?>
			<label for="<?php echo $this->get_field_id('sub_menu'); ?>">Lựa chọn Menu danh mục: 
				<select class='widefat' id="<?php echo $this->get_field_id('sub_menu'); ?>"
					name="<?php echo $this->get_field_name('sub_menu'); ?>" type="text">
					<option value='' <?php echo ($sub_menu=='')?'selected':''; ?>>
						Chọn menu
					</option>
					<?php 
					if(!empty($menus)){
						foreach ($menus as  $menu) {
							?>
							<option value='<?php echo $menu->term_id;?>'<?php echo ($sub_menu==$menu->term_id)?'selected':''; ?>>
								<?php echo $menu->name; ?>
							</option>
							<?php
						}

					}
					?>
				</select>                
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>"><?php esc_attr_e( 'CSS Class:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_class' ) ); ?>" type="text" value="<?php echo esc_attr( $css_class ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>">
				<?php esc_attr_e( 'Số sp hiển thị:', 'apc' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_post' ) ); ?>" type="text" value="<?php echo esc_attr( $number_post ); ?>">
		</p>
		<p>Chọn danh mục:
			<select name="<?php echo $this->get_field_name('category') ?>" class="widefat">
				<?php
				$taxonomies = array(
					'product_cat',
				);
				$args = array(
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => true,
					'exclude' => array(),
					'exclude_tree' => array(),
					'include' => array(),
					'fields' => 'all',
					'hierarchical' => true,
					'child_of' => 0,
					'pad_counts' => false,
				);
				$cats = get_terms($taxonomies, $args);

				foreach ($cats as $cat) {
					?>
					<option value="<?php echo $cat->slug ?>" <?php if ($category == $cat->slug) echo 'selected' ?>>
						<?php echo $cat->name ?>
					</option>
					<?php
				}
				?>
			</select>
		</p>

		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['css_class'] = ( ! empty( $new_instance['css_class'] ) ) ? strip_tags( $new_instance['css_class'] ) : '';
		$instance['number_post'] = ( ! empty( $new_instance['number_post'] ) ) ? strip_tags( $new_instance['number_post'] ) : '';
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance[ 'sub_menu' ] = $new_instance[ 'sub_menu' ];


		return $instance;

	}
}
add_action( 'widgets_init', function(){
	register_widget( 'Widget_Product_Slide' );
});

class Widget_Banner_Wide extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_banner_wide',
			'description' => 'Banner Wide Homepage',
		);
		parent::__construct( 'widget_banner_wide', 'Banner Wide', $widget_ops );
	}
	public function widget( $args, $instance ) {
		extract( $args );
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		if ( ! empty( $instance['css_class'] ) ) {
			$css_class = $instance['css_class'];
		}else{
			$css_class = '';
		}
		if ( ! empty( $instance['banner_link'] ) ) {
			$banner_link = $instance['banner_link'];
		}else{
			$banner_link = '#';
		}
		if ( ! empty( $instance['image_uri'] ) ) {
			$image_uri = $instance['image_uri'];
		}
		?>
		<div class="mb-3 d-none d-md-block <?php echo $css_class; ?>">
			<a href="<?php echo $banner_link;?>" target="_blank">
				<img src="<?php echo esc_url($image_uri); ?>" alt="">
			</a>
		</div>
		<?php
	}
	public function form( $instance ) {
		$defaults = array( 
			'title' => __( 'Banner', 'apc' ),
			'css_class' => ''
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Banner Wide', 'apc' );
		$css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';
		$banner_link = ! empty( $instance['banner_link'] ) ? $instance['banner_link'] : '#';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Tiêu đề:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>"><?php esc_attr_e( 'CSS Class:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_class' ) ); ?>" type="text" value="<?php echo esc_attr( $css_class ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link' ) ); ?>"><?php esc_attr_e( 'Banner Link:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_link' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_link ); ?>">
		</p>
		<p>
			<label for="<?= $this->get_field_id( 'image_uri' ); ?>">Ảnh banner ( 1200x65 pixel )</label>

			<img class="<?= $this->id ?>_img" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" style="margin:15px 0;padding:0;max-width:100%;display:block"/>
			<input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name( 'image_uri' ); ?>" value="<?= $instance['image_uri'] ?? ''; ?>" style="margin-top:5px;" />
			<input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['css_class'] = ( ! empty( $new_instance['css_class'] ) ) ? strip_tags( $new_instance['css_class'] ) : '';
		$instance['banner_link'] = ( ! empty( $new_instance['banner_link'] ) ) ? strip_tags( $new_instance['banner_link'] ) : '#';
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		return $instance;
	}
}
add_action( 'widgets_init', function(){
	register_widget( 'Widget_Banner_Wide' );
});

class Widget_Banner_Multi extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_banner_multi',
			'description' => 'Banner Multi Image',
		);
		parent::__construct( 'widget_banner_multi', 'Banner Multi Image', $widget_ops );
	}
	public function widget( $args, $instance ) {
		extract( $args );
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		if ( ! empty( $instance['css_class'] ) ) {
			$css_class = $instance['css_class'];
		}else{
			$css_class = '';
		}

		if ( ! empty( $instance['banner_link_1'] ) ) {
			$banner_link_1 = $instance['banner_link_1'];
		}else{
			$banner_link_1 = '#';
		}
		if ( ! empty( $instance['banner_link_2'] ) ) {
			$banner_link_2 = $instance['banner_link_2'];
		}else{
			$banner_link_2 = '#';
		}
		if ( ! empty( $instance['banner_link_3'] ) ) {
			$banner_link_3 = $instance['banner_link_3'];
		}else{
			$banner_link_3 = '#';
		}


		if ( ! empty( $instance['image_uri_1'] ) ) {
			$image_uri_1 = $instance['image_uri_1'];
		}
		if ( ! empty( $instance['image_uri_2'] ) ) {
			$image_uri_2 = $instance['image_uri_2'];
		}
		if ( ! empty( $instance['image_uri_3'] ) ) {
			$image_uri_3 = $instance['image_uri_3'];
		}
		?>

		<div class="widget-banner banner-col-3 <?php echo $css_class; ?>">
			<div class="widget-header">
				<h2 class="widget-title">
					<?php 
					if ( ! empty( $instance['title'] ) ) {
						$title = $instance['title'];
						echo  apply_filters( 'widget_title', $instance['title'] ) ;
					}
					?>
				</h2>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<a href="<?php echo $banner_link_1;?>" target="_blank">
						<img src="<?php echo esc_url($image_uri_1); ?>" alt="<?php echo $title;?>">
					</a>
					
				</div>
				<div class="col-md-4  col-sm-4">
					<a href="<?php echo $banner_link_2;?>" target="_blank">
						<img src="<?php echo esc_url($image_uri_2); ?>" alt="<?php echo $title;?>">
					</a>
				</div>
				<div class="col-md-4  col-sm-4">
					<a href="<?php echo $banner_link_3;?>" target="_blank">
						<img src="<?php echo esc_url($image_uri_3); ?>" alt="<?php echo $title;?>">
					</a>
				</div>
			</div>			
		</div>
		<?php
	}
	public function form( $instance ) {
		$defaults = array( 
			'title' => __( 'Banner', 'apc' ),
			'css_class' => ''
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Banner Wide', 'apc' );
		$css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';
		$banner_link_1 = ! empty( $instance['banner_link_1'] ) ? $instance['banner_link_1'] : '#';
		$banner_link_2 = ! empty( $instance['banner_link_2'] ) ? $instance['banner_link_2'] : '#';
		$banner_link_3 = ! empty( $instance['banner_link_3'] ) ? $instance['banner_link_3'] : '#';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Tiêu đề:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>"><?php esc_attr_e( 'CSS Class:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_class' ) ); ?>" type="text" value="<?php echo esc_attr( $css_class ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link_1' ) ); ?>"><?php esc_attr_e( 'Banner Link 1:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_link_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_link_1' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_link_1 ); ?>">
		</p>
		<p>
			<label for="<?= $this->get_field_id( 'image_uri_1' ); ?>">Ảnh banner ( 1200x65 pixel )</label>

			<img class="<?= $this->id ?>-1_img" src="<?= (!empty($instance['image_uri_1'])) ? $instance['image_uri_1'] : ''; ?>" style="margin:15px 0;padding:0;max-width:100%;display:block"/>
			<input type="text" class="widefat <?= $this->id ?>-1_url" name="<?= $this->get_field_name( 'image_uri_1' ); ?>" value="<?= $instance['image_uri_1'] ?? ''; ?>" style="margin-top:5px;" />
			<input type="button" id="<?= $this->id ?>-1"  data-id ="1" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link_2' ) ); ?>"><?php esc_attr_e( 'Banner Link 2:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_link_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_link_2' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_link_2 ); ?>">
		</p>
		<p>
			<label for="<?= $this->get_field_id( 'image_uri_2' ); ?>">Ảnh banner ( 1200x65 pixel )</label>

			<img class="<?= $this->id ?>-2_img" src="<?= (!empty($instance['image_uri_2'])) ? $instance['image_uri_2'] : ''; ?>" style="margin:15px 0;padding:0;max-width:100%;display:block"/>
			<input type="text" class="widefat <?= $this->id ?>-2_url" name="<?= $this->get_field_name( 'image_uri_2' ); ?>" value="<?= $instance['image_uri_2'] ?? ''; ?>" style="margin-top:5px;" />
			<input type="button" id="<?= $this->id ?>-2"  data-id ="2" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link_3' ) ); ?>"><?php esc_attr_e( 'Banner Link 3:', 'apc' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_link_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_link_3' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_link_3 ); ?>">
		</p>
		<p>
			<label for="<?= $this->get_field_id( 'image_uri_3' ); ?>">Ảnh banner ( 1200x65 pixel )</label>

			<img class="<?= $this->id ?>-3_img" src="<?= (!empty($instance['image_uri_3'])) ? $instance['image_uri_3'] : ''; ?>" style="margin:15px 0;padding:0;max-width:100%;display:block"/>
			<input type="text" class="widefat <?= $this->id ?>-3_url" name="<?= $this->get_field_name( 'image_uri_3' ); ?>" value="<?= $instance['image_uri_3'] ?? ''; ?>" style="margin-top:5px;" />
			<input type="button" id="<?= $this->id ?>-3"  data-id ="3" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['css_class'] = ( ! empty( $new_instance['css_class'] ) ) ? strip_tags( $new_instance['css_class'] ) : '';

		$instance['banner_link_1'] = ( ! empty( $new_instance['banner_link_1'] ) ) ? strip_tags( $new_instance['banner_link_1'] ) : '#';
		$instance['banner_link_2'] = ( ! empty( $new_instance['banner_link_2'] ) ) ? strip_tags( $new_instance['banner_link_2'] ) : '#';
		$instance['banner_link_3'] = ( ! empty( $new_instance['banner_link_3'] ) ) ? strip_tags( $new_instance['banner_link_3'] ) : '#';

		$instance['image_uri_1'] = strip_tags( $new_instance['image_uri_1'] );
		$instance['image_uri_2'] = strip_tags( $new_instance['image_uri_2'] );
		$instance['image_uri_3'] = strip_tags( $new_instance['image_uri_3'] );

		return $instance;
	}
}
add_action( 'widgets_init', function(){
	register_widget( 'Widget_Banner_Multi' );
});