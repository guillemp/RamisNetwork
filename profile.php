<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

// only logged users can view this
if (!$current_user->authenticated) {
	// check privacy options
	
	header('Location: ' . ROOT);
	die;
}

$id = intval($_GET['id']);
if ($id == 0) do_error("Invalid arguments.");
$user = new User();
$user->id = $id;
if (!$user->read()) {
	do_error("User doesn't exists.");
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = Post::save_post($user->id);	
}

// data for view
$data['user'] = $user;
$data['posts'] = get_posts();
$data['friends'] = get_friends();

// load views
do_header($user->name);
do_view('profile', $data);
do_footer();


//
// profile.php functions
//

function get_posts() {
	global $db, $user;
	
	$post_ids = $db->get_col("SELECT post_id FROM posts WHERE post_type = 'wall' AND post_link = $user->id ORDER BY post_id DESC");
	if ($post_ids) {
		foreach ($post_ids as $id) {
			$post = new Post();
			$post->id = $id;
			if ($post->read()) {
				$data[] = $post;
			}
		}
		return $data;
	}
	return false;
}

function get_friends() {
	global $db, $user;
	
	$friend_ids = $db->get_col("SELECT friend_to FROM friends WHERE friend_from = $user->id UNION SELECT friend_from FROM friends WHERE friend_to = $user->id");
	if ($friend_ids) {
		foreach ($friend_ids as $id) {
			$friend = new User();
			$friend->id = $id;
			if ($friend->read()) {
				$data[] = $friend;
			}
		}
		return $data;
	}
	return false;
}

?>