 <section class="featured-content">
    <div class="container">
        <div class="row list-featured-text">
            <div class="col-md-3 col-6">
                <div class="inner">
                    <span class="icon">
                        <img src="<?php echo THEME_URI; ?>/images/icons/icon-delivery.svg" alt="Vận chuyển">
                    </span>
                    <h3 class="heading-title">
                        Miễn phí giao hàng
                    </h3>
                    <p class="sub">
                        Free ship nội thành tất cả đơn đặt hàng online > 500k
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="inner">
                    <span class="icon">
                        <img src="<?php echo THEME_URI; ?>/images/icons/icon-support.svg" alt="Tư vấn">
                    </span>
                    <h3 class="heading-title">
                        Tư vấn miễn phí 24/7
                    </h3>
                    <p class="sub">
                        Tận tâm phục vụ quý khách là niềm vinh hạnh của chúng tôi
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="inner">
                    <span class="icon">
                        <img src="<?php echo THEME_URI; ?>/images/icons/icon-mastercard.svg" alt="Thanh toán">
                    </span>
                    <h3 class="heading-title">
                        Thanh toán linh hoạt
                    </h3>
                    <p class="sub">
                        Nhận hàng trả tiền hoặc chuyển khoản ngân hàng
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="inner">
                    <span class="icon">
                        <img src="<?php echo THEME_URI; ?>/images/icons/icon-guarantee.svg" alt="Bảo hành">
                    </span>
                    <h3 class="heading-title">
                        Hàng chính hãng 100%
                    </h3>
                    <p class="sub">
                        Cam kết hàng chuẩn - giá tốt nhất thị trường.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$options = get_option('wb-options' );
if(isset($options['banner_link_3'])){
    $banner_link_3 = $options['banner_link_3'];
}else{
    $banner_link_3 = '#';
}
if( isset( $options['banner_image_3'] ) ){
    $banner_image_3 = $options['banner_image_3' ];
    foreach ($banner_image_3 as $image_id) {
        $image_3 = wp_get_attachment_image_url( $image_id, 'full', false );
    }
}else{
    $image_3 = '';
}
?>
<section class="banner-after-slide d-none d-md-block">
    <div class="container">
        <a href="<?php echo $banner_link_3; ?>" class="flash-sale">
            <img src="<?php echo $image_3; ?>" alt="">
        </a>
    </div>
</section>