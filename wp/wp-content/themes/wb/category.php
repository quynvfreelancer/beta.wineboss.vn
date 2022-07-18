<?php get_header(); ?>
<main class="page-content" id="page-content">
	<div class="container">
		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<div class="row page-container">
			<div class="col-md-8">
				<h1 class="page-title ">
					<?php echo single_cat_title( '', false ); ?>
				</h1>
				<?php 
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				
				<div class=" list-post-cat">
					<?php 
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'post-cat' );
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
			<?php get_sidebar();?>
		</div>
		
	</div>
</main>
<?php get_footer(); ?>