<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<?php if ( get_field('lsb_show_book_navigation_field') ): ?>
  <?php get_template_part('templates/book-navigation'); ?>
<?php endif; ?>

<?php if ( have_rows('book_section') ): ?>
  <?php while ( have_rows('book_section') ) : the_row(); ?>
    <?php get_template_part('templates/book-section', get_sub_field('section_type')); ?>
  <?php endwhile; ?>
<?php endif; ?>
