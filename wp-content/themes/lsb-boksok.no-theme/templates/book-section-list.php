<?php

$list = get_sub_field('section_list');
$args = array(
    'post_type' => 'lsb_book',
    'tax_query' => array(
      array(
        'taxonomy' => 'lsb_tax_list',
        'field' => 'id',
        'terms' => array($list->term_id)
      )
    )
);
$wp_query = new WP_Query( $args );

?>

<?php if ( $wp_query->have_posts() ) : ?>
  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <?php echo $list->name ?>
        <?php if ( $list->description ) : ?>
          <small aria-hidden="true">
            | <button type="button" class="btn-link">
                <span class="glyphicon glyphicon-info-sign"></span>
              </button>
          </small>
        <?php endif; ?>
        <small>
          <a href="/liste/<?php echo $list->slug?>">Hele lista</a>
        </small>
      </h1>

      <?php if ( $list->description ) : ?>
        <p class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
          <?php echo $list->description; ?>
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
