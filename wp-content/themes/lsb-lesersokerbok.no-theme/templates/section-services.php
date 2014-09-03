<?php

$columnsPerService = 12/count(get_sub_field('section_service'));

?>

<div class="frontpage-section services">
  <div class="section-header">
    <?php the_sub_field('section_text'); ?>
  </div>
  <div class="row">
    <?php if ( have_rows('section_service') ): ?>
      <?php while ( have_rows('section_service') ) : the_row(); ?>
        <a href="<?php the_sub_field('section_service_link_'.get_sub_field('section_service_link_type')); ?> ">
          <div class="col-md-<?php echo $columnsPerService; ?> service">
            <h1><?php the_sub_field('section_service_heading'); ?></h1>
            <?php the_sub_field('section_service_text'); ?>
          </div>
        </a>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
