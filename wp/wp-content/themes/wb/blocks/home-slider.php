<section class="hero-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-slider">
                    <?php 
                    $slider = rwmb_meta( 'slide-item', ['object_type' => 'setting'],'wb-options');
                    if(!empty($slider)){
                        $i = 1;
                        foreach ($slider as $slide) {
                            $slide_url = $slide['slide-url'];
                            $slide_image_desktop = $slide['slide-image-desktop'];
                            $slide_image_mobile = $slide['slide-image-mobile'];
                            if($i==1){
                                echo '<div class="slide-item ">';
                            }else{
                                echo '<div class="slide-item slick-slide">';
                            }
                            echo '<a href="'.$slide_url.'">';
                            foreach ( $slide_image_desktop as $image_pc_id ) {
                                $image_pc = RWMB_Image_Field::file_info( $image_pc_id, array( 'size' => 'full' ) );
                                echo '<img  width="'. $image_pc['width'].'" height="'. $image_pc['height'].'" class="d-none d-sm-block d-md-block" src="' . $image_pc['url'] . '">';
                            }
                            foreach ( $slide_image_mobile as $image_mb_id ) {
                                $image_mb = RWMB_Image_Field::file_info( $image_mb_id, array( 'size' => 'full' ) );
                                echo '<img width="'. $image_mb['width'].'" height="'. $image_mb['height'].'" class="d-block d-sm-none d-md-none" src="' . $image_mb['url'] . '">';
                            }
                            echo '</a>';
                            echo '</div>';
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block  col-banner-small">
                <div class="banner-small">
                    <a href="#">
                        <img src="<?php echo THEME_URI;?>/images/banner/1.jpeg" alt="">
                    </a>
                </div>
                <div class="banner-small">
                    <a href="#">
                        <img src="<?php echo THEME_URI;?>/images/banner/2.jpeg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>