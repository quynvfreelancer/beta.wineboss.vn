<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package wineboss
*/

?>
<!doctype html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;0,900;1,400;1,700&display=swap"
		rel="stylesheet">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<?php get_template_part('blocks/home','mega-sale');?>
		<header class="page-header">
			<nav class="navbar navbar-expand-md top-nav">
				<div class="container">
					<?php
					if (has_nav_menu('top-menu')) {
						wp_nav_menu(
							array(
								'theme_location'  => 'top-menu',
								'container'       => '',
								'container_id'    => '',
								'container_class' => '',
								'menu_id'         => false,
								'menu_class'      => 'nav navbar-nav ml-auto',							
								'depth'           => 1,
								'fallback_cb'     => 'bs4navwalker::fallback',
								'walker'          => new bs4Navwalker()
							)
						);
					}
					?>
				</div>
			</nav>
			<nav class="navbar navbar-expand-md  primary-nav" id="primary-nav">
				<div class="container">
					<a class="navbar-brand" href="<?php echo get_home_url();?>">
						WINEBOSS
					</a>
					<button class="btn btn-search-mobile">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
					<button class="navbar-toggler d-lg-none btn-toggler-menu" type="button" data-toggle="collapse"
					data-target="#primary-nav-collapse" aria-controls="primary-nav-collapse" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="primary-nav-collapse">
					<?php
					if (has_nav_menu('primary-menu')) {
						wp_nav_menu(
							array(
								'theme_location'  => 'primary-menu',
								'container'       => '',
								'container_id'    => '',
								'container_class' => '',
								'menu_id'         => false,
								'menu_class'      => 'navbar-nav mr-auto ml-auto mt-2 mt-lg-0',
								'depth'           => 2,
								'fallback_cb'     => 'bs4navwalker::fallback',
								'walker'  => new BootstrapNavMenuWalker()
							)
						);
					}
					?>
					<form action="<?php echo get_home_url();?>" class="form-inline my-2 my-lg-0 search-form">
						<input class="form-control mr-sm-2" type="text" name="s" placeholder="Tìm kiếm">
						<button class="btn btn-search" type="submit">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
					</form>
				</div>
				<form class="form-inline  search-form search-form-mobile" action="<?php echo get_home_url();?>">
					<input class=" form-control mr-sm-2" name="s" type="text" placeholder="Tìm kiếm">
					<button class="btn btn-search" type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</nav>
	</header>