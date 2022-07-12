<div class="single-product-info mt-3">
	<div class="row">
		<div class="col-md-5 single-gallery">
			<?php 
			$images = rwmb_meta( 'product_image', array( 'size' => 'full' ) );
			if(!empty($images)):
				echo '<div class="list-gallery-large">';
				foreach ( $images as $image ) {
					echo '<div class="slide-image"><img src="', $image['url'], '"></div>';
				}
				echo '</div>';
			endif;
			?>
			<?php 
			$images_thumb = rwmb_meta( 'product_image', array( 'size' => 'thumbnail' ) );
			if(!empty($images_thumb)):
				echo '<div class="list-gallery-thumb">';
				foreach ( $images_thumb as $image_thumb ) {
					echo '<div class="slide-image"><img src="', $image_thumb['url'], '"></div>';
				}
				echo '</div>';
			endif;
			?>
		</div>
		<div class="col-md-7 single-info-detail">
			<h1 class="product-title">
				<?php the_title(); ?>
			</h1>
			<div class="product-sku mb-1">
				<strong>Mã SP: <span><?php echo rwmb_meta( 'product_sku');  ?></span></strong>
			</div>
			<div class="row mr-0 ml-0">
				<div class="col-md-7">
					<div class="d-flex post-meta row">

						<div class="star-rating col-6">
							<?php
							if(function_exists('kk_star_ratings')){
								echo kk_star_ratings();
							}
							?>
						</div>

					</div>
					<div class="row mt-2">
						<div class="col-md-6 pl-0">
							<?php 
							$product_id = get_the_ID();
							$product_normal_price = rwmb_meta('product_normal_price');
							$product_sale_price = rwmb_meta('product_sale_price');
							if(isset($product_sale_price) && $product_sale_price !=''){
								$is_sale = true;
								$product_price = $product_sale_price;
							}else{
								$is_sale =  false;
								$product_price = $product_normal_price;
							}
							?>
							<span class="product-price">
								<?php if(isset($product_price) && is_numeric($product_price)): ?>
								Giá: <?php echo number_format($product_price); ?> <sup>đ</sup>
							<?php endif; ?>
						</span>
						<span class="product-brand d-none">
							Thương hiệu: <a href="#" class="brand-name">OmRON</a>
						</span>
					</div>
					<div class="col-md-6 pl-0">
						<div class="product-stock">
							Tình trạng: <span class="status">Còn hàng</span>
						</div>
					</div>
					<div class="row mt-2">
						<div class="product-desc col-12 entry">
							<?php echo rwmb_meta( 'product_desc');  ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 product-cart">
						<form action="" method="post" class="add-to-cart">
							<input type="hidden" name="product_id" value="<?php echo $product_id;?>">
							<input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
							<input type="hidden" name="add-to-cart" value="add-to-cart">
							<span class="quantity form-group">
								<input type="button" value="+" class="plus">
								<i class="fa fa-angle-up" aria-hidden="true"></i>
								<input type="number" step="1" min="0" name="product_quantity" value="1"
								title="Qty" id="product_quantity" class="form-control ">
								<input type="button" value="-" class="minus">
								<i class="fa fa-angle-down" aria-hidden="true"></i>
							</span>
							<button type="submit" class="btn btn-add-to-cart">
								+ Thêm vào giỏ
							</button>
						</form>
					</div>
				</div>
				<div class="choose">
					<span>hoặc</span>
				</div>
				<form action="" class="call-me form-inline">
					<div class="form-title">
						Để lại số điện thoại để được tư vấn
					</div>
					<div class="form-group">
						<input type="text" name="numberphone" class="form-control"
						placeholder="Nhập số điện thoại">
						<input type="hidden" name="product" value="sản phẩm a">
						<button class="btn btn-call-me" type="submit">Gửi</button>
					</div>
				</form>
			</div>
			<div class="col-md-5 pr-0 product-benefit">
				<ul class="description-feature">
					<li class="freeship">
						<span class="icon"></span>
						Hàng chính hãng 100%
					</li>
					<li>
						<span class="icon"></span>
						Uy tín chất lượng
					</li>
					<li>
						<span class="icon">

						</span>
						Hỗ trợ liên tục trong quá trình sd
					</li>
					<li>
						<span class="icon"></span>
						Chính sách đổi trả hàng rõ ràng
					</li>
					<li>
						<span class="icon"></span>
						Giao hàng trên toàn quốc
					</li>
					<li>
						<span class="icon"></span>
						Thanh toán tại nhà hoặc qua thẻ
					</li>
					<li>
						<span class="icon"></span>
						Quà tặng và khuyến mãi
					</li>

				</ul>

				<div class="flash-sale-info">
					<a href="#">
						<img src="images/banner/1.jpeg" alt="">
					</a>
				</div>
			</div>
		</div>
		<!--End row-->
	</div>
</div>
</div>

<div class="row page-container">
	<div class="col-md-8 order-1 order-md-1">

		<!--Post content-->
		<div class="entry">
			<h2 class="entry-title">Thông tin sản phẩm</h2>
			<?php the_content(); ?>
		</div>

		<!---End entry--->
		<?php
		get_template_part('template-parts/content','social-share');
		?>
		<div class="post-tag-container">
			<div class="tag-s-title">Từ khóa</div>
			<ul class="post-tag">
				<li>
					<a href="#">#Thiết bị y tế</a>
				</li>
				<li>
					<a href="#">#Sức khỏe</a>
				</li>
				<li>
					<a href="#">#Dụng cụ y tế</a>
				</li>
			</ul>
		</div>
		<!---Comment box-->
		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template(); endif;
		?>
	</div>
	<?php get_sidebar('product'); ?>

	<div class="product-related related-post col-md-12 order-md-3 order-2">
		<div class="widget-product widget-product-slide">
			<div class="related-title">
				Sản phẩm tương tự
			</div>
			<div class="widget-content">
				<div class="row list-product">
					<?php
					$post_id = get_the_ID();
					$cats = wp_get_post_terms( $post_id, 'product_cat' ); 

					$cats_ids = array();  
					foreach( $cats as $wpex_related_cat ) {
						$cats_ids[] = $wpex_related_cat->term_id; 
					}
					if ( ! empty( $cats_ids ) ) {
						$agrs_product = array(
							'post_type' => 'product',
							'posts_per_page' => 12,
							'post__not_in'   => array( $post_id ), 
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'id',
									'terms' => $cats_ids)
							)
						);
					}
					$list_product = new WP_Query($agrs_product);
					if ($list_product->have_posts()):
						while ($list_product->have_posts()):$list_product->the_post();
							get_template_part( 'template-parts/content', 'product' );
						endwhile;
						wp_reset_postdata();
					endif; 
					?>
					
				</div>
			</div>
		</div>
	</div>
</div>