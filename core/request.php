<?php


class Request{

    public $status;
    public $host;
    public $uri;
    public $params;
    public $controller;
    public $action;
    public $idParam;

    public function  __construct(){
        $this->host = $_SERVER["SERVER_NAME"];
        $this->uri = substr($_SERVER["REQUEST_URI"],1);
    }

    public function route(){
      if($this->uri != ""){
        $infos = parse_url($this->uri);
        $this->splitUrl($infos["path"]);
        $this->params = $infos["query"];
        /*$uri = explode("/",$this->uri);
        $this->params = explode("?",$this->uri);
        $this->controller = $uri[0];
        if(explode("?",end($uri))){
          $params = explode("?",end($uri));
        }*/
      }
    }

    private function splitUrl($path){
      $parts = explode("/",$path);
      $this->controller = $parts[0];
      if(isset($parts[1])){
        $this->action = $parts[1];
      }
      if(isset($parts[2])){
        $this->idParam = $parts[2];
      }
    }
}