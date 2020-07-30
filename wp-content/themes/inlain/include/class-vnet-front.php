<?php



class Vnet_Front extends Vnet_Core
{


  private $about_info = false;





  public function the_page_template()
  {
    global $post;

    $layout = get_field('page_block_template', $post->ID);
    if (!is_array($layout)) return;

    foreach ($layout as &$item) {
      $key = $this->get_from_array($item, 'acf_fc_layout');
      ob_start();
      if ($key === 'template_block') {
        $this->require_block_template($item);
      } else {
        $this->require_template($item);
      }
      $content = ob_get_clean();
      if ($key === 'template_block') {
        $id = $this->get_block_id($this->get_from_array($item, 'block'));
        $fileName = 'block-' . $id;
      } else {
        $id = $post->ID;
        $fileName = 'layout-' . $this->get_from_array($item, 'acf_fc_layout');
      }
      echo $this->set_section_admin_info($content, $key, $id, $fileName);
    }
  }










  private function set_section_admin_info($content, $blockKey, $id, $fileName)
  {
    if (!is_user_logged_in()) return preg_replace("/data-admin/", "", $content);

    $data = 'data-edit-link="/wp-admin/post.php?post=' . $id . '&action=edit"';
    if ($blockKey === 'template_block') {
      $data .= ' data-section-type="block" data-file="' . $fileName . '"';
    } else {
      $data .= ' data-section-type="layout" data-file="' . $fileName . '"';
    }

    $content = preg_replace("/data-admin/", $data, $content);
    return $content;
  }









  private function require_block_template(&$item)
  {
    global $vnet;

    $name = $this->get_from_array($item, 'block');
    $id = (int)$this->get_block_id($name);

    $block = get_field('block', $id);

    $vnet->get_template('block-' . $id, $block);
  }










  private function get_block_id($name)
  {
    return (int) preg_replace("/block_/", "", $name);
  }








  private function require_template(&$item)
  {
    global $vnet;
    $file = 'layout-' . $this->get_from_array($item, 'acf_fc_layout');
    $vnet->get_template($file, $item);
  }






  public function youtube_to_iframe($link)
  {
    return preg_replace(
      "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "//www.youtube.com/embed/$2",
      $link
    );
  }




  public function get_youtube_id($url)
  {
    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
    return $my_array_of_vars['v'];
  }





  public function get_about_info()
  {
    if ($this->about_info) return $this->about_info;
  }
}
