<?php
$options = get_option('wb-options' );

for ($j=1; $j <= 2; $j++) {
    if(isset($options['banner_link_' . $j ])){
        $banner_link_[$j] = $options['banner_link_'. $j ];
    }else{
        $banner_link_[$j] = '#';
    }

    if( isset( $options['banner_image_' . $j ] ) ){
        $banner_image_[$j] = $options['banner_image_' . $j ];
        foreach ($banner_image_[$j] as $image_id) {
            $image_[$j] = wp_get_attachment_image_url( $image_id, 'full', false );
        }
    }else{
        $image_[$j] = '';
    }
}
?>
<section class="hero-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-slider">
                    <?php
                    $slides = $options['slide_group'];
                    if(isset($slides) && !empty($slides)):
                        $i = 1;
                    foreach ($slides as $slide) { $i ++;
                        if(isset($slide['slide_title'])){
                            $slide_title = $slide['slide_title'];
                        }else{
                            $slide_title = '';
                        }

                        if(isset($slide['slide_url'])){
                            $slide_url = $slide['slide_url'];
                        }else{
                            $slide_url = '#';
                        }

                        if( isset( $slide['slide_image'] ) ){
                            $slide_image = $slide['slide_image'];
                            foreach ($slide_image as $image_id) {
                                $image = wp_get_attachment_image_url( $image_id, 'full', false );
                            }
                        }else{
                            $image = '';
                        }
                        ?>
                        <div class="slide-item <?php if( $i != 1 ) echo 'slick-slide'; ?>">
                            <a href="<?php echo $slide_url; ?>">
                                <?php if( $i == 1 ) {
                                    echo "<img src='".$image."' alt='".$slide_title."' />";
                                }else{
                                    echo "<img data-lazy='".$image."' alt='".$slide_title."' />";
                                } ?>
                            </a>
                        </div>
                    <?php }
                    unset($i); endif; ?>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block col-banner-small">
                <?php
                for ($j=1; $j <= 2; $j++) { ?>
                    <div class="banner-small">
                        <a href="<?php echo $banner_link_[$j]; ?>" class="flash-sale">
                            <img src="<?php echo $image_[$j]; ?>" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>