<?php

use Aura\Router\RouterContainer;

$routerContainer = new RouterContainer();

$map = $routerContainer->getMap();

$map->get('index','/',[
    "controller" => "App\Controllers\IndexController",
    "action" => "indexAction"
]);

$map->get('addJob','/jobs/add',[
    "controller" => "App\Controllers\JobsController",
    "action" => "addJobAction"
]);

$map->post('saveJob','/jobs/add',[
    "controller" => "App\Controllers\JobsController",
    "action" => "addJobAction"
]);

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);

// var_dump($route->handler);

if(!$route)
    echo 'No route';
else{
    
    $arrayController = $route->handler;
    $controller = new $arrayController['controller'];
    $action_string = $arrayController['action'];
    
    $response = $controller->$action_string($request);

    echo $response->getBody() ; //PSR-7
    
    // echo $controller->$action_string($request); // its work    
    // echo $controller->$arrayController['action']; // its does not work
}

?>