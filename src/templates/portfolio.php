<?php
  /*
  Template Name: Страница Портфолио
  */
  get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <section class="portfolio">
      <h1 class="portfolio__title"><?php the_title(); ?></h1>
      <?php if (!empty($post->post_content) ) { ?>
        <p class="portfolio__description"><?php the_content(); ?></p>
      <?php } ?>
      <?php 
          global $wp_query;

          $wp_query = new WP_Query(array(
            'posts_per_page' => '5',
            'post_type' => 'post',
            'orderby'     => 'date',
            'order'       => 'DESC',
            'paged' => get_query_var('paged') ?: 1,
          ));
      ?>
      <ul class="portfolio__list">
        <?php
          while( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/content', 'portfolio' );
          }
        ?>
      </ul>
      <?php 
        if ( $wp_query->max_num_pages > 1 ) {
          ?>
          <script>
            var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
          </script>
          <div class="portfolio__loadmore">
            <button type="button" class="loadmore">
              Загрузить еще
            </button>
          </div>
          <?php
        }
      ?>
    </section>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
