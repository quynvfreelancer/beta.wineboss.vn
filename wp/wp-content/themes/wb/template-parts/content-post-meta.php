<div class="single-post-meta row align-items-center">
	<div class="col-md-6 mr-auto align-items-center">
		<div class="avartar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 55); ?>
		</div>
		<?php 
		$author_id = get_post_field ('post_author', get_the_ID());
		$display_name = get_the_author_meta( 'display_name' , $author_id ); 
		?>
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="author-link" rel="author">
			<?php echo $display_name; ?>
		</a>
		<span class="update-time">Ngày đăng: <?php the_time( 'G:i - d/m/Y' ); ?></span>
		

	</div>
	<div class="ml-auto col-md-6">
		<?php
		if(function_exists('kk_star_ratings')):
			echo kk_star_ratings(); 
		endif;
		?>
	</div>
</div>