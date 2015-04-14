<?php
/*
Template Name: Frontpage Template
*/
?>

<?php if ( have_rows('section') ): ?>
  <?php while ( have_rows('section') ) : the_row(); ?>
    <div class="frontpage-section frontpage-section-<?php the_sub_field('section_type'); ?> margin-bottom-<?php the_sub_field('section_margin'); ?>">
      
      <?php get_template_part('templates/section', get_sub_field('section_type')); ?>
      
    </div>
  <?php endwhile; ?>
<?php endif; ?>
