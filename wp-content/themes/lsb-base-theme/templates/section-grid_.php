<?php

$numberOfBoxes = count(get_sub_field('section_grid'));

?>

<?php if(get_sub_field('section_heading')): ?>
  <div class="section-header">
    <h2>
      <?php the_sub_field('section_heading'); ?>
      <?php if(get_sub_field('section_subheading')): ?>
        <small> | <?php the_sub_field('section_subheading'); ?></small>
      <?php endif; ?>
    </h2>
  </div>
<?php endif; ?>

<div class="row">
  <?php if ( have_rows('section_grid') ): ?>
    <?php $i = 0; ?>
    <?php while ( have_rows('section_grid') ) : the_row(); ?>

        <div class="<?php ColumnUtil::the_column_class($numberOfBoxes, $i); ?> grid-element">

          <h3>
            <a href="<?php the_sub_field('section_grid_element_link_'.get_sub_field('section_grid_element_link_type')); ?> " target="<?php echo get_sub_field('section_grid_element_link_type') == 'external' ? '_blank' : '_self'; ?>">
              <?php the_sub_field('section_grid_element_heading'); ?>
            </a>
          </h3>

          <?php the_sub_field('section_grid_element_text'); ?>
        </div>

    <?php $i++; ?>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
