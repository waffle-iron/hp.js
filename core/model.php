<?php

  class model{

    private static $instance;

    private function __construct(){}

    public static function instance(){
      if(!isset($instance)){
        $class = __CLASS__;
        self::$instance = new $class();
      }
      return self::$instance;
    }


    public function select($table, $elements, $where = null){

      if(!is_array($elements)) throw new Exception("Error: elements must be an array", 1);
      if(isset($where)) if(!is_array($where)) throw new Exception("Error: where must be an array", 1);

      $tables = $this->setting_elements($elements);
      
    }

    private function setting_elements($elements){
      $toret = "";
      foreach ($elements as $key => $value) {
        $toret .= $toret . ', ';
      }
      return trim($toret, ",");
    }

    /* get one element result */
    /* get array elements result */
    /* get boolean response */

    /* build where */
    /* build joinsinquealjoin */

  }

?>
