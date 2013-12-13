<?php

function valid_email($email) {
	$parts = explode("@", trim($email));
	if ($parts[1] == 'iesjoanramis.org') {
		return true;
	}
	return false;
}

function email_exists($email) {
	global $db;
	$exists = intval($db->get_var("SELECT count(*) FROM users WHERE email='$email'"));
	if ($exists) {
		return true;
	}
	return false;
}

function authenticated_users() {
	global $current_user;
	if (!$current_user->authenticated) {
		do_error('You can\'t acces here. Please, <a href="' . ROOT . 'login.php?return=' . $_SERVER['REQUEST_URI'] . '">login</a> or <a href="' . ROOT . 'register.php">register</a> to view this page.');
	}
}

function get_liked($type, $link) {
	global $db, $current_user;
	$liked = $db->get_var("SELECT count(*) FROM likes WHERE type = '$type' AND link = $link AND user = $current_user->id");
	if ($liked) return true;
	return false;
}

function get_likes_count($type, $link) {
	global $db;
	return intval($db->get_var("SELECT count(*) FROM likes WHERE type = '$type' AND link = $link"));
}

function get_user_likes($type, $link) {
	global $db, $current_user;
	
	$user_links = array();
	require_once(LIB  . 'User.php');
	
	$users = $db->get_col("SELECT user FROM likes WHERE type = '$type' AND link = $link");
	if ($users) {
		foreach ($users as $user_id) {
			$user = new User($user_id);
			if ($current_user->id == $user->id) {
				$user_links[] = 'You';
			} else {
				$user_links[] = '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a>';
			}
		}
	}
	return implode(', ', $user_links);
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
	
	if ($days> 1) return " $days days";
	else if ($days==1) return " $days day";
	
	if ($hours>1) $txt .= " $hours hours";
	else if ($hours==1) $txt .= " $hours hour";

	if ($minutes>1) $txt .= " $minutes minutes";
	else if ($minutes==1) $txt .= " $minutes minute";
	
	if ($txt=="") $txt = " $secs seconds";
	
    return $txt;
}

?>