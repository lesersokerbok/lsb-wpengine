<?php

  $rss = fetch_feed( get_sub_field('section_feed_url') );

  // These options could be managed from section if we want
  $show_summary = true;
  $show_date = true;
  $show_image = true;
  $items = 3;

  if ( is_wp_error($rss) ) {
    if ( is_admin() || current_user_can('manage_options') )
      echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
    return;
  }

  $items = (int) $items;
  if ( $items < 1 || 20 < $items )
    $items = 10;

  if ( !$rss->get_item_quantity() ) {
    echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
    $rss->__destruct();
    unset($rss);
    return;
  }

  echo '<h1>' . get_sub_field("section_feed_header") . '</h1>';
  echo '<div class="row">';

  foreach ( $rss->get_items(0, $items) as $item ) {
    $link = $item->get_link();
    while ( stristr($link, 'http') != $link )
      $link = substr($link, 1);
    $link = esc_url(strip_tags($link));
    $title = esc_attr(strip_tags($item->get_title()));
    if ( empty($title) )
      $title = __('Untitled');

    $desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
    $desc = esc_attr( strip_tags( $desc ) );
    $desc = trim( str_replace( array( "\n", "\r" ), ' ', $desc ) );
    $desc = wp_html_excerpt( $desc, 360 );
    $desc = trim( str_replace( "Les videre →", '', $desc) );

    $summary = '';
    if ( $show_summary && !empty($desc) ) {
      $summary = $desc;

      // Append ellipsis. Change existing [...] to [&hellip;].
      if ( '[...]' == substr( $summary, -5 ) ) {
        $summary = substr( $summary, 0, -5 ) . '[&hellip;]';
      } elseif ( '[&hellip;]' != substr( $summary, -10 ) && $desc !== $summary ) {
        $summary .= ' [&hellip;]';
      }

      $summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
    } else {
      $show_summary = false;
    }

    $date = '';
    if ( $show_date ) {
      $date = $item->get_date( 'U' );

      if ( $date ) {
        $date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
      }
    }

    $image = 'http://placehold.it/350x150';
    if ( $show_image && get_sub_field('section_type') === 'normal_feed') {
      foreach ($item->get_enclosures() as $enclosure) {
        if ($enclosure->link != '' && strpos($enclosure->link, 'gravatar') === false) {
          $image = $enclosure->link;
          break;
        }
      }
    } else if ( $show_image && get_sub_field('section_type') === 'lsb_book_feed') {
      $doc = new DOMDocument();
      $doc->loadHTML($item->get_description());
      $xpath = new DOMXPath($doc);
      $image = $xpath->evaluate("string(//img/@src)");
    }

    echo "<div class='col-md-4'>";

    if ( $link == '' ) {
      echo "<h2>$title</h2>";
    } else {
      echo "<h2><a class='rsswidget' href='$link'>$title</a></h2>";
    }

    if ( $show_date ) {
      echo "<p>{$date}</p>";
    }

    if ( $show_image ) {
      echo "<p><img src='{$image}'/></p>";
    }

    if ( $show_summary ) {
      echo "<p>{$summary}</p>";
    }

    echo '</div>';
  }

  echo '</div>';

  $rss->__destruct();
  unset($rss);

?>
