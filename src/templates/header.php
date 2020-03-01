<?php
/**
 * @package KateSlava
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'kateslava' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			if ( has_custom_logo()) :
				?>
					<h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h1>				
				<?php
				the_custom_logo();
			else: 
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$kateslava_description = get_bloginfo( 'description', 'display' );
				if ( $kateslava_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $kateslava_description; /* WPCS: xss ok. */ ?></p>
				<?php endif;
			endif; ?>
		</div><!-- .site-branding -->


		<?php if (esc_html( get_option('phone') )) {
				?>
					<div class="wa-button-mob">
						<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>"><img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/wa.svg" alt="whatsapp"></a>
					</div>
				<?php
			} ?>
		

		<input id="gamburger" type="checkbox">
		<label class="gamburger-inner" for="gamburger">
			<div></div>
			<div></div>
			<div></div>
		</label>

		<nav id="site-navigation" class="main-navigation">
			
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

		<div class="social-links">
			<?php if (esc_html( get_option('phone') )) {
				?>
					<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/wa.svg" alt="whatsapp"></a>	
				<?php
			} ?>
			<?php if (esc_html( get_option('email') )) {
				?>
				<a href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/envelope.svg" alt="Письмо"></a>
				<?php
			} ?>

			<?php if (esc_html( get_option('facebook') )) {
				?>
					<a href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/fb.svg" alt="Facebook"></a>	
				<?php
			} ?>

			<?php if (esc_html( get_option('instagram') )) {
				?>
					<a href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/ig.svg" alt="Instagram"></a>
				<?php
			} ?>

			<?php if (esc_html( get_option('vk') )) {
				?>
					<a href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/vk.svg" alt="Вконтакте"></a>
				<?php
			} ?>
		</div>
		
	</header><!-- #masthead -->
	