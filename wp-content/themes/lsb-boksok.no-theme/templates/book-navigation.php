<?php if ( have_rows( 'lsb_show_book_navigation_top_level_field' ) ): ?>
  <?php $count = 0; ?>
  <?php while ( have_rows( 'lsb_show_book_navigation_top_level_field') ): the_row(); $count++; ?>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#book-navigation-navbar-collapse-<?php echo $count; ?>">
            <span class="sr-only"><?php _e('Veksle meny', 'lsb_boksok'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php the_sub_field('lsb_show_book_navigation_top_level_url_field'); ?>"><?php the_sub_field('lsb_show_book_navigation_top_level_title_field'); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="book-navigation-navbar-collapse-<?php echo $count; ?>">
          <ul class="nav navbar-nav">
            <?php if ( have_rows( 'lsb_show_book_navigation_sublevel_field' ) ): ?>
              <?php while ( have_rows( 'lsb_show_book_navigation_sublevel_field') ): the_row(); ?>
                <li><a href="<?php the_sub_field('lsb_show_book_navigation_sublevel_url_field'); ?>"><?php the_sub_field('lsb_show_book_navigation_sublevel_title_field'); ?></a></li>
              <?php endwhile; ?>
            <?php endif; ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php endwhile; ?>
<?php endif; ?>
