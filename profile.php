<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');
require(LIB . 'Photo.php');

// TODO: check privacy options
authenticated_users();

$user = new User();
$user->id = intval($_REQUEST['id']);
if (!$user->read()) {
	do_error("User doesn't exists.");
}

$data['view'] = 'wall';
$data['photos'] = false;
if (isset($_GET['view'])) {
	$data['view'] = $_GET['view'];
	$data['photos'] = Photo::get_photos('wall', $user->id);
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = Post::save_post('wall', $user->id);	
}

$data['photo_error'] = false;
if (isset($_POST['upload'])) {
	$data['photo_error'] = Photo::save_photo('wall', $user->id);	
}

$data['friend_error'] = false;
if (isset($_POST['add_friend'])) {
	$from = intval($_POST['from']);
	$to = intval($_POST['to']);
	$data['friend_error'] = User::add_friend($from, $to);
}

// data for the view
$data['user'] = $user;
$data['posts'] = Post::get_posts('wall', $user->id);
$data['friends'] = User::get_friends($user->id);

// add new visit
add_visit();

// load views
do_header($user->name);
do_view('profile', $data);
do_footer();


//
// profile.php functions
//

function add_visit() {
	global $db, $user, $current_user;	
	if ($current_user->id != $user->id) {
		$db->query("UPDATE users SET visits = visits + 1 WHERE id = $user->id");
	}
}

?>