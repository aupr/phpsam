<?php

// Name
define('NAME', 'PHP-SAAM');

// Version
define('VERSION', '1.1.1');

// Configuration
require_once('config.php');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Start Routing
require_once start('expose');
