<?php

// Show errors
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
//error_reporting (E_ALL); // all errors, noticies too
error_reporting (E_ALL ^ E_NOTICE); // only errors, not notices

define('ROOT', '/RamisNetwork/');
define('PATH', dirname(__FILE__) . '/');
define('LIB', dirname(__FILE__) . '/lib/');
define('VIEWS', dirname(__FILE__) . '/views/');

require(LIB . 'db.php');
require(LIB . 'Login.php');
require(LIB . 'functions.php');

?>