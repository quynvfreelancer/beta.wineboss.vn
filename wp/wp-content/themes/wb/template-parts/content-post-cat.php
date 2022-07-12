<div class="post">
	<a href="<?php the_permalink();?>" class="post-thumbnail" title="<?php the_title();?>">
		<?php 
		if(has_post_thumbnail()){
			the_post_thumbnail('blog-size'); 
		}
		?>
	</a>

	<h2 class="post-title">
		<a href="<?php the_permalink();?>"  title="<?php the_title();?>">
			<?php echo wb_short_title(15); ?>
		</a>
	</h2>

	<p class="post-excerpt">
		<?php echo wb_post_excerpt(18); ?>
	</p>
</div>