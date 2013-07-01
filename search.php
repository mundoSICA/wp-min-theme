<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */

get_header(); ?>

		<div id="content-container" class="span8">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'min' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php get_template_part( 'loop', 'search' ); ?>
			<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'min' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'min' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
			<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
