<?php

/**
 * - Класс для загрузки темы
 */
class Vnet_Load
{

  private $path_theme;
  private $path_inc;



  function __construct()
  {
    $this->path_theme = realpath(dirname(__FILE__) . '/../') . '/';
    $this->path_inc = $this->path_theme . 'include/';
    $this->define_constants();
    $this->load_files();
    $this->add_hooks();
  }






  private function define_constants()
  {
    define('DISALLOW_FILE_EDIT', true);

    define('VNET_URI', '/wp-content/themes/vnet_theme/');
    define('VNET_PATH', ABSPATH . 'wp-content/themes/vnet_theme/');

    define('THEME_URI', get_stylesheet_directory_uri() . '/');
    define('THEME_PATH', get_stylesheet_directory() . '/');
  }







  private function load_files()
  {
    require_once $this->path_inc . 'class-vnet-common.php';
    require_once $this->path_inc . 'class-vnet-core.php';
  }








  private function add_hooks()
  {
    add_action('after_setup_theme', [$this, 'setup_theme']);
    add_action('wp_enqueue_scripts', [$this, 'register_jquery']);
    add_action('admin_head', [$this, 'add_back_dates_var']);
    add_action('wp_head', [$this, 'add_back_dates_var']);

    add_filter('get_avatar_url', [$this, 'change_root_avatar'], 10, 3);
  }









  public function setup_theme()
  {
    add_theme_support('automatic-feed-links');
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
      'top_menu'     => 'Главное меню',
      'foot_menu'    => 'Меню в подвале'
    ]);
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));

    add_theme_support('custom-background', apply_filters('vnet_theme_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    )));

    add_theme_support('customize-selective-refresh-widgets');
  }







  public function register_jquery()
  {
    wp_deregister_script('jquery');
    wp_register_script('jquery', VNET_URI . 'assets/jquery3/jquery3.min.js');
    wp_enqueue_script('jquery');
  }







  public function change_root_avatar($url, $id_or_email, $args)
  {
    if (gettype($id_or_email) === 'string' || gettype($id_or_email) === 'integer') {
      if ($id_or_email == 1) {
        return VNET_URI . 'img/root-avatar.jpg';
      }
    }

    if (gettype($id_or_email) === 'object') {
      if ($id_or_email->user_id == 1) {
        return VNET_URI . 'img/root-avatar.jpg';
      }
    }
    return $url;
  }






  public function add_back_dates_var()
  {
    $user = false;
    if (is_user_logged_in()) {
      $user = wp_get_current_user();
      if ($user) {
        $user = json_encode($user, JSON_UNESCAPED_UNICODE);
      }
    }
?>
    <script>
      window.back_dates = {
        'ajax_url': '<?= admin_url("admin-ajax.php"); ?>'
      };
      <?php
      if ($user) {
      ?>
        window.back_dates.user = JSON.parse('<?= $user; ?>');
      <?php
      }
      ?>
    </script>
<?php
  }
}
