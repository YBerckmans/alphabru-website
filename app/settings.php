<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

(Dotenv\Dotenv::create(__DIR__.'\..'))->load();

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => false, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],

            'smtp_host' =>  $_ENV['smtp_host'],
            'smtp_username' =>  $_ENV["smtp_username"],
            'smtp_password' => $_ENV["smtp_password"],
            'smtp_from' =>  $_ENV["smtp_from"],
            'smtp_to' =>	$_ENV["smtp_to"], 
			'smtp_port' => $_ENV['smtp_port'],
        ],
    ]);
};
