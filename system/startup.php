<?php

// Redirect to the Application location
if(sizeof($_GET) == 0){
    header("location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].explode("?", $_SERVER["REQUEST_URI"])[0].ADN);
    exit();
}

// Load the required class on demand
spl_autoload_register(function ($class_name) {
    if (file_exists(DIR_LIBRARY . $class_name . '.php')) {
        include_once DIR_LIBRARY . $class_name . '.php';
    } elseif (file_exists(DIR_EXTLIB . $class_name . '.php')) {
        include_once DIR_EXTLIB . $class_name . '.php';
    } else {
        foreach (glob(DIR_EXTLIB . '*', GLOB_ONLYDIR) as $fpath) {
            if (file_exists($fpath . '/' . $class_name . '.php')) {
                include_once $fpath . '/' . $class_name . '.php';
            }
        }
    }
});

// Set the value of configuration from target ini file
foreach (parse_ini_file(DIR_ . 'sw.ini') as $key => $value) {
    ini_set($key, $value);
}

// URL router object
global $url;
$url = new url(HTTP_SERVER . WDN);

// Encryption manager object
global $encryption;
// TODO: have to change the deprecated function considering php version
$encryption = new encryption(ENCRYPTION_HASH);

// Database manager object
global $db;
$db = new db(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_PREFIX . DB_DATABASE, DB_PORT);

// Cache manager object
global $cache;
$cache = new cache('file', 3600);

// Cookie manager object
global $cookie;
$cookie = new cookie(WDN);

// Session manager object
global $session;
// TODO: have to review the class for session name comparison
$session = new session('native', WDN);

// File downloader object
global $downloader;
$downloader = new downloader(DIR_FILE);

// Mail sender object
global $mail;
$email = new mail();

// Log manager object
global $error_log;
global $query_log;
$error_log = new log(DIR_LOGS, 'error.log');
$query_log = new log(DIR_LOGS, 'query.log');


// Including the layout files
foreach (glob(DIR_LAYOUT . '*', GLOB_ONLYDIR) as $fpath) {
    foreach (glob($fpath . '/*.php', GLOB_NOSORT) as $file) {
        require_once $file;
    }
}

// Including the security layout file
if (file_exists(DIR_LAYOUT . 'access.php')) {
    include_once DIR_LAYOUT . 'access.php';
} else {
    throw new \Exception("Error: Could not find the security layout file!");
}

// Default route function
function routeDefault($fname)
{
    if (sizeof($ires = glob(DIR_API . $fname . '.*', GLOB_NOSORT))) {
        return $ires[0];
    } else {
        exit("{File $fname not found at api directory!}");
    }
}

// Route function
function start($fname)
{
    if (isset($_REQUEST['api'])) {
        $exitMsg = '{PHPSAM-Invalid-API-Route}';
        if (!strlen($_REQUEST['api'])) exit($exitMsg);
        if (sizeof($ires = glob(DIR_API . $_REQUEST['api'] . '.*', GLOB_NOSORT))) {
            return $ires[0];
        } else {
            exit($exitMsg);
        }
    } elseif (isset($_REQUEST['transfer'])) {
        $exitMsg = '{PHPSAM-Invalid-File-Transfer-Route}';
        if (!strlen($_REQUEST['transfer'])) exit($exitMsg);
        if (sizeof($ires = glob(DIR_TRANSFER . $_REQUEST['transfer'] . '.*', GLOB_NOSORT))) {
            return $ires[0];
        } else {
            exit($exitMsg);
        }
    } else {
        return routeDefault($fname);
    }
}
