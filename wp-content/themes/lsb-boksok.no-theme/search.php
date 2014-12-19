<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Beklager, ingen søkeresultater.', 'lsb'); ?>
  </div>
  <?php get_search_form(); ?>
<?php else : ?>
  <div class="panel panel-default">
    <div class="row">
      <div class="col-md-3">
        <?php echo facetwp_display( 'facet', 'lsb_facet_lsb_cat' ); ?>
      </div>
      <div class="col-md-3">
        <?php echo facetwp_display( 'facet', 'lsb_facet_age' ); ?>
      </div>
      <div class="col-md-3">
        <?php echo facetwp_display( 'facet', 'lsb_facet_audience' ); ?>
      </div>
    </div>
  </div>


<?php endif; ?>

<section class="loop facetwp-template">
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

<script type="text/javascript">
  /*$(function() {
    ga(
      'send',
      'event',
      'BookSearchResults',
      'Pageview',
      '<?php echo $search_query ?>',
      <?php echo $total_results ?>
    );
  });*/
</script>
