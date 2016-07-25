<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

define('APP_DEFAULT_ROUTE', 'user');

$routesConfigFile = __DIR__ . DIRECTORY_SEPARATOR . 'config/routes.yml';
if (!file_exists($routesConfigFile)) {
    throw new RuntimeException("Routes config file not found");
}
$routes = Yaml::parse(file_get_contents($routesConfigFile), Yaml::PARSE_OBJECT);

if (!$route = $_GET['entity'] ?: false) {
    $route = APP_DEFAULT_ROUTE;
}

if (!array_key_exists($route, $routes)) {
    throw new RuntimeException('Route ' . $route . ' is not found in routes configuration file');
}

$controllerClass = $routes[$route]['class'];
$controllerMethod = $routes[$route]['method'] . 'Action';
if (!class_exists($controllerClass) || !method_exists($controllerClass, $controllerMethod)) {
    throw new RuntimeException('Your controller is a shit!');
}

$response = (new $controllerClass)->$controllerMethod();

$entity = $_GET['entity'];

include_once $entity . 'sTemplate.html.php';

if (gettype($response) === "string") {
    header("HTTP/1.1 200 OK");
    header('Content-Type: text/html');
    print($response);
    exit();
}

exit();
