<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// db
$container['db'] = function($c) {
    $capsule = new Capsule;
    $capsule->addConnection($c->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();    
    return $capsule;
};

