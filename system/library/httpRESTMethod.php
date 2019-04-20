<?php

class httpRESTMethod
{
    private static function commonCallback($callbackFunction, $methodId){
        switch ($methodId){
            case '':
            case $_GET['mid']: echo json_encode($callbackFunction(json_decode(file_get_contents('php://input'))));
        }
    }

    public static function get($callbackFunction, $methodId=''){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"GET") == 0)
            self::commonCallback($callbackFunction, $methodId);
    }

    public static function post($callbackFunction, $methodId=''){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"POST") == 0)
            self::commonCallback($callbackFunction, $methodId);
    }

    public static function put($callbackFunction, $methodId=''){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"PUT") == 0)
            self::commonCallback($callbackFunction, $methodId);
    }

    public static function delete($callbackFunction, $methodId=''){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"DELETE") == 0)
            self::commonCallback($callbackFunction, $methodId);
    }
}
