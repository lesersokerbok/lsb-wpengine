<?php
  list($books, $terms) = LsbQueryUtil::boksok_frontpage_advanced_section_query();
?>

<?php if ( $books->have_posts() ) : ?>

  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
        </a>

        <?php if ( get_field('sub_header') ) : ?>
          <small>| <?php the_field('sub_header'); ?></small>
        <?php endif; ?>

        <?php if ( get_field('description') ) : ?>
          <button type="button" class="btn-link" aria-hidden="true">
            <span class="glyphicon glyphicon-info-sign"></span>
          </button>
        <?php endif; ?>
      </h1>

      <?php if ( get_field('description') ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <?php the_field('description'); ?>
          <p>
            <a href="<?php the_permalink() ?>">
              <?php echo __('Se flere bøker i seksjonen', 'lsb_boksok'); ?>
            </a>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <?php include(locate_template('templates/book-section.php')); ?>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
