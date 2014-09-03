<div class="page-header">
  <h1>
    <?php echo roots_title(); ?>
    <?php if ( is_tax() || is_category() || is_tag() ) : ?>
      <?php if ( category_description() !== '') : ?>
        <button type="button" class="btn-link" aria-hidden="true">
          <span class="glyphicon glyphicon-info-sign"></span>
        </button>
      <?php endif; ?>
    <?php endif; ?>
  </h1>

  <?php if(is_singular('post')) : ?>
    <?php get_template_part('templates/entry-meta'); ?>
  <?php endif; ?>

  <?php if ( is_tax() || is_category() || is_tag() ) : ?>
    <?php if ( category_description() !== '') : ?>
      <div class="alert alert-info description sr-only">
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only"><?php _e('Lukk', 'lsb') ?></span>
        </button>
        <?php echo category_description(); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

</div>
