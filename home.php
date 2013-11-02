<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

authenticated_users();

$data['logs'] = get_logs();
$data['notifications'] = get_notifications();

do_header('Home');
do_view('home', $data);
do_footer();


//
// home.php functions
//

function get_notifications() {
	global $db, $current_user;
	
	$notifies = $db->get_results("SELECT * FROM notifications WHERE notification_to = $current_user->id ORDER BY notification_id DESC");
	if ($notifies) {
		$notify_array = array();
		foreach ($notifies as $notify) {
			switch ($notify->notification_type) {
				case 'post_like':
					$notify_array[] = get_post_like($notify);
					break;
				case 'photo_like':
					$notify_array[] = "X like your photo";
					break;
				case 'post_new':
					$notify_array[] = get_post_new($notify);
					break;
			}
		}
		return $notify_array;
	}
	return false;
}

function get_post_new($notify) {
	$user = new User($notify->notification_from);
	$res = '<div style="float:left;width:38px;">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" />';
	$res .= '</a></div>';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a><br/>';
	$res .= '<a href="' . ROOT . 'post.php?id=' . $notify->notification_link . '">wrote</a> on ';
	$res .= '<a href="' . profile_uri($notify->notification_to) . '">your wall</a>';
	//$res .= ' <span>' . date("H:i", strtotime($notify->notification_date)) . '</span>';	
	return $res;
}

function get_post_like($notify) {
	$user = new User($notify->notification_from);
	$res = '<div style="float:left;width:38px;">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" />';
	$res .= '</a></div>';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a><br/>likes ';
	$res .= '<a href="' . ROOT . 'post.php?id=' . $notify->notification_link . '">your post</a>';
	//$res .= ' <span>' . date("H:i", strtotime($notify->notification_date)) . '</span>';
	return $res;
}

//
// Logs
//
function get_logs() {
	global $db;
	
	$logs = $db->get_results("SELECT * FROM logs ORDER BY log_id DESC LIMIT 20");
	if ($logs) {
		$logs_array = array();
		foreach ($logs as $log) {
			switch ($log->log_type) {
				case 'post_new':
					$logs_array[] = get_post_new_log($log);
					break;
				case 'user_new':
					$logs_array[] = get_user_new_log($log);
					break;
				case 'post_like':
					$logs_array[] = get_post_like_log($log);
					break;
				case 'avatar_change':
					$logs_array[] = get_avatar_change_log($log);
					break;
				default:
					$logs_array[] = 'Something<br/>';
			}
		
		}
		return $logs_array;
	}
	return false;
}

function get_avatar_change_log($log) {
	$user = new User($log->log_user);
	return $user->name . ' changed his profile picture.';
}

function get_post_like_log($log) {
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$user_to = new User($post->author);
	
	$res = '';
	$res .= '<img src="' . ROOT . 'img/like.png" width="16" height="16" />';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a> likes ';
	$res .= '<a href="' . profile_uri($user_to->id) . '">' . $user_to->name . '</a>\'s post';
	$res .= '<br/><div style="margin-left:30px;">' . $post->content;
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	return $res;
}

function get_user_new_log($log) {
	global $db;
	
	$user = new User($log->log_user);
	return '<img src="' . ROOT . 'img/user_new.png">&nbsp;<a href="' . profile_uri($user->id) . '">' . $user->name . '</a> has been registered';
}

function get_post_new_log($log) {
	global $db;
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$user_to = new User($post->link);
	
	return '<img src="' . ROOT . 'img/post_new.png">&nbsp;<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a> wrote a message to <a href="' . profile_uri($post->link) . '">' . $user_to->name . '</a><br/><div style="margin-left:30px;">' . $post->content . '</div>';
}

?>