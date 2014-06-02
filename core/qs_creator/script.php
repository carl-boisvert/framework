<?php


  require_once("config.php");

  try{
    $pdo = new PDO($connectionString,"root","root",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $tables = array();
    foreach ( $pdo->query("select * from information_schema.columns where table_schema = '".$dbname."' order by table_name,ordinal_position") as $table) {
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["name"] = $table["COLUMN_NAME"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["default"] = $table["COLUMN_DEFAULT"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["nullable"] = ($table["IS_NULLABLE"] == "YES")? true : false;
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["type"] = $table["DATA_TYPE"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]][$table["COLUMN_NAME"]]["lenght"] = $table["NUMERIC_PRECISION"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["primary"] = $table["COLUMN_KEY"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["extra"] = $table["EXTRA"];
      $tables[$table["TABLE_NAME"]][$table["COLUMN_NAME"]]["actions"] = $table["PRIVILEGES"];
    }
    createController($tables);
    createModel($tables);
  }
  catch(PDOException $ex){
    echo $ex->getMessage();
  }


  function createModel($tables){
    foreach($tables as $key => $value){

      $attributes = attributesToString(array_keys($value));

      if(!file_exists(APP."model/".$key.".php")){
        // Create Model from template
        $modelString = file_get_contents(CORE.'qs_creator\templates\model.php');
        $modelString = str_replace('name',ucfirst($key),$modelString);
        $modelString = str_replace('public $attributes;','public $attributes = array('.$attributes.');',$modelString);
        file_put_contents(APP."model/".$key.".php",$modelString);
      }
    }

  }

  function createController($tables){
    foreach($tables as $key => $value){
      // Create REST Controller from template
      if(!file_exists(APP."controller/".$key.".php")){
        $modelString = file_get_contents(CORE.'qs_creator\templates\controller.php');
        $modelString = str_replace('name',ucfirst($key)."Controller",$modelString);
        $modelString = str_replace('variable',$key,$modelString);
        file_put_contents(APP."controller/".$key.".php",$modelString);
      }
    }
  }

  function attributesToString($attributes){
    $string = "";
    foreach($attributes as $attribute){
      if(end($attributes) != $attribute)
        $string .= "'".$attribute."',";
      else
        $string .= "'".$attribute."'";
    }
    return $string;
  }
