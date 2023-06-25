<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/english_skills', function() {
        App\english_skills::Singleton(json_decode(file_get_contents("php://input"), true))->englishSkillsPost();
    });
    $router->run();
    
?>