<?php
global $kino_user;

$kino_user->check_login();
get_header();

global $vcache, $post;

$vcache->get_template('template-top_slider');

$kino_user->add_view_list($post->ID);

// $vcache->get_single($post->ID, 'single-main_content');
$vnet->get_template('single-main_content');

get_footer();
