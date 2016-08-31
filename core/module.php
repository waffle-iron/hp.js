<?php

  interface module{

    public function __construct($module, $controller, $request);
    public function gateway();
    public function __destruct();

  }

?>
