<?php 
$job_type = rwmb_meta('career_ht');
$location = rwmb_meta('career_location');
$exprire_date = rwmb_meta('exprire_date');
$career_desc = rwmb_meta('career_desc');
if($career_desc ==''){
	$career_desc =  wb_post_excerpt(30);
}
if(str_word_count($career_desc) > 30){
	$career_desc = wp_trim_words( $career_desc, 30, '...' );
}
?>
<div class="post">                          
	<h2 class="post-title">
		<a href="<?php the_permalink();?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="post-meta">
		<span>
			<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $location; ?>
		</span>
		<span>
			<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $job_type; ?>
		</span>
		
	</div>
	<p class="post-excerpt">
		<?php echo $career_desc; ?>
	</p>
	<a href="<?php the_permalink();?>" class="readmore">Xem chi tiết</a>
</div>