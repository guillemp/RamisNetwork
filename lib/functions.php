<?php

function do_view($name, $data=null) {
	global $current_user;
	
	if (is_array($data)) {
		extract($data);
	}
	
	$view = VIEWS . $name . '_view.php';
	
	if (!file_exists($view)) {
		die('File <strong>' . $view . '</strong> does not exists.');
	}
	
	require($view);
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