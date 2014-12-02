<?php

$numberOfBoxes = count(get_sub_field('section_box'));

?>

<div class="frontpage-section boxes">
  <?php if(get_sub_field('section_text')): ?>
    <div class="section-header">
      <?php the_sub_field('section_text'); ?>
    </div>
  <?php endif; ?>
  <div class="row">
    <?php if ( have_rows('section_box') ): ?>
      <?php $i = 0; ?>
      <?php while ( have_rows('section_box') ) : the_row(); ?>

          <div class="<?php ColumnUtil::the_column_class($numberOfBoxes, $i); ?> box">
            <a href="<?php the_sub_field('section_box_link_'.get_sub_field('section_box_link_type')); ?> ">
              <h3><?php the_sub_field('section_box_heading'); ?></h3>
            </a>
            <?php the_sub_field('section_box_text'); ?>
          </div>

      <?php $i++; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
