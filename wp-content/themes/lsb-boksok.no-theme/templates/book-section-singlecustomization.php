<?php

$customization = get_sub_field('section_singlecustomization');
$args = array(
    'post_type' => 'lsb_book',
    'tax_query' => array(
      array(
        'taxonomy' => 'lsb_tax_customization',
        'field' => 'id',
        'terms' => array($customization->term_id)
      )
    )
);

$hashed = 'section_customization_' . $customization->term_id;
$hashed = hash('md5', $hashed);

if ( false == ( $books = get_transient( $hashed ) ) ) {
  $books = new WP_Query ($args);
  set_transient($hashed, $books, 3600);
}

?>

<?php if ( $books->have_posts() ) : ?>
  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <a href="<?php echo get_term_link( $customization, $customization->taxonomy ); ?> "><?php echo ucfirst($customization->name) ?></a>

        <?php if ( $customization->description ) : ?>
          <button type="button" class="btn-link" aria-hidden="true">
            <span class="glyphicon glyphicon-info-sign"></span>
          </button>
        <?php endif; ?>
        
      </h1>

      <?php if ( $customization->description ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <p><?php echo $customization->description; ?></p>
          <p>
            <a href="<?php echo get_term_link( $customization, $customization->taxonomy ); ?> ">
              <?php echo __('Gå til alle bøker i ', 'lsb_boksok'); ?>
              <?php echo $customization->name ?>.
            </a>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <div class="book-section-body">

      <span aria-hidden="true" class="book-section-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
      <span aria-hidden="true" class="book-section-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

      <div class="book-section-scroll">

        <?php while ( $books->have_posts() ) : $books->the_post(); ?>
          <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
        <?php endwhile; ?>

      </div>

    </div>

  </div>
<?php endif; ?>


<?php wp_reset_query(); ?>
