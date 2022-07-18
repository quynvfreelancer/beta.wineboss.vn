<section class="featured-news">
    <div class="container">
        <div class="s-header">
            <h2 class="s-title">
                <a href="/cam-nang-ruou-vang">Cẩm nang rượu vang</a>
            </h2>
            <a href="/cam-nang-ruou-vang" class="more-link">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
        </div>

        <div class="row">
            <div class="col-md-9">
                <?php
                $post_not_in = array();
                $args_1 = array(
                    'post_type' => 'post',
                    'orderby' =>'date',
                    'order' => 'DESC',
                    'posts_per_page' => 5,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => 'cam-nang-ruou-vang'
                        )
                    )
                );
                $list_post_1 = new WP_Query($args_1);
                if ($list_post_1->have_posts()):
                    $i=1;
                    while ($list_post_1->have_posts()):$list_post_1->the_post();
                        $post_id = get_the_ID();
                        $post_not_in[] = $post_id;
                        if($i==1):
                            ?>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="post big-post">
                                        <a href="<?php the_permalink();?>" class="post-thumbnail">
                                            <?php the_post_thumbnail( 'medium'); ?>
                                        </a>
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title();?>
                                            </a>
                                        </h3>
                                        <p class="post-excerpt">
                                            <?php echo wb_post_excerpt(35); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <?php
                                else:
                                    ?>
                                    <div class="post post-row">
                                        <a href="<?php the_permalink();?>" class="post-thumbnail">
                                            <?php the_post_thumbnail( 'thumbnail'); ?>
                                        </a>
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title();?>
                                            </a>
                                        </h3>
                                    </div>
                                    <?php
                                endif;
                                $i++;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>

            </div>
            <div class="col-md-3 list-post-medium">
                <?php
                $args_2 = array(
                    'post_type' => 'post',
                    'orderby' =>'date',
                    'order' => 'DESC',
                    'posts_per_page' => 2,
                    'post__not_in' => $post_not_in,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => 'cam-nang-ruou-vang'
                        )
                    )
                );
                $list_post_2 = new WP_Query($args_2);
                if ($list_post_2->have_posts()):
                    while ($list_post_2->have_posts()):$list_post_2->the_post();
                        ?>
                        <div class="post medium-post ">
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php the_post_thumbnail( 'medium'); ?>
                            </a>
                            <h3 class="post-title">
                                <a href="<?php the_permalink();?>">
                                    <?php the_title();?>
                                </a>
                            </h3>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>