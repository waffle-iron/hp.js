<?php

  abstract class controller{

    protected static $_controller;
    protected static $_request;
    private   static $module_path;

    private function __construct(){}
    abstract function index();

    public static function instance($class, $_request){

      /* Asignar valor a la request */
      self::$_request = $_request;

      if(!isset(self::$_controller)){

        self::$_controller = new $class();
        self::$module_path = 'modules' . DS . $_request["module"];

      }

      return self::$_controller;

    }

    protected function _viewer($elements = null){

      $view_path = 'modules' . DS . self::$_request["module"] . DS . 'views';
      if(!_exists($view_path . DS . 'overall_header', "html") || !_exists($view_path . DS . 'overall_footer', "html")){
        throw new Exception("Error: important files does not exist at view", 1);
      }else{
        _require($view_path . DS . 'overall_header', "html");
        if(is_array($elements)){
          foreach ($elements as $key => $value) {
            _require($view_path . DS . $value, "html");
          }
        }
        _require($view_path . DS . 'overall_footer', "html");
      }

    }

    protected function _typreq(){
      return $_SERVER["REQUEST_METHOD"];
    }

  }

?>
