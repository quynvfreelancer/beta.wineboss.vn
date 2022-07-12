<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package An_Phat_Medical
 */

if ( ! is_active_sidebar( 'sidebar-text-link' ) ) {
    return;
}
?>
<section class="keyword-brand">
    <div class="container">
        <div class="row">
            <?php dynamic_sidebar( 'sidebar-text-link' ); ?>
        </div>
    </div>
</section>