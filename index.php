<?php
  define("SEPARATOR","\\");
  define("ROOT",realpath(dirname(__FILE__)).SEPARATOR);
  define("CORE",ROOT.'core'.SEPARATOR);
  define("MODEL",ROOT.'model'.SEPARATOR);
  define("APP",ROOT.'application'.SEPARATOR);

  require_once(APP."bootstrap.php");

