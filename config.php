<?php

//
// User config
//

define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'ramis');
define('DB_HOST', 'localhost');

define('ROOT', '/RamisNetwork/');

//
// You don't have to change anything more
//

// Show errors
ini_set('display_errors','1');
ini_set('display_startup_errors','1');

// all errors, noticies too
//error_reporting (E_ALL);

// only errors, not notices
error_reporting (E_ALL ^ E_NOTICE);

define('PATH', dirname(__FILE__) . '/');
define('LIB', dirname(__FILE__) . '/lib/');
define('VIEWS', dirname(__FILE__) . '/views/');

require(LIB . 'db.php');
require(LIB . 'Login.php');
require(LIB . 'functions.php');

?>