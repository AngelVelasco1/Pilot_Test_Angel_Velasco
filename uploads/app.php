<?php   
    require_once "../vendor/autoload.php";

    $router = new \Bramus\Router\Router();
    $router->get('/campus', function() {
        echo "Hola";
    });
    $router->run();

?>