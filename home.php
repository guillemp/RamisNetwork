<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');
require(LIB . 'Photo.php');
require(LIB . 'Course.php');

authenticated_users();

if (isset($_POST['accept'])) {
	$friend_id = intval($_POST['id']);
	User::accept_request($friend_id);
}

$data['requests'] = get_requests();
$data['logs'] = get_logs();
$data['notifications'] = get_notifications();

do_header('Home');
do_view('home', $data);
do_footer();


//
// home.php functions
//

function get_requests() {
	global $db, $current_user;
	
	$arr = array();
	$requests = $db->get_results("SELECT * FROM friends WHERE friend_to=$current_user->id AND friend_status=0");
	if ($requests) {
		foreach ($requests as $request) {
			$arr[] = $request;
		}
	}
	return $arr;
}

function get_notifications() {
	global $db, $current_user;
	
	$notifies = $db->get_results("SELECT * FROM notifications WHERE notification_to = $current_user->id ORDER BY notification_id DESC LIMIT 10");
	if ($notifies) {
		$notify_array = array();
		foreach ($notifies as $notify) {
			switch ($notify->notification_type) {
				case 'post_like':
					$notify_array[] = get_post_like($notify);
					break;
				case 'wall_post_new':
					$notify_array[] = get_post_new($notify);
					break;
				case 'reply_new':
					$notify_array[] = get_reply_new($notify);
					break;
				case 'friend_new':
					$notify_array[] = get_friend_new($notify);
					break;
				default:
					$notify_array[] = 'Unknown notification<br/>';
			}
		}
		return $notify_array;
	}
	return false;
}

function get_friend_new($notify) {
	$user = new User($notify->notification_from);
	
	$res = '';
	$res .= '<div class="sidebar-left">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" /></a>';
	$res .= '</div>';
	
	$res .= '<div class="sidebar-right">';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a> is now your friend';
	$res .= '<div class="post-date">' . time_ago(strtotime($notify->notification_date)) . '</div>';
	$res .= '</div>';
	$res .= '<div class="clear"></div>';	
	return $res;
}

function get_post_new($notify) {
	$user = new User($notify->notification_from);
	
	$res = '';
	$res .= '<div class="sidebar-left">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" /></a>';
	$res .= '</div>';
	
	$res .= '<div class="sidebar-right">';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a><br/>';
	$res .= '<a href="' . ROOT . 'post.php?id=' . $notify->notification_link . '">wrote</a> on ';
	$res .= '<a href="' . profile_uri($notify->notification_to) . '">your wall</a>';
	$res .= '<div class="post-date">' . time_ago(strtotime($notify->notification_date)) . '</div>';
	$res .= '</div>';
	$res .= '<div class="clear"></div>';	
	return $res;
}

function get_reply_new($notify) {
	$user = new User($notify->notification_from);
	$post = new Post($notify->notification_link);
	$replied_post = new Post($post->parent);
	
	$res = '';
	$res .= '<div class="sidebar-left">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" /></a>';
	$res .= '</div>';
	
	$res .= '<div class="sidebar-right">';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a><br/>replied ';
	$res .= '<a href="' . $replied_post->permalink() . '">one of your posts</a>';
	$res .= '<div class="post-date">' . time_ago(strtotime($notify->notification_date)) . '</div>';
	$res .= '</div>';
	$res .= '<div class="clear"></div>';	
	return $res;
}

function get_post_like($notify) {
	$user = new User($notify->notification_from);
	
	$res = '';
	$res .= '<div class="sidebar-left">';
	$res .= '<a href="' . profile_uri($user->id) . '"><img src="' . get_avatar($user->avatar) . '" width="30" height="30" /></a>';
	$res .= '</div>';
	
	$res .= '<div class="sidebar-right">';
	$res .= '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a><br/>likes ';
	$res .= '<a href="' . ROOT . 'post.php?id=' . $notify->notification_link . '">your post</a>';
	$res .= '<div class="post-date">' . time_ago(strtotime($notify->notification_date)) . '</div>';
	$res .= '</div>';
	$res .= '<div class="clear"></div>';
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
				case 'wall_post_new':
					$logs_array[] = get_wall_post_new_log($log);
					break;
				case 'course_post_new':
					$logs_array[] = get_course_post_new_log($log);
					break;
				case 'reply_new':
					$logs_array[] = get_reply_new_log($log);
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
				case 'wall_photo_new':
					$logs_array[] = get_photo_new_log($log);
					break;
				case 'friend_new':
					$logs_array[] = get_friend_new_log($log);
					break;
				default:
					$logs_array[] = 'Unknown activity<br/>';
			}
		
		}
		return $logs_array;
	}
	return false;
}


