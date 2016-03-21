<?php if (has_post_thumbnail()): ?>
<div class="cover content-part">
  <?php if ( get_field('lsb_look_inside')): ?>
    <a class="thumbnail look-inside" href="<?php the_field('lsb_look_inside'); ?>" target="_blank">
      <?php the_post_thumbnail('large', array('class' => 'look-inside')); ?>
    </a>
  <?php else : ?>
    <div class="thumbnail"><?php the_post_thumbnail('large'); ?></div>
  <?php endif; ?>
</div>
<?php endif; ?>
