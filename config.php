<?php
// TODO: it's for remind to check
// TODO: Application 'href' at index.html
// TODO: Storage directory "DIR_STORAGE"

// Protocol
// TODO: Change according to the server protocol http or https
define('PROTOCOL', 'http');

// Domain
// TODO: Give server domain name or ip address along with port number
define('DOMAIN', 'localhost');

// Working Directory name
// TODO: Change it or make it empty if public directory
define('WDN', 'phpsam/');

// Application Directory Name
// TODO: Change it only if you changed the 'app' directory
define('ADN', 'app/');

// Home Directory
// TODO: Change according to your server home directory
define('HOME_DIR', 'C:/xampp/');

// Public Directory
// TODO: Change according to your server public directory
define('PUBLIC_DIR', HOME_DIR . 'htdocs/');

// Base directory
define('DIR_', PUBLIC_DIR . WDN);
// Relative directory path
define('DIR_STORAGE', HOME_DIR . 'storage_sam/');
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
// TODO: Change as per your SQL database connection
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', '');
define('DB_PORT', '3306');
define('DB_PREFIX', '');

// Encryption
// TODO: Set a 32 digit key as you link
define('ENCRYPTION_HASH', '6d8d9f1ec2ec849e6dd3433213ffb734');

// Cache
define('CACHE_PREFIX', 'SAM'); // For "Alternative PHP Cache" or Memcache driver
define('CACHE_HOSTNAME', ''); // for Memcache driver
define('CACHE_PORT', ''); // for Memcache driver

// Server
define('SERVER', PROTOCOL.'://'.DOMAIN.'/');