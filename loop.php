<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'min' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'min' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'min' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'min' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	// Start the Loop.
	$options = min_get_theme_options();
	while ( have_posts() ):
	the_post();
	if ( is_home() && !has_tag( 'inicio', $post )) {
    continue;
	}
	?>
<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( ( isset( $options['gallery_category'] ) && '0' != $options['gallery_category'] && in_category( $options['gallery_category'] ) ) || 'gallery' == get_post_format( $post->ID ) ) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php
					  printf( esc_attr__( 'Permalink to %s', 'min' ), the_title_attribute( 'echo=0' ));
					?>" rel="bookmark" itemprop="url">
					<span itemprop="name"><?php the_title(); ?></span>
				</a>
			</h2>

			<div class="entry-meta">
				<?php min_posted_on(); min_posted_by(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'min' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'min' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
					<?php the_excerpt(); ?>
			<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-info">
				<span class="comments-link" itemprop="discussionUrl"><?php comments_popup_link(
				'&rarr; Deja un comentario',
				'&rarr; 1 Comentario',
				__( '&rarr; % Comments')
			); ?></span>

			<?php
				if ( isset( $options['gallery_category'] ) ) :
					$cat_slug = sanitize_title( $options['gallery_category'] );
					if ( in_category( $cat_slug ) ) :
			?>
				<p><a href="<?php echo get_term_link( $cat_slug, 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'min' ); ?>"><?php _e( 'More Galleries', 'min' ); ?></a></p>
			<?php endif; endif; ?>

				<p><?php edit_post_link( __( 'Edit', 'min' ), '', '' ); ?></p>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( isset( $options['aside_category'] ) && '0' != $options['aside_category'] && in_category( $options['aside_category'] ) || 'aside' == get_post_format( $post->ID ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="http://schema.org/Article">

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary aside">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content aside">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'min' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-info">
				<p class="comments-link" itemprop="discussionUrl"><?php comments_popup_link( '&rarr; Deja un comentario', '&rarr; 1 Comentario', '&rarr; % Comentarios' ); ?></p>
				<p><?php min_posted_on(); min_posted_by(); ?></p>
				<?php edit_post_link( __( 'Edit', 'min' ), '', '' ); ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="http://schema.org/Article">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'min' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php min_posted_on(); min_posted_by(); ?>
				<span class="comments-link">
					<span class="meta-sep">|</span>
					<i class='icon-comment'></i>
					<span itemprop="discussionUrl">
						<?php comments_popup_link( 'Deja un comentario', '&rarr; 1 Comentario', __( '% Comments', 'min' ) ); ?>
					</span>
				</span>
			</div><!-- fin - entry-meta -->

<!-- Seccion compartir  -->
<div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true" data-href="<?php the_permalink(); ?>" ></div>
<a href="https://twitter.com/share" data-url="<?php the_permalink(); ?>" class="twitter-share-button" data-via="proyectomin" data-lang="es">Twitter</a>
<div class="g-plus" data-action="share" data-height="15" data-href="<?php the_permalink(); ?>"></div>
<!-- Seccion compartir  -->

	<?php if ( is_search() ) : // Display excerpts for search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'min' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'min' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-info">
					<p class="comments-link" itemprop="discussionUrl"><?php comments_popup_link( '&rarr; Deja un comentario', '&rarr; 1 Comentario', '&rarr; % Comentarios' ); ?></p>
				<?php if ( count( get_the_category() ) ) : ?>
					<p class="cat-links categories">
						<?php
						printf(
							'<span class="%1$s">Publicado en: </span> %2$s',
							'entry-info-prep entry-info-prep-cat-links label label-info',
							preg_replace('/ href="/', ' class="btn btn-success btn-mini" href="', get_the_category_list( ', ' ))
							); ?>
					</p>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ' ' );
					if ( $tags_list ):
				?>
					<div class="tag-links tags" itemprop="keywords">
						<?php printf(
						'<span class="%1$s">Etiquetas:</span>%2$s',
						'entry-info-prep entry-info-prep-tag-links label label-info',
						$tags_list
						); ?>
					</div>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'min' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>
	<hr class="clear"/>
	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */
#
# http://panosgalatis.com/2012/08/14/wordrpess-and-twitter-bootstrap-pagination/#.UHvXCqyqyio
#
#
$total_pages = $wp_query->max_num_pages;
if ($total_pages > 1){
	$current_page = max(1, get_query_var('paged'));
	$links = paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => '/page/%#%',
			'current' => $current_page,
			'total' => $total_pages,
			'type' => 'list',
			'prev_text' => '&larr; Entradas Antiguas',
			'next_text' => 'Entradas Nuevas &rarr;'
		));
	printf(
		'<div class="pagination">%s</div>',
		str_replace('page-numbers current', 'page-numbers current active', $links)
	);
}
?>
