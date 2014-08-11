<article <?php post_class('summary'); ?>>
  <div class="entry-image">
    <a href="<?php the_permalink(); ?>">
      <?php if ( has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('medium'); ?></img></a>
      <?php else : ?>
        <img src="http://dummyimage.com/220x300/eeeeee/eeeeee.jpg"></img>
      <?php endif; ?>
  </div>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="meta">
      <?php the_terms($post->ID, 'lsb_tax_author') ?><br/>
      <?php the_terms($post->ID, 'lsb_tax_publisher') ?><br/>
      <?php the_field('year_published'); ?>
    </p>
  </header>
</article>
