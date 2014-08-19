<?php

$hashed = '';

$taxQuery = null;

$age = null;
$age = get_sub_field('section_age');
if ($age) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_age',
    'field' => 'id',
    'terms' => $age
  );

  $hashed .= 'lsb_tax_age_' . implode($age);
}

$customization = null;
$customization = get_sub_field('section_customization');
if ($customization) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_customization',
    'field' => 'id',
    'terms' => $customization
  );
  $hashed .= 'lsb_tax_customization_' . implode($customization);
}

$author = null;
$author = get_sub_field('section_author');
if ($author) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_author',
    'field' => 'id',
    'terms' => $author
  );
  $hashed .= 'lsb_tax_author_' . implode($author);
}

$genre = null;
$genre = get_sub_field('section_genre');
if ($genre) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_genre',
    'field' => 'id',
    'terms' => $genre
  );
  $hashed .= 'lsb_tax_genre_' . implode($genre);
}

$topic = null;
$topic = get_sub_field('section_topic');
if ($topic) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_topic',
    'field' => 'id',
    'terms' => $topic
  );
  $hashed .= 'lsb_tax_topic_' . implode($topic);
}

$language = null;
$language = get_sub_field('section_language');
if ($language) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_language',
    'field' => 'id',
    'terms' => $language
  );
  $hashed .= 'lsb_tax_language_' . implode($language);
}

$publisher = null;
$publisher = get_sub_field('section_publisher');
if ($publisher) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_publisher',
    'field' => 'id',
    'terms' => $publisher
  );
  $hashed .= 'lsb_tax_publisher_' . implode($publisher);
}

$series = null;
$series = get_sub_field('section_series');
if ($series) {
  $taxQuery[] = array(
    'taxonomy' => 'lsb_tax_series',
    'field' => 'id',
    'terms' => $series
  );
  $hashed .= 'lsb_tax_series_' . implode($series);
}

$args = array(
    'post_type' => 'lsb_book',
    'tax_query' => $taxQuery
);

$orderby = null;
$orderby = get_sub_field('section_orderby');
$order = get_sub_field('section_order');

if ($orderby) {
    switch($orderby) {
      case 'random':
        $args['orderby'] = 'rand';
        $hashed .= '_orderby_rand';
        break;
      case 'added':
        $args['orderby'] = 'date';
        $args['order'] = $order;
        $hashed .= '_orderby_date_order_' . $order;
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
        $hashed .= '_orderby_lsb_published_year_order_' . $order;
        break;
      default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        $hashed .= '_orderby_date_order_DESC';
        break;
    }
}

$hashed = hash('md5', $hashed);

if ( false == ( $books = get_transient( $hashed ) ) ) {
  $books = new WP_Query( $args );
  set_transient( $hashed, $books, 3600 );
}

?>

<?php if ( $books->have_posts() ) : ?>
  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <?php the_sub_field('section_header'); ?>
        <?php if ( get_sub_field('section_sub_header') ) : ?>
          <small>| <?php the_sub_field('section_sub_header'); ?></small>
        <?php endif; ?>
        <?php if ( get_sub_field('section_description') ) : ?>
          <small aria-hidden="true">
            | <button type="button" class="btn-link">
                <span class="glyphicon glyphicon-info-sign"></span>
              </button>
          </small>

        <?php endif; ?>
      </h1>

      <?php if ( get_sub_field('section_description') ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <?php the_sub_field('section_description'); ?>
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
