<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/soft_skills', function() {
        App\soft_skills::Singleton(json_decode(file_get_contents("php://input"), true))->softSkillsPost();
    });
    $router->run();
    
?>