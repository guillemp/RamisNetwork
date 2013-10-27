<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

// only logged users can view this
if (!$current_user->authenticated) {
	header('Location: ' . ROOT);
	die;
}

$data['logs'] = get_logs();

do_header('Home');
do_view('home', $data);
do_footer();


//
// home.php functions
//

function get_logs() {
	global $db;
	
	$logs = $db->get_results("SELECT * FROM logs ORDER BY log_id DESC");
	if ($logs) {
		foreach ($logs as $log) {
			switch ($log->log_type) {
				case 'post_new':
					$data['logs'][] = get_post_new($log);
					break;
				case 'user_new':
					$data['logs'][] = get_user_new($log);
					break;
				default:
					$data['logs'][] = 'Something<br/>';
			}
		
		}
		return $data['logs'];
	}
	return false;
}

function get_user_new($log) {
	global $db;
	
	$user = new User($log->log_user);
	return '<img src="' . ROOT . 'img/user_add.png">&nbsp;<a href="' . profile_uri($user->id) . '">' . $user->name . '</a> has been registered';
}

function get_post_new($log) {
	global $db;
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$user_to = new User($post->link);
	
	return '<img src="' . ROOT . 'img/comment.png">&nbsp;<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a> wrote a message to <a href="' . profile_uri($post->link) . '">' . $user_to->name . '</a><br/><div style="margin-left:30px;">' . $post->content . '</div>';
}

?>