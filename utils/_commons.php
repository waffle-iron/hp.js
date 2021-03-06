<?php
function _extension($ext = null){
  return (!isset($ext)) ? ".php" : "." . $ext;
}

function _require($path, $ext = null){
  require_once($path . _extension($ext));
}

function _exists($path, $ext = null){
  //echo $path . _extension($ext) . '<br>';
  return file_exists($path . _extension($ext));
}

function _readable($path, $ext = null){
  return is_readable($path . _extension($ext));
}

function _method($instance, $method){
  return method_exists($instance, $method);
}

function _gets($path, $ext = null){
  return file_get_contents($path . _extension($ext));
}

function _jdcode($content, $option = true){
  return json_decode($content, $option);
}

function _jecode($content, $option = true){
  return json_encode($content, $option);
}

function _maus($word){
  return ucfirst($word);
}

function _write($file, $content){
  $_temp = fopen($file, "w");
  fwrite($_temp, $content);
  fclose($_temp);
}

function _replace($found, $str, $replace = ""){
  return str_replace($found, $replace, $str);
}

function _tolower($str){
  return strtolower($str);
}

function _compress($content){
  return gzdeflate($content, 9);
}

function _uncompress($content){
  return gzinflate($content);
}

function is_json($string) {
 return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function _error($msg){

    header('Content-Type: application/json');

    echo json_encode(
      array(
        "error" => array(
          "state" => true,
          "response" => strval($msg)
        )
      ),
      true
    );

}

?>
