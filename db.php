<?php

if (PHP_SAPI != 'cli') {
   exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

$settings = require __DIR__ . '/src/settings.php';
$app      = new \Slim\App($settings);

require __DIR__ . '/src/dependencies.php';

$db        = $container->get('db');
$schema    = $db->schema();
$tabela    = 'produtos';

$schema->dropIfExists($tabela);

// Criar a tabela
$schema->create($tabela, function($table) {
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->date('dt_criacao');
});

$db->table($tabela)->insert([
    'titulo' => 'Smartphone Motorola G6',
    'descricao' => 'Android Oreo - 8.0',
    'preco' => 899.00,
    'fabricante' => 'Motorola',
    'dt_criacao' => '2019-10-22'
]);

$db->table($tabela)->insert([
    'titulo' => 'Iphone X Cinza Espacial',
    'descricao' => 'IOS 12 4G',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'dt_criacao' => '2020-01-10'
]);

?>