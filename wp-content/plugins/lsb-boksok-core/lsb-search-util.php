<?php

class LsbSearchUtil {

  public static function format_string_array($string_array, $delimiter, $binding_word, $capitalize) {
    $formatted_string = "";
    $count = count($string_array);
    for ($i = 0; $i < $count; $i++) {
      $string = $string_array[$i];
      if($capitalize)
        $string = ucfirst($string);

      if($i == $count-1)
        $formatted_string = $formatted_string.$string;
      elseif ($i == $count-2)
        $formatted_string = $formatted_string.$string." ".$binding_word." ";
      else
        $formatted_string = $formatted_string.$string."".$delimiter." ";
    }

    return $formatted_string;
  }

  public static function alert_text() {
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    $tax_names_array_dict = array();

    foreach ($lsb_book_tax_objects as $tax_object) {
      $query_var = TaxonomyUtil::get_tax_object_rewrite_slug($tax_object);
      $taxonomy = $tax_object->name;
      $tax_slugs_string = get_query_var($query_var);
      if($tax_slugs_string) {
        $tax_names_array = TaxonomyUtil::get_terms_name_array_from_slugs_array(explode(",", $tax_slugs_string), $taxonomy);
        $tax_names_array_dict[$taxonomy] = $tax_names_array;
      } else {
        $tax_names_array_dict[$taxonomy] = array();
      }
    }

    $alert_text = null;

    if($tax_names_array_dict['lsb_tax_lsb_cat']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_lsb_cat'], ",", "og", true);
      $alert_text = $alert_text."i ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_age'] || $tax_names_array_dict['lsb_tax_audience']) {
      $names_string = self::format_string_array(array_merge($tax_names_array_dict['lsb_tax_age'], $tax_names_array_dict['lsb_tax_audience']), ",", "eller", false);
      $alert_text = $alert_text." som passer for ".$names_string;
    }

    $more_filters_text_array = array();

    if($tax_names_array_dict['lsb_tax_author']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_author'], ",", "eller", false);
      $more_filters_text_array[] = "skrevet av ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_illustrator']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_illustrator'], ",", "eller", false);
      $more_filters_text_array[] = "illusterert av ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_translator']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_translator'], ",", "eller", false);
      $more_filters_text_array[] = "oversatt av ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_publisher']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_publisher'], ",", "eller", false);
      $more_filters_text_array[] = "gitt ut av ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_genre']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_genre'], ",", "eller", false);
      $more_filters_text_array[] = "med sjanger ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_customization'] || $tax_names_array_dict['lsb_tax_topic']) {
      $names_string = self::format_string_array(array_merge($tax_names_array_dict['lsb_tax_customization'], $tax_names_array_dict['lsb_tax_topic']), ",", "eller", false);
      $more_filters_text_array[] = "merket med ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_language']) {
      $names_string = self::format_string_array($tax_names_array_dict['lsb_tax_language'], ",", "eller", false);
      $more_filters_text_array[] = "skrevet på ".$names_string;
    }

    if($tax_names_array_dict['lsb_tax_list'] || $tax_names_array_dict['lsb_tax_series']) {
      $names_string = self::format_string_array(array_merge($tax_names_array_dict['lsb_tax_list'], $tax_names_array_dict['lsb_tax_series']), ",", "eller", false);
      $more_filters_text_array[] = "som er en del av ".$names_string;
    }

    if(count($more_filters_text_array) > 0)
      $alert_text = $alert_text." ".self::format_string_array($more_filters_text_array, ";", "og", false);

    if($alert_text)
      $alert_text = $alert_text.".";

    return $alert_text;
  }

  public static function activate_cat_menu_item($classes) {

    $classes_string = implode($classes);
    $lsb_cat_slugs_string = get_query_var(TaxonomyUtil::get_tax_rewrite_slug('lsb_tax_lsb_cat'));
    $lsb_cat_slug_array = explode(",", $lsb_cat_slugs_string);

    foreach($lsb_cat_slug_array as $term) {
      if ($term && (strpos($classes_string, $term) !== false)) {
        $classes[] = 'active';
      }
    }

    $classes = array_unique($classes);

    return $classes;
  }

  public static function books_matching_current_query_vars() {

    $args = array(
      'post_type' => 'lsb_book',
      'tax_query' => LsbFilterQueryUtil::tax_query_built_from_query_vars(),
      'fields' => 'ids',
      'nopaging' => true
    );

    $ids = get_posts( $args );

    if(count($ids) == 0) {
      global $searchwp_filter_no_results;
      $searchwp_filter_no_results = true;
    }

    return $ids;
  }

}

?>
