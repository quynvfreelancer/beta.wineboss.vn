<?php
$options = get_option('wb-options' );

for ($j=4; $j <= 5; $j++) {
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
<section class="banner-middle">
    <div class="container">
        <div class="row">
            <?php
            for ($j=4; $j <= 5; $j++) { ?>
                <div class="col-md-6">
                    <a href="<?php echo $banner_link_[$j]; ?>" class="flash-sale">
                        <img src="<?php echo $image_[$j]; ?>" alt="">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>