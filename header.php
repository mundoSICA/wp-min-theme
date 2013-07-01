<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */
?><!DOCTYPE html>
<!--

     .oPYo.
     8####8
     `YooP'  .oPYo.
.oPYo.       8####8               _           _
8####8       `YooP'              | |         (_)
`YooP'  _ __ ___  _   _ _ __   __| | ___  ___ _  ___ __ _   ___ ___  _ __ ___
       | '_ ` _ \| | | | '_ \ / _` |/ _ \/ __| |/ __/ _` | / __/ _ \| '_ ` _ \
       | | | | | | |_| | | | | (_| | (_) \__ \ | (_| (_| || (_| (_) | | | | | |
       |_| |_| |_|\__,_|_| |_|\__,_|\___/|___/_|\___\__,_(_)___\___/|_| |_| |_|
..:..:..:.....:..::..:.....::.....::.....::..:.....::.....:..::.....::.....:..:..:..
:: Desarrollado por mundosica.com ::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
-->
<!--[if IE 6]>
<html id="ie6" lang="es-MX">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" lang="es-MX">
<![endif]-->
<!--[if (!IE)]><!-->
<html lang="es-MX">
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="search" type="application/opensearchdescription+xml" href="<?php bloginfo( 'stylesheet_directory' ); ?>/search.xml" title="Buscador Min" />
<link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates' rel='stylesheet' type='text/css'>
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
		echo ' | ' . sprintf( __( 'Page %s', 'min' ), max( $paged, $page ) );

	?></title>
<link href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.png" type="image/png" rel="shortcut icon" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/colorbox.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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
   <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_57.png">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39815532-1', 'min.org.mx');
  ga('send', 'pageview');
</script>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php 
	wp_nav_menu(
	array(
	'container_class' => 'navbar navbar-inverse navbar-fixed-top menu-header',
	'theme_location' => 'primary',
	'items_wrap' => '
   <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="'.home_url( '/' ).'" title="Inicio - '.esc_attr( get_bloginfo( 'description', 'display' ) ).'">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a>
          <div class="nav-collapse collapse">
          <ul class="nav">%3$s</ul>
          </div>
        </div>
   </div>'
	) );
?>

<div id="container" class="hfeed">
<div id='Topbanner'></div>
<?php do_action( 'before' ); ?>
	<div id="header">
		<div id="masthead" role="banner">
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="site-title">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php
						echo esc_attr( get_bloginfo( 'name', 'display' ) );
						 ?>" rel="home" itemprop="name">
						 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/min_logo.png" alt="Logo Min" />
					</a>
			</<?php echo $heading_tag; ?>>
			<div id="site-description"  itemprop="description"><?php bloginfo( 'description' ); ?></div>
		</div><!-- #masthead -->

		<div id="branding">

<!-- agregando buscadorFijo
<div id='buscadorFijo'>
<form action="/" method="get">
        <input placeholder='Buscar en min.com.mx ...' type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        <input type="image" alt="Search" id='searchsubmitFijo' />
</form>
</div> fin agregando buscadorFijo -->

			<?php
				// Check to see if the header image has been removed
				if ( get_header_image() != '' ) :
			?>
			<a href="<?php echo home_url( '/' ); ?>">
				<?php
					// The header image
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php endif; // end check for featured image or standard header ?>
			</a>
			<?php endif; // end check for removed header image ?>
		</div><!-- #branding -->
	</div><!-- #header -->

	<div  class="row-fluid" id="content-box">
