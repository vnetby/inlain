<?php
require realpath(dirname(__FILE__) . '/../') . '/vnet_theme/include/class-vnet-load.php';
new Vnet_Load;

$vnet = new Vnet_Core;
$vnet->setup();

require THEME_PATH . 'include/class-theme-load.php';

$theme_load = new Theme_Load;
