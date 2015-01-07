<?php
  list($books, $terms) = LsbQueryUtil::boksok_frontpage_advanced_section_query();
?>

<?php if ( $books->have_posts() ) : ?>

  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <?php if(get_sub_field('section_target_page')) : ?>
          <a href="<?php the_sub_field('section_target_page') ?>">
            <?php the_sub_field('section_header'); ?>
          </a>
        <?php else : ?>
          <?php the_sub_field('section_header'); ?>
        <?php endif; ?>

        <?php if ( get_sub_field('section_sub_header') ) : ?>
          <small>| <?php the_sub_field('section_sub_header'); ?></small>
        <?php endif; ?>

        <?php if ( get_sub_field('section_description') ) : ?>
          <button type="button" class="btn-link" aria-hidden="true">
            <span class="glyphicon glyphicon-info-sign"></span>
          </button>
        <?php endif; ?>

      </h1>

      <?php if ( get_sub_field('section_description') ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <?php the_sub_field('section_description'); ?>
          <p>
            <?php if ( get_sub_field('section_target_page') ): ?>
              <a href="<?php the_sub_field('section_target_page'); ?>">
                <?php echo __('Se flere bøker i seksjonen', 'lsb_boksok'); ?>
              </a>
            <?php else: ?>
              <a href="<?php echo get_search_link( implode( ' ', $terms ) ); ?> ">
                <?php echo __('Søk etter bøker i seksjonen', 'lsb_boksok'); ?>
                <?php the_sub_field('section_header') ?>.
              </a>
            <?php endif; ?>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <?php include(locate_template('templates/book-section.php')); ?>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
