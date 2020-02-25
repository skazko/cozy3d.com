<?php
/*
Template Name: Страница контакты
*/



get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-content">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

	            <?php kateslava_post_thumbnail(); ?>

                <div class="entry-content">
                    <div class="wp-block-cover has-very-light-gray-background-color has-background-dim contact-cover" style="background-image:url('https://cozy3d.com/wp-content/uploads/2019/07/contacts-background.png');background-position:89.5% 50%;margin-bottom:1rem;">
                        <div class="wp-block-cover__inner-container">
                        <p style="text-align:left" class="contacts-header">Свяжитесь удобным для вас способом</p>
                            <?php if (esc_html( get_option('phone') )) {
                                ?>
                                    <div class="contacts-row">
                                        <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/wa.svg" alt="whatsapp">
                                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>">Whatsapp</a>
                                    </div>
                                    
                                <?php
                            } ?>
                            <?php if (esc_html( get_option('email') )) {
                                ?>
                                <div class="contacts-row">
                                    <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/envelope.svg" alt="Письмо">
                                    <a href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>"><?php echo esc_html( get_option( 'email', '' ) );?></a>
                                </div>
                                <?php
                            } ?>

                            <?php if (esc_html( get_option('facebook') )) {
                                ?>
                                <div class="contacts-row">
                                    <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/fb.svg" alt="Facebook">
                                    <a href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>">facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?></a>
                                </div>
                                <?php
                            } ?>

                            <?php if (esc_html( get_option('instagram') )) {
                                ?>
                                <div class="contacts-row">
                                    <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/ig.svg" alt="Instagram">
                                    <a href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>">instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?></a>
                                </div>
                                <?php
                            } ?>

                            <?php if (esc_html( get_option('vk') )) {
                                ?>
                                <div class="contacts-row">
                                    <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/vk.svg" alt="Vkontakte">
                                    <a href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>">vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?></a>
                                </div>
                                <?php
                            } ?>
                        </div>

                    </div>
                    <?php
                    

          
                    ?>
                </div><!-- .entry-content -->

	
            </article><!-- #post-<?php the_ID(); ?> -->
        <?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
