<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package KateSlava
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( array(
				'next_text' => '<span class="screen-reader-text">Следующая запись</span>' .
					'<span class="post-title">%title </span>' . 
					'<span class="nav-small">Вперед</span>' .
					'<div class="icon-small">' .
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 792 792" fill="currentColor"><path d="M618 371L222 10a33 33 0 00-48 0 33 33 0 000 47l373 339-373 339c-13 13-13 34 0 47s35 13 48 0l396-361c7-7 10-16 9-25 1-9-2-18-9-25z"/></svg>' . 
					'</div>',
				'prev_text' => '<div class="icon-small">' . 
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 792 792" fill="currentColor"><path d="M245 396L617 57a33 33 0 00-47-47L175 371c-7 7-10 16-10 25s3 18 10 25l395 361c13 13 34 13 47 0s13-34 0-47L245 396z"/></svg>'.
					'</div><span class="nav-small"> Назад</span>' .
					'<span class="screen-reader-text">Предыдущая запись</span> ' .
					'<span class="post-title"> %title</span>',
			) );
		endwhile;
		?>

		</main>
	</div>

<?php

get_footer();
