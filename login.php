<?php

require('config.php');
require(LIB . 'html.php');

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


//
// login.php functions
//

function do_login() {
	global $db, $current_user;
	
	$email = $db->escape(trim($_POST['email']));
	$password = trim($_POST['password']);
	$remember = ($_POST['remember']) ? true : false;
	
	if ($current_user->authenticate($email, md5($password), $remember) == false) {
		return 'Invalid email or password.';	
	}
	// authenticated, redirect to home
	header('Location: ' . ROOT . 'home.php');
	die;
}

?>