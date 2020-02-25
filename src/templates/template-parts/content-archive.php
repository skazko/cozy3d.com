<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KateSlava
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="project-row">
		<div class="project-left-column<?php if ( is_singular() ) : ?> fixed<?php endif?>">
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<p class="publication-date">
						<i class="far fa-calendar-alt"></i> <?php the_date( "j F Y"); ?>
						</p>
						<?php the_category(' '); ?>
						<?php the_tags( ' '); ?>
						
					</div><!-- .entry-meta -->

				<?php endif; ?>
				<?php the_excerpt(); ?>
			</header><!-- .entry-header -->
			
		</div>
		<div class="project-right-column">
			<a href="<?php the_permalink(); ?>">
			<div class="entry-content in-archive">
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kateslava' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				?>
			</div><!-- .entry-content -->
			</a>
		</div>
	</div>
	

	
</article><!-- #post-<?php the_ID(); ?> -->
