<!DOCTYPE html>
<html lang="<?php bloginfo('language') ?>">
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<title><?php bloginfo('title') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<?php wp_head() ?>
</head>
<body>
	<div class="container p-0">
		<header class="header">
			<a href="<?php echo home_url() ?>" class="header__home" title="Go Home">
				<i class="fas fa-home fa-2x header__home-icon"></i>
				<img class="header__home-img" src="<?php $upload_dir = wp_upload_dir();
				echo $upload_dir['baseurl']; ?>/2019/08/logo.png" alt="logotip">
			</a>
			<a href="javascript:void(0)" class="nav__toggler"><i class="fas fa-bars fa-2x"></i></a>
		<?php wp_nav_menu( array(
				'theme_location'  => 'main-menu',
				'container'       => 'nav',
				'container_class' => 'nav',
				'menu_class'      => 'nav__list',
				'items_wrap'      => '<ul class = "%2$s">%3$s</ul>',
			) ); ?>
		</header>