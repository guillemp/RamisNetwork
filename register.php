<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

$data['error'] = false;
if (isset($_POST['register'])) {
	$data['error'] = check_form();
	if ($data['error'] === false) {
		save_user();
	}
}

do_header('Register');
do_view('register', $data);
do_footer();


function check_form() {
	if (empty($_POST['name'])) {
		return 'Please, enter your name';
	}
	if (empty($_POST['lastname'])) {
		return 'Please, enter your last name';
	}
	if (!valid_email($_POST['email'])) {
		return 'Please, enter an email from <b>iesjoanramis.org</b>';
	}
	if (email_exists($_POST['email'])) {
		return 'This email is already taken';
	}
	if (empty($_POST['password'])) {
		return 'Please, enter a password';
	}
	if (strlen(trim($_POST['password'])) <= 3) {
		return 'Please, enter a password greater than 3';
	}
	if (empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year'])) {
		return 'Please, enter your birthday';
	}
	if (empty($_POST['gender'])) {
		return 'Please, select your gender';
	}
	return false;
}

function valid_email($email) {
	$parts = explode("@", trim($email));
	if ($parts[1] == 'iesjoanramis.org') {
		return true;
	}
	return false;
}

function email_exists($email) {
	global $db;
	$exists = intval($db->get_var("SELECT count(*) FROM users WHERE email='$email'"));
	if ($exists) {
		return true;
	}
	return false;
}

function save_user() {
	global $db;
	
	$user = new User();
	$user->name = $db->escape($_POST['name']);
	$user->lastname = $db->escape($_POST['lastname']);
	$user->email = $db->escape(trim($_POST['email']));
	$user->password = md5(trim($_POST['password']));
	$user->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$user->gender = ($_POST['gender'] == 'male') ? 1 : 2;
	
	// insert user into the DB
	$new_user_id = $user->store();
	
	if ($new_user_id) {
		// save activity & notification
		insert_log('user_new', 0, $new_user_id);
		//insert_notify();
		
		// redirect to profile page
		header('Location: ' . profile_uri($new_user_id));
		die;
	}
	return 'Unknown error.';
}

?>