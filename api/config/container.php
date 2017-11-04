<?php

declare(strict_types=1);

return (function (): \Zend\ServiceManager\ServiceManager {
    $config = include __DIR__ . '/config.php';

    $dependencies = $config['dependencies'];
    $dependencies['services']['config'] = $config;

    return new \Zend\ServiceManager\ServiceManager($dependencies);
})();
