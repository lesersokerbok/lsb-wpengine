<?php

$counties = get_post_meta($post->ID, 'lsb_library_status', true);

?>

<?php if( $counties ) : ?>
<div class="content-part library-status">
  <?php foreach( $counties as $county_libraries ) : ?>
    <?php echo esc_html( $county_libraries[0]['county'] ) ?>
    <ul>
    <?php foreach( $county_libraries as $library ) : ?>
      <li>
        <a href="<?php echo esc_url( $library['url'] ) ?>"><?php echo esc_html( $library['name'] ) ?></a>:
        <?php printf( esc_html(
          _n( '%d eksemplar', '%d eksemplarer', $library['copies'], 'lsb'  ) ), $library['copies'] );
        ?>
        <a href="<?php echo esc_url( $library['book_url'] ) ?>"><?php esc_html_e('(sjekk status)', 'lsb'); ?></a>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endforeach; ?>
</div>
<?php endif; ?>
