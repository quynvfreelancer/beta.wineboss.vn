<div class="sidebar col-md-3">
    <div class="widget widget-menu sticky">
        <div class="widget-title">
            Hỗ trợ khách hàng
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
                    'menu_class'      => 'list-cat-side list-bullet',
                    'depth'           => 1,

                )
            );
        }
        ?>
    </div>
</div>