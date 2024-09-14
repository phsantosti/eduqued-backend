<?php

namespace Application\Controllers;

use Application\Helpers\PasswordHelper;
use Application\Helpers\PermissionHelper;
use Application\Libraries\AuthenticationLibrary;
use Application\Models\User\UserModel;
use Application\ViewModel\LoginViewModel;
use Application\ViewModel\TokenViewModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthenticationController
{
    public function token(Request $request, Response $response, $args): Response
    {
        $login = new LoginViewModel($request->getParsedBody());
        if($login->grantType !== "client_credentials"){
            $response->getBody()->write(PermissionHelper::denyAccessResponseMessage());
        } else {
            if(!PasswordHelper::isValid($login->email)){
                $response->getBody()->write(json_encode([
                    "success" => false,
                    "title" => "Ops!",
                    "message" => "E-mail inválido.",
                    "redirect" => null,
                    "content" => null
                ]));
            } else {
                $user = (new UserModel())->find("email = :email", "email={$login->email}")->fetch();
                if(empty($user)){
                    $response->getBody()->write(json_encode([
                        "success" => false,
                        "title" => "Ops!",
                        "message" => "E-mail não cadastrado.",
                        "redirect" => null,
                        "content" => null
                    ]));
                } else {
                    if(!PasswordHelper::check($login->password, $user->password)){
                        $response->getBody()->write(json_encode([
                            "success" => false,
                            "title" => "Ops!",
                            "message" => "Senha inválida.",
                            "redirect" => null,
                            "content" => null
                        ]));
                    } else {
                        if($user->status != "active"){
                            $response->getBody()->write(json_encode([
                                "success" => false,
                                "title" => "Ops!",
                                "message" => "Conta inativa.",
                                "redirect" => null,
                                "content" => null
                            ]));
                        } else {
                            $token = AuthenticationLibrary::encode($user->data());
                            $tokenViewModel = new TokenViewModel("Bearer", $token);

                            $response->getBody()->write(json_encode([
                                "success" => true,
                                "title" => "Sucesso!",
                                "message" => "Token gerado com sucesso!",
                                "redirect" => null,
                                "content" => $tokenViewModel->data()
                            ]));
                        }
                    }
                }
            }
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}