<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Course.php');

$form_error = false;

if (isset($_POST['register'])) {
	// form validation
	$form_error = check_form();
	
	if ($form_error === false) {
		// save the new user		
		$new_user_id = User::save_user();
		if ($new_user_id > 0) {
			header('Location: ' . ROOT . 'register.php?done=1');
			die;
		}
	}
}

// Pass data to the view
$data['error'] = $form_error;
$data['courses'] = Course::get_courses();

do_header('Register');

if (empty($_GET['done'])) {
	do_view('register', $data);
} else {
	do_view('register_done');
}

do_footer();


// form validation
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
	if (empty($_POST['course'])) {
		return 'Please, select your course';
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