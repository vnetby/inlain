<?php

class Acf_Blocks extends Vnet_Core
{


  function __construct()
  {
    $this->define('EXTENSION_ACF_BLOCKS', true);
  }






  static function can_load()
  {
    if (!defined('ACF')) {
      if (!is_admin() && defined('WP_DEBUG')) {
        if (WP_DEBUG) {
          echo '<p style="color: red"><strong>Acf_Blocks: active advanced custom fields</strong></p>';
        }
      }
      return false;
    }
    return true;
  }





  public function get_page_template()
  {
  }
}


if (!Acf_Blocks::can_load()) return;

$acf_blocks = new Acf_Blocks;
