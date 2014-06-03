<?php

  require_once(CORE."controller\autoload.php");
  require_once(CORE."model\autoload.php");
  require_once(APP."config\module.php");
  require_once(CORE."log.php");
  require_once(CORE."request.php");
  require_once(CORE."route.php");
  require_once(CORE."application.php");


  foreach($modules as $module){
      require_once(CORE.$module.'\autoload.php');
  }



  $app = new Application();