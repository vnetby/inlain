<?php

class Vnet_Core extends Vnet_Comon
{


  private $path_svg = THEME_PATH . 'img/svg/';
  private $path_templates = THEME_PATH . 'template-parts/';
  private $path_debug = THEME_PATH;
  private $path_extensions = VNET_PATH . 'extensions/';

  public $ajax_key = 'vnet_ajax';

  private $js_vars;
  private $ajax_actions;
  private $libs;





  public function setup()
  {
    $this->js_vars = [];
    $this->ajax_actions = [];
    $this->libs = [];
    $this->add_hooks();
  }






  private function add_hooks()
  {
    add_action('wp_enqueue_scripts', [$this, '_add_css_libs']);
    add_action('wp_enqueue_scripts', [$this, '_add_js_libs']);

    add_action('wp_head', [$this, '_add_js_vars']);
    add_action('wp_ajax_vnet_ajax', [$this, '_do_ajax']);
    add_action('wp_ajax_nopriv_vnet_ajax', [$this, '_do_ajax']);
  }








  public function _add_css_libs()
  {
    if (!$this->libs) return;

    foreach ($this->libs as $args) {
      $name = $this->get_from_array($args, 'name');
      $sets = $this->get_from_array($args, 'sets');
      $exclude = $this->get_from_array($sets, 'exclude', []);
      $exclude = is_string($exclude) ? [$exclude] : $exclude;
      $path = VNET_PATH . 'assets/' . $name . '/';
      if (!file_exists($path)) continue;
      $scan = scandir($path);
      foreach ($scan as $file_name) {
        if (in_array($file_name, $exclude)) continue;
        $lib_file = $path . $file_name;
        if (!is_file($lib_file)) continue;
        if (!preg_match('/.*\.css$/', $lib_file)) continue;
        wp_enqueue_style('vnet-' . $file_name, VNET_URI . 'assets/' . $name . '/' . $file_name);
      }
    }
  }






  public function _add_js_libs()
  {
    if (!$this->libs) return;

    foreach ($this->libs as $args) {
      $name = $this->get_from_array($args, 'name');
      $sets = $this->get_from_array($args, 'sets');
      $exclude = $this->get_from_array($sets, 'exclude', []);
      $exclude = is_string($exclude) ? [$exclude] : $exclude;
      $path = VNET_PATH . 'assets/' . $name . '/';
      if (!file_exists($path)) continue;
      $scan = scandir($path);
      foreach ($scan as $file_name) {
        if (in_array($file_name, $exclude)) continue;
        $lib_file = $path . $file_name;
        if (!is_file($lib_file)) continue;
        if (!preg_match('/.*\.js$/', $lib_file)) continue;
        wp_enqueue_script('vnet-' . $file_name, VNET_URI . 'assets/' . $name . '/' . $file_name, [], null, true);
      }
    }
  }







  public function _do_ajax()
  {
    $key = $this->get_from_request($this->ajax_key);
    if (!$key) return;

    $fn = $this->get_from_array($this->ajax_actions, $key);
    if (!$fn) return;

    if (!is_callable($fn)) return;
    call_user_func($fn);
  }







  public function _add_js_vars()
  {
    if (!$this->js_vars) return;
    $vars = [];
    foreach ($this->js_vars as $key => $val) {
      if (is_array($val) || is_object($val)) {
        $val = json_encode($val, JSON_UNESCAPED_UNICODE);
        $vars[] = 'window.back_dates.' . $key . ' = JSON.parse(\'' . stripslashes($val) . '\');';
      } else {
        $vars[] = 'window.back_dates.' . $key . ' = \'' . $val . '\';';
      }
    }
    echo '<script>' . implode("\r\n", $vars) . '</script>';
  }






  public function get_svg($name)
  {
    $path = self::path([$this->path_svg, $name . '.svg']);
    if (!file_exists($path)) {
?>
      <span style="color: brown; font-weight: bold">[svg]</span><?= $name; ?><span style="color: brown; font-weight: bold">[/svg]</span>
    <?php
      return;
    }
    $svg = file_get_contents($path);
    $svg = preg_replace("/xmlns[\s]*=[\s]*\"[^\"]+\"/s", "", $svg);
    $svg = preg_replace("/<svg/", "<svg data-name='" . $name . "'", $svg);
    return $svg;
  }








  function get_template($name, $args = false, $sets = false)
  {
    $path = self::path([$this->path_templates, $name . '.php']);
    if (!file_exists($path)) {
    ?>
      <span style="color: brown; font-weight: bold">[template]</span><?= $path; ?><span style="color: brown; font-weight: bold">[/template]</span>
    <?php
      return;
    }
    if (is_user_logged_in()) {
    ?>
<?php
    }
    ob_start();
    require($path);
    $content = ob_get_clean();
    $content = $this->add_template_data_admin($content, ['path' => $path]);
    echo $content;
  }







  public function debug($var, $file_name = false, $append = false)
  {
    $this->mkpath($this->path_debug);

    $file_name = $file_name ? $file_name : '_DEBUG';
    $file = self::path([$this->path_debug, $file_name]);

    ob_start();
    print_r($var);
    $var = ob_get_clean();

    if ($append && file_exists($file)) file_put_contents($file, "\r\n\r\n");

    if ($append) {
      file_put_contents($file, $var, FILE_APPEND);
    } else {
      file_put_contents($file, $var);
    }
  }






  private function add_template_data_admin($content, $args)
  {
    if (!is_user_logged_in()) return $content;

    $path = $this->get_from_array($args, 'path');

    $content = preg_replace("/data-admin/", 'data-file="' . $path . '"', $content);

    return $content;
  }










  public function set_path($key, $value)
  {
    $var = 'path_' . $key;
    if (!isset($this->$var)) return;
    $this->$var = $value;
  }




  public function set_js_var($key, $value)
  {
    $this->js_vars[$key] = $value;
  }




  public function add_ajax($name, $callback)
  {
    $this->ajax_actions[$name] = $callback;
  }




  public function add_lib($name, $sets = [])
  {
    $this->libs[] = ['name' => $name, 'sets' => $sets];
  }






  public function load_extension($name)
  {
    if (is_array($name)) {
      foreach ($name as $real_name) {
        $this->_load_extension($real_name);
      }
    }
    if (is_string($name)) {
      $this->_load_extension($name);
    }
  }



  private function _load_extension($name)
  {
    $file = $this->path_extensions . 'class-' . $name . '.php';
    if (file_exists($file)) {
      require_once $file;
    } else {
      $file = $this->path_extensions . $name . '/' . $name . '.php';
      if (file_exists($file)) require_once $file;
    }
  }
}
