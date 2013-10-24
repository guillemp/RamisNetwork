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
	if (empty($_POST['password'])) {
		return 'Please, enter a password';
	}
	if (empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year'])) {
		return 'Please, enter you birthday';
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

function save_user() {
	global $db;
	
	$user = new User();
	$user->name = $db->escape($_POST['name']);
	$user->lastname = $db->escape($_POST['lastname']);
	$user->email = $db->escape($_POST['email']);
	$user->password = md5(trim($_POST['password']));
	$user->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$user->gender = ($_POST['male'] == 'male') ? 1 : 2;
	
	$user_id = $user->store();
	if ($user_id) {
		// save activity
		insert_log('user_new', 0, $user_id);
		// redirect to profile page
		header('Location: ' . profile_uri($user_id));
		die;
	}
	return 'Unknown error.';
}

?>