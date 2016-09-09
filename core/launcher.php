<?php

  class launcher{

    public static function run($_session){

      $_request = request::instance()->capture();
      print_r($_session->get_session());

      $_module     = $_request["module"];
      $_mod_name = 'ctl' . ucfirst($_module);
      $_mod_path = MODNAME . DS . $_module;
      $_ctl_path = MODNAME . DS . $_module . DS . '_ctl.' . $_module;
      $_modpkg   = (_exists($_mod_path . DS . 'mod.pkg', "json")) ? _jdcode(_gets($_mod_path . DS . 'mod.pkg', "json")) : null;
      $_short_name = $_modpkg["short"];
      $_controller = $_short_name . "." . $_request["controller"];

      if( self::ctl_gateway($_ctl_path, $_mod_name) ){

        if( _exists($_mod_path . DS . '_controllers' . DS . $_controller) ){

          _require($_mod_path . DS . '_controllers' . DS . $_controller);
          $_instance_module = new $_mod_name($_mod_name, str_replace($_short_name . ".", "", $_controller), $_request);
          $response = $_instance_module->gateway();
          //print_r($response);

        }

        /* get user key */
        $user_key = session::get_user_date("key");
        $user_cache_dir = 'cache/';
        $user_cache_file = $user_cache_dir . $user_key . '.json';
        $write = array(
            $_request["controller"] => array(
            $_request["method"] => $response
          )
        );

        /* Si el fichero de sesión no existe */
        if(!_exists($user_cache_file)){
          _write($user_cache_file, _jecode($write, JSON_PRETTY_PRINT));
        }else{

          $cache_file_content = _jdcode(_gets($user_cache_file), true);

          /* Comprobar si existe esa petición en el caché del usuario */
          if(!isset($cache_file_content[$_request["controller"]][$_request["method"]])){

            /* Si no existe se añade la nueva petición al archivo de caché */
            $write = array_merge($cache_file_content, $write);
            _write($user_cache_file, _jecode($write, JSON_PRETTY_PRINT));

          }else{

            /* Comprobar si el resultado de la petición ha cambiado comparando el tamaño */
            $prev_date = $cache_file_content[$_request["controller"]]["time"];
            $next_date = date('d/m/Y H:i:s', time());

            if($next_date > $prev_date){

              /* Comparar el tamaño de los resultados */
              $prev_size = $cache_file_content[$_request["controller"]]["size"];
              $next_size = mb_strlen(_jecode($response, true), '8bit');

              /* Si son diferentes hay que actualizar los datos */
              if($prev_size !== $next_size){

                /* Si hubo cambios hay que reescribir el fichero de caché del usuario */
                $cache_file_content[$_request["controller"]][$_request["method"]] = $response;
                _write($user_cache_file, _jecode($cache_file_content, JSON_PRETTY_PRINT));

              }

            }

          }

        }

      }else throw new Exception("Error: I cant find his ctl.controller", 1);

    }

    private static function ctl_gateway($_ctl_path, $_mod_name){

      if(_exists($_ctl_path) && _readable($_ctl_path)){

        _require($_ctl_path);
        if(_method($_mod_name, "gateway")) return true;
        else return false;

      } else return false;

    }

  }

?>
