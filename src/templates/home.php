<?php
/**
 * @package KateSlava
 */

get_header();
$counter = 0;
?>

<main id="main" class="site-main">
	<div class="flex-container">
		<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'homepage' );
				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>
	</div>
</main>

<?php
get_footer();
