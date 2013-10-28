<?php

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

function do_view($name, $data=null) {
	global $current_user;
	
	if (is_array($data)) {
		extract($data);
	}
	
	$_view = VIEWS . $name . '_view.php';
	
	if (!file_exists($_view)) {
		die('File <strong>' . $_view . '</strong> does not exists.');
	}
	
	require($_view);
}

function insert_log($type, $link, $user=0, $comment='') {
	global $db;		
	$log = $db->query("INSERT INTO logs (log_type, log_link, log_user, log_comment) VALUES ('$type', $link, $user, '$comment')");
	return $log;
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