<?php //if ( !empty($terms) ) : ?>

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

      <?php TaxonomyUtil::the_taxonomy_navigation_menu( array('lsb_tax_topic', 'lsb_tax_genre') ) ?>

    </div>

  </div>
<?php //endif; ?>

<?php wp_reset_query(); ?>
