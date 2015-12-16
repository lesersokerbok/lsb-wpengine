<?php $terms = TaxonomyUtil::get_terms_with_icons( ['lsb_tax_topic', 'lsb_tax_genre'] ) ?>

<?php if ( !empty($terms) ) : ?>

  <div class="book-shelf">

    <div class="page-header">
      <h2>
        <?php the_field('lsb_book_page_visual_nav_title'); ?>

        <?php if ( get_field('lsb_book_page_visual_nav_sub_title') ) : ?>
          <small>| <?php the_field('lsb_book_page_visual_nav_sub_title'); ?></small>
        <?php endif; ?>
      </h2>
    </div>

    <div class="book-shelf-body">

      <span aria-hidden="true" class="book-shelf-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
      <span aria-hidden="true" class="book-shelf-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

      <div class="book-shelf-scroll">
        <?php foreach ( $terms as $term ) : ?>

          <a class="term-icon" href="<?php echo get_term_link( $term, $term->taxonomy ); ?>">
            <?php TaxonomyUtil::the_single_term_icon($term, true); ?>
          </a>
        <?php endforeach; ?>
      </div>

    </div>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
