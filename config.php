<?php
// TODO: it's a remind to check the angular app 'href' at index.html

// HTTP
// TODO: have to change
define('HTTP_SERVER', 'http://localhost/');

// HTTPS
// TODO: have to change
define('HTTPS_SERVER', 'http://localhost/');

// Working Directory name
// TODO: Change it or make it empty if public directory
define('WDN', 'phpsaam/');

// Application Directory Name
// TODO: Change it only if you changed the 'app' directory
define('ADN', 'app/');

// Home Directory
// TODO: have to change
define('HOME_DIR', 'C:/xampp/');

// Public Directory
// TODO: have to change
define('PUBLIC_DIR', HOME_DIR . 'htdocs/');


// Base directory
define('DIR_', PUBLIC_DIR . WDN);
// Relative directory path
define('DIR_STORAGE', HOME_DIR . 'storage_sam_ucm/');
define('DIR_API', DIR_ .'api/');
define('DIR_TRANSFER', DIR_ .'transfer/');
define('DIR_APPFILE', DIR_ .'appfile/');
define('DIR_SYSTEM', DIR_ .'system/');
define('DIR_LAYOUT', DIR_ .'layout/');
define('DIR_LIBRARY', DIR_SYSTEM .'library/');
define('DIR_EXTLIB', DIR_SYSTEM .'extlib/');
define('DIR_CACHE', DIR_STORAGE .'cache/');
define('DIR_FILE', DIR_STORAGE . 'file/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_SESSION', DIR_STORAGE . 'session/');


// DB
// TODO: have to update sql connection data
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', '');
define('DB_PORT', '3306');
define('DB_PREFIX', '');

// Encryption
// TODO: have to chance the encryption hash key
define('ENCRYPTION_HASH', '6d2d9f1ec2ec849e9dd3433213ffb509');

// Cache
define('CACHE_PREFIX', 'SAAM'); // For "Alternative PHP Cache" or Memcache driver
define('CACHE_HOSTNAME', ''); // for Memcache driver
define('CACHE_PORT', ''); // for Memcache driver
