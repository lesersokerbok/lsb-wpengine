<article <?php post_class('full'); ?>>
  <header class="page-header">
    <h1>
      <?php echo roots_title(); ?>
      <small>
        <?php the_terms($post->ID, 'lsb_tax_author', ' | ', ', ') ?>
      </small>
    </h1>
  </header>

  <div class="entry-content">

    <p><?php the_field('lsb_review'); ?></p>
    <?php if(get_field('lsb_quote')): ?>
      <blockquote><?php the_field('lsb_quote'); ?></blockquote>
    <?php endif; ?>
    <p class="meta">

      <?php the_terms($post->ID, 'lsb_tax_genre', 'Sjanger: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'tax_lsb_language', 'Språk: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'lsb_tax_age', 'Passer for: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'lsb_tax_customization', 'Tilpassning: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'lsb_tax_topic', 'Tema: ', ', ', '<br/>') ?>

      <?php if( get_field( "lsb_pages" ) ): ?>
        Antall sider: <?php the_field( "lsb_pages" ); ?><br/>
      <?php endif; ?>

    </p>
    <p class="meta">

      <?php the_terms($post->ID, 'lsb_tax_illustrator', 'Illustratør: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'lsb_tax_translator', 'Oversetter: ', ', ', '<br/>') ?>
      <?php the_terms($post->ID, 'lsb_tax_publisher', 'Forlag: ', ', ', '<br/>') ?>

      <?php if( get_field( "lsb_isbn" ) ): ?>
        ISBN: <?php the_field( "lsb_isbn" ); ?><br/>
      <?php endif; ?>

      <?php if( get_field( "lsb_published_year" ) ): ?>
        Utgitt: <?php the_field( "lsb_published_year" ); ?><br/>
      <?php endif; ?>

    </p>
  </div>

  <div class="entry-image">
    <?php if ( has_post_thumbnail() && get_field('lsb_look_inside')): ?>
      <a href="<?php the_field('lsb_look_inside'); ?>" target="_blank"><?php the_post_thumbnail('large', array('class' => 'look-inside')); ?></a>
    <?php elseif (has_post_thumbnail()): ?>
      <?php the_post_thumbnail('large'); ?>
    <?php else: ?>
      <img src="http://dummyimage.com/300x450/eeeeee/eeeeee.jpg"></img>
    <?php endif; ?>
  </div>
  <footer>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
  </footer>
</article>
