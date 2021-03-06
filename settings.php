<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

authenticated_users();

$user = new User();
$user->id = $current_user->id;
if (!$user->read()) {
	do_error('Invalid user');
}

$data['msg'] = false;
if (isset($_POST['save_settings'])) {
	$data['msg'] = save_settings();
}

$data['user'] = $user;

do_header('Settings');
do_view('settings', $data);
do_footer();


//
// settings.php functions
//

function save_settings() {
	global $db, $user, $current_user;
	
	if (empty($_POST['name'])) {
		return array('error' => 'Please, enter your name');
	}
	if (empty($_POST['lastname'])) {
		return array('error' => 'Please, enter your last name');
	}
	if (!valid_email($_POST['email'])) {
		return array('error' => 'Please, enter an email from <b>iesjoanramis.org</b>');
	}
	if ($user->email != trim($_POST['email']) && email_exists($_POST['email'])) {
		return array('error' => 'This email is already taken');
	}
	if (!empty($_POST['password']) || !empty($_POST['password2'])) {
		if (trim($_POST['password']) != trim($_POST['password2'])) {
			return array('error' => 'Passwords doesn\'t match');
		}
		if (strlen(trim($_POST['password'])) <= 3) {
			return array('error' => 'Please, enter a password greater than 3');
		}
		// set new password
		$user->password = md5(trim($_POST['password']));
	}
	if (empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year'])) {
		return array('error' => 'Please, enter your birthday');
	}
	if (empty($_POST['gender'])) {
		return array('error' => 'Please, select your gender');
	}
	
	$user->name = $db->escape($_POST['name']);
	$user->lastname = $db->escape($_POST['lastname']);
	$user->email = $db->escape(trim($_POST['email']));
	$user->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$user->gender = ($_POST['gender'] == 'male') ? 1 : 2;
	$user->avatar = upload_avatar();
	
	// store to the database
	$user->store();
	$user->read();
	
	return array('done' => 'Changes saved');
}

function upload_avatar() {
	global $db, $user;
	
	$temp = $_FILES['avatar']['tmp_name'];
	$path = PATH . 'img/avatars/';
	$name = uniqid().'.jpg';
	
	// no avatar, return the old one
	if (empty($temp)) return $user->avatar;
	
	if (is_uploaded_file($temp)) {
		// include phpthumb library
		require(LIB . 'phpthumb/ThumbLib.inc.php');
		
		// Create a thumbnail of 200x200
		$thumb = PhpThumbFactory::create($temp);
		$thumb->adaptiveResize(200, 200);
		$thumb->save($path.$name, 'jpg');
		
		// Remove old avatar
		@unlink($path.$user->avatar);
		
		// Insert a new activity, sure? not...
		insert_log('avatar_change', 0, $user->id);
		
		return $name;
	}
	return $user->avatar;
}

?>