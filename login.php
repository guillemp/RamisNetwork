<?php

require('config.php');
require(LIB . 'html.php');

$error = false;
if (isset($_POST['login'])) {
	$error = do_login();
}

if (!empty($_GET['action']) && $_GET['action'] == 'logout') {
	$current_user->logout();
}

$data['error'] = $error;
$data['return'] = !empty($_GET['return']) ? $_GET['return'] : '';

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
	
	if (!empty($_POST['return'])) {
		header('Location: ' . $_POST['return']);
	} else {
		header('Location: ' . ROOT . 'home.php');
	}	
	die;
}

?>