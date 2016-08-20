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

// TODO: unload bootstrap to controllers


$commentRepository = new \Bormborm\Model\Repository\Comment();
$postRepository = new \Bormborm\Model\Repository\Post();


$entity = $_GET['entity'];

$response = (new $controllerClass)->$controllerMethod();

if (!empty($_POST['addedComment']) && (!empty($_POST['postId']))) {
    $postId = (int)$_POST['postId'];
    $commentRepository->addNewCommentByUserId($_SESSION['id'], $_POST['addedComment'], $postId);
}

if (!empty($_POST['deleteComment'])) {
    $id = (int)$_POST['deleteComment'];
    $commentRepository->deleteComment($id);
}

if (!empty($_POST['postText'])) {
    $postRepository->addNewPost($_POST['postText'], $_SESSION['id']);
}


//echo 'SESSION: '; var_dump($_SESSION); echo "<br />";
//echo 'ENTITY: '; var_dump($_GET['entity']); echo "<br />";
//echo 'id-modified: '; var_dump($_GET['id']); echo "<br />";

if (gettype($response) === "string") {
    header("HTTP/1.1 200 OK");
    header('Content-Type: text/html');
    print($response);
    exit();
}

exit();
