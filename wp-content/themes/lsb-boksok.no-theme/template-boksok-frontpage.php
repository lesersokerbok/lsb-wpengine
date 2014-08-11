<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if( have_rows('frontpage_list') ): ?>

      <?php while ( have_rows('frontpage_list') ) : the_row(); ?>

          <?php
          $taxQuery = null;

          $age = null;
          $age = get_sub_field('age');
          if ($age) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_age',
              'field' => 'id',
              'terms' => $age
            );
          }

          $customization = null;
          $customization = get_sub_field('customization');
          if ($customization) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_customization',
              'field' => 'id',
              'terms' => $customization
            );
          }

          $author = null;
          $author = get_sub_field('author');
          if ($author) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_author',
              'field' => 'id',
              'terms' => $author
            );
          }

          $genre = null;
          $genre = get_sub_field('genre');
          if ($genre) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_genre',
              'field' => 'id',
              'terms' => $genre
            );
          }

          $topic = null;
          $topic = get_sub_field('topic');
          if ($topic) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_topic',
              'field' => 'id',
              'terms' => $topic
            );
          }

          $language = null;
          $language = get_sub_field('language');
          if ($language) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_language',
              'field' => 'id',
              'terms' => $language
            );
          }

          $publisher = null;
          $publisher = get_sub_field('publisher');
          if ($publisher) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_publisher',
              'field' => 'id',
              'terms' => $publisher
            );
          }

          $args = array(
              'post_type' => 'lsb_book',
              'tax_query' => $taxQuery
          );

          $wp_query = new WP_Query( $args );

          ?>

          <?php if ( $wp_query->have_posts() ) : ?>
            <div class="book-list">
              <div class="book-list-header">
                <h1>
                  <?php the_sub_field('list-header'); ?>
                  <?php if ( get_sub_field('list-sub-header') ) : ?>
                    <small>| <?php the_sub_field('list-sub-header'); ?></small>
                  <?php endif; ?>
                  <?php if ( get_sub_field('description') ) : ?>
                    <button type="button" class="btn btn-link">
                      <span class="glyphicon glyphicon-info-sign"></span>
                    </button>
                  <?php endif; ?>
                </h1>
                <?php if ( get_sub_field('description') ) : ?>
                  <p class="alert alert-info book-list-description sr-only">
                    <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <?php the_sub_field('description'); ?>
                  </p>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="book-list-scroll-button-wrapper col-md-1">
                  <button type="button" class="book-list-left-scroll btn btn-link btn-lg btn-block">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>
                  </button>
                </div>
                <div class="book-list-body col-md-10">
                  <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
                  <?php endwhile; ?>
                </div>
                <div class="book-list-scroll-button-wrapper col-md-1">
                  <button type="button" class="book-list-right-scroll btn btn-link btn-lg btn-block">
                    <span class="glyphicon glyphicon-circle-arrow-right"></span>
                  </button>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php wp_reset_query(); ?>

      <?php endwhile; ?>

  <?php endif; ?>
