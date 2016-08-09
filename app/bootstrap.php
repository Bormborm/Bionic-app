<?php
ini_set('display_errors', 1);

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

$validator = new \Bormborm\Services\ValidationService();

if (!empty($_POST['password']) && (!empty($_POST['email'])))
{
    $validated = $validator->validatePassword($_POST['email'], $_POST['password']);

    //TODO: Сделать с этим что-нибудь!
    // hardcoding incoming!!!

    $_GET['entity'] = 'user';
    $_GET['id'] = $validated['id'];

}

$entity = $_GET['entity'];
$response = (new $controllerClass)->$controllerMethod();

if (empty($entity)) include __DIR__ . DIRECTORY_SEPARATOR . 'templates/htmlTemplate.html';  // temporary


if (gettype($response) === "string") {
    header("HTTP/1.1 200 OK");
    header('Content-Type: text/html');
    print($response);
    exit();
}

exit();
