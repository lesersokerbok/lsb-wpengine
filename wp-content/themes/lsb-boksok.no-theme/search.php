<?php get_template_part('templates/page', 'header'); ?>

<?php 

$lsb_cat_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat'));
$lsb_cat_query_var_array = explode(',', $lsb_cat_query_var);
if(!$lsb_cat_query_var)
   $lsb_cat_query_var_array = array();
$lsb_cat_names = TaxonomyUtil::get_names_from_slugs($lsb_cat_query_var_array, 'lsb_tax_lsb_cat');

$age_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_age'));
$age_query_var_array = explode(',', $age_query_var);
if(!$age_query_var)
   $age_query_var_array = array();
$age_names = TaxonomyUtil::get_names_from_slugs($age_query_var_array, 'lsb_tax_age');

$audience_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_audience'));
$audience_query_var_array = explode(',', $audience_query_var);
if(!$audience_query_var)
   $audience_query_var_array = array();
$audience_names = TaxonomyUtil::get_names_from_slugs($audience_query_var_array, 'lsb_tax_audience');

function format_names($names, $binding_word, $capitalize) {
    $formatted_names = "";
    $count = count($names);
    for ($i = 0; $i < $count; $i++) {
      $name = $names[$i];
      if($capitalize)
        $name = ucfirst($name);
      
      if($i == $count-1)
        $formatted_names = $formatted_names.$name;
      elseif ($i == $count-2)
        $formatted_names = $formatted_names.$name." ".$binding_word." ";
      else
        $formatted_names = $formatted_names.$name.", ";
    }
    
    return $formatted_names;
}

?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Beklager, ingen søkeresultater.', 'lsb'); ?>
  </div>
  <?php get_search_form(); ?>
<?php elseif($lsb_cat_query_var || $age_query_var || $audience_query_var) : ?>
  <p class="alert alert-info">
    <?php if($lsb_cat_query_var && ($age_query_var || $audience_query_var)) : ?>
      Viser kun resultater i <?php echo format_names($lsb_cat_names, "og", true) ?> som passer for <?php echo format_names(array_merge($age_names, $audience_names), "eller", false) ?>.
    
    <?php elseif($lsb_cat_query_var) : ?>
      Viser kun resultater i <?php echo format_names($lsb_cat_names, "og", true) ?>.
    
    <?php elseif($age_query_var || $audience_query_var) : ?>
      Viser kun resultater som passer for <?php echo format_names(array_merge($age_names, $audience_names), "eller", false) ?>.
    
    <?php endif; ?>
    
    Søk etter "<?php echo get_search_query()?>"
    <a href="/?s=<?php echo get_search_query()?>">
       i alle bøker.
    </a>
  </p>
<?php endif; ?>

<section class="loop">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content-summary', get_post_type()); ?>
<?php endwhile; ?>
</section>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php roots_pagination(); ?>
  </nav>
<?php endif; ?>

<?php
  global $wp_query;
  $total_results = $wp_query->found_posts;
  $search_query = $wp_query->query_vars['s'];
?>
