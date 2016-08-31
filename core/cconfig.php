<?php

  ini_set('display_errors', 1);
  error_reporting(~0);

  if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
    define('RPATH', realpath('.')); // realpath
    define('MODNAME', 'modules'); // module directory name
    define('MPATH', RPATH . DS . MODNAME); // module directory
  }

?>
