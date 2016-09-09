<?php

  class session{

    private static $instance;

    private function __construct(){

      if(!isset($_SESSION["user"])){
        session_start();
        $_SESSION["user"] = array(
          "sessionid"     => session_id(),
          "username"      => "annon",
          "password"      => base64_encode("password"),
          "session_start" => false,
          "session_time"  => date('m/d/Y H:i:s', time())
        );
      }

    }

    public static function instance(){

      if(!isset(self::$instance)){
        $class = __CLASS__;
        self::$instance = new $class();
      }

      return self::$instance;

    }

    public function genkey(){
      if(isset($_SESSION["user"])){
        $_SESSION["user"]["key"] = base64_encode(
          session_id() . ',' .
          $_SESSION["user"]["username"] . ',' .
          base64_encode($_SESSION["user"]["password"])
        );
      }else{
        throw new Exception("Error: session does not start", 1);
      }
    }

    public function get_session(){
      return $_SESSION["user"];
    }

    public static function is_user_loggin(){
      if($_SESSION["user"]["session_start"]) return true;
      else return false;
    }

    public static function get_user_date($date){
      return $_SESSION["user"][$date];
    }

  }

?>
