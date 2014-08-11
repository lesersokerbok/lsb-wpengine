<article <?php post_class('full'); ?>>

  <header class="page-header">

    <h1>
      <?php echo roots_title(); ?>
      <small>
        <?php the_terms($post->ID, 'lsb_tax_author', ' | ', ', ') ?>
      </small>
    </h1>
    <p>
      <?php the_terms($post->ID, 'lsb_tax_illustrator', 'Illustratør: ', ', ', ' | ') ?>
      <?php the_terms($post->ID, 'lsb_tax_translator', 'Oversetter: ', ', ', ' | ') ?>
      <?php the_terms($post->ID, 'lsb_tax_publisher', 'Forlag: ', ', ', ' | ') ?>

      <?php if( get_field( "lsb_isbn" ) ): ?>
        ISBN: <?php the_field( "lsb_isbn" ); ?> |
      <?php endif; ?>

      <?php if( get_field( "lsb_published_year" ) ): ?>
        Utgitt: <?php the_field( "lsb_published_year" ); ?>
      <?php endif; ?>
    </p>

  </header>

  <div class="entry-content">

    <div class="row">
      <div class="col-lg-8 col-sm-6">
        <div class="row">
          <div class="col-lg-6">

            <div class="panel panel-default">
              <div class="panel-heading">Anmeldelse</div>
              <div class="panel-body">
                <?php the_field('lsb_review'); ?>
              </div>
            </div>

          </div>
          <div class="col-lg-6">
            <?php if ( has_post_thumbnail() && get_field('lsb_look_inside')): ?>
              <a class="thumbnail" href="<?php the_field('lsb_look_inside'); ?>" target="_blank"><?php the_post_thumbnail('large', array('class' => 'look-inside')); ?></a>
            <?php elseif (has_post_thumbnail()): ?>
              <div class="thumbnail"><?php the_post_thumbnail('large'); ?></div>
            <?php else: ?>
              <img src="http://dummyimage.com/300x450/eeeeee/eeeeee.jpg"></img>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">

        <div class="panel panel-default">
          <div class="panel-body">
            <?php the_terms($post->ID, 'lsb_tax_genre', 'Sjanger: ', ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'tax_lsb_language', 'Språk: ', ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_age', 'Passer for: ', ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_customization', 'Tilpassning: ', ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_topic', 'Tema: ', ', ', '<br/>') ?>

            <?php if( get_field( "lsb_pages" ) ): ?>
              Antall sider: <?php the_field( "lsb_pages" ); ?><br/>
            <?php endif; ?>
          </div>
        </div>

        <?php if(get_field('lsb_quote')): ?>
        <div class="panel panel-default">
          <div class="panel-heading">Utdrag fra boka</div>
          <div class="panel-body">
            <?php the_field('lsb_quote'); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <footer>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
  </footer>
</article>
