<div class="page-header">
  <div>
    <header>
      <h1>
        <?php TaxonomyUtil::the_single_term_icon(get_queried_object())?><?php echo roots_title(); ?>
      </h1>
      <?php echo category_description(); ?>
    </header>
    <?php get_search_form(); ?>
  </div>
</div>

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
