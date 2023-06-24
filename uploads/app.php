<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/areas', function() {
        App\areas::Singleton(json_decode(file_get_contents("php://input"), true))->areasPost();
    });
    $router->run();
    
?>