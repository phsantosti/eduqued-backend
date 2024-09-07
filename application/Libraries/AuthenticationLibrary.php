<?php

namespace Application\Libraries;

use Application\ViewModel\TokenViewModel;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ServerRequestInterface;

final class AuthenticationLibrary
{
    public static function encode(object $data): ?string
    {
        $domain = CONF_APP_DOMAIN;
        $securityKey = CONF_APP_SECURITY_KEY;
        $now = time();
        $payload = [
            "sub" => $data->id,
            "iss" => "https://{$domain}",
            "exp" => $now + 86400,
            "iat" => $now,
            "aud" => "https://{$domain}",
            "data" => $data
        ];

        return JWT::encode($payload, $securityKey, 'HS256');
    }

    public static function decode(string $token): ?object
    {
        try{
            $key = new Key(CONF_APP_SECURITY_KEY, 'HS256');
            return JWT::decode($token, $key);
        } catch (ExpiredException $exception){
            return null;
        }
    }

    public static function getTokenFromRequest(ServerRequestInterface $request): ?TokenViewModel
    {
        if(!$request->hasHeader("Authorization")){
            return null;
        } else {
            $authorization = $request->getHeader("Authorization")[0];
            $authorizationData = explode(" ", $authorization);

            return new TokenViewModel($authorizationData[0], $authorizationData[1]);
        }
    }
}