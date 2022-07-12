<?php
/**
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>
<?php get_template_part( 'blocks/home','slider'); ?>
<?php get_template_part( 'blocks/home','featured-content');?>
<?php get_template_part( 'blocks/home','suggest-product');?>
<?php get_template_part( 'blocks/home','middle-banner');?>
<?php get_template_part( 'blocks/home','product');?>
<?php get_template_part( 'blocks/home','featured-news');?>
<?php get_template_part( 'blocks/home','key-brand');?>

<?php get_footer(); ?>
