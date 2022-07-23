<?php 
/**
* Template Name: Cart Page
*/
?>
<?php get_header(); ?>
<main class="page-content" id="page-content">
	<div class="container">
		<div class="row">
			<?php 
			if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart']) ):
				?>
			<div class="col-md-7 order-md-1 order-2">
				<div class="checkout-container">
					<h2 class="page-title mb-3">Thông tin đặt hàng</h2>
					<form action="" class="checkout-form">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Họ tên</label>
								<input type="text" name="fullname" placeholder="Nhập họ tên" class="form-control" required="required">
							</div>
							<div class="form-group col-md-3">
								<label for="">Số điện thoại</label>
								<input type="text" name="numberphone" placeholder="Điện thoại" class="form-control"
								pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" required="required">
							</div>
							<div class="form-group col-md-5">
								<label for="">Email</label>
								<input type="text" name="email" placeholder="@email" class="form-control">
							</div>
							<div class="form-group col-md-12">
								<label for="">Địa chỉ nhận hàng</label>
								<input type="text" name="address" placeholder="" class="form-control" required="required">
							</div>
							<div class="form-group col-md-12">
								<label for="">Ghi chú đơn hàng</label>
								<textarea name="order-note" class="form-control"
								placeholder="vd: giao hàng trước 11h trưa" rows="5"></textarea>
							</div>

						</div>
						<?php 
						if ( isset($_SESSION['shopping_cart']) ) {
							$shopping_cart = $_SESSION['shopping_cart'];
							if(!empty($shopping_cart)):
								$sum = 0;
								$products = array();
								foreach ($shopping_cart as $cart_item):
									$product_id = $cart_item['product_id'];
									$featured_img_url = get_the_post_thumbnail_url($product_id,'thumbnail'); 
									$product_name = get_the_title($product_id);
									$product_price = $cart_item['product_price'];
									$product_qty = $cart_item['product_quantity'];
									$products[]= "$product_name"."[".number_format($product_price)."x".$product_qty."]";
									$total = $product_price*$product_qty;
									$sum = $sum + $total;
								endforeach;

								$product_str = implode(',',$products);

							endif;
						}
						?>
						<input type="hidden" name="product" value="<?php echo $product_str;?>">
						<input type="hidden" name="total" value="<?php echo $sum;?>">
						<button type="submit" class="btn btn-order">Đặt hàng</button>
					</form>
				</div>
			</div>
			<?php 
		endif;
		?>
		<?php 
		$sum = 0;
		if ( isset($_SESSION['shopping_cart'])  && !empty($_SESSION['shopping_cart'])) :
			?>
		<div class="col-md-5 order-md-2 order-1">
			<div class="cart-container">
				<h1 class="page-title mb-3">Giỏ hàng</h1>
				<?php
				$shopping_cart = $_SESSION['shopping_cart'];
				if(!empty($shopping_cart)):
					foreach ($shopping_cart as $cart_item):
						$product_id = $cart_item['product_id'];
						$featured_img_url = get_the_post_thumbnail_url($product_id,'thumbnail'); 
						$product_name = get_the_title($product_id);
						$product_short_name = get_post_meta($product_id,'product_short_name',true);
						$product_price = $cart_item['product_price'];
						$product_qty = $cart_item['product_quantity'];

						?>
						<div class="d-flex align-items-center cart-item">
							<div class="col col-image col-2">
								<a href="<?php the_permalink($product_id);?>">
									<img src="<?php echo $featured_img_url;?>" alt="">
								</a>
							</div>
							<div class="col col-name col-7">
								<p class="product-name">
									<a href="<?php the_permalink($product_id);?>">
										<?php 
										if($product_short_name !=''){
											echo $product_short_name;
										}else{
											echo $product_name; 
										}
										?>
									</a>
								</p>
								<div class="product-qty">
									<div class="product-qty">
										<span class="price">
											<?php echo number_format($product_price); ?>
										</span>
										<span class="qty"><span class="number">x<?php echo $product_qty;?></span></span>
									</div>
								</div>
							</div>
							<div class="col col-price  col-3">
								<span class="product-price">
									<?php 
									$total = $product_price*$product_qty;
									$sum = $sum + $total;
									echo number_format($total);
									?>
									<sup>đ</sup>
								</span>
								<span class="delete-item" data-id="<?php echo $product_id;?>">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</span>
							</div>
						</div>
						<?php
					endforeach;
					?>
					<div class="cart-total text-right">
						<div class="total">
							Tổng tiền <span><?php echo number_format($sum); ?><sup>đ</sup></span>
						</div>
					</div>
					<?php
				endif;
				?>
			</div>
		</div>
		<?php
	else:
		?>
		<div class="col-md-12 order-md-2 order-1">
			<div class="cart-container entry">
				<h1 class="page-title mb-3">Giỏ hàng</h1>
				<p>Giỏ hàng trống</p>
			</div>
		</div>
		<?php 
	endif; 
	?>					

</div>
</div>
<?php if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart']) ): ?>
<!-- Modal -->
<div class="modal fade" id="modal-checkout" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal-checkoutLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-checkout-label">Thông tin đặt hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="cart-info">
					<div class="inner">
						<?php
						if(!empty($shopping_cart)):
							$sum = 0;
							foreach ($shopping_cart as $cart_item):
								$product_id = $cart_item['product_id'];
								$featured_img_url = get_the_post_thumbnail_url($product_id,'thumbnail'); 
								$product_name = get_the_title($product_id);
								$product_price = $cart_item['product_price'];
								$product_qty = $cart_item['product_quantity'];
								?>
								<div class="cart-info-item d-flex">
									<div class="col col-name col-9">
										<p class="product-name">
											<?php echo $product_name; ?>
										</p>
										<div class="product-qty">
											<div class="product-qty">
												<span class="price">
													<?php echo number_format($product_price); ?>
												</span>
												<span class="qty"><span class="number">x<?php echo $product_qty;?></span></span>
											</div>
										</div>
									</div>
									<div class="col col-price  col-3">
										<span class="product-price">
											<?php 
											$total = $product_price*$product_qty;
											$sum = $sum + $total;
											echo number_format($total);
											?>
											<sup>đ</sup>
										</span>
									</div>
								</div>
								<?php
							endforeach;
						endif;
						?>
						<div class="cart-total text-right">
							<div class="total">
								Tổng tiền <span><?php echo number_format($sum); ?><sup>đ</sup></span>
							</div>

						</div>
					</div>
				</div>
				<div class="order-info mt-3">
					<div class="order-title">
						Thông tin giao hàng
					</div>
					<div class="order-detail">
						<p>
							<strong class="order-name"></strong> - <span
							class="numberphone order-numberphone"></span>
						</p>
						<p class="order-addr">

						</p>
						<p class="order-note">

						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-close" data-dismiss="modal">Hoàn tất</button>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
</main>
<?php get_footer(); ?>