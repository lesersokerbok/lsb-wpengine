<header class="banner navbar navbar-static-top" role="banner">
  <div class="container">

    <div class="navbar-header">
      <ul class="nav navbar-nav pull-left">
        <li>
          <a class="navbar-nav-brand" href="<?php echo home_url(); ?>/">
            <?php bloginfo( 'name' ) ?>
          </a>
        </li>
      </ul>
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'pull-right nav navbar-nav'));
        endif;
      ?>
    </nav>

  </div>
</header>
