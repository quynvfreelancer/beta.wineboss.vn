<?php
/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package An_Phat_Medical
*/

get_header();
?>

<main class="page-content">
	<div class="container">
		<section class="error-404">
			<div class="container">
				<img src="<?php echo THEME_URI;?>/images/404.jpeg" alt="Lỗi 404">
				<h1 class="page-title">Lỗi 404! Không tìm thấy trang bạn yêu cầu</h1>
				<a href="/" class="btn go-to-home">
					Về trang chủ <i class="fa fa-angle-right"
					aria-hidden="true"></i>
				</a>
			</div>
		</section>
	</div>
</main>
<?php
get_footer();
?>
