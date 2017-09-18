<?php
/**
 * Arquivo de Header para o tema
 *
 * Este é o template que exibe todos os componentes da seção <head> e tudo incluso dentro da div content
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Favicon Icons -->
		<link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
		<link rel="manifest" href="manifest.json">
		<meta name="msapplication-TileColor" content="##994688">
		<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
		<meta name="theme-color" content="#994688">
		
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php echo get_site_url(); ?>">

		<!-- Scripts Principais -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

	    <?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> >
		
		<!-- CABEÇALHO -->
		<div class="container header">
			<header class="row">
				<div class="col-md-12 header-branding">
					<?php get_template_part( 'template-parts/header/header', 'branding' ); ?>
				</div>
				<nav class="col-md-12 header-nav">
					<?php get_template_part( 'template-parts/header/header', 'nav' ); ?>
				</nav>	
				<nav class="col-md-12 header-nav-mobile visible-xs">
					<?php get_template_part( 'template-parts/header/header', 'nav-mobile' ); ?>
				</nav>				
			</header>
		</div>