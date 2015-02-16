<?php get_template_part('templates/page', 'header'); ?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if ( category_description() !== '') : ?>
  <div class="lsb-alert description">
    <?php echo category_description(); ?>
  </div>
<?php endif; ?>

<?php if ( have_posts() ): ?>
  <section class="loop">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-summary', get_post_type()); ?>
    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php roots_pagination(); ?>
  </nav>
<?php endif; ?>
