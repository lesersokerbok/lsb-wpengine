
<article <?php post_class('full'); ?>>

  <header class="page-header">
    <h1>
      <?php echo roots_title(); ?>
    </h1>
  </header>

  <div class="entry-content">
    <div class="meta">
      <ul>
        <?php the_terms($post->ID, 'lsb_tax_author', '<li>'.__('Forfatter: ', 'lsb_boksok'), ',', '</li>') ?>
        <?php the_terms($post->ID, 'lsb_tax_illustrator', '<li>'.__('Illustratør: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_topic', '<li>'.__('Tema: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php the_terms($post->ID, 'lsb_tax_audience', '<li>'.__('Tilpasset ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php the_terms($post->ID, 'lsb_tax_age', '<li>'.__('Boken passer for ', 'lsb_boksok'), ', ', '</li>') ?>
      </ul>
    </div>

    <?php if (has_post_thumbnail()): ?>
    <div>
      <?php if ( get_field('lsb_look_inside')): ?>
        <a class="thumbnail look-inside" href="<?php the_field('lsb_look_inside'); ?>" target="_blank">
          <?php the_post_thumbnail('large', array('class' => 'look-inside')); ?>
        </a>    
      <?php else : ?>
        <div class="thumbnail"><?php the_post_thumbnail('large'); ?></div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="review">
      <h2><?php _e('Om boka', 'lsb_boksok'); ?></h2>
      <?php the_excerpt(); ?>
      <?php the_field('lsb_review'); ?>
    </div>

    <?php if( get_field( 'lsb_quote' ) ): ?>
    <div class="quote">
      <h2><?php _e('Utdrag fra boka', 'lsb_boksok'); ?></h2>
      <?php the_field('lsb_quote'); ?>
    </div>
    <?php endif; ?> 

    <div class="more">
      <ul>
        <?php the_terms($post->ID, 'lsb_tax_series', '<li>'.__('Se flere bøker fra samme serie: '), ', ', '</li>') ?>
        <?php the_terms($post->ID, 'lsb_tax_list', '<li>'.__('Se flere bøker fra samme liste: '), ', ', '</li>') ?>
      </ul>
    </div>

    <div class="tax-navigation">
      <?php TaxonomyUtil::the_taxonomy_navigation_menu( array('lsb_tax_topic', 'lsb_tax_genre'), array('selected_only' => false, 'icons_only' => true) ) ?>
    </div>

    <div class="meta">
      <ul>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_genre', '<li>'.__('Sjanger: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_publisher', '<li>'.__('Forlag: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_translator', '<li>'.__('Oversetter: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_lsb_cat', '<li>'.__('Hovedkategori: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php if( get_field( "lsb_published_year" ) ): ?>
        <li>
          <?php _e('Utgitt: ', 'lsb_boksok');?>
          <?php the_field( "lsb_published_year" ); ?>
        </li>
        <?php endif; ?>
        <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_language', '<li>'.__('Hovedkategori: ', 'lsb_boksok'), ', ', '</li>') ?>
        <?php if( get_field( 'lsb_pages' ) ): ?>
        <li>
          <?php echo __('Antall sider: ', 'lsb_boksok'); ?>
          <?php the_field( "lsb_pages" ); ?><br/>
        </li>
        <?php endif; ?>
        <?php if( get_field( "lsb_isbn" ) ): ?>
        <li>
          <?php _e('ISBN: ', 'lsb_boksok'); ?>
          <?php the_field( "lsb_isbn" ); ?>
        </li>
        <?php endif; ?>
      </ul>
    </div>

    <?php if ( get_field('lsb_supported')): ?>
      <div class="lsb-supported">    
        <p class="lsb-supported <?php the_field('lsb_support_cat') ?>">
          <?php echo __('Boken er støttet av Leser søker bok', 'lsb_boksok'); ?>
        </p>
      </div>
    <?php endif; ?>
  </div>
</article>