<?php

  ini_set('display_errors', 1);
  error_reporting(~0);

  header('Content-Type: application/json');

  if(!isset($_GET["key"])){

    echo json_encode(
      array(
        "error" => array(
          "state" => true,
          "response" => "Recurse doesnt available"
        )
      ),
      true
    );

  }else{

    $user = explode("-", base64_decode($_GET["key"]));
    $user = array(
      "username" => array_shift($user),
      "password" => base64_decode(array_shift($user)),
      "dates" => json_encode(file_get_contents('cache/' . $_GET["key"] . '.json'), true)
    );

    echo json_encode($user, true);
  }

?>
