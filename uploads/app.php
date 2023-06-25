<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/teachers', function() {
        App\teachers\teachers::Singleton(json_decode(file_get_contents("php://input"), true))->teachersPost();
    });
    $router->run();
?>