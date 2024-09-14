<?php

namespace Application\Controllers;

use Application\Helpers\PermissionHelper;
use Application\Libraries\AuthenticationLibrary;
use Application\Models\User\LevelModel;
use Application\ViewModel\LevelFilterViewModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LevelController
{
    public function search(Request $request, Response $response, $args): Response
    {
        if(!PermissionHelper::check($request, $this, __FUNCTION__)){
            $response->getBody()->write(PermissionHelper::denyAccessResponseMessage());
        } else {
            $filter = new LevelFilterViewModel($request->getParsedBody());

            $list = LevelModel::search($filter);
            $count = count($list);

            $response->getBody()->write(json_encode([
                "success" => true,
                "title" => "Ok",
                "message" => "Busca executada com sucesso. {$count} registro(s) localizados",
                "redirect" => null,
                "content" => $list
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function load(Request $request, Response $response, $args): Response
    {
        if(!PermissionHelper::check($request, $this, __FUNCTION__)){
            $response->getBody()->write(PermissionHelper::denyAccessResponseMessage());
        } else {
            $filter = new LevelFilterViewModel($request->getParsedBody());

            $list = LevelModel::search($filter);
            $count = count($list);

            $response->getBody()->write(json_encode([
                "success" => true,
                "title" => "Ok",
                "message" => "Busca executada com sucesso. {$count} registro(s) localizados",
                "redirect" => null,
                "content" => $list
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function save(Request $request, Response $response, $args): Response
    {
        if(!PermissionHelper::check($request, $this, __FUNCTION__)){
            $response->getBody()->write(PermissionHelper::denyAccessResponseMessage());
        } else {
            $filter = new LevelFilterViewModel($request->getParsedBody());

            $list = LevelModel::search($filter);
            $count = count($list);

            $response->getBody()->write(json_encode([
                "success" => true,
                "title" => "Ok",
                "message" => "Busca executada com sucesso. {$count} registro(s) localizados",
                "redirect" => null,
                "content" => $list
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, $args): Response
    {
        if(!PermissionHelper::check($request, $this, __FUNCTION__)){
            $response->getBody()->write(PermissionHelper::denyAccessResponseMessage());
        } else {
            $filter = new LevelFilterViewModel($request->getParsedBody());

            $list = LevelModel::search($filter);
            $count = count($list);

            $response->getBody()->write(json_encode([
                "success" => true,
                "title" => "Ok",
                "message" => "Busca executada com sucesso. {$count} registro(s) localizados",
                "redirect" => null,
                "content" => $list
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}