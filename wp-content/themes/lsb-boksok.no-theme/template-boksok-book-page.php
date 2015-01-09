<?php
/*
Template Name: Boksside Template
*/
?>

<?php 

  $args = array(
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'post_type' => 'page'
  ); 
  $child_pages_query = new WP_Query($args);
?>

<div class="page-header">
  <h1>
    <?php the_title(); ?>

    <?php if ( get_field('lsb_book_page_sub_title') ) : ?>
      <small>| <?php the_field('lsb_book_page_sub_title'); ?> </small>
    <?php endif; ?>

    <?php if ( get_field('lsb_book_page_description') ) : ?>
      <small class="smaller">|
        <button type="button" class="btn-link">
          <?php echo __('Mer info', 'lsb_boksok'); ?>
        </button>
      </small>
    <?php endif; ?>
  </h1>

  <?php if ( get_field('lsb_book_page_description') ) : ?>
    <div class="alert alert-info description sr-only">
      <button type="button" class="close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
      </button>
      <?php the_field('lsb_book_page_description'); ?>
    </div>
  <?php endif; ?>
  <?php if(is_user_logged_in()) : ?>
    <span class="filter-info hidden">
      <?php echo LsbFilterQueryUtil::filters_string_for_book_page() ?>
    </span>
  <?php endif; ?>
</div>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if($child_pages_query->have_posts()) : ?>

  <?php while ( $child_pages_query->have_posts() ) : $child_pages_query->the_post(); ?>
    <?php get_template_part('templates/book-shelf'); ?>
  <?php endwhile; ?>

<?php else : ?>

  <?php $books = LsbFilterQueryUtil::get_books_for_book_page(get_query_var('paged')) ?>

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