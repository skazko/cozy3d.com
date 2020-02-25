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
				'next_text' => '<span class="screen-reader-text">Следующая запись</span> ' .
					'<span class="post-title">%title </span>' . '<span class="nav-small">Вперед</span>' .
					' <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					width="20px" height="20px" viewBox="0 0 792.033 792.033" style="vertical-align: middle; fill:#404040;"
					xml:space="preserve">
			   <g>
				   <g id="_x38_">
					   <g>
						   <path d="M617.858,370.896L221.513,9.705c-13.006-12.94-34.099-12.94-47.105,0c-13.006,12.939-13.006,33.934,0,46.874
							   l372.447,339.438L174.441,735.454c-13.006,12.94-13.006,33.935,0,46.874s34.099,12.939,47.104,0l396.346-361.191
							   c6.932-6.898,9.904-16.043,9.441-25.087C627.763,386.972,624.792,377.828,617.858,370.896z"/>
					   </g>
				   </g>
			   </g>
			   </svg> ',
				'prev_text' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				width="20px" height="20px" viewBox="0 0 791.966 791.967" style="vertical-align: middle; fill:#404040;"
				xml:space="preserve">
		   <g>
			   <g id="_x37_">
				   <g>
					   <path d="M245.454,396.017L617.077,56.579c12.973-12.94,12.973-33.934,0-46.874c-12.973-12.94-34.033-12.94-47.006,0
						   L174.615,370.896c-6.932,6.899-9.87,16.076-9.408,25.087c-0.462,9.045,2.476,18.188,9.408,25.088l395.456,361.19
						   c12.973,12.94,34.033,12.94,47.006,0c12.973-12.939,12.973-33.934,0-46.873L245.454,396.017z"/>
				   </g>
			   </g>
		   </g>
		   </svg>' . '<span class="nav-small"> Назад</span>' .
				'<span class="screen-reader-text">Предыдущая запись</span> ' .
					'<span class="post-title"> %title</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
