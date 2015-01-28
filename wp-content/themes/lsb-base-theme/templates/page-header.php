<div class="page-header">
  <h1>
    <?php echo roots_title(); ?>
  </h1>

  <?php if(is_singular('post')) : ?>
    <?php get_template_part('templates/entry-meta'); ?>
  <?php endif; ?>

  <?php if ( is_tax() || is_category() || is_tag() ) : ?>
    <?php if ( category_description() !== '') : ?>
      <?php
        $class = '';
        if ( is_tax('lsb_tax_lsb_cat') ):
          $class = get_query_var( 'lsb_tax_lsb_cat' );
        endif;
      ?>
      <div class="description <?php echo $class; ?>">
        <?php echo category_description(); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

</div>
