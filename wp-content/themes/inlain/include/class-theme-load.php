<?php


class Theme_Load extends Vnet_Core
{

  private $path_inc = THEME_PATH . 'include/';




  function __construct()
  {
    $this->define_constants();
    $this->load_files();

    $this->add_vnet_libs();
    $this->remove_hooks();
    $this->add_hooks();
    $this->add_theme_support();
    // $this->remove_post_type_support();

    $this->add_front_vars();
  }






  private function define_constants()
  {
  }






  private function load_files()
  {
    require_once $this->path_inc . 'class-vnet-front.php';
    require_once $this->path_inc . 'class-about-company.php';
  }







  private function add_vnet_libs()
  {
    global $vnet;

    $vnet->add_lib('slick');
    $vnet->add_lib('fancybox');
    $vnet->add_lib('multi-select');
    $vnet->add_lib('animate-css');
    $vnet->add_lib('intl-tel-input');
    $vnet->add_lib('aos');
  }





  private function add_hooks()
  {
    add_action('after_setup_theme', [$this, 'register_menu']);
    add_action('after_setup_theme', [$this, 'register_text_domain']);
    add_action('after_setup_theme', [$this, 'add_image_size']);
    add_action('after_setup_theme', [$this, 'register_forms_locations']);
    add_action('after_setup_theme', [$this, 'register_post_types']);
    add_action('admin_enqueue_scripts', [$this, 'admin_style']);

    add_action('wp_enqueue_scripts', [$this, 'style_theme']);
    add_action('wp_enqueue_scripts', [$this, 'script_theme']);

    add_action('init', [$this, 'remove_post_type_support']);

    add_filter('script_loader_tag', [$this, 'add_async_attribute'], 10, 2);
    add_filter('image_size_names_choose', [$this, 'set_custom_img_sizes']);
  }









  private function remove_hooks()
  {
  }







  private function add_theme_support()
  {
    add_theme_support('post-thumbnails', ['post', 'page', 'post-blog', 'awards-post', 'clients-post', 'reviews-post', 'vacancies-post', 'work-post', 'tech-post', 'services', 'lang-post']);
    add_theme_support('title-tag');
  }






  public function remove_post_type_support()
  {
    remove_post_type_support('about_company', 'editor');
    remove_post_type_support('about_company', 'title');
    remove_post_type_support('about_company', 'author');
    remove_post_type_support('about_company', 'trackbacks');
    remove_post_type_support('about_company', 'excerpt');
    remove_post_type_support('about_company', 'comments');
    remove_post_type_support('about_company', 'revisions');
    remove_post_type_support('about_company', 'page-attributes');
    remove_post_type_support('about_company', 'post-formats');

    remove_post_type_support('the_blocks', 'editor');
    // remove_post_type_support('the_blocks', 'title');
    remove_post_type_support('the_blocks', 'author');
    remove_post_type_support('the_blocks', 'trackbacks');
    remove_post_type_support('the_blocks', 'excerpt');
    remove_post_type_support('the_blocks', 'comments');
    remove_post_type_support('the_blocks', 'revisions');
    remove_post_type_support('the_blocks', 'page-attributes');
    remove_post_type_support('the_blocks', 'post-formats');
  }







  public function register_forms_locations()
  {
    global $cfextend;

    if ($cfextend) {
      $cfextend->register_form_location('order_test', ['label' => 'Заказать тестирование']);
      $cfextend->register_form_location('order_consulting', ['label' => 'Заказать консультацию']);
    }
  }






  public function add_image_size()
  {
    add_image_size('inlain-video-cover', '780', '440', true);
  }






  public function admin_style()
  {
    wp_enqueue_style('admin-styles', THEME_URI . 'css/admin.css');
  }






  public function set_custom_img_sizes($sizes)
  {
    return array_merge($sizes, [
      'inlain-video-cover' => 'Видео превью'
    ]);
  }






  public function style_theme()
  {
    wp_enqueue_style('index', THEME_URI . 'css/index.min.css');
  }





  public function script_theme()
  {
    wp_enqueue_script('kino-front-index', THEME_URI . 'js/index.min.js', [], null, true);
  }








  public function register_post_types()
  {
    register_post_type('about_company', [
      'labels' => [
        'name'              => 'О компании',
        'singular_name'     => 'О компании',
        'edit_item'         => 'Редактировать информацию о компании',
        'parent_item_colon' => '',
        'menu_name'         => 'О компании'
      ],
      'description'           => '',
      'public'                => true,
      'publicly_queryable'    => true,
      'exclude_from_searc'    => false,
      'show_u'                => false,
      'show_in_menu'          => true,
      'show_in_nav_menus'     => true,
      'show_in_res'           => true,
      'rest_base'             => 'about_company',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'menu_position'         => 21,
      'menu_icon'             => 'dashicons-building',
      'capability_type'       => 'post',
      'map_meta_cap'          => true,
      'hierarchica'           => false,
      'supports'              => [],
      'capabilities'          => ['create_posts' => 'do_not_allow'],
      'has_archive'           => true,
      'rewrite'               => true,
      'can_export'            => true,
      'delete_with_use'       => false,
      'query_var'             => '/?{query_var_string}={post_slug}',
      '_builtin'              => false,
      '_edit_link'            => 'post.php?post=%d'
    ]);


    register_post_type('the_blocks', [
      'labels' => [
        'name'              => 'Блоки',
        'singular_name'     => 'Блоки',
        'edit_item'         => 'Редактировать блоки',
        'parent_item_colon' => '',
        'menu_name'         => 'Блоки'
      ],
      'description'           => '',
      'public'                => true,
      'publicly_queryable'    => true,
      'exclude_from_search'   => false,
      'show_u'                => false,
      'show_in_menu'          => false,
      'show_in_menu'       => true,
      // 'show_in_menu'       => 'the_blocks_page',
      // 'show_in_admin_bar'  => false,
      'show_in_nav_menus'     => true,
      'show_in_res'           => true,
      'rest_base'             => 'the_blocks',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'menu_position'         => 21,
      'menu_icon'             => 'dashicons-align-left',
      'capability_type'       => 'post',
      'map_meta_cap'          => true,
      'hierarchica'           => false,
      'supports'              => ['thumbnail', 'title'],
      // 'capabilities'          => ['create_posts' => 'do_not_allow'],
      // 'taxonomies'         => ['news_cat'],
      'has_archive'           => true,
      'rewrite'               => true,
      'can_export'            => true,
      'delete_with_use'       => false,
      'query_var'             => false,
      // 'query_var'             => '/?{query_var_string}={post_slug}',
      '_builtin'              => false,
      '_edit_link'            => 'post.php?post=%d'
    ]);
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

    $vnet->set_js_var('SRC', THEME_URI);
  }
}
