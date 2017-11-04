<?php

require_once 'initialize.php';
require_once PROJECT_ROOT . '/vendor/autoload.php';

$dispatcher = FastRoute\SimpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/hello', 'hello');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        echo $handler($vars);
        break;
}

function hello()
{
    return "hello world";
}
