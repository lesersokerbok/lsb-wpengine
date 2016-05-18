<header class="banner navbar navbar-static-top" role="banner">
  <div class="container">

    <div class="navbar-header">
      <ul class="nav navbar-nav pull-left">
        <li>
          <a class="navbar-nav-brand" href="<?php echo home_url(); ?>/">
            <?php bloginfo( 'name' ) ?>
						<svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 283.5">
							<path class="fill" d="M111.2 141.7c0-16.9 13.7-30.6 30.6-30.6 16.9 0 30.6 13.7 30.6 30.6 0 16.9-13.7 30.6-30.6 30.6C124.9 172.3 111.2 158.6 111.2 141.7z"/>
							<path class="fill" d="M238.5 155c-6.5 47.7-47.3 84.4-96.7 84.4 -49.4 0-90.3-36.7-96.7-84.4H14.2c6.6 64.6 61.2 115 127.6 115 66.4 0 120.9-50.4 127.6-115H238.5z"/>
							<path class="fill" d="M45 128.5c6.5-47.7 47.3-84.4 96.7-84.4 49.4 0 90.3 36.7 96.7 84.4h30.8c-6.6-64.6-61.2-115-127.6-115 -66.4 0-120.9 50.4-127.6 115H45z"/>
						</svg>
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
