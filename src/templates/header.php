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
		<?php	if ( has_custom_logo()) : 
			if ( is_front_page() && is_home() ) { ?>
				<h1 class="screen-reader-text"><?php 
					bloginfo( 'name' ); 
					echo ' - ';
					bloginfo( 'description' );
				?></h1>	
			<?php }			
			the_custom_logo();
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
				<div class="icon">
					<?php get_template_part('img/icon', 'menu.svg'); ?>
					<?php get_template_part('img/icon', 'x.svg'); ?>
				</div>
			</button>
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'main-navigation__menu',
			) ); ?>
		</nav>

		<ul class="social-links">
			<?php if (esc_html( get_option('phone') )) { ?>
				<li>
					<a target="_blank" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>">
						<div class="icon">
							<?php get_template_part('img/icon', 'wa.svg'); ?>
						</div>
					</a>	
				</li>
			<?php }
			if (esc_html( get_option('email') )) { ?>
				<li>
					<a target="_blank" href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>">
						<div class="icon">
							<?php get_template_part('img/icon', 'mail.svg'); ?>
						</div>
					</a>
				</li>
			<?php }
			if (esc_html( get_option('facebook') )) {	?>
				<li>
					<a target="_blank" href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>">
						<div class="icon">
							<?php get_template_part('img/icon', 'fb.svg'); ?>
						</div>
					</a>	
				</li>
			<?php	}
			if (esc_html( get_option('instagram') )) { ?>
				<li>
					<a target="_blank" href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>">
						<div class="icon">
							<?php get_template_part('img/icon', 'instagram.svg'); ?>
						</div>
					</a>
				</li>
			<?php }
			if (esc_html( get_option('vk') )) {	?>
				<li>
					<a target="_blank" href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>">
						<div class="icon">
							<?php get_template_part('img/icon', 'vk.svg'); ?>
						</div>
					</a>
				</li>	
			<?php } ?>
			</ul>
		
	</header>
	