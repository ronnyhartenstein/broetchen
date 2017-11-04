<?php

//declare(strict_types=1);

chdir(dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';


(function (\Interop\Container\ContainerInterface $container) {
    $app = $container->get(\Zend\Expressive\Application::class);

    (require __DIR__ .'/../config/pipeline.php')($app);
    (require __DIR__ .'/../config/routes.php')($app);

    $app->run();
})(require __DIR__ . '/../config/container.php');
