<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

authenticated_users();
// check privacy options

$id = intval($_REQUEST['id']);
$user = new User();
$user->id = $id;
if (!$user->read()) {
	do_error("User doesn't exists.");
}

$data['view'] = 'wall';
$data['photos'] = false;
if (isset($_GET['view'])) {
	$data['view'] = $_GET['view'];
	$data['photos'] = get_photos();
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = Post::save_post('wall', $user->id);	
}

$data['friend_error'] = false;
if (isset($_POST['add_friend'])) {
	$data['friend_error'] = add_friend();
}

// data for the view
$data['user'] = $user;
$data['posts'] = Post::get_posts('wall', $user->id);
$data['friends'] = get_friends();
$data['friend_button'] = friend_button();

// load views
do_header($user->name);
do_view('profile', $data);
do_footer();


//
// profile.php functions
//

function get_photos() {
	
}

function friend_button() {
	global $db, $user, $current_user;
	
	// can't add myself as a friend
	if ($user->id == $current_user->id) {
		return false;
	}
	
	$friend_ids = get_friend_ids();
	if (in_array($user->id, $friend_ids)) {
		return false;
	}
	
	$button_name = "Request friend";
	$status = get_friend_status($current_user->id, $user->id);
	if ($status > 0) {
		$button_name = "Waiting";
	}
	
	$button = "";
	$button .= '<div style="margin-bottom:15px;">';
	$button .= '<form action="profile.php" method="post">';
	$button .= '<input type="hidden" name="from" value="' . $current_user->id . '" />';
	$button .= '<input type="hidden" name="to" value="' . $user->id . '" />';
	$button .= '<input type="hidden" name="id" value="' . $user->id . '" />';
	$button .= '<input type="submit" name="add_friend" value="' . $button_name . '" class="button" style="width:200px;" />';
	$button .= '</form>';
	$button .= '</div>';
	
	return $button;
}

function add_friend() {
	global $db, $user;
	
	$from = intval($_POST['from']);
	$to = intval($_POST['to']);
	
	if ($db->query("INSERT INTO friends (friend_from, friend_to) VALUES ($from, $to)")) {
		// add notify to user
		// notify_user('friend_request');
		header('Location: ' . profile_uri($to));
		die;
	}
	return 'Error adding as a friend';
}

function get_friends() {
	global $db, $user;
	
	$friend_ids = get_friend_ids($user->id);
	if ($friend_ids) {
		foreach ($friend_ids as $id) {
			$friend = new User();
			$friend->id = $id;
			if ($friend->read()) {
				$friends_array[] = $friend;
			}
		}
		return $friends_array;
	}
	return false;
}

?>