<?php
/*
Template Name: Frontpage Template
*/
?>

<?php if ( have_rows('section') ): ?>
  <?php while ( have_rows('section') ) : the_row(); ?>
    <?php get_template_part('templates/section', get_sub_field('section_type')); ?>
  <?php endwhile; ?>
<?php endif; ?>
