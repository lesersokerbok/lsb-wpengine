<?php
/*
Template Name: Frontpage Template
*/
?>

<?php if ( have_rows('section') ): ?>
  <?php while ( have_rows('section') ) : the_row(); ?>
    <div class="row frontpage-section frontpage-section-<?php echo get_row_layout(); ?>">
      
      <?php get_template_part('templates/section', get_row_layout()); ?>
      
    </div>
  <?php endwhile; ?>
<?php endif; ?>
