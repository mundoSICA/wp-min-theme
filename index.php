<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */

get_header(); ?>

		<div id="content-container" class="span8">
			<div id="content" role="main">

			<?php get_template_part( 'loop', 'index' ); ?>
			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
