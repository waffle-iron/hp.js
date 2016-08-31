<?php

  class session{

    private function __construct(){}
    public static function instance($newsession = null){

      session_start();
      if(!isset($_SESSION["user"])){

        if(!isset($newsession)){
          $_SESSION["user"] = array(
            "sessionid"     => session_id(),
            "username"      => "annon",
            "password"      => base64_encode("password"),
            "session_start" => null,
            "session_time"  => date('m/d/Y H:i:s', time())
          );

        }else $_SESSION["user"] = $newsession;

      }else{
        if(isset($newsession)) $_SESSION["user"] = $newsession;
      }

      return $_SESSION["user"];

    }

    public static function gen_user_key(){
      $_SESSION["user"]["key"] = base64_encode($_SESSION["user"]["username"] . '-' . $_SESSION["user"]["password"]);
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
