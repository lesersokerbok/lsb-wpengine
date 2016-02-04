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

      <ul>
        <?php foreach ( $terms as $term ) : ?>
        <li>
          <a class="term-icon" href="<?php echo get_term_link( $term, $term->taxonomy ); ?>">
            <?php TaxonomyUtil::the_single_term_icon($term, true); ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>

      <ul class="menu">
        <li><a href="bok-tema.html">Krim</a></li>
        <li><a href="bok-tema.html">Spenning</a></li>
        <li><a href="bok-tema.html">Sommerferie</a></li>
        <li><a href="bok-tema.html">Ølbrygging</a></li>
        <li><a href="bok-tema.html">Ipsum</a></li>
        <li><a href="bok-tema.html">Sport og fritid</a></li>
        <li><a href="bok-tema.html">Fantacy</a></li>
        <li><a href="bok-tema.html">Lorem</a></li>
        <li><a href="bok-tema.html">Ølbrygging</a></li>
        <li><a href="bok-tema.html">Sport og fritid</a></li>
        <li><a href="bok-tema.html">Fantacy</a></li>
        <li><a href="bok-tema.html">Lorem</a></li>
      </ul>
    </div>

  </div>
<?php endif; ?>

<?php wp_reset_query(); ?>
