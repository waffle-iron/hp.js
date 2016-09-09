<?php

  class Cyclon {

    private $list;
    private static $instance;

    private function __construct() {
      $this->list = [];
    }

    public static function get_instance(){

      if (!isset( self::$instance )) {
        $class = __CLASS__;
        self::$instance = new $class();
      }

      return self::$instance;

    }

    public function get_list(){
      return $this->list;
    }

    public function add_cyclon($path, $newcyclon){
      if (true) {

        //array_push($this->list, $newroute);
        $this->list[$path] = $newcyclon;
        print_r($this->list);

      } else {
        throw new Exception("Error: can't create an cyclon because it's not a function.", 1);
      }
    }

  }

  function read_callback($p, $f) {
    return $f($p);
  }

  class FalseClosure {

    private $params;
    private $def_function;

    public function __construct($params, $f) {
      $this->params = $params;
      $this->def_function = $f;
    }

    public function get_args(){
      return array(
        $this->params,
        $this->$def_function
      );
    }

  }

  // TODO: Singleton interface which it'll implemented on all classes.

  class App {

    private $app_list;

    public function __construct(){
      $this->app_list = Cyclon::get_instance()->get_list();
      if(is_array($this->app_list)) echo "list has been charged <br>";
    }

    public function get($element){

      $factory = Cyclon::get_instance();
      $factory->add_cyclon('/path/uri', new FalseClosure(array("param_1", "param_2"), function(){
        echo "I can do anything";
      }));

      // list['path'] => object => (params, def_function)
      print_r($element);
    }

    public function post(){}
    public function delete(){}
    public function put(){}
    public function __destruct(){}

  }

?>
