<?php

$util = new TaxonomyUtil();
$hashed = '';
$taxQuery = null;
$terms = array();

$age = null;
if ( get_field('lsb_frontpage_filter_age') ) {
  $age = get_field('lsb_frontpage_filter_age');
}
if ( is_array($age) ) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_age',
    'field' => 'id',
    'terms' => array_map(array($util, 'get_id'), $age),
  );
  $terms = array_merge($terms, array_map(array($util, 'get_name'), $age));
}

$list = get_sub_field('section_list');
$taxQuery[] = array(
  'taxonomy' => 'lsb_tax_list',
  'field' => 'id',
  'terms' => array($list->term_id)
);
$terms[] = $list->name;

$args = array(
    'post_type' => 'lsb_book',
    'update_post_term_cache' => false,
    'update_post_meta_cache' => false,
    'no_found_rows' => true,
    'post_status'=>'publish',
    'tax_query' => $taxQuery
);

$hashed = 'section_list_' . $terms;
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
        <a href="<?php echo get_term_link( $list, 'lsb_tax_list' ); ?> "><?php echo ucfirst($list->name) ?></a>

        <?php if ( $list->description ) : ?>
          <button type="button" class="btn-link" aria-hidden="true">
            <span class="glyphicon glyphicon-info-sign"></span>
          </button>
        <?php endif; ?>

      </h1>

      <?php if ( $list->description ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <p><?php echo $list->description; ?></p>
          <p>
            <a href="<?php echo get_term_link( $list, 'lsb_tax_list' ); ?> ">
              <?php echo __('Gå til alle bøker i ', 'lsb_boksok'); ?>
              <?php echo $list->name ?>.
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
