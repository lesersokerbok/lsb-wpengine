<?php
/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 *
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
 * add_theme_support('soil-nice-search');
 */
function soil_nice_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {

    $search_string = urlencode(get_query_var('s'));

    global $wp_query;
    $query_vars = $wp_query->query;

    if (count($query_vars) > 1) {
      $search_string .= '#!/';
      foreach ($query_vars as $key => $value) {
        if ($key != 's') {
          $key = str_replace("_tax_", "_facet_", $key);
          $search_string .= $key . '=' . $value . '&';
        }
      }
      $search_string = rtrim($search_string, "&");
    }

    wp_redirect(home_url("/{$search_base}/" . $search_string));

    exit();
  }
}
add_action('template_redirect', 'soil_nice_search_redirect');
