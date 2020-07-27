<?php


class Theme_Load extends Vnet_Core
{

  private $path_inc = THEME_PATH . 'include/';




  function __construct()
  {
    $this->define_constants();
    $this->load_files();

    $this->add_vnet_libs();
    $this->add_hooks();
    $this->remove_hooks();
    $this->add_theme_support();

    $this->add_front_vars();
  }






  private function define_constants()
  {
  }






  private function load_files()
  {
  }







  private function add_vnet_libs()
  {
    global $vnet;

    $vnet->add_lib('slick');
    $vnet->add_lib('fancybox');
    $vnet->add_lib('multi-select');
    $vnet->add_lib('animate-css');
  }





  private function add_hooks()
  {
    add_action('after_setup_theme', [$this, 'register_menu']);
    add_action('after_setup_theme', [$this, 'register_text_domain']);

    add_action('wp_enqueue_scripts', [$this, 'style_theme']);
    add_action('wp_enqueue_scripts', [$this, 'script_theme']);

    add_filter('script_loader_tag', [$this, 'add_async_attribute'], 10, 2);
  }









  private function remove_hooks()
  {
  }







  private function add_theme_support()
  {
    add_theme_support('post-thumbnails', ['post', 'page', 'post-blog', 'awards-post', 'clients-post', 'reviews-post', 'vacancies-post', 'work-post', 'tech-post', 'services', 'lang-post']);
    add_theme_support('title-tag');
  }






  public function style_theme()
  {
    wp_enqueue_style('index', THEME_URI . 'css/index.min.css');
  }





  public function script_theme()
  {
    wp_enqueue_script('kino-front-index', THEME_URI . 'js/index.min.js', [], null, true);
  }








  public function register_menu()
  {
    register_nav_menu('main', 'Главное меню');
  }







  public function register_text_domain()
  {
    load_theme_textdomain('inlain', THEME_PATH . 'languages');
  }






  public function add_async_attribute($tag, $handle)
  {
    if (!is_admin()) {
      if ('jquery-core' == $handle) {
        return $tag;
      }
      return str_replace(' src', ' defer src', $tag);
    } else {
      return $tag;
    }
  }






  private function add_front_vars()
  {
    global $vnet;

    $vnet->set_js_var('validateMsg', [
      'invalidExtension' => 'недопустимый формат файла',
      'required' => 'Заполните поле',
      'checkboxRequired' => 'Выберите значение',
      'invalidEmail' => 'Неверный формат e-mail',
      'invlidCompare' => 'Значения не совпадают',
      'imgFormat' => 'Выберите изображение',
      'maxFileSize' => 'Макимальный размер фала: $1мб', // $1 - max file size
      'minLength' => 'Минимальное количество символов: $1' // $1 - min number
    ]);
  }
}
