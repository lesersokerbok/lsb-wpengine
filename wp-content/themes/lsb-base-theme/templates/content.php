<?php if(is_single() || is_page()): ?>
  <?php get_template_part('templates/content-single', get_post_type() ); ?>
<?php else : ?>
  <?php get_template_part('templates/content-summary', get_post_type() ); ?>
<?php endif; ?>
