<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KateSlava
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="column">
				<div class="for-business">
					<a class="footer-item footer-head" href="<?php echo get_category_link( get_category_by_slug( 'vizualizaciya-kommercheskih-pomeshchenij' ) -> cat_ID ); ?>">Для бизнеса</a>
					<?php
					$posts = get_posts( array(
						'numberposts' 		=> 3,
						'category_name'   	=> 'vizualizaciya-kommercheskih-pomeshchenij',
						'post_status'		=> 'publish',
					) );
					foreach( $posts as $post ){
						setup_postdata($post);
						?> <a class="footer-item" href="<?php the_permalink() ?>"><?php the_title() ?></a><?php
					}
					
					wp_reset_postdata();
					?>
				</div>

				<div class="for-home">
				<a class="footer-item footer-head" href="<?php echo get_category_link( get_category_by_slug( 'home' ) -> cat_ID ); ?>">Для дома</a>
					<?php
					$posts = get_posts( array(
						'numberposts' 		=> 3,
						'category_name'   	=> 'home',
						'post_status'		=> 'publish',
					) );
					foreach( $posts as $post ){
						setup_postdata($post);
						?> <a class="footer-item" href="<?php the_permalink() ?>"><?php the_title() ?></a><?php
					}
					
					wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="column">
				<div class="site-info">
					<a class="footer-item footer-head" href="<?php echo home_url(); ?>"><?php bloginfo( $name ); ?></a>
					<?php
					$args = array(
						'sort_order'   => 'DESC',
						'sort_column'  => 'post_date',
						'include'      => '17, 21, 42',
						'post_status'  => 'publish',
					); 
					$pages = get_pages( $args );
					foreach( $pages as $post ){
						setup_postdata( $post ); ?>
						<a class="footer-item" href="<?php echo get_page_link( $post->ID ); ?>"><?php the_title(); ?></a>
					
					<?php
					}  
					wp_reset_postdata();
					?>
				</div><!-- .site-info -->
				<div class="copyright"> 
					
					<?php if ( has_custom_logo()) :
						the_custom_logo();
					endif;
					?>
					<p>&copy; <?php bloginfo( $name ); ?>, 2019</p>

				</div>
			</div>
			
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
