<?php

add_action( 'admin_init', 'min_theme_options_init' );
add_action( 'admin_menu', 'min_theme_options_add_page' );

/**
 * Add theme options page styles
 */
wp_register_style( 'min', get_template_directory_uri() . '/inc/theme-options.css', '', '0.1' );
if ( isset( $_GET['page'] ) && $_GET['page'] == 'theme_options' ) {
	wp_enqueue_style( 'min' );
}

/**
 * Init plugin options to white list our options
 */
function min_theme_options_init(){
	register_setting( 'min_options', 'min_theme_options', 'min_theme_options_validate' );
}

/**
 * Load up the menu page
 */
function min_theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'min' ), __( 'Theme Options', 'min' ), 'edit_theme_options', 'theme_options', 'min_theme_options_do_page' );
}

/**
 * Return array for our color schemes
 */
function min_color_schemes() {
	$color_schemes = array(
		'light' => array(
			'value' =>	'light',
			'label' => __( 'White', 'min' )
		),
		'dark' => array(
			'value' =>	'dark',
			'label' => __( 'Black', 'min' )
		),
		'pink' => array(
			'value' =>	'pink',
			'label' => __( 'Pink', 'min' )
		),
		'blue' => array(
			'value' =>	'blue',
			'label' => __( 'Blue', 'min' )
		),
		'purple' => array(
			'value' =>	'purple',
			'label' => __( 'Purple', 'min' )
		),
		'red' => array(
			'value' =>	'red',
			'label' => __( 'Red', 'min' )
		),
		'brown' => array(
			'value' =>	'brown',
			'label' => __( 'Brown', 'min' )
		),
	);

	return $color_schemes;
}

/**
 * Return array for our layouts
 */
function min_layouts() {
	$theme_layouts = array(
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content-Sidebar', 'min' ),
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Sidebar-Content', 'min' )
		),
		'content-sidebar-sidebar' => array(
			'value' => 'content-sidebar-sidebar',
			'label' => __( 'Content-Sidebar-Sidebar', 'min' )
		),
		'sidebar-sidebar-content' => array(
			'value' => 'sidebar-sidebar-content',
			'label' => __( 'Sidebar-Sidebar-Content', 'min' )
		),
		'sidebar-content-sidebar' => array(
			'value' => 'sidebar-content-sidebar',
			'label' => __( 'Sidebar-Content-Sidebar', 'min' )
		),
		'no-sidebars' => array(
			'value' => 'no-sidebars',
			'label' => __( 'Full Width (No Sidebars)', 'min' )
		),
	);

	return $theme_layouts;
}

/**
 * Create the options page
 */
function min_theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . sprintf( __( '%1$s Theme Options', 'min' ), get_current_theme() )
		 . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'min' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'min_options' ); ?>
			<?php $options = min_get_theme_options(); ?>

			<table class="form-table">

				<?php
				/**
				 * Min Color Scheme
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Color Scheme', 'min' ); ?></th>
					<td>
						<select name="min_theme_options[color_scheme]">
							<?php
								$selected_color = $options['color_scheme'];
								$p = '';
								$r = '';

								foreach ( min_color_schemes() as $option ) {
									$label = $option['label'];

									if ( $selected_color == $option['value'] ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="min_theme_options[color_scheme]"><?php _e( 'Select a default color scheme', 'min' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Min Layout
				 */
				?>
				<tr valign="top" id="min-layouts"><th scope="row"><?php _e( 'Default Layout', 'min' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Default Layout', 'min' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( min_layouts() as $option ) {
								$radio_setting = $options['theme_layout'];

								if ( '' != $radio_setting ) {
									if ( $options['theme_layout'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<div class="layout">
								<label class="description">
									<input type="radio" name="min_theme_options[theme_layout]" value="<?php esc_attr_e( $option['value'], 'min' ); ?>" <?php echo $checked; ?> />
									<span>
										<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['value']; ?>.png"/>
										<?php echo $option['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Min Aside Category
				 */

				$selected_aside_category = ( isset( $options['aside_category'] ) ) ? $options['aside_category'] : null;
				if ( ! empty( $selected_aside_category ) ) :
				?>

				<tr valign="top"><th scope="row"><?php _e( 'Aside Category', 'min' ); ?></th>
					<td>
						<select name="min_theme_options[aside_category]">
							<option value="0"><?php _e( 'Select a category &hellip;', 'min' ); ?></option>
							<?php
								$p = '';
								$r = '';

								foreach ( get_categories( array( 'hide_empty' => 0 ) ) as $category ) {

									if ( $selected_aside_category == $category->cat_name ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="min_theme_options[aside_category]"><?php _e( 'Select a category to use for shorter aside posts', 'min' ); ?></label>
						<div class="update-msg"><p>Note: Min now supports Post Formats! Read more at <a href="http://support.wordpress.com/posts/post-formats/">Support &raquo; Post Formats</a>.</p></div>
					</td>
				</tr>
				<?php endif; ?>

				<?php
				/**
				 * Min Gallery Category
				 */
				$selected_gallery_category = ( isset( $options['gallery_category'] ) ) ? $options['gallery_category'] : null;
				if ( ! empty( $selected_gallery_category ) ) :
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Gallery Category', 'min' ); ?></th>
					<td>
						<select name="min_theme_options[gallery_category]">
							<option value="0"><?php _e( 'Select a category &hellip;', 'min' ); ?></option>
							<?php
								$p = '';
								$r = '';

								foreach ( get_categories( array( 'hide_empty' => 0 ) ) as $category ) {

									if ( $selected_gallery_category == $category->cat_name ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="min_theme_options[gallery_category]"><?php _e( 'Select a category to use for posts with image galleries', 'min' ); ?></label>
						<div class="update-msg"><p>Note: Min now supports Post Formats! Read more at <a href="http://support.wordpress.com/posts/post-formats/">Support &raquo; Post Formats</a>.</p></div>
					</td>
				</tr>
				<?php endif; ?>

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Options', 'min' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function min_theme_options_validate( $input ) {

	// Our color scheme option must actually be in our array of color scheme options
	if ( ! array_key_exists( $input['color_scheme'], min_color_schemes() ) )
		$input['color_scheme'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['theme_layout'] ) )
		$input['theme_layout'] = null;
	if ( ! array_key_exists( $input['theme_layout'], min_layouts() ) )
		$input['theme_layout'] = null;

	// Our aside category option must actually be in our array of categories
	if ( isset( $input['aside_category'] ) && array_search( $input['aside_category'], get_categories() ) != 0 )
		$input['aside_category'] = null;

	// Our gallery category option must actually be in our array of categories
	if ( isset( $input['gallery_category'] ) && array_search( $input['gallery_category'], get_categories() ) != 0 )
		$input['gallery_category'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
