<footer class="page-footer" id="page-footers">
    <div class="container">
        <div class="row">
            <div class="col-md-3 company-info ">
                <p class="company-name">
                    Công ty Cổ phần WINEBOSS
                </p>
                <p class="addr">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    Địa chỉ: Showroom 102 Thượng Đình - Thanh Xuân - Hà Nội ( <a href="#">Xem bản đồ</a> )
                </p>
                <p class="addr">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    Chi nhánh miền nam: Phường 12 - Quận Tân Bình - TP Hồ Chí Minh ( <a href="#">Xem bản đồ</a> )
                </p>
                <p class="hotline">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:02420208111">(024) 2020 8111</a> <span>|</span> <a href="tel:0978966891">
                        0978 966 891
                    </a>
                </p>
                <p class="email">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:wineboss.jsc@gmail.com">wineboss.jsc@gmail.com</a>
                </p>
            </div>
            <div class="col-md-2 col-6">
                <div class="widget widget-footer">
                    <div class="widget-title">
                        Về chúng tôi
                    </div>
                    <div class="widget-content">
                        <?php
                        if(has_nav_menu('menu-footer-1')){
                            wp_nav_menu( array(
                                'menu'              => 'menu-footer-1',
                                'theme_location'    => 'menu-footer-1',
                                'depth'             => 1,
                                'container'         => '',
                                'container_id'      => '',
                                'container_class'   => '',
                                'container_id'      => '',
                                'menu_id'           => false,
                                'menu_class'        => 'footer-menu',
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2  col-6">
                <div class="widget widget-footer">
                    <div class="widget-title">
                        Hỗ trợ khách hàng
                    </div>
                    <div class="widget-content">
                        <?php
                        if(has_nav_menu('menu-footer-2')){
                            wp_nav_menu( array(
                                'menu'              => 'menu-footer-2',
                                'theme_location'    => 'menu-footer-2',
                                'depth'             => 1,
                                'container'         => '',
                                'container_id'      => '',
                                'container_class'   => '',
                                'container_id'      => '',
                                'menu_id'           => false,
                                'menu_class'        => 'footer-menu',
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2  col-12 pr-md-0">
                <div class="widget widget-footer">
                    <div class="widget-title">
                        Chính sách
                    </div>
                    <div class="widget-content">
                        <?php
                        if(has_nav_menu('menu-footer-3')){
                            wp_nav_menu( array(
                                'menu'              => 'menu-footer-3',
                                'theme_location'    => 'menu-footer-3',
                                'depth'             => 1,
                                'container'         => '',
                                'container_id'      => '',
                                'container_class'   => '',
                                'container_id'      => '',
                                'menu_id'           => false,
                                'menu_class'        => 'footer-menu',
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3  col-12">
                <div class="widget widget-footer">
                    <div class="widget-title">
                        Kết nối với chúng tôi
                    </div>
                    <div class="widget-content">
                        <ul class="social-link">
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-google" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget widget-footer mt-3 widget-subcribe">
                    <div class="widget-title">
                        Đăng ký khuyến mãi
                    </div>
                    <form action="" class="form-inline subcribe-form">
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ email">
                        <button type="submit" class="btn btn-submit">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </button>
                    </form>
                    <div class="d-flex">
                        <a href="#">
                            <img class="img-cert" src="<?php echo THEME_URI;?>/images/bo-cong-thuong.png" alt="Bộ Công Thương">
                        </a>
                        <a href="#">
                            <img class="img-cert" src="<?php echo THEME_URI;?>/images/handle_cert.png" alt="Tín nhiệm mạng">
                        </a>
                    </div>

                    <a href="#">
                        <img class="img-cert" src="<?php echo THEME_URI;?>/images/dmca-badge-w150-5x1-01.png" alt="DMCA">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright mt-3">
        <div class="container">
            <p>
                &copy; Bản quyền <a href="/">Wineboss</a> - All Rights Reserved
            </p>
        </div>
    </div>
</footer>
<div class="live-support">
    <div class="title">
        Hỗ trợ trực tuyến
        <span class="close-livechat"></span>
    </div>
    <div class="sub-content">
        Hãy liên hệ với chúng tôi bằng việc lựa chọn phương thức thuận tiện cho bạn
    </div>
    <div class="list-method">
        <a href="#" class="item">
            <span class="icon">
                <img src="<?php echo THEME_URI;?>/images/chat.svg" alt="Chat zalo">
            </span>
            <span class="text">
                Zalo Chat
            </span>
        </a>
        <a href="#" class="item">
            <span class="icon">
                <img src="<?php echo THEME_URI;?>/images/messenger.svg" alt="Chat Messenger">
            </span>
            <span class="text">
                Messenger
            </span>
        </a>
        <a href="#" class="item">
            <span class="icon">
                <img src="<?php echo THEME_URI;?>/images/email.svg" alt="Email">
            </span>
            <span class="text">
                Gửi Email
            </span>
        </a>
    </div>
    <div class="support-footer">
        Hỗ trợ dịch vụ tất cả các ngày trong tuần
    </div>
</div>
<?php
$total_qty = 0;
if ( isset($_SESSION['shopping_cart']) ) {
    $shopping_cart = $_SESSION['shopping_cart'];
    if(!empty($shopping_cart)):
        foreach ($shopping_cart as $cart_item):
            $product_qty = $cart_item['product_quantity'];
            $total_qty = $total_qty + $product_qty;
        endforeach;
    endif;
}
?>
<a href="/gio-hang" class="mini-cart">
   <span class="number cart-number" data-number="<?php echo $total_qty;?>">
    <?php echo $total_qty; ?>
</span>
</a>
<button class="btn-livechat">
    Livechat
</button>
<div class="call-button">
    <a href="tel:0978966891" rel=" nofollow noopenner" target="_blank">
        <i class="fa fa-phone" aria-hidden="true"></i>
    </a>
</div>
<?php wp_footer(); ?>

</body>
</html>
