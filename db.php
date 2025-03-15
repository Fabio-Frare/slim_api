<?php
// Pemite executar somente via linha de comando. Não permite executar no browser.
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI (linha de comando).');
}

require __DIR__ . '/vendor/autoload.php';

$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/src/dependencies.php';

$db     = $container->get('db');
$schema = $db->schema(); 
$tabela = 'produtos';
$schema->dropIfExists($tabela);

$schema->create($tabela, function($table) {
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao', 100);
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->date('dt_criacao');
});

$db->table($tabela)->insert([
    'titulo'      => 'Smatphone Motorola Moto G6',
    'descricao'   => 'Android Oreo - 8.0 Tela 5.7',
    'preco'       => 899.00,
    'fabricante'  => 'Motorola',
    'dt_criacao' => '2019-10-22'
]);

$db->table($tabela)->insert([
    'titulo'      => 'Iphone X Cinza 64G',
    'descricao'   => ' Tela 5.8 IOS 12',
    'preco'       => 4500.00,
    'fabricante'  => 'Apple',
    'dt_criacao' => '2020-01-10'
]);



?>
