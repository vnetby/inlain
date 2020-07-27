<?php
global $kino_user, $vnet;

$kino_user->check_login();

get_header();

$vnet->get_template('page-home');

get_footer();
