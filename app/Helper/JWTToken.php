<?php

namespace App\Helper;



use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
   public static function encodeJWT($email , $id)
    {
        $key = env("JWT_KEY");
        $payload = [
            "iss"=>"token",
            "iat" => time(),
            "exp" => time() + 3601,
            "email" => $email,
            "id" => $id

        ];
        return JWT::encode($payload, $key , "HS256");
    }

    public static function decodeJWT($token){
        $key = env("JWT_KEY");
        return JWT::decode($token, new Key($key, "HS256") );
    }
}
