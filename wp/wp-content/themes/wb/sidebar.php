<div class="sidebar col-md-4 order-md-2 order-3">
    <?php 
    $args_rescent = array(
        'post_type' => 'post',
        'orderby' =>'date',
        'order' => 'DESC',
        'posts_per_page' => 5,
    );
    $list_post = new WP_Query($args_rescent);
    if ($list_post->have_posts()):
        ?>
        <div class="widget widget-recent-post">
            <div class="widget-title">
                Tin gần đây
            </div>
            <div class="widget-body">
                <div class="list-post">
                    <?php 
                    while ($list_post->have_posts()):$list_post->the_post();
                        ?>
                        <div class="post">
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                            <h4 class="post-title">
                                <a href="<?php the_permalink();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </div>
                        <?php 
                    endwhile;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </div>
        <?php 
    endif;
    ?>
    <div class="widget widget-menu sticky">
        <div class="widget-title">
            Chuyên mục
        </div>
        <?php 
        if(has_nav_menu('sidebar-menu')){
            wp_nav_menu(
                array(
                    'theme_location'  => 'sidebar-menu',
                    'container'       => '',
                    'container_id'    => '',
                    'container_class' => '',
                    'menu_id'         => false,
                    'menu_class'      => 'list-cat-side',
                    'depth'           => 1,

                )
            );
        }
        ?>
    </div>
</div>