<?php
global $front;

get_header();

while (have_posts()) {
  the_post();
  $front->the_page_template();
}

get_footer();
