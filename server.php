<?php

  require('utils/_commons.php');
  require('core/cconfig.php');

  try{

    _require('utils/_corecharger');

    /*session::instance();
    session::gen_user_key(request::capture());

    // Initial position
    launcher::run(request::capture());
    */
    
    _core();
    _loader();

  }catch(Exception $e){
    _error($e);
  }

?>
