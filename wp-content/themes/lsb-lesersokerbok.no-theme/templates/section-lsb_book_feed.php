  <?php

  $rss = fetch_feed( get_sub_field('section_feed_url') );

  if ( is_wp_error($rss) ) {
    if ( is_admin() || current_user_can('manage_options') )
      echo '<div class="alert alert-warning">' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</div>';
    return;
  }

  if ( !$rss->get_item_quantity() ) {
    echo '<div class="alert alert-warning">' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</div>';
    $rss->__destruct();
    unset($rss);
    return;
  }

  ?>

  <div class="frontpage-section rss">
    <?php if(get_sub_field('section_text')): ?>
      <div class="section-header">
        <?php the_sub_field('section_text'); ?>
      </div>
    <?php endif; ?>

    <div class="book-section">

      <div class="book-section-body">

        <span aria-hidden="true" class="book-section-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
        <span aria-hidden="true" class="book-section-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

        <div class="book-section-scroll">
          <?php

          foreach ( $rss->get_items() as $item ) :

            // Get link
            $link = $item->get_link();
            while ( stristr($link, 'http') != $link )
              $link = substr($link, 1);
            $link = esc_url(strip_tags($link));

            // Get title
            $title = esc_attr(strip_tags($item->get_title()));
            if ( empty($title) )
              $title = __('Untitled');

            // Get image URL from description element
            $doc = new DOMDocument();
            $doc->loadHTML($item->get_description());
            $xpath = new DOMXPath($doc);
            $image = $xpath->evaluate("string(//img/@src)");
            if ( is_a($image, 'DOMNodeList') ) {
              $image = $image->item(0);
            }

          ?>

            <article class="lsb_book type-lsb_book status-publish has-post-thumbnail hentry summary">
              <div class="entry-image">
                <a class="thumbnail" href="<?php echo $link; ?>">
                  <?php if ( $image != '' ) : ?>
                    <img class="attachment-medium wp-post-image" height="300" width="200" src='<?php echo $image; ?>'/>
                  <?php else : ?>
                    <div class="missing-cover"></div>
                  <?php endif; ?>
                </a>
              </div>
              <header>
                <h2 class="entry-title"><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
              </h2>
            </article>

          <?php

          endforeach;

          $rss->__destruct();
          unset($rss);

          ?>

        </div>

      </div>

    </div>

  </div>
