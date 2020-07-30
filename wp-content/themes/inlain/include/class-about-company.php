<?php





class About_Company extends Vnet_Core
{


  private $info;


  private $post_id = 35;








  public function get_logo()
  {
    $logo = $this->get_info('logo');
    if (!$logo) return;

    if ($logo['img']) {
      return '<img src="' . $logo['img']['url'] . '" class="logo-img">';
    }

    if ($logo['text']) {
      return '<div class="logo-text">' . $logo['text'] . '</div>';
    }

    return false;
  }





  public function get_signature()
  {
    return $this->get_info('footer_sign');
  }








  private function set_info()
  {
    if ($this->info) return;
    $this->info = get_field('about-company', $this->post_id);
  }





  private function get_info($key)
  {
    $this->set_info();
    return $this->get_from_array($this->info, $key);
  }
}
