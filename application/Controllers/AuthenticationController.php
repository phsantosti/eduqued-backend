<?php

namespace Application\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthenticationController
{
    public function token(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write(json_encode([
            "success" => true,
            "title" => "Ok",
            "message" => "Mensagem aqui",
            "redirect" => null,
            "content" => null
        ]));

        return $response;
    }
}