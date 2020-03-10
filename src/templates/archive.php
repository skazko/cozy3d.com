<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KateSlava
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<section class="portfolio">
				<header class="portfolio__header">
					<?php
					the_archive_title( '<h1 class="portfolio__title">', '</h1>' ); ?>
					<p class="portfolio__description"> 
						<?php echo	strip_tags(get_the_archive_description()); ?>
					</p>
				</header>
				<ul class="portfolio__list">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'portfolio' );

					endwhile;?>
				</ul>
				<?php the_posts_navigation(); ?>
			</section><!-- .portfolio -->
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
