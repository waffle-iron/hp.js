<?php

  class request{

    private $uri;
    public static $instance;

    private function __construct(){
      // TODO: heritance singleton interface
      // TODO: logic to construct
      if (!isset($_GET["app"])) {
        $this->uri = explode("/", 'web/init/index');
      } else {
        // preg_match_all to find slash continue by a word or number
        if ( preg_match_all('/\/[a-zA-Z0-9]/', $_GET["app"]) >= 2 ) {
          $this->uri = explode("/", $_GET["app"]);
        } else {
          $this->uri = explode("/", 'web/error/_404');
        }
      }

    }

    public static function instance(){

      if (!isset(self::$instance)) {
        $class = __CLASS__;
        self::$instance = new $class();
      }

      return self::$instance;

    }

    public function capture(){

      return array(
        "module"      => array_shift($this->uri),
        "controller"  => array_shift($this->uri),
        "method"      => array_shift($this->uri),
        "args"             => array(
          "get_args"       => $this->uri,
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
