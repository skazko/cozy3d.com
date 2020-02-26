<?php
/**
 * Template part for displaying portfolio items
 * @package KateSlava
 */
?>

<li class="portfolio__item">
  <article id="post-<?php the_ID(); ?>" <?php post_class("project"); ?>>
    <h2 class="project__title"><?php the_title(); ?></h2>
    <a class="project__link" href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail("full", array(
        "class" => "project__image",
      )) ?> 
    </a>
    <p class="project__excerpt">
      <span><?php echo get_the_excerpt(); ?></span>
      <a href="<?php the_permalink(); ?>" class="project__button">Смотреть</a>
    </p>
  </article><!-- #post-<?php the_ID(); ?> -->
</li>