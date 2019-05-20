<?php

use Aura\Router\RouterContainer;

$routerContainer = new RouterContainer();

$map = $routerContainer->getMap();

$map->get('index','/',[
    "controller" => "App\Controllers\IndexController",
    "action" => "indexAction",
    "auth" => true
]);

$map->get('addJob','/jobs/add',[
    "controller" => "App\Controllers\JobsController",
    "action" => "addJobAction",
    "auth" => true
]);

$map->get('addUser','/users/add',[
    "controller" => "App\Controllers\UsersController",
    "action" => "addUserAction",
    "auth" => true
]);

$map->get('login','/login',[
    "controller" => "App\Controllers\AuthController",
    "action" => "loginAction"
]);

$map->get('admin','/admin',[
    "controller" => "App\Controllers\AdminController",
    "action" => "adminAction",
    "auth" => true
]);

$map->get('logout','/logout',[
    "controller" => "App\Controllers\AuthController",
    "action" => "logoutAction"
]);

$map->post('saveJob','/jobs/add',[
    "controller" => "App\Controllers\JobsController",
    "action" => "addJobAction",
    "auth" => true
]);

$map->post('saveUser','/users/add',[
    "controller" => "App\Controllers\UsersController",
    "action" => "addUserAction",
    "auth" => true
]);

$map->post('Auth','/login',[
    "controller" => "App\Controllers\AuthController",
    "action" => "loginAction",
]);

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);


if(!$route)
    echo '<h1 class="h1">404 Route not found</h1>';
else{
    
    $arrayController = $route->handler;
    
    $needAuth = $arrayController['auth'] ?? false;
    
    $session_init =  $_SESSION['userID'] ?? null ;
    
    if($needAuth && !$session_init ){
        $arrayController['controller'] = "App\Controllers\AuthController";
        $arrayController['action'] = 'logoutAction';    
    }
    
    $controller = new $arrayController['controller'];
    $action_string = $arrayController['action'];

    $response = $controller->$action_string($request);

    foreach($response->getHeaders() as $name => $values){
        foreach($values as $value){
            header(sprintf('%s: %s', $name, $value),false);
        }
    }

    http_response_code($response->getStatusCode());

    echo $response->getBody() ; //PSR-7
    
    // echo $controller->$action_string($request); // its work    
    // echo $controller->$arrayController['action']; // its does not work
}

?>