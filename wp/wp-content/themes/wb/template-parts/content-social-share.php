<div class="single-post-meta single-post-meta-bottom d-flex align-items-center">
	<div class="update-time">
		Cập nhật lúc <?php the_modified_time('G:i - d/m/Y' );  ?>
	</div>
	<div class="social-share-button ml-auto">
		<strong>Chia sẻ</strong>
		<a class="social" aria-label="Facebook"  target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook" rel="nofollow noopener noreferrer">
			<i class="fa fa-facebook" aria-hidden="true"></i>
		</a>
		<a class="social"  aria-label="Twitter" target="_blank" href="https://twitter.com/intent/tweet?status='<?php the_permalink(); ?>" class="twitter" rel="nofollow noopener noreferrer">
			<i class="fa fa-twitter" aria-hidden="true"></i>
		</a>
		<a class="social" aria-label="Pinterest"  target="_blank" href="https://pinterest.com/pin/create/button?url=<?php the_permalink();?>&description=<?php the_title();?>" class="pinterest" rel="nofollow noopener noreferrer">
			<i class="fa fa-pinterest" aria-hidden="true"></i>
		</a>
	</div>
</div>