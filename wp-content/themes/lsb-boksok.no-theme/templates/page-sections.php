<?php

if( have_rows('lsb_page_sections', get_queried_object()) ) {

  while( have_rows('lsb_page_sections', get_queried_object()) ) {
    the_row();
    get_template_part('templates/page-section-'.get_sub_field('lsb_page_section_type' ) );
  }

}
