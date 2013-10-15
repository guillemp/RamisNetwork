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

function get_avatar($id) {
	$file = PATH . 'img/pics/user' . $id . '.jpg';
	if (file_exists($file)) {
		return ROOT . 'img/pics/user' . $id . '.jpg';
	}
	return ROOT . 'img/default.jpg';
}

?>