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
	<a class="skip-link screen-reader-text" href="#main">
		<?php esc_html_e( 'Skip to content', 'kateslava' ); ?>
	</a>
	<header id="masthead" class="site-header">
		<?php	if ( has_custom_logo()) : ?>
			<h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h1>				
			<?php the_custom_logo();
		else: 
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			<?php else : ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</p>
			<?php	endif;
			$kateslava_description = get_bloginfo( 'description', 'display' );
			if ( $kateslava_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $kateslava_description; /* WPCS: xss ok. */ ?></p>
			<?php endif;
		endif; ?>
		
		<nav id="site-navigation" class="main-navigation">
			<button type="button" class="main-navigation__toggler">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
					fill="none" 
					stroke="currentColor" 
					stroke-width="2" 
					stroke-linecap="round" 
					stroke-linejoin="round"
					class="icon-open" >
					<line x1="3" y1="12" x2="21" y2="12"></line>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<line x1="3" y1="18" x2="21" y2="18"></line>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
					fill="none" 
					stroke="currentColor" 
					stroke-width="2" 
					stroke-linecap="round" 
					stroke-linejoin="round"
					class="icon-close" >
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'main-navigation__menu',
			) ); ?>
		</nav>

		<div class="social-links">
			<?php if (esc_html( get_option('phone') )) { ?>
				<a target="_blank" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/wa.svg" alt="whatsapp"></a>	
			<?php }
			if (esc_html( get_option('email') )) { ?>
				<a target="_blank" href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/envelope.svg" alt="Письмо"></a>
			<?php }
			if (esc_html( get_option('facebook') )) {	?>
				<a target="_blank" href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/fb.svg" alt="Facebook"></a>	
			<?php	}
			if (esc_html( get_option('instagram') )) { ?>
				<a target="_blank" href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/ig.svg" alt="Instagram"></a>
			<?php }
			if (esc_html( get_option('vk') )) {	?>
				<a target="_blank" href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>"><img width="24px" height="24px" src="<?php echo get_template_directory_uri();?>/img/icons/vk.svg" alt="Вконтакте"></a>
			<?php } ?>
		</div>
		
	</header><!-- #masthead -->
	