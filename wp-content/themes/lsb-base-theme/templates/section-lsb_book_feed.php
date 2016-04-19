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

  <div class="book-shelf">

    <div class="book-shelf-body">

      <span aria-hidden="true" class="book-shelf-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
      <span aria-hidden="true" class="book-shelf-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

      <div class="book-shelf-scroll">

        <?php foreach ( $rss->get_items() as $item ) : ?>

          <?php $image = LsbFeedUtil::get_image_from_feed_item($item) ?>

          <article class="lsb_book type-lsb_book status-publish has-post-thumbnail hentry summary">
            <div class="entry-image">
              <a class="thumbnail" href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">
                <?php if ( $image ) : ?>
                  <img class="attachment-medium wp-post-image" height="300" width="200" src='<?php echo $image; ?>'/>
                <?php else : ?>
                  <div class="missing-cover"></div>
                <?php endif; ?>
              </a>
            </div>
            <header>
              <h2 class="entry-title"><a href="<?php echo $link; ?>" target="_blank"><?php echo esc_html( $item->get_title() ); ?></a></h2>
            </header>
          </article>

        <?php endforeach; ?>

      </div>

    </div>

  </div>

<?php else : ?>

  <?php if(current_user_can('manage_options')) : ?>
    <div class="alert alert-warning">
      <?php LsbFeedUtil::print_error_message($feed_url, $rss) ?>
    </div>
  <?php endif; ?>

<?php endif; ?>
