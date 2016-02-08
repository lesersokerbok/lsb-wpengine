<?php

if( have_rows('lsb_page_sections') ) {

//  echo '<pre>';
//  var_dump(get_field('lsb_page_sections'));
//  echo '</pre>';

  while( have_rows('lsb_page_sections') ) {
    the_row();

    if( get_sub_field('lsb_page_section_type' ) == 'book_shelf' ) {
      get_template_part('templates/page-section-book-shelf');
    } else {

    }

  }
}
