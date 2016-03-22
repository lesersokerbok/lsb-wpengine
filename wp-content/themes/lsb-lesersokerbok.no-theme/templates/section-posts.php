<?php

$posts = new WP_Query('cat=1101');

?>

<?php if ( $posts->have_posts() ) : ?>

  <?php if(get_sub_field('section_heading')): ?>
    <div class="section-header">
      <h2>
        <a href="<?php  ?>"><?php the_sub_field('section_heading'); ?></a>
        <?php if(get_sub_field('section_subheading')): ?>
        <small> | <a href="<?php the_sub_field('section_feed_link') ?>"><?php the_sub_field('section_subheading'); ?></a></small>
        <?php endif; ?>
      </h2>
    </div>
  <?php endif; ?>

  <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
    <article class="row rss-post">
      <div class="col-sm-8">
        <header>
          <h3>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>
        </header>
        <div class="rss-summary">
          <?php the_excerpt(); ?>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="rss-image">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-thumb'); ?></a>
        </div>
      </div>
    </article>
  <?php endwhile; wp_reset_postdata(); ?>

<?php else : ?>

  <?php if(current_user_can('manage_options')) : ?>
    <div class="alert alert-warning">
      <?php LsbFeedUtil::print_error_message($feed_url, $rss) ?>
    </div>
  <?php endif; ?>

<?php endif; ?>
