<?php

// access layout file to access control


// simple login format

// Startup the session
$sessionCookieName = "SAMSESSID";
if ($tokenId = $cookie->get($sessionCookieName)){
    $session->start($tokenId);
} else {
    $cookie->set($sessionCookieName, $session->start());
}

function authGuard() {
    global $session;
    // Check the data available
    if (empty($session->data)){
        // route to the login page or send 401 response
        echo "you are not logged in";
        exit();
    } else {
        // check whether the data is valid or not
        if (isset($session->data['http-user-agent']) and isset($session->data['user-id'])){
            // Check the data is valid or not
            if ($session->data['http-user-agent'] == $_SERVER['HTTP_USER_AGENT'] and $session->data['user-id'] == 1){
                // Authentic User
                echo "Welcome you are logged in";
            } else {
                // route to the login page or send 401 response
                $session->data = array();
                exit();
            }
        } else {
            // route to the login page or send 401 response
            $session->data = array();
            exit();
        }
    }
}






/*
if ($cookie->get('SAMSESSID')){
    $session->start($_COOKIE['SAMSESSID']);
    echo "old set val \n";
    var_dump($session->data);
    if (empty($session->data)){
        $cookie->delete('SAMSESSID');
    }
} else {
    $cookie->set("SAMSESSID", $session->start());
    $session->data = array("name"=>"aman", "age"=>26);
    $session->close();
    echo "new set val \n";
    var_dump($session->data);
}*/


//header("HTTP/1.1 401 Unauthorized");
//exit;
