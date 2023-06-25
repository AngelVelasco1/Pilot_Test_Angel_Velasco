<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/emergency_contact', function() {
        App\emergency_contact::Singleton(json_decode(file_get_contents("php://input"), true))->emergencyContactPost();
    });
    $router->run();
    
?>