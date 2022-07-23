<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wineboss
 */

?>

<section class="no-results not-found">
	
	<h1 class="page-title"><?php esc_html_e( 'Đang cập nhật nội dung', 'wb' ); ?></h1>

	<div class="page-content entry">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wb' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

	elseif ( is_search() ) :
		?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wb' ); ?></p>
		<?php
		get_search_form();

	else :
		?>

		<p><?php esc_html_e( 'Có vẻ như chúng tôi không thể tìm thấy những gì bạn đang tìm kiếm. Hãy sử dụng khung tìm kiếm dưới đây', 'wb' ); ?></p>
		<?php
		get_search_form();

	endif;
	?>
</div><!-- .page-content -->
</section><!-- .no-results -->
