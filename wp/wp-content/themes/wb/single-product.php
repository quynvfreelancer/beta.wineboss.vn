<?php get_header(); ?>
<main class="page-content">
	<div class="container">
		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<?php
		while ( have_posts() ) :the_post();
			get_template_part( 'template-parts/content', 'single-product');
		endwhile; 
		?>
	</div>
</main>
<?php get_footer(); ?>