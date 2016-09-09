<?php
ini_set('display_errors', 1);

session_start();

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

define('APP_DEFAULT_ROUTE', 'index');

$routesConfigFile = __DIR__ . DIRECTORY_SEPARATOR . 'config/routes.yml';
if (!file_exists($routesConfigFile)) {
    throw new RuntimeException("Routes config file not found");
}
$routes = Yaml::parse(file_get_contents($routesConfigFile), Yaml::PARSE_OBJECT);

if (\Bormborm\Services\Api\ApiHelper::isApiCall($_REQUEST)) {
    $route = \Bormborm\Services\Api\ApiHelper::generateRouteByRequest($_REQUEST);
} // elseif ...vvv...

if (!$route = $_GET['entity'] ? $_GET['entity'] : false) {
    $route = APP_DEFAULT_ROUTE;
}

if (!array_key_exists($route, $routes)) {
    throw new RuntimeException('Route ' . $route . ' is not found in routes configuration file');
}

$controllerClass = $routes[$route]['class'];
$controllerMethod = $routes[$route]['method'] . 'Action';
if (!class_exists($controllerClass) || !method_exists($controllerClass, $controllerMethod)) {
    throw new RuntimeException('No controller class or method provided');
}

// $query = UriHelper::buildRequestQueryArgs($_REQUEST['query']);



$response = (new $controllerClass)->$controllerMethod();

if (gettype($response) === "string") {
    header("HTTP/1.1 200 OK");
    header('Content-Type: text/html');
    print($response);
    exit();
}

exit();
