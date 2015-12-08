<div class="page-header <?php echo !empty( TaxonomyUtil::single_term_icon('', false) ) ? 'has-term-icon': '';  ?>">
  <h1>
    <?php TaxonomyUtil::single_term_icon('', true)?> <?php echo roots_title(); ?>
  </h1>
</div>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if ( category_description() !== '') : ?>
  <div class="alert description">
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
