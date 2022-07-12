<?php
function wb_add_nofollow() {
    wp_deregister_script('wplink');
    wp_register_script('wplink', get_template_directory_uri().'/core/modules/admin/js/nofollow.min.js', array('jquery'), '1.07', 1);
    wp_enqueue_script('wplink');
    wp_localize_script('wplink', 'wpLinkL10n', array(
        'title' => __('Insert/edit link'),
        'update' => __('Update'),
        'save' => __('Add Link'),
        'noTitle' => __('(no title)'),
        'labelTitle' => __( 'Title' ),
        'noMatchesFound' => __('No results found.'),
        'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
    ));
}
add_action('wp_enqueue_editor', 'wb_add_nofollow', 99999);

function wb_add_nofollow_early() {
    if ( ! wp_script_is( 'wplink', 'registered' ) ) {
        return;
    }
    wp_deregister_script('wplink');
    wp_register_script('wplink', get_template_directory_uri().'/core/modules/admin/js/nofollow.min.js', array('wp-a11y'), '1.07', 1);
    wp_localize_script('wplink', 'wpLinkL10n', array(
        'title' => __('Insert/edit link'),
        'update' => __('Update'),
        'save' => __('Add Link'),
        'noTitle' => __('(no title)'),
        'labelTitle' => __( 'Title' ),
        'noMatchesFound' => __('No results found.'),
        'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
    ));
}
add_action('admin_enqueue_scripts', 'wb_add_nofollow_early', 99999 );
/**
* add nofollow to links
*/
function wb_add_nofollow_content($content) {
    $content = preg_replace_callback(
        '/<a[^>]*href=["|\']([^"|\']*)["|\'][^>]*>([^<]*)<\/a>/i',
        function($m) {
            if (strpos($m[1], "hoangphiglass.vn") === false && strpos($m[1], "hoangphiglass.vn") === false)
                return '<a href="'.$m[1].'" rel="nofollow" target="_blank">'.$m[2].'</a>';
            else
                return '<a href="'.$m[1].'">'.$m[2].'</a>';
        },
        $content);
    return $content;
}
//add_filter('the_content', 'wb_add_nofollow_content');