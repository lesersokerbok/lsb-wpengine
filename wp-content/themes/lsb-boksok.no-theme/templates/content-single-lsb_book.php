
<article <?php post_class('full'); ?>>

  <header class="page-header">

    <h1>
      <?php echo roots_title(); ?>
      <small>
        <?php the_terms($post->ID, 'lsb_tax_author', ' | ', ', ') ?>
      </small>
    </h1>
    <p>
      <?php the_terms($post->ID, 'lsb_tax_illustrator', __('Illustratør: ', 'lsb_boksok'), ', ', ' | ') ?>
      <?php the_terms($post->ID, 'lsb_tax_translator', __('Oversetter: ', 'lsb_boksok'), ', ', ' | ') ?>
      <?php the_terms($post->ID, 'lsb_tax_publisher', __('Forlag: ', 'lsb_boksok'), ', ', ' | ') ?>

      <?php if( get_field( "lsb_isbn" ) ): ?>
        <?php echo __('ISBN: ', 'lsb_boksok'); ?>
        <?php the_field( "lsb_isbn" ); ?> |
      <?php endif; ?>

      <?php if( get_field( "lsb_published_year" ) ): ?>
        <?php echo __('Utgitt: ', 'lsb_boksok');?>
        <?php the_field( "lsb_published_year" ); ?>
      <?php endif; ?>
    </p>

  </header>

  <div class="entry-content">

    <div class="row">
      <div class="col-lg-8 col-sm-6">
        <div class="row">
          <div class="col-lg-6">

            <div class="panel panel-default">
              <div class="panel-heading"><?php echo __('Om boka', 'lsb_boksok'); ?></div>
              <div class="panel-body">
                <?php the_excerpt(); ?>
                <?php the_field('lsb_review'); ?>
              </div>
            </div>

          </div>
          <div class="col-lg-6">
            <?php if ( has_post_thumbnail() && get_field('lsb_look_inside')): ?>
              <a class="thumbnail look-inside" href="<?php the_field('lsb_look_inside'); ?>" target="_blank"><?php the_post_thumbnail('large', array('class' => 'look-inside')); ?></a>
            <?php elseif (has_post_thumbnail()): ?>
              <div class="thumbnail"><?php the_post_thumbnail('large'); ?></div>
            <?php else: ?>
              <div class="thumbnail"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/img/book-cover.jpg"></img></div>
            <?php endif; ?>
            <?php if ( get_field('lsb_look_inside')): ?>
              <a href="<?php the_field('lsb_look_inside'); ?>" class="btn btn-primary btn-block" role="button">
                <?php _e('Bla i boken', 'lsb_boksok'); ?>
              </a>
            <?php endif; ?>
            <?php if ( get_field('lsb_boksok_option_page_for_library_loan', 'option')): ?>
              <a href="<?php the_field('lsb_boksok_option_page_for_library_loan', 'option'); ?>" class="btn btn-default btn-block" role="button">
                <?php _e('Lån boken', 'lsb_boksok'); ?>
              </a>
            <?php endif; ?>
            <?php if ( get_field('lsb_boksok_option_page_for_buying_book', 'option')): ?>
              <a href="<?php the_field('lsb_boksok_option_page_for_buying_book', 'option'); ?>" class="btn btn-default btn-block" role="button">
                <?php _e('Kjøp boken', 'lsb_boksok'); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">

        <?php if ( get_field('lsb_supported')): ?>
          <div class="panel panel-default">
            <div class="panel-body lsb-supported <?php the_field('lsb_support_cat') ?>">
              <?php echo __('Boken er støttet av Leser søker bok', 'lsb_boksok'); ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="panel panel-default">
          <div class="panel-body">
            <?php the_terms($post->ID, 'lsb_tax_lsb_cat', __('Hovedkategori: ', 'lsb_boksok'), ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_age', __('Alder: ', 'lsb_boksok'), ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_audience', __('Tilpasset: ', 'lsb_boksok'), ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_genre', __('Sjanger: ', 'lsb_boksok'), ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'tax_lsb_language', __('Språk: ', 'lsb_boksok'), ', ', '<br/>') ?>
            <?php the_terms($post->ID, 'lsb_tax_topic', __('Tema: ', 'lsb_boksok'), ', ', '<br/>') ?>
            
            <?php if(has_term('', 'lsb_tax_series') || has_term('', 'lsb_tax_list')): ?>
              En del av: 
              <?php if(has_term('', 'lsb_tax_series')): ?>
                <?php the_terms($post->ID, 'lsb_tax_list', '', ', ', ',') ?>
              <?php else: ?>
                <?php the_terms($post->ID, 'lsb_tax_list', '', ', ', '<br/>') ?>
              <?php endif; ?>
              <?php the_terms($post->ID, 'lsb_tax_series', '', ', ', '<br/>') ?>
            <?php endif; ?>

            <?php if( get_field( "lsb_pages" ) ): ?>
              <?php echo __('Antall sider: ', 'lsb_boksok'); ?>
              <?php the_field( "lsb_pages" ); ?><br/>
            <?php endif; ?>
          </div>
        </div>

        <?php if(get_field('lsb_quote')): ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <?php echo __('Utdrag fra boka', 'lsb_boksok'); ?>
          </div>
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
