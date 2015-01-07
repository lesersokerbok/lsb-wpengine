<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<?php 

  $args = array(
    'sort_order' => 'ASC',
    'sort_column' => 'menu_order',
    'post_parent' => $post->ID,
    'post_type' => 'page'
  ); 
  $child_pages_query = new WP_Query($args);
?>

<?php get_template_part('templates/page', 'header'); ?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php while ( $child_pages_query->have_posts() ) : $child_pages_query->the_post(); ?>
  <?php get_template_part('templates/book-section', 'frontpage'); ?>
<?php endwhile; ?>

<?php if ( have_rows('book_section') ): ?>
  <?php while ( have_rows('book_section') ) : the_row(); ?>
    <?php get_template_part('templates/book-section', get_sub_field('section_type')); ?>
  <?php endwhile; ?>
<?php else: ?>

  <?php list($books, $terms) = LsbQueryUtil::boksok_frontpage_advanced_section_query(array('paged' => get_query_var( 'paged' ))); ?>

  <section class="loop">
  <?php while ( $books->have_posts() ) : $books->the_post(); ?>
    <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
  <?php endwhile; ?>
  </section>

  <?php if ($books->max_num_pages > 1) : ?>
    <nav class="post-nav">
      <?php roots_pagination(array('query' => $books)); ?>
    </nav>
  <?php endif; ?>

<?php endif; ?>