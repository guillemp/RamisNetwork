<?php

require('config.php');
require(LIB . 'html.php');

if ($current_user->authenticated) {
	header('Location: ' . ROOT . 'home.php');
	die;
}

do_header();
do_view('index');
do_footer();

?>