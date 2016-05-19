<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="input-group">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php echo __('Søk etter en forfatter, en tittel eller et tema!', 'lsb_boksok'); ?>">
    <label class="hide"><?php echo __('Søk etter', 'lsb_boksok'); ?></label>

    <?php if ( is_tax() ): ?>

      <?php
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_slug = $queried_object->slug;
        $taxonomy_rewrite_slug = TaxonomyUtil::get_tax_rewrite_slug($taxonomy);
      ?>
      <input type="hidden" value="<?= $term_slug; ?>" name="<?= $taxonomy_rewrite_slug ?>" />

    <?php endif; ?>

    <?php if ( is_search()): ?>

      <?php foreach (LsbFilterQueryUtil::possible_query_vars_for_lsb_book() as $query_var) : ?>
        <?php if(get_query_var($query_var)): ?>
          <input type="hidden"
            value="<?= get_query_var($query_var) ?>"
            name="<?= $query_var ?>"
          />
        <?php endif; ?>
      <?php endforeach; ?>

    <?php endif; ?>

    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php echo __('Søk', 'lsb_boksok'); ?></button>
    </span>
  </div>
</form>
