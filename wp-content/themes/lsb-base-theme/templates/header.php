<header class="banner navbar navbar-static-top" role="banner">
  <div class="container-fluid">

    <div class="navbar-header">
      <ul class="nav navbar-nav pull-left">
        <li>
          <a class="navbar-nav-brand" href="<?php echo home_url(); ?>/">
						<?php get_template_part('templates/logo'); ?>
            &nbsp;
          </a>
        </li>
      </ul>

			<ul class="toggle nav navbar-nav pull-right">
				<li>
					<a href="#" class="collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<?php esc_html_e( 'Meny', 'lsb' ); ?>
					</a>
				</li>
			</ul>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'pull-left nav navbar-nav'));
        endif;
      ?>
    </nav>

  </div>
</header>
