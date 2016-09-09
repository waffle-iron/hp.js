<?php

  abstract class controller{

    protected static $_controller;
    protected static $_request;
    private   static $module_path;
    private   static $_model;

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
      _require($view_path . DS . 'index', "html");

    }

    protected function _model(){
      if(!isset(self::$_model)){
        _require('core' . DS . 'model');
        self::$_model = new model();
      }
      return self::$_model;
    }

    protected function _typreq(){
      return $_SERVER["REQUEST_METHOD"];
    }

  }

?>
