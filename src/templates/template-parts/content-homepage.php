<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KateSlava
 */

if (has_post_thumbnail()) {
    global $counter;
    if ($counter == 1) { ?>
       
				<div class="site-welcome">
					<p>Добро пожаловать на сайт Cozy3d!</p>
					<?php if (esc_html( get_option('phone') )) {
				        ?>
				        <p><?php echo esc_html( get_option( 'welcome', '' ) );?></p>
				        <?php
			        } ?>
                </div> 
        <?php
        
    }
    $id = get_post_thumbnail_id();
    $image = image_get_intermediate_size( $id, 'large' );
    $add_class = '';
    if ( $image['width'] < $image['height'] ) {
        $add_class = 'portrait-img';
    }
?> 
    <a id="post-<?php the_ID(); ?>" class="project-inner<?php echo ' ' . $add_class; ?>" href="<?php the_permalink()?>">
        <div class="img" style="background-image: url(<?php the_post_thumbnail_url( 'full' );?>);"></div>
        <div class="descr"><p><?php the_title();?></p></div>
    </a><!-- #post-<?php the_ID(); ?> -->
<?php
$counter++;
}