<?php

namespace Application\Middlewares;

use Application\Libraries\AuthenticationLibrary;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

final class AuthenticationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $request->getUri()->getPath();

        if($this->checkRoute($route)){
            return $handler->handle($request);
        } else {
            $token = AuthenticationLibrary::getTokenFromRequest($request);

            if(empty($token)){
                $json = json_encode([
                    "success" => false,
                    "title" => "Ops!",
                    "message" => "Token de acesso não informado.",
                    "redirect" => null,
                    "content" => null
                ]);

                $response = new Response();
                $response->getBody()->write($json);

                return $response->withStatus(403)->withHeader('Content-Type', 'application/json');
            }

            $data = AuthenticationLibrary::decode($token->getToken());

            if($data->exp < time()){
                $json = json_encode([
                    "success" => false,
                    "title" => "Ops!",
                    "message" => "Token expirado.",
                    "redirect" => null,
                    "content" => null
                ]);

                $response = new Response();
                $response->getBody()->write($json);

                return $response->withStatus(403)->withHeader('Content-Type', 'application/json');
            }

            return $handler->handle($request);
        }
    }

    private function checkRoute(string $route): bool
    {
        if(mb_strpos($route, "authentication/token") || mb_strpos($route, "authentication/check")){
            return true;
        }

        if(mb_strpos($route, "status")){
            return true;
        }

        if(mb_strpos($route, "documentation")){
            return true;
        }

        if(mb_strpos($route,"website")){
            return true;
        }

        return false;
    }
}