<?php
/**
 * @package WordPress
 * @subpackage Min
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 500;

/** Tell WordPress to run min_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'min_setup' );

if ( ! function_exists( 'min_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * To override min_setup() in a child theme, add your own min_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Min 1.0
 */
function min_setup() {

	// This theme has some pretty cool theme options
	require_once ( get_template_directory() . '/inc/theme-options.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. Legacy category chooser will display in Theme Options for sites that set a category before post formats were added.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'min', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'min' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '000' );
	// No CSS, just an IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/water-drops.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to min_header_image_width and min_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'min_header_image_width', 990 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'min_header_image_height', 180 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See min_admin_header_style(), below.
	add_custom_image_header( 'min_header_style', 'min_admin_header_style', 'min_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'water-drops' => array(
			'url' => '%s/images/headers/water-drops.jpg',
			'thumbnail_url' => '%s/images/headers/water-drops-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Water drops', 'min' )
		),
		'limestone-cave' => array(
			'url' => '%s/images/headers/limestone-cave.jpg',
			'thumbnail_url' => '%s/images/headers/limestone-cave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Limestone cave', 'min' )
		),
		'Cactii' => array(
			'url' => '%s/images/headers/cactii.jpg',
			'thumbnail_url' => '%s/images/headers/cactii-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cactii', 'min' )
		)
	) );
}
endif;

if ( ! function_exists( 'min_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Min 1.0
 */
function min_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute;
			left: -9000px;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


if ( ! function_exists( 'min_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in min_setup().
 *
 * @since Min 1.0
 */
function min_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #<?php echo get_background_color(); ?>;
		border: none;
		text-align: center;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 36px;
		letter-spacing: -0.03em;
		line-height: 42px;
		text-decoration: none;
	}
	#desc {
		font-size: 18px;
		line-height: 31px;
		padding: 0 0 9px 0;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 990px;
		width: 100%;
	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'min_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in min_setup().
 *
 * @since Min 1.0
 */
function min_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<img src="<?php esc_url ( header_image() ); ?>" alt="" />
	</div>
<?php }
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Min 1.0
 */
function min_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'min_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * @since Min 1.0
 * @return int
 */
function min_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'min_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Min 1.0
 * @return string "Continue Reading" link
 */
function min_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'min' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and min_continue_reading_link().
 *
 * @since Min 1.0
 * @return string An ellipsis
 */
function min_auto_excerpt_more( $more ) {
	return ' &hellip;' . min_continue_reading_link();
}
add_filter( 'excerpt_more', 'min_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * @since Min 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function min_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= min_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'min_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Min's style.css.
 *
 * @since Min 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function min_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'min_remove_gallery_css' );

if ( ! function_exists( 'min_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own min_comment(), and that function will be used instead.
 *
 * @since Min 1.0
 */
function min_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, '96' ); ?>

			<cite class="fn"><?php comment_author_link(); ?></cite>

			<span class="comment-meta commentmetadata">
				|
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'min' ),
						get_comment_date(),
						get_comment_time()
					); ?></a>
					|
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'min' ), ' | ' );
				?>
			</span><!-- .comment-meta .commentmetadata -->
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'min' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'min' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'min' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * @since Min 1.0
 * @uses register_sidebar
 */
