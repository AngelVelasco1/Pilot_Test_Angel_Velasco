<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/trainers', function() {
        App\trainers\trainers::Singleton(json_decode(file_get_contents("php://input"), true))->trainersPost();
    });
    $router->run();
?>