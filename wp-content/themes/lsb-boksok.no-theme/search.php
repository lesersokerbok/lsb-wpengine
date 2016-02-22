<?php 

  $alert_text = LsbSearchUtil::alert_text(); 
  global $searchwp_filter_no_results;

  $has_posts = have_posts() && !$searchwp_filter_no_results;
?>

<div class="page-header">
  <div>
    <header>
      <h1>
        <?php echo roots_title(); ?>
      </h1>
      <?php if($alert_text) : ?>
        <p>
          <?php _e('Viser kun søkeresultater', 'lsb'); ?> <?php echo $alert_text; ?><br/>
          Søk etter <i><?php echo get_search_query()?></i>
          <a href="/?s=<?php echo get_search_query()?>">
            <?php _e('i alle bøker.'); ?>
          </a>
        </p>
      <?php endif; ?>
    </header>
    <?php get_search_form(); ?>
  </div>
</div>

<section class="loop">
<?php if($has_posts) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content-summary', get_post_type()); ?>
  <?php endwhile; ?>
<?php else : ?>

<?php endif; ?>
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
