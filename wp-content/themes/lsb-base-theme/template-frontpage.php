<?php
/*
Template Name: Frontpage Template
*/
?>

<?php if ( have_rows('sections') ): ?>
  <?php while ( have_rows('sections') ) : the_row(); ?>
    <div class="page-section page-section-<?php echo get_row_layout(); ?>">

      <?php get_template_part('templates/section', get_row_layout()); ?>

    </div>
  <?php endwhile; ?>
<?php endif; ?>
