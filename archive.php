<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */

get_header(); ?>

		<div id="content-container" class="span8">
			<div id="content" role="main">

			<?php if ( have_posts() ) the_post(); ?>

			<h1 class="page-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'min' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'min' ), get_the_date( 'F Y' ) ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'min' ), get_the_date( 'Y' ) ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'min' ); ?>
			<?php endif; ?>
			</h1>

			<?php
				rewind_posts();
				get_template_part( 'loop', 'archive' );
			?>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
