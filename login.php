<?php

require('config.php');
require(LIB . 'html.php');

//ob_start();

$data['error'] = false;
if (isset($_POST['login'])) {
	$data['error'] = do_login();
}

if (isset($_GET['action'])) {
	$current_user->logout();
}

do_header('Login');
do_view('login', $data);
do_footer();


function do_login() {
	global $current_user;
	
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	if ($current_user->authenticate($email, md5($password)) == false) {
		return 'Invalid email or password.';	
	}
	// authenticated, redirect
	header('Location: ' . ROOT);
	die;
}

?>