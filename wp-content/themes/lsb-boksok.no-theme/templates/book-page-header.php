
<div class="book-section-header page-header">

  <h1>
    <a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
    </a>

    <?php if ( get_field('lsb_book_page_sub_title') ) : ?>
      <small>| <?php the_field('lsb_book_page_sub_title'); ?></small>
    <?php endif; ?>

    <?php if ( get_field('lsb_book_page_description') ) : ?>
      <button type="button" class="btn-link" aria-hidden="true">
        <span class="glyphicon glyphicon-info-sign"></span>
      </button>
    <?php endif; ?>
  </h1>

  <?php if ( get_field('lsb_book_page_description') ) : ?>
    <div class="alert alert-info description sr-only">
      <button type="button" class="close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only"><?php echo __('Lukk', 'lsb_boksok'); ?></span>
      </button>
      <?php the_field('lsb_book_page_description'); ?>
      <?php if(!is_page(get_the_ID())) : ?>
        <p>
          <a href="<?php the_permalink() ?>">
            <?php echo __('Se flere bøker i seksjonen', 'lsb_boksok'); ?>
          </a>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  
  <?php if(is_user_logged_in()) : ?>
    <?php echo LsbFilterQueryUtil::filters_string_for_book_page() ?>
  <?php endif; ?>

</div>