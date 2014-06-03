<?php


class Application{

  public $request;
  public $route;
  public $controller;
  public $action;
  public $idParam;
  public $params;

  public function __construct(){
    $this->request = new Request();
    //$this->route = new Route();
  }


  private function route(){
    //need to include the file before instanciate the class
    if(class_exists($this->controller."Controller"))
      $this->controller = new $this->controller."Controller";
    else
      throw new Exception("Controller not found");

    if(method_exists($this->controller,$this->action))
      $this->prepareAction();
    else
      throw new Exception("Method not found");
  }

  private function prepareAction(){
    $id = $this->idParam;

  }
}