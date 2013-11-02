<?php

function authenticated_users() {
	global $current_user;
	if (!$current_user->authenticated) {
		do_error('You can\'t acces here. Please, <a href="' . ROOT . 'login.php">login</a> or <a href="' . ROOT . 'register.php">register</a> to view this page.');
	}
}

function get_friend_status($from, $to) {
	global $db;
	$status = intval($db->get_var("SELECT count(*) FROM friends WHERE friend_from = $from AND friend_to = $to AND friend_status = 0"));
	return $status;
}

function get_friend_ids($from=false) {
	global $db, $current_user;
	
	$user_id = $current_user->id;
	if ($from !== false) {
		$user_id = $from;
	}
	
	$friend_ids = $db->get_col("SELECT friend_to FROM friends WHERE friend_from = $user_id AND friend_status=1 UNION SELECT friend_from FROM friends WHERE friend_to = $user_id AND friend_status=1");
	if ($friend_ids) {
		return (array)$friend_ids;
	}
	
	return array();
}

function insert_log($type, $link, $user=0, $comment='') {
	global $db;		
	$log = $db->query("INSERT INTO logs (log_type, log_link, log_user, log_comment) VALUES ('$type', $link, $user, '$comment')");
	return $log;
}

function insert_notify($type, $link, $from=0, $to=0) {
	global $db;		
	$notification = $db->query("INSERT INTO notifications (notification_type, notification_link, notification_from, notification_to) VALUES ('$type', $link, $from, $to)");
	return $notification;
}

function profile_uri($id) {
	return ROOT . 'profile.php?id=' . $id;
}

function search($key, $value) {
	return ROOT . 'members.php?' . $key . '=' . $value;
}

function get_avatar($name='') {
	if (!empty($name)) {
		$file = PATH . 'img/avatars/' . $name;
		if (file_exists($file)) {
			return ROOT . 'img/avatars/' . $name;
		}
	}
	return ROOT . 'img/default.jpg';
}

function time_ago($time) {
	$txt = "";
	$diff = time() - $time;
	$days = intval($diff / 86400);
	$diff = $diff % 86400;
	$hours = intval($diff / 3600);
	$diff = $diff % 3600;
	$minutes = intval($diff / 60);
	$secs = $diff % 60;
	
	if ($days>1) $txt .= " $days days";
	else if ($days==1) $txt .= " $days day";
	
	if ($hours>1) $txt .= " $hours hours";
	else if ($hours==1) $txt .= " $hours hour";

	if ($minutes>1) $txt .= " $minutes minutes";
	else if ($minutes==1) $txt .= " $minutes minute";
	
	if ($txt=="") $txt = " $secs seconds";
	
    return $txt;
}

?>