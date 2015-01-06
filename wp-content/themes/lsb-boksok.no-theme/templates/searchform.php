
<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="input-group">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php echo __('Søk etter en forfatter, en tittel eller et tema!', 'lsb_boksok'); ?>">
    <label class="hide"><?php echo __('Søk etter', 'lsb_boksok'); ?></label>

    <?php if ( is_tax('lsb_tax_lsb_cat') ): ?>
      <?php
        global $wp_query;
        $term_slug = $wp_query->get_queried_object()->slug;
      ?>
      <input type="hidden" value="<?php echo $term_slug; ?>" name="<?php echo TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat'); ?>" />
    <?php endif; ?>

    <?php if ( is_page_template( 'template-boksok-frontpage.php' ) ): ?>
      <?php if ( get_field('lsb_frontpage_filter_lsb_cat') ): ?>
        <input type="hidden"
          value="<?php echo TaxonomyUtil::get_slug(get_field('lsb_frontpage_filter_lsb_cat'), 'lsb_tax_lsb_cat'); ?>"
          name="<?php echo TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat'); ?>"
        />
      <?php endif; ?>
      <?php if ( get_field('lsb_frontpage_filter_age') ): ?>
        <input type="hidden"
        value="<?php echo TaxonomyUtil::get_slugs(get_field('lsb_frontpage_filter_age'), 'lsb_tax_age'); ?>"
        name="<?php echo TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_age'); ?>"
        />
      <?php endif; ?>
      <?php if ( get_field('lsb_frontpage_filter_audience') ): ?>
        <input type="hidden"
        value="<?php echo TaxonomyUtil::get_slugs(get_field('lsb_frontpage_filter_audience'), 'lsb_tax_audience'); ?>"
        name="<?php echo TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_audience'); ?>"
        />
      <?php endif; ?>

    <?php endif; ?>

    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php echo __('Søk', 'lsb_boksok'); ?></button>
    </span>
  </div>
</form>
