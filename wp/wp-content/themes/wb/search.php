<?php get_header(); ?>
<main class="page-content" id="page-content">
	<div class="container">
		<?php get_template_part('components/content','breadcrumb'); ?>
		<div class="row page-container">
			<div class="col-md-8">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Kết quả tìm kiếm từ khoá: %s', 'apc' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				

				
				<div class=" list-post-cat">
					<?php 
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'search' );
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