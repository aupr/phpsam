<?php

// access layout file to access control


// simple login format

$devMode = true;
$sessionCookieName = "SAMSESSID";
if ($devMode){
    // Allow CORS headers
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    // set the defined token for development mode
    $session->start('thisIsDevelopmentModeToken');
} else {
    // Startup the session
    if ($tokenId = $cookie->get($sessionCookieName)){
        $session->start($tokenId);
    } else {
        $cookie->set($sessionCookieName, $session->start());
    }
}


function response_401(){
    global $session;
    header("HTTP/1.1 401 Unauthorized");
    $session->data = array();
    exit();
}

function authGuard() {
    global $session;
    // Check the data available
    if (empty($session->data)){
        response_401();
    } else {
        // check whether the data is valid or not
        if (isset($session->data['http-user-agent']) and isset($session->data['user-id'])){
            // Check the data is valid or not
            if ($session->data['http-user-agent'] == $_SERVER['HTTP_USER_AGENT']){
                // Authentic User
                // echo "Welcome you are logged in";
            } else {
                response_401();
            }
        } else {
            response_401();
        }
    }
}

function login($userId, $password) {
    global $session;
    // fetch data from database and verify
    if ( $userId == "111" and  $password == "1234") {
        $session->data = array(
            "http-user-agent" => $_SERVER['HTTP_USER_AGENT'],
            "user-id" => $userId
        );
    }
}

function logout() {
    global $session;
    $session->data = array();
}

