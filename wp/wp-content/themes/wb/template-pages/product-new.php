<?php 
/**
 * Template Name: Sản phẩm mới
 */
?>
<?php get_header(); ?>
<main class="page-content">
	<div class="container">
		
		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<h1 class="page-title">
			Sản phẩm mới
		</h1>
		<div class="row list-product list-product-archive">
			
			<?php
			$agrs_product = array(
				'post_type' => 'product',
				'posts_per_page' => 12,
				'meta_query' => array(
					array(
						'key' => 'new_product',
						'value' => 1,
						'compare' => '=',
					)
				)
			);
			$list_product = new WP_Query($agrs_product);
			if ($list_product->have_posts()):
				while ($list_product->have_posts()):$list_product->the_post();
					get_template_part( 'template-parts/content', 'product' );
				endwhile;
				wp_reset_postdata();
			endif;
			?>

		</div>
		<?php 
		wb_pagination();
		?>
	</div>
</main>
<?php get_footer(); ?>