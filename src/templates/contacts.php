<?php
/*
Template Name: Страница контакты
*/
get_header(); ?>

<main id="main" class="contacts-page">
<?php while ( have_posts() ) :
  the_post();
  the_title('<h1 class="title">', '</h1>'); ?>

    <div class="contacts">
      <!-- <p style="text-align:left" class="contacts-header">Просто напишите мне:</p> -->
      <ul class="contacts__list">
      <?php if (esc_html( get_option('phone') )) { ?>
        <li class="contacts__item">
          <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/wa.svg" alt="whatsapp">
          <a target="_blank" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>">whatsapp</a>
        </li>
      <?php } 
      if (esc_html( get_option('email') )) { ?>
        <li class="contacts__item">
          <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/envelope.svg" alt="Письмо">
          <a target="_blank" href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>"><?php echo esc_html( get_option( 'email', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('facebook') )) { ?>
        <li class="contacts__item">
          <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/fb.svg" alt="Facebook">
          <a target="_blank" href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>">facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('instagram') )) { ?>
        <li class="contacts__item">
          <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/ig.svg" alt="Instagram">
          <a target="_blank" href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>">@<?php echo esc_html( get_option( 'instagram', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('vk') )) { ?>
        <li class="contacts__item">
          <img width="32px" height="32px" src="<?php echo get_template_directory_uri();?>/img/icons/vk.svg" alt="Vkontakte">
          <a target="_blank" href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>">vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?></a>
        </li>
      <?php } ?>
      </ul>
    </div><!-- .contact-list -->
<?php endwhile; ?>
</main><!-- #main -->

<?php
get_footer();
