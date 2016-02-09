<?php

$terms = LsbPageSectionsUtil::get_terms_for_navigation();

?>

<?php if($terms->with_icons || $terms->without_icons) : ?>

<nav class="tax-navigation book-shelf">
  <div class="page-header">
    <h2>
      <?php the_sub_field('lsb_page_section_title') ?>

      <?php if ( get_sub_field('lsb_page_section_sub_title') ) : ?>
        <small>| <?php the_sub_field('lsb_page_section_sub_title'); ?></small>
      <?php endif; ?>
    </h2>
  </div>

  <div class="book-shelf-body">
    <?php if($terms->with_icons) : ?>
      <ul>
      <?php foreach ($terms->with_icons as $term ): ?>
        <li>
          <a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
            <?php echo TaxonomyUtil::get_term_icon( $term ) ?>
            <?php echo ucfirst( TaxonomyUtil::get_term_name( $term ) ) ?>
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if($terms->without_icons) : ?>
      <ul>
      <?php foreach ($terms->without_icons as $term ): ?>
        <li>
          <a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
            <?php echo  ucfirst( TaxonomyUtil::get_term_name( $term ) ) ?>
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</nav>

<?php endif; ?>
