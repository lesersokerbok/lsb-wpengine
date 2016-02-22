<?php
/*
Template Name: Forside
*/
?>

<div class="main-header">
  <div>
    <header>
      <h1>
        <?php the_title(); ?>
      </h1>
    </header>
    <?php get_search_form(); ?>
  </div>
</div>

<?php get_template_part('templates/main-sections'); ?>
