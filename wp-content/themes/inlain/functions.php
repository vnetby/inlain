<?php
if ($SITE_SETTINGS['WP_DEBUG']) {
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

require realpath(dirname(__FILE__) . '/../') . '/vnet_theme/include/class-vnet-load.php';
new Vnet_Load;

$vnet = new Vnet_Core;
$vnet->setup();

require THEME_PATH . 'include/class-theme-load.php';

$theme_load = new Theme_Load;
$front = new Vnet_Front;
$about = new About_Company;
