<?php get_header(); ?>
<main class="page-content">
	<div class="container">

		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<h1 class="page-title archive-title">
			<?php echo single_term_title( '', false ); ?>
		</h1>
		<?php 
		the_archive_description( '<div class="archive-description mb-3 entry">', '</div>' );
		?>
		<?php get_template_part( 'template-parts/content','product-filter'); ?>
		<div class="row list-product list-product-archive">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'product' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
		<?php 
		wb_pagination();
		?>
	</div>
</main>
<?php get_footer(); ?>