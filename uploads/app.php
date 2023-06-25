<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/contact_info', function() {
        App\contact_info::Singleton(json_decode(file_get_contents("php://input"), true))->contactInfoPost();
    });
    $router->run();
    
?>