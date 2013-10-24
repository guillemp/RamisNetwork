<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

$user = new User();
$user->id = $current_user->id;
if (!$user->read()) do_error('invalid user');

if (isset($_POST['save'])) {
	$user->avatar = upload_avatar();
	$user->store();
}

$data['user'] = $user;

do_header('Settings');
do_view('settings', $data);
do_footer();


function upload_avatar() {
	$temp = $_FILES['avatar']['tmp_name'];
	$name = uniqid() . '.jpg';	
	$dest = PATH . 'img/pics/' . $name;
	
	if (is_uploaded_file($temp)) {
		if (move_uploaded_file($temp, $dest)) {
			//
			// remove old avatar from server
			//
			return $name;
		}
	}
	return false;
}

?>