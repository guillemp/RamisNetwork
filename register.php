<?php

require('config.php');
require(LIB . 'html.php');

$data['error'] = false;
if (isset($_POST['register'])) {
	$data['error'] = check_form();
	if ($data['error'] === false) {
		// register user
	}
}

do_header();
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
		return 'Please, enter an email from iesjoanramis.org';
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

?>