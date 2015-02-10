<div class="page-header">
  <h1>
    <?php echo roots_title(); ?>
  </h1>

  <?php if(is_singular('post')) : ?>
    <?php get_template_part('templates/entry-meta'); ?>
  <?php endif; ?>
</div>

<?php if ( is_tax() || is_category() || is_tag() ) : ?>
  <?php if ( category_description() !== '') : ?>
    <div class="lsb-alert description">
      <?php echo category_description(); ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
