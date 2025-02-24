<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function() {
   
    // Lista produtos
    $this->get('/produtos/lista', function(Request $request, Response $response) {
        $produtos = Produto::get();
        return $response->withJson($produtos);
    });

      // Adiciona um produto
    $this->post('/produtos/adiciona', function(Request $request, Response $response) {
        $dados   = $request->getParsedBody();  //Validar dados recebidos e fazer tratamento        
        $produto = Produto::create($dados);
        return $response->withJson($produto);
    });

    // Recupera um produto por ID
    $this->get('/produtos/lista/{id}', function(Request $request, Response $response, $args) {       
        $produto = Produto::findOrFail($args['id']);
        return $response->withJson($produto);
    });

    // Atualiza um produto por ID
    $this->put('/produtos/atualiza/{id}', function(Request $request, Response $response, $args) {
        $dados   = $request->getParsedBody();  //Validar dados recebidos e fazer tratamento 
        $produto = Produto::findOrFail($args['id']);
        $produto->update($dados);
        return $response->withJson($produto);
    });

    // Remover um produto por ID
    $this->get('/produtos/remove/{id}', function(Request $request, Response $response, $args) {       
        $produto = Produto::findOrFail($args['id']);
        $produto->delete();
        return $response->withJson($produto);
    });


});





?>
