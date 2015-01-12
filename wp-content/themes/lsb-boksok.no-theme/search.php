<?php $alert_text = LsbSearchUtil::alert_text(); ?>

<?php get_template_part('templates/page', 'header'); ?>

<?php if(!have_posts() && $alert_text) : ?>
  <p class="alert alert-warning">
    <?php _e('Beklager, ingen søkeresultater', 'lsb'); ?> <?php echo $alert_text; ?>
    Søk etter "<?php echo get_search_query()?>"
    <a href="/?s=<?php echo get_search_query()?>">
       i alle bøker.
    </a>
  </p>
<?php elseif (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Beklager, ingen søkeresultater', 'lsb'); ?>.
  </div>
  <?php get_search_form(); ?>
<?php elseif($alert_text) : ?>
  <p class="alert alert-info">
    <?php _e('Viser kun søkeresultater', 'lsb'); ?> <?php echo $alert_text; ?>
    Søk etter "<?php echo get_search_query()?>"
    <a href="/?s=<?php echo get_search_query()?>">
       i alle bøker.
    </a>
  </p>
<?php endif; ?>

<section class="loop">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content-summary', get_post_type()); ?>
<?php endwhile; ?>
</section>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php roots_pagination(); ?>
  </nav>
<?php endif; ?>

<?php
  global $wp_query;
  $total_results = $wp_query->found_posts;
  $search_query = $wp_query->query_vars['s'];
?>
