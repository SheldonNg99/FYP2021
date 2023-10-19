<?php

class App{
  //Properties
  protected $controller = 'Home';
  protected $method = 'index';
  protected $params = [];
  public function __construct(){
    $url = $this->parseURL();
    //var_dump($url);
    //check file(method) is inside the controller
    //Controller

    if(file_exists('../App/Controllers/' . $url[0] . '.php')){
      $this->controller = $url[0];
      unset($url[0]);
    }
    require_once '../App/Controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    //Method
    if(isset($url[1])){
      if(method_exists($this->controller, $url[1])){
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    //params
    if(!empty($url) ){
      //Get the parameters
      $this->params = array_values($url);
    }

    //Run controller, method and params if any
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  //Method to get the Url and split them
  public function parseURL(){
    if(isset($_GET['url'])){
      //Get rid of the last slash
      $url = rtrim($_GET['url'],'/');
      //Get rid of weird url
      $url = filter_var($url, FILTER_SANITIZE_URL);
      //Save the url as an array
      $url = explode('/',$url);
      return $url;
    }
  }
}
