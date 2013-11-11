<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

$form_error = false;

if (isset($_POST['register'])) {	
	// Check fields if the are correct
	$form_error = check_form();
	
	if ($form_error === false) {
		// if it's all ok, save user
		$user_id = User::save_user();
		
		// now, login the user
		$user = new User();
		$user->id = $user_id;
		if ($user->read()) {
			$current_user->authenticate($user->email, $user->password);
			// authenticated, redirect to home
			header('Location: ' . ROOT . 'home.php');
			die;
		}
	}
}

// Pass data to the view
$data['error'] = $form_error;

do_header('Register');
do_view('register', $data);
do_footer();

//
// register.php functions
//

function save_user() {
	$user = new User();
	$user->name = $db->escape($_POST['name']);
	$user->lastname = $db->escape($_POST['lastname']);
	$user->email = $db->escape(trim($_POST['email']));
	$user->password = md5(trim($_POST['password']));
	$user->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$user->gender = ($_POST['gender'] == 'male') ? 1 : 2;

	// insert user into the DB
	return $user->store();
}

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

?>