function get_friend_new_log($log) {
	global $db;
	
	$res = '';
	
	$f = $db->get_row("SELECT * FROM friends WHERE friend_id=$log->log_link");
	if ($f) {
		
		$from = new User($f->friend_from);
		$to = new User($f->friend_to);

		$res .= '<div class="post-avatar">';
		$res .= '<img src="' . get_avatar($from->avatar) . '" width="50" height="50" />';
		$res .= '</div>';

		$res .= '<a href="' . profile_uri($from->id) . '">' . $from->name . '</a> and ';
		$res .= '<a href="' . profile_uri($to->id) . '">' . $to->name . '</a> are now friends. ';
		
		$res .= '<div class="post-avatar">';
		$res .= '<img src="' . get_avatar($to->avatar) . '" width="50" height="50" />';
		$res .= '</div>';
		
		$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago';

		$res .= '<div class="clear"></div>';
	}
	
	return $res;
}

function get_avatar_change_log($log) {
	
	$user_from = new User($log->log_user);
	
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</div>';
	
	$res .= $user_from->name . ' changed his profile picture.';
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_post_like_log($log) {
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$user_to = new User($post->author);
	
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</div>';
	
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a> likes ';
	$res .= '<a href="' . profile_uri($user_to->id) . '">' . $user_to->name . '</a>\'s ';
	$res .= '<a href="' . $post->permalink() . '">post</a>';
	$res .= '<br/><div style="margin-left:30px;">' . $post->content;
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_user_new_log($log) {
	
	$user_from = new User($log->log_user);
	
	$res = '';
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a> has been registered';
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_wall_post_new_log($log) {
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$user_to = new User($post->link);
	
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<a href="' . profile_uri($user_from->id) . '">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</a>';
	$res .= '</div>';
	
	
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a>';
	$res .= ' wrote a <a href="'.$post->permalink().'">message</a> to <a href="' . profile_uri($post->link) . '">' . $user_to->name . '</a>';
	$res .= '<br/><div style="margin-left:30px;">' . $post->content;
	$res .= '<br/><div class="post-date">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_course_post_new_log($log) {
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$course = new Course($post->link);
	
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</div>';
	
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a>';
	$res .= ' wrote a message in <a href="' . $course->permalink() . '">' . $course->name . '</a>';
	$res .= '<br/><div style="margin-left:30px;">' . $post->content;
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_photo_new_log($log) {
		
	$user_from = new User($log->log_user);
	$photo = new Photo($log->log_link);
		
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</div>';
	
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a>';
	$res .= ' uploaded a new photo';
	$res .= '<br/><div style="margin-left:30px;"><a href="' . $photo->src2() . '"><img src="' . $photo->src() . '" /></a>';
	$res .= '<br/><div style="color:#666;font-size:12px;">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

function get_reply_new_log($log) {
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$replied_post = new Post($post->parent);
	$user_to = new User($replied_post->author);
	
	$res = '';
	$res .= '<div class="post-avatar">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="50" height="50" />';
	$res .= '</div>';
	
	$res .= '<div class="aaaa">';
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a>';
	$res .= ' reply a <a href="' . $replied_post->permalink() . '">message</a> to <a href="' . profile_uri($post->link) . '">' . $user_to->name . '</a>';
	$res .= '<br/><div style="margin-left:30px;">' . $post->content;
	
	$res .= '<div class="post-date">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	$res .= '</div>';
	$res .= '<div class="clear"></div>';
	return $res;
}

?>