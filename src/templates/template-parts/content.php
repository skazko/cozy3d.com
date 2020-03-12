<?php
/**
 * Template part for displaying posts(projects)
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
							<svg 
								xmlns="http://www.w3.org/2000/svg" 
								width="24" 
								height="24" 
								viewBox="0 0 24 24" 
								fill="none" 
								stroke="currentColor" 
								stroke-width="2" 
								stroke-linecap="round" 
								stroke-linejoin="round" 
								class="icon icon-calendar">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
								<line x1="16" y1="2" x2="16" y2="6"></line>
								<line x1="8" y1="2" x2="8" y2="6"></line>
								<line x1="3" y1="10" x2="21" y2="10"></line>
							</svg>
							<?php the_date( "j F Y"); ?>
						</p>
						<?php the_category(' '); ?>
						<?php the_tags( ' '); ?>
						
					</div><!-- .entry-meta -->

				<?php endif; ?>
				<?php the_excerpt(); ?>
				
			</header><!-- .entry-header -->
			
		</div>
		<div class="project-right-column">
			<div class="entry-content">
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

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kateslava' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
			<div class="feedback">
				<a 
					target="_blank"
					id="order-button" 
					class="feedback__button" 
					href="mailto:<?php 
						echo esc_html( get_option( 'email', '' ) );
					?>?subject=Письмо%20со%20страницы%20проекта%20<?php 
						the_title(); 
					?>%20(<?php 
						the_id(); 
					?>)&amp;body=Меня%20заинтересовал%20ваш%20проект%20<?php 
						the_title(); 
					?>">
						Напишите мне письмо
				</a>
			</div>
		</div>
	</div>
	

	
</article><!-- #post-<?php the_ID(); ?> -->
