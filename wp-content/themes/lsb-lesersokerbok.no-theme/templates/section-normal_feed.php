<?php

$feed_url = get_sub_field('section_feed_url');
$rss = fetch_feed( $feed_url );

?>

<?php if ( ! is_wp_error( $rss ) && $rss->get_item_quantity()) : ?>


  <?php if(get_sub_field('section_heading')): ?>
    <div class="section-header">
      <h2>
        <a href="<?php the_sub_field('section_feed_link') ?>"><?php the_sub_field('section_heading'); ?></a>
        <?php if(get_sub_field('section_subheading')): ?>
        <small> | <a href="<?php the_sub_field('section_feed_link') ?>"><?php the_sub_field('section_subheading'); ?></a></small>
        <?php endif; ?>
      </h2>
    </div>
  <?php endif; ?>

  <?php foreach ( $rss->get_items(0, get_sub_field('section_feed_max_items')) as $item ) : ?>
    <article class="row rss-post">
      <div class="col-sm-8">
        <header>
          <h3>
            <a <?php echo !LsbFeedUtil::is_feed_item_permalink_same_domain_as_site_domain($item) ? 'target="_blank"' : '' ?>
               href="<?php echo esc_url( $item->get_permalink() ); ?>"><?php echo esc_html( $item->get_title() ); ?></a>
          </h3>
          <p class="rss-meta">
            <span class="rss-date"><?php echo date_i18n( get_option( 'date_format' ), $item->get_date( 'U' ) ); ?></span>
          </p>
        </header>
        <div class="rss-summary">
          <?php echo LsbFeedUtil::get_excerpt_from_feed_item($item); ?>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="rss-image">
          <?php $image = LsbFeedUtil::get_image_from_feed_item($item); ?>
          <?php if( $image) : ?>
            <a <?php echo !LsbFeedUtil::is_feed_item_permalink_same_domain_as_site_domain($item) ? 'target="_blank"' : '' ?>
               href="<?php echo esc_url( $item->get_permalink() ); ?>">
              <img src="<?php echo esc_url( $image ); ?>" />
            </a>
          <?php endif; ?>
        </div>
      </div>
    </article>
  <?php endforeach; ?>

<?php else : ?>

  <?php if(current_user_can('manage_options')) : ?>
    <div class="alert alert-warning">
      <?php LsbFeedUtil::print_error_message($feed_url, $rss) ?>
    </div>
  <?php endif; ?>

<?php endif; ?>
