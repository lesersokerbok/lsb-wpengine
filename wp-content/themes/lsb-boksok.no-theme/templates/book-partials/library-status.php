<?php

$counties = get_post_meta($post->ID, 'lsb_library_status', true);

?>

<?php if( $counties ) : ?>
<div class="content-part library-status">

  <?php foreach( $counties as $county_libraries ) : ?>
  <table class="table">
    <thead>
      <tr><th colspan="2"><?php echo esc_html( $county_libraries[0]['county'] ) ?></th></tr>
    </thead>
    <tbody>
    <?php foreach( $county_libraries as $library ) : ?>
      <tr>
        <td>
          <a href="<?php echo esc_url( $library['url'] ) ?>">
            <?php echo esc_html( $library['name'] ) ?>
          </a>
        </td>
        <td>
          <a class="btn btn-default" target="_blank" href="<?php echo esc_url( $library['book_url'] ) ?>">
            <?php _e('Lån boka', 'lsb'); ?>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php endforeach; ?>
</div>
<?php endif; ?>
