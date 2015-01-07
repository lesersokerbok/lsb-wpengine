<?php
  list($books, $list) = LsbQueryUtil::boksok_frontpage_list_section_query();
?>

<?php if ( $books->have_posts() ) : ?>
  <div class="book-section">
    <div class="book-section-header page-header">

      <h1>
        <a href="<?php echo get_term_link( $list, 'lsb_tax_list' ); ?> "><?php echo ucfirst($list->name) ?></a>

        <?php if ( $list->description ) : ?>
          <button type="button" class="btn-link" aria-hidden="true">
            <span class="glyphicon glyphicon-info-sign"></span>
          </button>
        <?php endif; ?>

      </h1>

      <?php if ( $list->description ) : ?>
        <div class="alert alert-info description sr-only">
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
          </button>
          <p><?php echo $list->description; ?></p>
          <p>
            <a href="<?php echo get_term_link( $list, 'lsb_tax_list' ); ?> ">
              <?php echo __('Gå til alle bøker i ', 'lsb_boksok'); ?>
              <?php echo $list->name ?>.
            </a>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <?php include(locate_template('templates/book-section.php')); ?>
    
  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
