<?php $books = LsbFilterQueryUtil::get_books_for_book_shelf() ?>

<?php if ( $books->have_posts() ) : ?>

  <div class="book-section">

    <?php get_template_part('templates/book-page-header'); ?>
    
    <?php if($books): ?>  
      <div class="book-section-body">

          <span aria-hidden="true" class="book-section-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
          <span aria-hidden="true" class="book-section-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

          <div class="book-section-scroll">
            <?php while ( $books->have_posts() ) : $books->the_post(); ?>
              <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
            <?php endwhile; ?>
          </div>

        </div>
    <?php endif; ?>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
