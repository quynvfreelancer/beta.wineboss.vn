<?php

class bs4Navwalker extends Walker_Nav_Menu
{

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if($depth >0 ){
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }else{
            $output .= "\n$indent<div class=\"dropdown-menu\">\n";
        }

    }


    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if($depth > 0){
            $output .= "$indent</ul>\n";
        }else{
            $output .= "$indent</div>\n";
        }

    }


    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

        // New
        $class_names .= ' nav-item';

        if (in_array('menu-item-has-children', $classes)) {
            $class_names .= ' dropdown';
        }

        if (in_array('current-menu-item', $classes)) {
            $class_names .= ' active';
        }

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        
        if ($depth === 0) {
            $output .= $indent . '<li' . $id . $class_names .'>';
        }



        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';


        if ($depth === 0) {
            $atts['class'] = 'nav-link';
        }


        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $atts['class']       .= ' dropdown-toggle';
            $atts['data-toggle']  = 'dropdown';
        }
        $class_item = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        if ($depth > 0) {
            $atts['class'] = 'dropdown-item '.$class_item;
        }

        if (in_array('current-menu-item', $item->classes)) {
            $atts['class'] .= ' active';
        }


        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;

        if($depth===3){
            $item_output .= '<li><a'. $attributes .'>';

        }else{
            $item_output .= '<a'. $attributes .'>';

        }

        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if($depth===3){
            $item_output .= '</a></li>';

        }else{
            $item_output .= '</a>';

        }


        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if (isset($args->has_children) && $depth === 0) {
            $output .= "</li>\n";
        }
    }
}