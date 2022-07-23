<?php 
/**
 * Template Name: Contact Page
 */
?>
<?php get_header(); ?>
<main class="page-content">
	<div class="container">
		<?php get_template_part( 'template-parts/content','breadcrumb'); ?>
		<h1 class="page-title">
			Liên hệ
		</h1>
		<div class="contact-info row">
			<div class="col-md-4 col-border">
				<p>Hợp tác <a href="mailto:wineboss.jsc@gmail.com"><i class="fa fa-envelope"
					aria-hidden="true"></i>wineboss.jsc@gmail.com</a></p>
					<p>Hành chính <a href="tel:0978966891">
						<i class="fa fa-phone" aria-hidden="true"></i>
						0978 966 891
					</a>
				</p>
			</div>
			<div class="col-md-8">
				<p>
					<i class="fa fa-envelope" aria-hidden="true"></i>
					Email <a href="mailto:info@thietbiyteanphat.com">info@thietbiyteanphat.com</a>
				</p>
				<p>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					102 Thượng Đình - Thanh Xuân - Hà Nội
				</p>
			</div>
		</div>

		<div class="d-flex mt-3 flex-wrap">
			<div class="col-md-6  col-form ">
				<form action="" class="contact-form">

					<div class="form-row">
						<div class="form-group  col-md-6">
							<label for="input-fullname">Họ tên</label>
							<input id="input-fullname" type="text" name="fullname" placeholder="Nhập tên"
							class="form-control" required="required">
						</div>
						<div class="form-group  col-md-6">
							<label for="input-numberphone">Số điện thoại</label>
							<input id="input-numberphone" type="text" name="numberphone" placeholder="SĐT liên hệ"
							class="form-control" required="" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group  col-md-12">
							<label for="input-email">Email</label>
							<input id="input-email" type="email" name="email" placeholder="Nhập địa chỉ email"
							class="form-control" required="">

						</div>
					</div>

					<div class="form-row">
						<div class="form-group  col-md-12">
							<label for="input-content">Nội dung</label>
							<textarea name="content" class="form-control" id="input-content" rows="3"
							placeholder="Nhập nội dung cần liên hệ ..."></textarea>
						</div>
					</div>
					<button type="submit" class="btn btn-submit">
						Gửi liên hệ <i class="fa fa-envelope-open" aria-hidden="true"></i>
					</button>
				</form>
			</div>
			<div class="col-md-6 pl-0 contact-map">
				<iframe
				src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1862.075615890188!2d105.81620244531229!3d21.02663401234718!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3c07e4327cee132!2sPlatinum%20Residences!5e0!3m2!1svi!2s!4v1632711190107!5m2!1svi!2s"
				width="600" height="390" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>