<?php 
    header("Content-Type: application/json");
    require_once "./vendor/autoload.php";
    
    $router = new \Bramus\Router\Router();

    $router->get('/academic_area', function() {
        App\academic_area::Singleton(json_decode(file_get_contents("php://input"), true))->getAllAcademicArea();
    });
    $router->run();
?>