function min_widgets_init() {
	// widget1 Banner superior.
	register_sidebar( array(
		'name' => __( 'Banner superior', 'min' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'Banner superior', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'min' ),
		'id' => 'sidebar-1',
		'description' => __( 'The primary widget area', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'min' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area appears in 3-column layouts', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located above the primary and secondary sidebars in Content-Sidebar-Sidebar and Sidebar-Sidebar-Content layouts. Empty by default.
	register_sidebar( array(
		'name' => __( 'Feature Widget Area', 'min' ),
		'id' => 'feature-widget-area',
		'description' => __( 'The feature widget above the sidebars in Content-Sidebar-Sidebar and Sidebar-Sidebar-Content layouts', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'min' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'min' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'min' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'min' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running min_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'min_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Min 1.0
 */
function min_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'min_remove_recent_comments_style' );

if ( ! function_exists( 'min_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time.
 *
 * @since Min 1.0
 */
function min_posted_on() {
	printf(
		'<i class="icon-calendar"></i> <span class="%1$s">Escrito hace: </span> %2$s ',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">'.
						'<time itemprop="dateCreated" class="entry-date" datetime="%3$s">%4$s</time></a>',
			get_bloginfo('url') . '/' . get_the_time('Y/m/d'),//Aqui la liga deberia de ir a los posts de ese día
			'Articulos del día ' . get_the_date(),
			get_the_time('Y-m-d G:i:s'),
			get_the_date()
		)
	) . ' | ';
}
endif;

if ( ! function_exists( 'min_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author on multi-author blogs
 */
function min_posted_by() {
	/*
	 * Vamos agregar soporte para  popOvers de twBootstrap
	 *
	 * http://twitter.github.com/bootstrap/javascript.html#popovers
	 *
	 * Prototipo get_avatar
	 * function get_avatar( $id_or_email, $size = '96', $default = '', $alt = false )
	 *
	 * @param int|string|object $id_or_email A user ID,  email address, or comment object
	 * @param int $size Size of the avatar image
	 * @param string $default URL to a default image to use if no avatar is available
	 * @param string $alt Alternate text to use in image tag. Defaults to blank
	 * @return string <img> tag for the user's avatar
	 *
	 * De WordPress Revisar
	 * http://codex.wordpress.org/Function_Reference/get_the_author_meta
	 */
	if ( is_multi_author() && ! is_author() ) {
		printf(
	'<span class="by-author" data-content="%1$s" data-original-title="Author: %2$s" itemscope itemprop="author" itemtype="http://schema.org/Person">'
	. '<i class="icon-user"></i>'
	. '<span class="sep">por</span> '
	. '<span class="author vcard"><a class="url fn n" href="%3$s" title="%4$s" rel="author" itemprop="url">'
	. '  <span itemprop="name">%5$s</span></a></span>'
	.'</span>',
			get_the_author_meta('description'),//get_avatar( get_the_author_meta( 'user_email' ))
			get_the_author_meta('display_name'),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( 'Ver todos los articulos de %s', get_the_author_meta( 'display_name' ) ) ),
			esc_attr( get_the_author_meta( 'display_name' ) )
		);
	}
}
endif;

if ( ! function_exists( 'min_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Min 1.0
 */
function min_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$posted_in = '<p class="cat-links categories">'
		. '<span class="entry-info-prep entry-info-prep-cat-links label label-info">Publicado en: </span>'
		.' %1$s</p><br />'
		. '<div itemprop="keywords" class="tag-links tags">'
		. '<span class="label label-info">Etiquetado como: </span>'
		. ' %2$s</div>';

	printf(
		$posted_in,
		preg_replace('/ href="/', ' class="btn btn-success btn-mini" href="', get_the_category_list( ', ' )),
		get_the_tag_list( '', ' ' ),
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
 *  Returns the Min options with defaults as fallback
 *
 * @since Min 1.0.2
 */
function min_get_theme_options() {
	$defaults = array(
		'color_scheme' => 'light',
		'theme_layout' => 'content-sidebar',
	);
	$options = get_option( 'min_theme_options', $defaults );

	return $options;
}

/**
 * Register our color schemes and add them to the queue
 */
function min_color_registrar() {
	$options = min_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( ! empty( $color_scheme ) && $color_scheme != 'light' ) {
		wp_register_style( $color_scheme, get_template_directory_uri() . '/colors/' . $color_scheme . '.css', null, null );
		wp_enqueue_style( $color_scheme );
	}
}
add_action( 'wp_enqueue_scripts', 'min_color_registrar' );

/**
 *  Returns the current Min layout as selected in the theme options
 *
 * @since Min 1.0
 */
function min_current_layout() {
	$options = min_get_theme_options();
	$current_layout = $options['theme_layout'];

	$two_columns = array( 'content-sidebar', 'sidebar-content' );
	$three_columns = array( 'content-sidebar-sidebar', 'sidebar-content-sidebar', 'sidebar-sidebar-content' );

	if ( in_array( $current_layout, $two_columns ) )
		return 'two-column ' . $current_layout;
	elseif ( in_array( $current_layout, $three_columns ) )
		return 'three-column ' . $current_layout;
	else
		return 'no-sidebars';
}

/**
 *  Adds min_current_layout() to the array of body classes
 *
 * @since Min 1.0
 */
function min_body_class($classes) {
	$classes[] = min_current_layout();

	return $classes;
}
add_filter( 'body_class', 'min_body_class' );

/**
 * WP.com: Check the current color scheme and set the correct themecolors array
 */
$options = min_get_theme_options();

$color_scheme = 'light';
if ( isset( $options['color_scheme'] ) )
	$color_scheme = $options['color_scheme'];

if ( 'light' == $color_scheme ) {
	$themecolors = array(
		'bg' => 'ffffff',
		'border' => 'cccccc',
		'text' => '333333',
		'link' => '0060ff',
		'url' => 'df0000',
	);
}
if ( 'dark' == $color_scheme ) {
	$themecolors = array(
		'bg' => '151515',
		'border' => '333333',
		'text' => 'bbbbbb',
		'link' => '80b0ff',
		'url' => 'e74040',
	);
}
if ( 'pink' == $color_scheme ) {
	$themecolors = array(
		'bg' => 'faccd6',
		'border' => 'c59aa4',
		'text' => '222222',
		'link' => 'd6284d',
		'url' => 'd6284d',
	);
}
if ( 'purple' == $color_scheme ) {
	$themecolors = array(
		'bg' => 'e1ccfa',
		'border' => 'c5b2de',
		'text' => '333333',
		'link' => '7728d6',
		'url' => '7728d6',
	);
}
if ( 'brown' == $color_scheme ) {
	$themecolors = array(
		'bg' => '9a7259',
		'border' => 'b38970',
		'text' => 'ffecd0',
		'link' => 'ffd2b7',
		'url' => 'ffd2b7',
	);
}
if ( 'red' == $color_scheme ) {
	$themecolors = array(
		'bg' => 'a20013',
		'border' => 'b92523',
		'text' => 'e68d77',
		'link' => 'ffd2b7',
		'url' => 'ffd2b7',
	);
}
if ( 'blue' == $color_scheme ) {
	$themecolors = array(
		'bg' => 'ccddfa',
		'border' => 'b2c3de',
		'text' => '333333',
		'link' => '2869d6',
		'url' => '2869d6',
	);
}

/**
 * Adjust the content_width value based on layout option and current template.
 *
 * @since Min 1.0.2
 * @param int content_width value
 */
function min_set_full_content_width() {
	global $content_width;
	$content_width = 770;

	// Override for 3-column layouts
	$layout = min_current_layout();
	if ( strstr( $layout, 'three-column' ) )
		$content_width = 990;
}


/**
 * Descripción de la función
 *
 * @param tipo $parametro1 descripción del párametro 1.
 * @return tipo descripcion de lo que regresa
 * @access publico/privado
 * @link [URL de mayor infor]
 */
function compartir_redes_sociales() { ?>
<div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="proyectomin" data-lang="es">Twitter</a>
<div class="g-plus" data-action="share" data-height="15"></div>
<?php
}//end function
