<?php $books = LsbFilterQueryUtil::get_books_for_book_shelf() ?>

<?php if ( $books->have_posts() ) : ?>

  <div class="book-shelf">

    <div class="page-header">

    <h2>
      <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

      <?php if ( get_field('lsb_book_page_sub_title') ) : ?>
        <small>| <a href="<?php the_permalink() ?>"><?php the_field('lsb_book_page_sub_title'); ?></a></small>
      <?php endif; ?>
    </h2>

    <span class="filter-info hidden">
      <?php echo LsbFilterQueryUtil::filters_string_for_book_page() ?>
    </span>

    </div>

    <?php if($books): ?>
      <div class="book-shelf-body">

          <span aria-hidden="true" class="book-shelf-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
          <span aria-hidden="true" class="book-shelf-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

          <div class="book-shelf-scroll">
            <?php while ( $books->have_posts() ) : $books->the_post(); ?>
              <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
            <?php endwhile; ?>
          </div>

        </div>
    <?php endif; ?>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
