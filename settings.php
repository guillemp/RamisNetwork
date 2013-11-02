<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

authenticated_users();

$user = new User();
$user->id = $current_user->id;
if (!$user->read()) do_error('invalid user');

if (isset($_POST['save'])) {
	$user->avatar = upload_avatar($user->avatar);
	$user->store();
}

$data['user'] = $user;

do_header('Settings');
do_view('settings', $data);
do_footer();


//
// settings.php functions
//

function upload_avatar($current_avatar) {
	global $user;
	
	require(LIB . 'phpthumb/ThumbLib.inc.php');
	
	$temp = $_FILES['avatar']['tmp_name'];
	$path = PATH . 'img/avatars/';
	$name = uniqid().'.jpg';	
	
	if (is_uploaded_file($temp)) {
		// create a thumbnail of 200px x 200px
		$thumb = PhpThumbFactory::create($temp);
		$thumb->adaptiveResize(200, 200);
		$thumb->save($path.$name, 'jpg');
		// remove old avatar
		@unlink($path.$current_avatar);
		// insert activity
		insert_log('avatar_change', 0, $user->id);
		return $name;
	}
	return false;
}

?>