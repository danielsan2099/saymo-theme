<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Saymo_Theme
 * @since Saymo Theme 0.29
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- Default para responsivo -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
	<meta name="description" content="Descripcion del sitio web"/>
	<!-- --------------   META SEO   ------------ -->
	<?php // metatags generation
		if ( is_single() || is_page() ) {
		        $metadesc = $post->post_excerpt;
		        if ( $metadesc == '' ) { $metadesc = $post->post_content; }
		        $metadesc = wp_strip_all_tags( $metadesc );
		        $metadesc = strip_shortcodes( $metadesc );
		        $metadesc_fb = substr( $metadesc, 0, 297 );
		        $metadesc_tw = substr( $metadesc, 0, 200 );
		        $metadesc = substr( $metadesc, 0, 154 );
		        $metatit = $post->post_title;
		        $metatype = "article";
		        $metaperma = get_permalink();

		} else {
		        $metadesc = "Descripcion";
		        $metadesc_tw = $metadesc;
		        $metadesc_fb = $metadesc;
		        $metatit = "Descripcion";
		        $metatype = "website";
		        $metaperma = "url";
		}

		$metaUserTwiter = "@twitter";
		$metaAuthor = "Autor";        
	?>	
	<!-- generic meta -->
	<meta content="<?php echo $metaAuthor; ?>" name="author" />
	<meta name="title" content="<?php echo $metatit ?>" />
	<meta content="<?php echo $metadesc ?>" name="description" />

	<!-- facebook meta -->
	<meta property="og:title" content="<?php echo $metatit ?>" />
	<meta property="og:type" content="<?php echo $metatype ?>" />
	<meta property="og:description" content="<?php echo $metadesc_fb ?>" />
	<meta property="og:url" content="<?php echo $metaperma ?>" />
	<!-- twitter meta -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="<?php echo $metaUserTwiter ?>">
	<meta name="twitter:title" content="<?php echo $metatit ?>" />
	<meta name="twitter:description" content="<?php echo $metadesc_tw ?>" />
	<meta name="twitter:creator" content="<?php echo $metaUserTwiter ?>">
	<!-- -------------------------- -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!-- Bootstrap 3 -->
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory');?>/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory');?>/css/bootstrap/css/bootstrap-theme.min.css">
	<!-- Jquery -->
	<script src="<?php echo get_bloginfo('stylesheet_directory');?>/js/jquery/jquery-1.10.2.min.js"></script>
	<!-- JS Bootstrap -->
	<script src="<?php echo get_bloginfo('stylesheet_directory');?>/css/bootstrap/js/bootstrap.min.js"></script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

	<header>
		Header
	</header>
