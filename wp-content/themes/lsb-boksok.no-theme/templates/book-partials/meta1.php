<div class="meta panel panel-default">
  <div class="panel-body">
    <ul>
      <?php the_terms($post->ID, 'lsb_tax_author', '<li>'.__('Forfatter: ', 'lsb_boksok'), ',', '</li>') ?>
      <?php the_terms($post->ID, 'lsb_tax_illustrator', '<li>'.__('Illustratør: ', 'lsb_boksok'), ', ', '</li>') ?>
      <?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_topic', '<li>'.__('Tema: ', 'lsb_boksok'), ', ', '</li>') ?>
      <?php the_terms($post->ID, 'lsb_tax_audience', '<li>'.__('Tilpasset ', 'lsb_boksok'), ', ', '</li>') ?>
      <?php the_terms($post->ID, 'lsb_tax_age', '<li>'.__('Boken passer for ', 'lsb_boksok'), ', ', '</li>') ?>
    </ul>
  </div>
</div>
