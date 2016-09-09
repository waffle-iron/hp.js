<?php

  class model{

    private static $instance;
    private $model;

    public function __construct(){
      $this->model = _uncompress(_gets('modules' . DS . 'model.pkg', "json"));
    }

    public function select($table, $elements, $where = null){

      if(!is_array($elements)) throw new Exception("Error: elements must be an array", 1);
      if(isset($where)) if(!is_array($where)) throw new Exception("Error: where must be an array", 1);

      if (is_array($table)) {

      } else {
        echo $this->model;
      }

    }

    public function __destruct(){}

    /* get one element result */
    /* get array elements result */
    /* get boolean response */

    /* build where */
    /* build joinsinquealjoin */

  }

?>
