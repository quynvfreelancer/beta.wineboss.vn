<div class="single-product-info mt-0 mt-md-3">
	<div class="row">
		<div class="col-md-4 single-gallery">
			<?php the_post_thumbnail('full');?>
			<div class="product-attr row">
				<ul class="col-md-6 list-attr">
					<?php if(rwmb_meta( 'xuat_xu') !=''): ?>
						<li>
							<span class="label">Xuất xứ</span> <span class="value">Vang <?php echo rwmb_meta( 'xuat_xu');  ?></span>
						</li>
					<?php endif; ?>
					<?php if(rwmb_meta( 'dung_tich') !=''): ?>
						<li>
							<span class="label">Dung tích</span> <span class="value"><?php echo rwmb_meta( 'dung_tich');  ?></span>
						</li>
					<?php endif; ?>
					<?php if(rwmb_meta( 'nong_do') !=''): ?>
						<li>
							<span class="label">Nồng độ</span> <span class="value"> <?php echo rwmb_meta( 'nong_do');  ?></span>
						</li>
					<?php endif; ?>
					
				</ul>
				<ul class="col-md-6  list-attr">
					<?php if(rwmb_meta( 'vung_lam_vang') !=''): ?>
						<li>
							<span class="label">Vùng làm vang</span> <span class="value"><?php echo rwmb_meta( 'vung_lam_vang');  ?></span>
						</li>
					<?php endif; ?>
					<?php if(rwmb_meta( 'giong_nho') !=''): ?>
						<li>
							<span class="label">Giống nho</span> <span class="value"><?php echo rwmb_meta( 'giong_nho');  ?></span>
						</li>
					<?php endif; ?>
				</ul>
			</div>

		</div>
		<div class="col-md-8 single-info-detail">
			<h1 class="product-title">
				<?php the_title(); ?>
			</h1>
			<div class="product-sku mb-1">
				<strong>Mã SP: <span><?php echo rwmb_meta( 'product_sku');  ?></span></strong>
			</div>
			<div class="row mr-0 ml-0">
				<div class="col-md-6">

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
								Giá: <?php echo number_format($product_price); ?> <sup>đ</sup><?php endif; ?>
							</span>

						</div>
						<div class="col-md-6 pl-0">
							<div class="product-stock">
								Tình trạng: <span class="status instock">Còn hàng</span>
							</div>
						</div>						
						<div class="product-desc  entry mt-2 mb-2">
							<?php echo rwmb_meta( 'product_desc');  ?>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12 product-cart">
							<form action="" method="post" class="add-to-cart">
								<input type="hidden" name="product_id" value="<?php echo $product_id;?>">
								<input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
								<input type="hidden" name="add-to-cart" value="add-to-cart">
								<div class="quantity">
									<span class="minus">-</span>
									<input type="number" id="quantity_6232186014191"
									class="input-text qty text input-number form-control" step="1"
									min="1" max="" name="quantity" value="1" title="SL" size="4"
									placeholder="" inputmode="numeric" />
									<span class="plus">+</span>
								</div>
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
				<div class="col-md-6 pr-0 product-benefit">
					<ul class="description-feature">
						<li class="freeship">
							<span class="icon"></span>
							Cam kết hàng chính hãng 100%
						</li>
						<li>
							<span class="icon"></span>
							Chất lượng uy tín, đảm bảo
						</li>
						<li>
							<span class="icon">

							</span>
							Chính sách đổi trả hàng rõ ràng
						</li>
						<li>
							<span class="icon"></span>
							Giao hàng trên toàn quốc
						</li>
						<li>
							<span class="icon"></span>
							Thanh toán khi nhận hàng
						</li>
						<li>
							<span class="icon"></span>
							Ưu đãi quà tặng và khuyến mãi
						</li>
					</ul>
					<div class="flash-sale-info">
						<a href="#">
							<img src="<?php echo THEME_URI;?>/images/banner/1.jpeg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row page-container">
	<div class="col-md-8 order-1 order-md-1">
		<!--Post content-->
		<div class="entry">			
			<?php the_content(); ?>
		</div>
		<!---End entry--->
		<?php
		get_template_part('template-parts/content','social-share');
		?>
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
							get_template_part( 'template-parts/content', 'product-related' );
						endwhile;
						wp_reset_postdata();
					endif; 
					?>

				</div>
			</div>
		</div>
	</div>
</div>