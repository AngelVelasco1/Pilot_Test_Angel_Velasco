<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/campers', function() {
        App\campers::Singleton(json_decode(file_get_contents("php://input"), true))->campersPost();
    });
    $router->run();
    
?>