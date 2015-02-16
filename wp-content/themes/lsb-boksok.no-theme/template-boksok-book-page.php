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
  </h1>
</div>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if ( get_field('lsb_book_page_description') || is_user_logged_in() ) : ?>
  <div class="lsb-alert description">
    <?php the_field('lsb_book_page_description'); ?>
    <?php if ( is_user_logged_in() ) : ?>
      <small>
        <br/>
        <strong><?php echo __('Filterinstillinger:', 'lsb_boksok'); ?></strong> 
        <?php echo LsbFilterQueryUtil::filters_string_for_book_page() ?>
        <strong><?php echo __('- Vises kun for innloggede brukere', 'lsb_boksok'); ?></strong> 
      </small>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php if($child_pages_query->have_posts()) : ?>

  <section class="book-shelf-loop">
    <?php while ( $child_pages_query->have_posts() ) : $child_pages_query->the_post(); ?>
      <?php get_template_part('templates/book-shelf'); ?>
    <?php endwhile; ?>
  </section>

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
