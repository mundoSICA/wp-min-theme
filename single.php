<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */

get_header(); ?>

		<div id="content-container" class="span8">
			<div id="content" role="main">

			<?php if ( have_posts() )
			while ( have_posts() ) : the_post();
			
			?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'min' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'min' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php min_posted_on(); min_posted_by(); ?>
						<span class="comments-link">
								<span class="meta-sep">|
								</span><?php
									comments_popup_link( 'Deja un comentario', __( '1 Comment', 'min' ), __( '% Comments', 'min' ) ); ?>
									</span>
						<?php edit_post_link( __( 'Edit', 'min' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->

<?php compartir_redes_sociales(); ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'min' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-info">
						<?php min_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'min' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-info -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'min' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'min' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

<br clear='all'>
<div id="idCompartirPost" class="row-fluid well">
<h4>Te gusto el articulo? compartilo en:</h4>
<div class="span5">
	<p id="copiarLink">
		<span>URL para compartir:</span>
		<input type="text" placeholder='<?php echo wp_get_shortlink(); ?>' value="<?php echo wp_get_shortlink(); ?>"/>
	</p>
</div>
<div class="span3">.
	<a href="https://twitter.com/share" class="twitter-share-button" data-via="proyectomin" data-lang="es" data-size="large" data-dnt="true">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</div>
<div class="span3">
	<div class="fb-like" data-send="true" data-layout="box_count" data-width="250" data-show-faces="true" data-font="lucida grande"></div>

</div>
</div>
<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
