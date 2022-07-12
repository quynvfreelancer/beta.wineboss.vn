<?php
class BootstrapNavMenuWalker extends Walker_Nav_Menu 
{ 

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output	.= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent         = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $li_attributes  = '';
        $class_names    = $value = '';
        $hasMegaMenu    = is_active_sidebar( 'mega-menu-item-' . $item->ID );

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;


        $divider_class_position = array_search('divider', $classes);

        if($divider_class_position !== false) {
            $output .= "<li class=\"divider\"></li>\n";
            unset($classes[$divider_class_position]);
        }

        $classes[] = ($args->has_children || $hasMegaMenu) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'nav-item-' . $item->ID;

        if($depth && $args->has_children) {
            $classes[] = 'dropdown-submenu';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="nav-item ' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'nav-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        $attributes .= ($args->has_children || $hasMegaMenu) ? ' class="dropdown-toggle nav-link" data-toggle="dropdown"' : ''; 
        if ($depth === 0) {
            $attributes .=' class="nav-link" ';
        }
        if ($depth > 0) {
            $attributes .=' class="dropdown-item" ';
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= (($depth == 0 || 1) && ($args->has_children || $hasMegaMenu)) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $args->after;     

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        if ($hasMegaMenu) {
            $output .= "<ul id=\"mega-menu-{$item->ID}\" class=\"mega-menu-wrap dropdown-menu depth_".$depth."\">";
            ob_start();
            dynamic_sidebar( 'mega-menu-item-' . $item->ID );
            $dynamicSidebar = ob_get_contents();
            ob_end_clean();
            $output .=  $dynamicSidebar;
            $output .= "</ul>";
        }
    }


    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
            return;

        $id_field = $this->db_fields['id'];


        if ( is_array( $args[0] ) )
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        else if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;


        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
            foreach( $children_elements[ $id ] as $child ){
                if ( !isset($newlevel) ) {
                    $newlevel = true;

                    $cb_args = array_merge( array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }

                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }

            unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){

            $cb_args = array_merge( array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }


        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}

add_action( 'widgets_init', 'dynamic_sidebar_mega_init' );
function dynamic_sidebar_mega_init() {
    $location = 'primary-menu';
    $css_class = 'mega-menu';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        $menu = get_term( $locations[ $location ], 'nav_menu' );
        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            foreach ( $items as $item ) {
                $title = isset($item->title) ? $item->title : $item->post_title;
                if ( in_array( $css_class, $item->classes ) ) {
                    register_sidebar( array(
                        'id'   => 'mega-menu-item-' . $item->ID,
                        'description' => 'Mega Menu items',
                        'name' =>  $title. ' - Mega Menu',
                        'before_widget' => '<div id="%1$s" class="widget mega-menu-item col">',
                        'after_widget' => '</div>',
                    ));
                }
            }
        }
    }
}
add_action( 'widgets_init', 'dynamic_sidebar_mega_init' );