<?php

httpMethod::get(function (){
    echo "iam from get fnc: ";
});

echo file_get_contents('php://input');

echo '<br><br><br>';

class A{
    static function cb($callB) {
        $callB(10);
    }
}

A::cb(function ($data) {
    echo "method call $data";
});

function doIt($callback) {
    $callback();
}

doIt(function() {
    echo '<br><br>call back function working';
});


echo "<pre>";

var_dump($_SERVER);
