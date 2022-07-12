<?php
function wpdocs_theme_add_editor_styles() {
	$font_url = str_replace(',', '%2C', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i,900&display=swap&subset=vietnamese' );
	add_editor_style( $font_url);
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'wpdocs_theme_add_editor_styles' );