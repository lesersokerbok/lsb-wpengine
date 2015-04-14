<?php

$numberOfBoxes = count(get_sub_field('section_box'));

?>

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
          
          <h3>
            <a href="<?php the_sub_field('section_box_link_'.get_sub_field('section_box_link_type')); ?> ">
              <?php the_sub_field('section_box_heading'); ?>
            </a>
          </h3>
          
          <?php the_sub_field('section_box_text'); ?>
        </div>

    <?php $i++; ?>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
