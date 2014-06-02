<?php

  require_once(CORE."controller\autoload.php");
  require_once(CORE."model\autoload.php");
  require_once(APP."config\module.php");


  foreach($modules as $module){
      require_once(CORE.$module.'\autoload.php');
  }