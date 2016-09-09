<?php

  class ctl implements module{

    protected $_module;
    protected $_controller;
    protected $_request;

    public function __construct($module, $controller, $request){

      if(!isset($controller) || !isset($request) || !isset($module)){
        throw new Exception("Error: request or controller cant be null", 1);
      }else{
        $this->_module = $module;
        $this->_controller = $controller;
        $this->_request = $request;
      }

    }

    public function gateway(){

      $_instance = $this->_controller::instance($this->_controller, $this->_request);

      //Comprimir model pkg
      if(!filesize('modules' . DS . 'model.pkg.json') > 0){

        $mod_path = 'modules' . DS . _tolower(_replace("ctl", $this->_module)) . DS . 'models';
        $mod_dir = opendir($mod_path);
        $str = "";
        while ($archivo = readdir($mod_dir)) {
          if($archivo !== '.' && $archivo !== '..'){
            $str .= _gets(_replace(".json", $mod_path . DS . $archivo), "json");
          }
        }

        _write('modules' . DS . 'model.pkg.json', _compress($str));

        // Check if the bd sintax is correct
        if(!is_json(_uncompress(_gets('modules' . DS . 'model.pkg', "json")))){
          //echo preg_replace("/(\n[\t ]*)([^\t ]+):/", "$1\"$2\":", $str);
          throw new Exception("Error: not correct BD sintax", 1);
        }

      }

      // Ver si el método es callable
      if(_method($_instance, $this->_request["method"]) ){

        if(empty($this->_request["args"]["get_args"]) && empty($this->_request["args"]["post_args"])){
          $response = call_user_func(array($_instance, $this->_request["method"]));
        } else $response = call_user_func_array(array($_instance, $this->_request["method"]), array($this->_request["args"]));

      }

      // Devolver datos
      return array(
        "dates" => $response,
        "result" => ($response !== false) ? "true" : "false",
        "time" => date('d/m/Y H:i:s', time()),
        "size" => mb_strlen(json_encode($response, true), '8bit')
      );

    }

    public function __destruct(){}

  }

?>
