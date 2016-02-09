<?php
/*
Template Name: Forside
*/
?>

<div class="page-header">
  <h1>
    <?php the_title(); ?>
  </h1>
</div>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php get_template_part('templates/page-sections'); ?>
