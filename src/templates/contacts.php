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
      <ul class="contacts__list">
      <?php if (esc_html( get_option('phone') )) { ?>
        <li class="contacts__item">
          <div class="icon-big">
            <?php get_template_part('img/icon', 'wa.svg'); ?>
          </div>
          <a target="_blank" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', esc_html( get_option( 'phone', '' ) ));?>">whatsapp</a>
        </li>
      <?php } 
      if (esc_html( get_option('email') )) { ?>
        <li class="contacts__item">
          <div class="icon-big">
            <?php get_template_part('img/icon', 'mail.svg'); ?>
          </div>
          <a target="_blank" href="mailto:<?php echo esc_html( get_option( 'email', '' ) );?>"><?php echo esc_html( get_option( 'email', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('facebook') )) { ?>
        <li class="contacts__item">
          <div class="icon-big">
            <?php get_template_part('img/icon', 'fb.svg'); ?>
          </div>
          <a target="_blank" href="https://facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?>">facebook.com/<?php echo esc_html( get_option( 'facebook', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('instagram') )) { ?>
        <li class="contacts__item">
          <div class="icon-big">
            <?php get_template_part('img/icon', 'instagram.svg'); ?>
          </div>
          <a target="_blank" href="https://instagram.com/<?php echo esc_html( get_option( 'instagram', '' ) );?>">@<?php echo esc_html( get_option( 'instagram', '' ) );?></a>
        </li>
      <?php } 
      if (esc_html( get_option('vk') )) { ?>
        <li class="contacts__item">
          <div class="icon-big">
            <?php get_template_part('img/icon', 'vk.svg'); ?>
          </div>
          <a target="_blank" href="https://vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?>">vk.com/<?php echo esc_html( get_option( 'vk', '' ) );?></a>
        </li>
      <?php } ?>
      </ul>
    </div>
<?php endwhile; ?>
</main>

<?php
get_footer();
