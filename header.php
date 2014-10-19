<!doctype html>
<!--[if lt IE 7]><html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php wimpgives_get_title(); ?></title>

	<meta name="keywords" content="<?php wimpgives_get_meta_keywords(); ?>" />

	<meta name="viewport" content="width=device-width,initial-scale=1" />

	<?php wp_head(); ?>
</head>

<body id="<?php wimpgives_page_id(); ?>" <?php body_class(); ?>>
<div id="wrapper">

	<header class="group">
		<div id="logo" class="image-logo">
			<h2 class="ir"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html( bloginfo( 'name' ) ); ?></a></h2>
		</div>

		<div id="date-header">
			<p><?php esc_html( bloginfo( 'description' ) ); ?></p>
		</div>
	</header>
	<section id="body-wrap">
		<nav>
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'menu nav-list group'
			) ); ?>
		</nav>
		<section id="content-wrapper">