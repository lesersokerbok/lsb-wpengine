<?php

if( have_rows('lsb_page_sections') ) {

  while( have_rows('lsb_page_sections') ) {
    the_row();

    get_template_part('templates/main-section-'.get_sub_field('lsb_page_section_type' ) );
  }
}
