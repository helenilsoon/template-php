<?php

namespace app\framework\classes;

class Router
{
  private string $patch;
  private string $request;

  private function routerFound($routes) {
    if (!isset($routes[$this->request])) {
      throw new \Exception("Route {$this->patch} do not exist :(");
    }
    if (!isset($routes[$this->request][$this->patch])) {
      throw new \Exception("Route {$this->patch} do not exist :(");
    }}
  private function controllerFound() {}
  public function execute($routes) {  

    $this->patch = patch();
    $this->request = request();
    $this->routerFound($routes);
  }
}