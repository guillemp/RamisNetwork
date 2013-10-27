<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');

// only logged users can view this
if (!$current_user->authenticated) {
	header('Location: ' . ROOT);
	die;
}

$data['users'] = get_users();

do_header('Members');
do_view('members', $data);
do_footer();


function get_users() {
	global $db;
	
	$from_where = "";
	if (isset($_GET['course'])) {
		$from_where = "WHERE course = ". intval($_GET['course']);
	} else if (isset($_GET['gender'])) {
		$from_where = "WHERE gender = ". intval($_GET['gender']);
	} else if (isset($_GET['max'])) {

	}
	
	$user_ids = $db->get_col("SELECT id FROM users $from_where ORDER BY id DESC");
	if ($user_ids) {	
		foreach ($user_ids as $id) {
			$user = new User();
			$user->id = $id;
			if ($user->read()) {
				$data[] = $user;
			}
		}
		return $data;
	}
	return false;
}

?>