<?php

class httpMethod
{
    static function get($process){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"GET") == 0)
            $process($_SERVER["QUERY_STRING"]);
    }

    static function post($process){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"POST") == 0)
            $process(file_get_contents('php://input'));
    }

    static function put($process){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"PUT") == 0)
            $process(file_get_contents('php://input'));
    }

    static function delete($process){
        if (strcasecmp($_SERVER["REQUEST_METHOD"],"DELETE") == 0)
            $process(file_get_contents('php://input'));
    }
}
