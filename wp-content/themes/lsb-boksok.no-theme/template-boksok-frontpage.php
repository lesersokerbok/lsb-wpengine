<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if( have_rows('frontpage_section') ): ?>

      <?php while ( have_rows('frontpage_section') ) : the_row(); ?>

          <?php
          $taxQuery = null;

          $age = null;
          $age = get_sub_field('section-age');
          if ($age) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_age',
              'field' => 'id',
              'terms' => $age
            );
          }

          $customization = null;
          $customization = get_sub_field('section-customization');
          if ($customization) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_customization',
              'field' => 'id',
              'terms' => $customization
            );
          }

          $author = null;
          $author = get_sub_field('section-author');
          if ($author) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_author',
              'field' => 'id',
              'terms' => $author
            );
          }

          $genre = null;
          $genre = get_sub_field('section-genre');
          if ($genre) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_genre',
              'field' => 'id',
              'terms' => $genre
            );
          }

          $topic = null;
          $topic = get_sub_field('section-topic');
          if ($topic) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_topic',
              'field' => 'id',
              'terms' => $topic
            );
          }

          $language = null;
          $language = get_sub_field('section-language');
          if ($language) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_language',
              'field' => 'id',
              'terms' => $language
            );
          }

          $publisher = null;
          $publisher = get_sub_field('section-publisher');
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

          $orderby = null;
          $orderby = get_sub_field('section-orderby');
          $order = get_sub_field('section-order');
          if ($orderby) {
              switch($orderby) {
                case 'random':
                  $args['orderby'] = 'rand';
                  break;
                case 'added':
                  $args['orderby'] = 'date';
                  $args['order'] = $order;
                  break;
                case 'published':
                  $args['meta_key'] = 'lsb_published_year';
                  $args['orderby'] = 'meta_value_num';
                  $args['order'] = $order;
                  $args['meta_query'] = array(
                    array(
                      'key' => 'lsb_published_year'
                    )
                  );
                  break;
                default:
                  $args['orderby'] = 'date';
                  $args['order'] = 'DESC';
                  break;
              }
          }

          $wp_query = new WP_Query( $args );

          ?>

          <?php if ( $wp_query->have_posts() ) : ?>
            <div class="book-section">
              <div class="book-section-header page-header">

                <h1>
                  <?php the_sub_field('section-header'); ?>
                  <?php if ( get_sub_field('section-sub-header') ) : ?>
                    <small>| <?php the_sub_field('section-sub-header'); ?></small>
                  <?php endif; ?>
                  <?php if ( get_sub_field('section-description') ) : ?>
                    <small aria-hidden="true">
                      | <button type="button" class="btn-link">
                          <span class="glyphicon glyphicon-info-sign"></span>
                        </button>
                    </small>

                  <?php endif; ?>
                </h1>

                <?php if ( get_sub_field('section-description') ) : ?>
                  <p class="alert alert-info description sr-only">
                    <button type="button" class="close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                    <?php the_sub_field('section-description'); ?>
                  </p>
                <?php endif; ?>

              </div>

              <div class="book-section-body">

                <span aria-hidden="true" class="book-section-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
                <span aria-hidden="true" class="book-section-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

                <div class="book-section-scroll">

                  <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
                  <?php endwhile; ?>

                </div>

              </div>

            </div>
          <?php endif; ?>

          <?php wp_reset_query(); ?>

      <?php endwhile; ?>

  <?php endif; ?>
