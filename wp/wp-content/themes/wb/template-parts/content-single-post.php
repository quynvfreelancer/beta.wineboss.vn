<h1 class="single-page-title">
	<?php the_title(); ?>
</h1>
<?php 
get_template_part( 'template-parts/content', 'post-meta' );
?>
<div class="entry entry-content">
	<?php the_content();?>
</div>
<?php
get_template_part('template-parts/content','social-share');
?>
<?php
if ( comments_open() || get_comments_number() ) :
	comments_template(); endif;
?>
<div class="related-post">
	<p class="related-title">
		Tin liên quan
	</p>
	<div class="row">
		<?php
		$post_id = get_the_ID();
		$args = array(
			'posts_per_page' => 6, 
			'post__not_in'   => array( $post_id ), 
			'no_found_rows'  => true, 
		);
		$cats = wp_get_post_terms( $post_id, 'category' ); 
		$cats_ids = array();  
		foreach( $cats as $wpex_related_cat ) {
			$cats_ids[] = $wpex_related_cat->term_id; 
		}
		if ( ! empty( $cats_ids ) ) {
			$args['category__in'] = $cats_ids;
		}
		$wpex_query = new wp_query( $args );
		foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
			<div class="post col-md-12">
				<div class="inner">
					<a href="<?php the_permalink();?>" class="post-thumbnail">
						<?php the_post_thumbnail( 'thumbnail'); ?>
					</a>

					<h4 class="post-title">
						<a href="<?php the_permalink();?>">
							<?php the_title();?>
						</a>
					</h4>
					<div class="post-excerpt">
						<p>
							<?php echo wb_post_excerpt(25);?>
						</p>
					</div>
				</div>

			</div>
			<?php
		endforeach;
		wp_reset_postdata(); 
		?>
	</div>
</div>