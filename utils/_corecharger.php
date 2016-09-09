<?php

  function _core(){
    spl_autoload_register(function($elm){
      //echo $elm;
      _require('core/' . $elm);
    });
  }

  function _loader($response = null, $session = null){

    switch ($response) {
      case null:
        //echo 'case null';
        $session = session::instance();
        $session->genkey();
        _loader('launcher', $session);
        break;
      case 'launcher':
        # code...
        //echo 'case instance';
        launcher::run($session);
        break;
      default:
        # code...
        throw new Exception("Error: error with loader autocall.", 1);
        break;
    }
  }

?>
