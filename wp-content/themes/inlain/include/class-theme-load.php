<?php


class Theme_Load extends Vnet_Core
{

  private $path_inc = THEME_PATH . 'include/';

  private $kino_user;
  private $theme_db;





  function __construct()
  {
    $this->define_constants();
    $this->load_files();

    $this->kino_user = new Kino_User;
    $this->theme_db = new Theme_DB;

    $this->theme_db->create_tables();

    $this->add_vnet_libs();
    $this->add_hooks();
    $this->remove_hooks();
    $this->add_theme_support();

    $this->add_front_vars();
  }






  private function define_constants()
  {
    $this->define('LOADER', THEME_URI . '/assets/images/lazy.gif');
    $this->define('MAIN_PAGE', get_option('page_on_front'));
    $this->define('LOGIN_SECRET', '23423423wfesddsDSASFEewrwer2342342323edewd23r233tg45');
    $this->define('FORCE_CACHE_KEY', 'asdasdqw23123r234f34f3f34f34f');
  }






  private function load_files()
  {
    require $this->path_inc . 'class-kinoclub-front.php';
    require $this->path_inc . 'class-vnet-cache.php';
    require $this->path_inc . 'class-kino-user.php';
    require $this->path_inc . 'class-theme-db.php';
    require $this->path_inc . 'class-kino-update.php';

    require THEME_PATH . 'ajax/comment-karma.php';
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

    if (!$this->kino_user->can_view_content()) {
      add_action('wp_enqueue_scripts', [$this, 'style_theme_auth']);
      add_action('wp_enqueue_scripts', [$this, 'script_theme_auth']);
    } else {
      add_action('wp_enqueue_scripts', [$this, 'style_theme']);
      add_action('wp_enqueue_scripts', [$this, 'script_theme']);
    }

    add_action('after_setup_theme', [$this, 'remove_admin_bar']);

    if (!is_admin()) {
      add_action('init', [$this, 'my_avatar_filter']);
    }

    add_filter('deprecated_function_trigger_error', '__return_false');
    add_filter('script_loader_tag', [$this, 'add_async_attribute'], 10, 2);
  }







  public function remove_admin_bar()
  {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
  }






  private function remove_hooks()
  {
    remove_action('wp_head', 'adjacent_posts_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  }







  private function add_theme_support()
  {
    add_theme_support('post-thumbnails', ['post', 'page', 'post-blog', 'awards-post', 'clients-post', 'reviews-post', 'vacancies-post', 'work-post', 'tech-post', 'services', 'lang-post']);
    add_theme_support('title-tag');
  }





  /**
   * - Стили для не авторизированных пользователей
   */
  public function style_theme_auth()
  {
    // wp_enqueue_style('multi-select', THEME_URI . 'libs/multi-select/main.min.css');
    // wp_enqueue_style('min', THEME_URI . 'css/libs.min.css');
    wp_enqueue_style('auth', THEME_URI . 'css/auth.css');
  }



  /**
   * - Скрипты для не авторизированных пользователей
   */
  public function script_theme_auth()
  {
    wp_enqueue_script('auth', THEME_URI . 'assets/js/auth.js', 'jquery', null, true);
    wp_localize_script('auth', 'ajax_object', [
      'ajaxurl' => admin_url('admin-ajax.php'),
      'redirecturl' => $this->get_from_server('REQUEST_URI'),
    ]);
  }




  /**
   * - Стили для авторизированных пользователей
   */
  public function style_theme()
  {
    wp_enqueue_style('kino-front-main', THEME_URI . 'css/main.css');
    wp_enqueue_style('kino-front-index', THEME_URI . 'css/index.min.css');
  }


  /**
   * - Скрипты для авторизированных пользователей
   */
  public function script_theme()
  {
    wp_enqueue_script('kino-front-index', THEME_URI . 'js/index.min.js', [], null, true);
    // wp_enqueue_script('multi-select', THEME_URI . 'libs/multi-select/main.min.js', [], null, true);
    // wp_enqueue_script('main', THEME_URI . 'js/common.js', 'jquery', null, true);
    // wp_localize_script('ajax', 'ajax_object', [
    //   'ajaxurl' => admin_url('admin-ajax.php'),
    //   'redirecturl' => $_SERVER['REQUEST_URI'],
    // ]);
  }





  public function my_avatar_filter()
  {
    // Remove from show_user_profile hook
    remove_action('show_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
    remove_action('show_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

    // Remove from edit_user_profile hook
    remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
    remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

    // Add to edit_user_avatar hook
    add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_action_show_user_profile'));
    add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_media_upload_scripts'));
  }






  public function register_menu()
  {
    register_nav_menu('main', 'Главное меню');
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
