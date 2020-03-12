<?php
/**
 * @package KateSlava
 */
?>
	<footer id="colophon" class="site-footer">

		<div class="site-footer__section">
			<h4 class="site-footer__title">
				<a  
					href="<?php echo get_category_link( 
						get_category_by_slug( 'vizualizaciya-kommercheskih-pomeshchenij' ) -> cat_ID
					); ?>">
					Для бизнеса
				</a>
			</h4>
			<ul class="footer-links">
			<?php
			$posts = get_posts( array(
				'numberposts' 		=> 3,
				'category_name'   	=> 'vizualizaciya-kommercheskih-pomeshchenij',
				'post_status'		=> 'publish',
			) );
			foreach( $posts as $post ){
				setup_postdata($post); ?> 
				<li>
					<a class="footer-links__link" href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</li> 
			<?php
			}
			wp_reset_postdata();
			?>
			</ul>
		</div>

		<div class="site-footer__section">
			<h4 class="site-footer__title">
				<a  
					href="<?php echo get_category_link( 
						get_category_by_slug( 'home' ) -> cat_ID
					); ?>">
					Для дома
				</a>
			</h4>
			<ul class="footer-links">
			<?php
			$posts = get_posts( array(
				'numberposts' 		=> 3,
				'category_name'   	=> 'home',
				'post_status'		=> 'publish',
			) );
			foreach( $posts as $post ){
				setup_postdata($post); ?>
				<li>
					<a class="footer-links__link" href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</li>
			<?php
			}
			wp_reset_postdata();
			?>
			</ul>
		</div>
		<div class="site-footer__section">
			<h4 class="site-footer__title">
				<a href="<?php echo home_url(); ?>">
					<?php bloginfo( $name ); ?>
				</a>
			</h4>
			<ul class="footer-links">
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
				<li>
					<a class="footer-links__link" href="<?php echo the_permalink(); ?>">
						<?php the_title() ?>
					</a>
				</li> 			
			<?php
			}  
			wp_reset_postdata();
			?>
			</ul>
		</div>
		<div class="site-footer__section"> 
			
			<?php if ( has_custom_logo()) :
				the_custom_logo();
			endif;
			?>
			<p class="site-footer__copyright">
				&copy; 
				<?php
					bloginfo( $name );
					echo ", " . date("Y"); 
				?>
			</p>

		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
