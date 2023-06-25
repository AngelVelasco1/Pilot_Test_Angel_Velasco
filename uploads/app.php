<?php 
    header("Content-Type: application/json");

    require_once "../vendor/autoload.php";
    $router = new \Bramus\Router\Router();

    $router->post('/review_skills', function() {
        App\review_skills::Singleton(json_decode(file_get_contents("php://input"), true))->reviewSkillsPost();
    });
    $router->run();
    
?>