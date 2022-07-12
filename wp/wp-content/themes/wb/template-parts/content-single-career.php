<h1 class="single-page-title">
	<?php the_title(); ?>
</h1>
<?php 
$job_type = rwmb_meta('career_ht');
$location = rwmb_meta('career_location');
$exprire_date = rwmb_meta('exprire_date');
$salary = rwmb_meta('career_salary');
?>
<div class="post-meta-job">
	<span>
		<i class="fa fa-map-marker" aria-hidden="true"></i>  <?php echo $location; ?>
	</span>
	<span>
		<i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo $job_type; ?>
	</span>
	<span>
		<i class="fa fa-money" aria-hidden="true"></i> Mức lương: <?php echo $salary; ?>
	</span>
</div>
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
