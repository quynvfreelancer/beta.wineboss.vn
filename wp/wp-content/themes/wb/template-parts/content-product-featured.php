<?php
$is_sale = false;
$product_sale_price = rwmb_meta('product_sale_price');
$product_normal_price = rwmb_meta('product_normal_price');
if($product_sale_price !=''){
    $is_sale = true;
    $price = $product_sale_price;
}else{
    $price = $product_normal_price;
}
?>
<div class="col-md-2">
    <div class="product">
        <a href="<?php the_permalink();?>" class="product-thumbnail"  title="<?php the_title();?>">
            <?php 
            if(has_post_thumbnail()){
                the_post_thumbnail('thumbnail'); 
            }
            ?>
        </a>
        <h3 class="product-title">
            <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                <?php 
                $product_title = get_the_title();
                $short_title = rwmb_meta('product_short_name');
                if($short_title != ''){
                    $title = $short_title;
                }else{
                    $title = $product_title;
                }
                if(str_word_count($title) > 7){
                    $title = wp_trim_words( $title, 7, '...' );
                }
                ?>
                <?php echo $title; ?>
            </a>
        </h3>
        <div class="product-info">
            <span class="product-price">
                <?php if(isset($price) && is_numeric($price)) echo number_format($price); ?> <sup>đ</sup>
            </span>
        </div>
    </div>
</div>