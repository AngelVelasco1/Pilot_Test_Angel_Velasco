<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/design_area', function() {
        App\design_area\design_area::Singleton(json_decode(file_get_contents("php://input"), true))->designAreaPost();
    });
    $router->run();
?>