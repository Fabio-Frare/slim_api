<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function() {
   
    $this->get('/produtos/lista', function(Request $request, Response $response) {

        $produtos = Produto::get();
        return $response->withJson($produtos);
    });


});





?>
