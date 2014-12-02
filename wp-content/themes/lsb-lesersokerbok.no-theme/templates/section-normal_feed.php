<?php

  $rss = fetch_feed( get_sub_field('section_feed_url') );

  $show_summary = true;
  $show_date = true;
  $show_image = true;
  $items = get_sub_field('section_feed_max_items');

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

  echo '<div class="frontpage-section rss">';
  if(get_sub_field('section_text')) {
    echo '<div class="section-header">';
    echo get_sub_field('section_text');
    echo '</div>';
  }

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

    //Option?
    $desc = wp_html_excerpt( $desc, 360 );

    //Only on normal feed
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

      $summary = '<div class="rss-summary">' . esc_html( $summary ) . '</div>';
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

    $image = '';
    if ( $show_image ) {
      foreach ($item->get_enclosures() as $enclosure) {
        if ($enclosure->link != '' && strpos($enclosure->link, 'gravatar') === false) {
          $image = $enclosure->link;
          break;
        }
      }
    }

    echo '<article class="row rss-post ">';
    echo '<div class="col-md-8">';
    echo '<header>';

    if ( $link == '' ) {
      echo "<h2>$title</h2>";
    } else {
      echo "<h2><a href='$link'>$title</a></h2>";
    }

    if ( $show_date ) {
      echo "{$date}";
    }

    echo '</header>';

    if ( $show_summary ) {
      echo "<p>{$summary}</p>";
    }

    echo '</div>';

    echo '<div class="col-md-4">';
    if ( $show_image && $image) {
      echo '<div class="rss-image">';
      if ( $link == '' ) {
        echo "<img src='{$image}'/>";
      } else {
        echo "<a href='$link'><img src='{$image}'/></a>";
      }
      echo '</div>';
    }
    echo '</div>';

    echo '</article>';

  }

  echo '</div>';

  $rss->__destruct();
  unset($rss);

?>
