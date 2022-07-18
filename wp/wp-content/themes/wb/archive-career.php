<?php get_header(); ?>
<main class="page-content">
	<div class="container">
		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<div class="row page-container">
			<div class="col-md-8">
				<h1 class="page-title ">
					Tuyển dụng
				</h1>				
				<?php 
				if ( have_posts() ) :
					?>
					<div class="list-post-cat list-post-job">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'post-career' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
					<?php
				endif;
				?>

			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>