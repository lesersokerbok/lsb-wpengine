<?php
/*
Template Name: Boksøk Forsidemal
*/
?>

<div class="page-header">
  <div>
    <header>
      <h1>
        <?php the_title(); ?>
      </h1>
    </header>
    <?php get_search_form(); ?>
  </div>
</div>

<?php
if( have_rows('lsb_page_sections', get_queried_object()) ) {

  while( have_rows('lsb_page_sections', get_queried_object()) ) {
    the_row();
    get_template_part('templates/page-sections/page-section-'.get_sub_field('lsb_page_section_type' ) );
  }

}
?>
