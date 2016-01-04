<?php if(get_sub_field('section_text') || get_sub_field('section_video') ) : ?>
  <div class="jumbotron">
    <?php if(get_sub_field('section_text') && get_sub_field('section_video') ) : ?>
      <div class="row">
        <div class="col-md-6 col-md-push-6 ">
          <?php the_sub_field('section_text'); ?>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <?php the_sub_field('section_video'); ?>
        </div>
      </div>
    <?php else : ?>
      <?php the_sub_field('section_video'); ?>
      <?php the_sub_field('section_text'); ?>
    <?php endif; ?>
  </div>
<?php endif; ?>