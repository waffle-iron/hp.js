<?php

  class b2cyclon {

    private $list;
    public static $instance;

    private function b2cyclon(){
      $this->list = Array();
    }

    public static function i(){
      if(!isset(self::$instance)) {
        $class = __CLASS__;
        self::$instance = new $class();
      }
      return self::$instance;
    }

    public function get($path, $instruction){
      $this->list[$path] = $instruction("objreq", "objres");
      //print_r($this->list);
    }

    public function server(){
      if(is_array($this->list) && (count($this->list) > 0)) {
        $path = '/path/:id'; // only usecase
        foreach ($this->list as $key => $function) {
          # code...
          if($key == $path) {
            call_user_func($function, 'null');
            // TODO: exec function by param
            // exec($function);
          }
        }
      }
    }

    public function __destruct() {}

  }

  // TODO: to decide if b2cyclon can be create twice or more or ones.
  $b2c = b2cyclon::i();
  $request = $_GET;
  $response = "Nothing by now";
  $b2c->get("/path/:id", function($request, $response){
    echo $request;
  });

  $b2c->server();

?>
