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
<?php endif; ?>