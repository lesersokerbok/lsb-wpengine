<div class="more panel panel-default">
  <div class="panel-body">
    <ul>
      <?php the_terms($post->ID, 'lsb_tax_series', '<li>'.__('Se flere bøker fra samme serie: '), ', ', '</li>') ?>
      <?php the_terms($post->ID, 'lsb_tax_list', '<li>'.__('Se flere bøker fra samme liste: '), ', ', '</li>') ?>
    </ul>
  </div>
</div>
