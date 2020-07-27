<?php

/**
 * 
 * Класс с набором простых методов для разработки
 * 
 */



class Vnet_Comon
{



  public function console($item)
  {
?>
    <div class="block-var-display" id="blockVarDisplay" style="display: none;">
      <?php
      echo json_encode($item);
      ?>
    </div>
    <script>
      {
        let block = document.querySelector('#blockVarDisplay');
        if (block) {
          let content = block.textContent;
          if (content) {
            console.log(JSON.parse(content));
          }
          block.parentNode.removeChild(block);
        }
      }
    </script>
  <?php
  }











  public function strip_text($str, $max, $sets = [])
  {
    $str = explode(' ', $str);
    $start = '';
    $end = '';
    $count = 0;
    foreach ($str as $word) {
      if ($count < $max) {
        $start .= $word . ' ';
      } else {
        $end .= $word . ' ';
      }
      $count++;
    }
    return ['start' => $start, 'end' => $end];
  }







  public function random_str($length = 10)
  {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }









  public function pre($str = '', $attach = false)
  {
    $class_name = 'php-code-display';
    if ($attach) $class_name .= ' php-code-fixed';
    echo '<pre class="' . $class_name . '">';
  ?>
    <style>
      .php-code-display {
        background-color: #4d535c !important;
        color: #fff !important;
        width: 100% !important;
        padding: 20px !important;
        overflow: auto !important;
      }

      .php-code-fixed {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        z-index: 10000 !important;
        height: 100vh !important;
        max-height: 400px !important;
      }
    </style>
<?php
    print_r($str);
    echo '</pre>';
  }







  public function get_from_object(&$obj, $key, $def = false, $callback = false, $callBackArgs = false)
  {
    if (!is_object($obj)) return $def;
    if (!property_exists($obj, $key)) return $def;
    if (!$obj->$key) return $def;
    if (!$callback) return $obj->$key;
    return call_user_func($callback, $obj->$key, $callBackArgs);
  }









  public function get_from_array(&$arr = false, $key, $def = false, $callback = false, $callBackArgs = false)
  {
    if (!is_array($arr)) return $def;
    if (!isset($arr[$key])) return $def;
    if (!$arr[$key]) return $def;
    if (!$callback) return $arr[$key];
    return call_user_func($callback, $arr[$key], $callBackArgs);
  }





  public function get_array_from_array(&$arr, $key, $def = false)
  {
    return $this->get_from_array($arr, $key, $def, function ($item) {
      return is_array($item) ? $item : false;
    });
  }






  public function get_from_post($key, $def = false)
  {
    return $this->get_from_array($_POST, $key, $def);
  }






  public function get_from_get($key, $def = false)
  {
    return $this->get_from_array($_GET, $key, $def);
  }






  public function get_from_request($key, $def = false)
  {
    return $this->get_from_array($_REQUEST, $key, $def);
  }






  public function get_from_server($key, $def = false)
  {
    return $this->get_from_array($_SERVER, $key, $def);
  }




  public static function mkpath($path)
  {
    $path = array_values(array_filter(explode('/', $path)));
    if (!$path) return;

    $real_path = '';
    foreach ($path as $file_name) {
      $real_path .= '/' . $file_name;
      if (!is_writable($file_name)) continue;
      if (!file_exists($real_path)) @mkdir($real_path);
    }
  }








  public static function path($paths, $append = '')
  {
    $paths[count($paths) - 1] = str_replace('/', '', $paths[count($paths) - 1]);
    $paths = implode('/', $paths);
    $paths = preg_replace('/[\/]+/', '/', $paths);
    $paths .= $append;
    return $paths;
  }






  public function define($name, $val)
  {
    if (defined($name)) return;
    define($name, $val);
  }
}
