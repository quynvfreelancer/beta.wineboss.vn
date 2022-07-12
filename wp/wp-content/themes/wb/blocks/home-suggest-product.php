<section class="suggest-product">
    <div class="container">
        <div class="row list-product">
            <?php 
            $agrs_featured_product = array(
                'post_type' => 'product',
                'posts_per_page' => 10,
                'meta_query' => array(
                    array(
                        'key' => 'featured_product',
                        'value' => 1,
                        'compare' => '=',
                    )
                ),
            );
            $list_featured_product = new WP_Query($agrs_featured_product);
            if ($list_featured_product->have_posts()):
                while ($list_featured_product->have_posts()):$list_featured_product->the_post();
                    get_template_part( 'template-parts/content', 'product-featured');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>