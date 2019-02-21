<?php

// HTTP
define('HTTP_SERVER', 'http://localhost/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/');

// Working Directory name
define('WDN', 'phpsaam/');

// Application Directory Name
define('ADN', 'app/');

// Home Directory
define('HOME_DIR', 'C:/xampp/'); //in cloud '/home/'

// Public Directory
define('PUBLIC_DIR', HOME_DIR . 'htdocs/'); //in cloud 'domainName/public_html'

// Working Directory
define('DIR_', PUBLIC_DIR . WDN);

// DIR_RELATIVE_PATH
define('DIR_STORAGE', HOME_DIR . 'storage_sam/');
define('DIR_API', DIR_ .'api/');
define('DIR_TRANSFER', DIR_ .'transfer/');
define('DIR_APPFILE', DIR_ .'appfile/');
define('DIR_SYSTEM', DIR_ .'system/');
define('DIR_LAYOUT', DIR_ .'layout/');
define('DIR_LIBRARY', DIR_ .'system/library/');
define('DIR_EXTLIB', DIR_ .'system/extlib/');
define('DIR_CACHE', DIR_STORAGE .'cache/');
define('DIR_FILE', DIR_STORAGE . 'file/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_SESSION', DIR_STORAGE . 'session/');


// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', '');
define('DB_PORT', '3306');
define('DB_PREFIX', '');

// Encryption
define('ENCRYPTION_HASH', '6d2d9f1ec2ec849e9dd3433213ffb509');

// Cache
define('CACHE_PREFIX', 'SAM'); // For "Alternative PHP Cache" or Memcache driver
define('CACHE_HOSTNAME', ''); // for Memcache driver
define('CACHE_PORT', ''); // for Memcache driver
