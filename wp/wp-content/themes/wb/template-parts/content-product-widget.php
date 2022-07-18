<?php
$is_sale = false;
$product_sale_price = rwmb_meta('_sale_price');
$product_normal_price = rwmb_meta('_regular_price');
if($product_sale_price !=''){
    $is_sale = true;
    $price = $product_sale_price;
}else{
    $price = $product_normal_price;
}
?>
<div class="col-md-2 ">
    <div class="product <?php if($is_sale) echo ' is-sale'; ?>">
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
                if(str_word_count($title) > 12){
                    $title = wp_trim_words( $title, 12, '...' );
                }
                ?>
                <?php echo $title; ?>
            </a>
        </h3>
        <div class="product-info">
            <span class="product-price">
                <?php if(isset($price) && is_numeric($price)) echo number_format($price); ?> <sup>đ</sup>
            </span>

            <span class="product-normal-price">
                <?php if(isset($product_normal_price) && is_numeric($product_normal_price)) echo number_format($product_normal_price); ?> <sup>đ</sup>
            </span>
        </div>
        <div class="product-rating ">
            <ul class="d-flex">
                <li>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </li>
            </ul>
            <span class="rating-label">
                10 đánh giá
            </span>
        </div>
        <a href="#" class="add-to-cart-link">
            Thêm vào giỏ <span class="icon-cart"></span>
        </a>
    </div>
</div>