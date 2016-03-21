<?php if ( get_field('lsb_supported')): ?>
  <div class="lsb-supported panel panel-default">
    <div class="panel-body">
      <p class="lsb-supported <?php the_field('lsb_support_cat') ?>">
        <?php echo __('Boken er støttet av Leser søker bok', 'lsb_boksok'); ?>
      </p>
    </div>
  </div>
<?php endif; ?>
