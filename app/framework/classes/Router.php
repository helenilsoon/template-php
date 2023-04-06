<?php

namespace app\framework\classes;

class Router
{

  private string $patch ;
  private string $request;

  private function routerFound($routes) {
      
    if (!isset($routes[$this->request])) {

      throw new \Exception("Router {$this->patch} does not exist :(");

    }
    if (!isset($routes[$this->request][$this->patch])) {

      throw new \Exception("Route {$this->patch} does  not exist :(");

    }
  }
  private function controllerFound(string $controlleNamespace, string $controller,string $action ) {

    if(!class_exists($controlleNamespace)){
      throw new \Exception("Controller {$controller} does not exits");
    }

    if(!method_exists($controlleNamespace,$action)){
      throw new \Exception("Method {$action} does not exist in {$controller}");
    }
  }

  public function execute($routes) {  
    
    $this->patch = patch();
    $this->request = request();
    $this->routerFound($routes);

    [$controller, $action]= explode('@',$routes[$this->request][$this->patch]);

    $controlleNamespace = "app\\controllers\\{$controller}";

    $this->controllerFound($controlleNamespace,$controller,$action);
    
    $controllerInstace = new $controlleNamespace;
    $controllerInstace->$action();
  
  }
}