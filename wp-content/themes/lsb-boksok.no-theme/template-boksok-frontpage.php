<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if ( have_rows('book_section') ): ?>
  <?php while ( have_rows('book_section') ) : the_row(); ?>
    <?php get_template_part('templates/book-section', get_sub_field('section_type')); ?>
  <?php endwhile; ?>
<?php endif; ?>
