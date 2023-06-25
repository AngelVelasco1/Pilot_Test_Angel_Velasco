<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/software_skills', function() {
        App\software_skills::Singleton(json_decode(file_get_contents("php://input"), true))->softwareSkillsPost();
    });
    $router->run();
    
?>