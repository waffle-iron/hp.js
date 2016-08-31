<?php

  class request{

    private static $urifault = "index/init";

    public static function capture($uri = null){

      if(!isset($uri)) $uri = explode("/", (!isset($_GET["app"])) ? self::$urifault : $_GET["app"]);

      return array(
        "module"      => array_shift($uri),
        "controller"  => array_shift($uri),
        "method"      => array_shift($uri),
        "args"             => array(
          "get_args"       => $uri,
          "post_args"      => (isset($_POST["_send"])) ? $_POST : array()
        ),
        "userdates"        => array(
          "username" => (session::is_user_loggin()) ? "annon" : session::get_user_date("username"),
          "password" => (session::is_user_loggin()) ? "password" : session::get_user_date("password")
        )
        );

    }

  }

?>
