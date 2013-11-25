<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Course.php');

// viewable to everyone
//authenticated_users();

$data['input_name'] = !empty($_GET['name']) ? $_GET['name'] : '';
$data['input_lastname'] = !empty($_GET['lastname']) ? $_GET['lastname'] : '';
$data['input_gender'] = !empty($_GET['gender']) ? intval($_GET['gender']) : 0;
$data['input_course'] = !empty($_GET['course']) ? intval($_GET['course']) : 0;
$data['input_min_age'] = !empty($_GET['min_age']) ? intval($_GET['min_age']) : 0;
$data['input_max_age'] = !empty($_GET['max_age']) ? intval($_GET['max_age']) : 0;

$data['users'] = get_users();
$data['courses'] = Course::get_courses();

do_header('Members');
do_view('members', $data);
do_footer();

//
// members.php functions
//

function get_users() {
	global $db;
	
	$from_where = get_where_conditions();
	$sql = "SELECT id FROM users $from_where ORDER BY id DESC";
	
	$user_ids = $db->get_col($sql);
	if ($user_ids) {	
		foreach ($user_ids as $id) {
			$user = new User();
			$user->id = $id;
			if ($user->read()) {
				$users_array[] = $user;
			}
		}
		return $users_array;
	}
	return false;
}

function get_where_conditions() {
	$conditions = array();
		
	if (!empty($_GET['name'])) {
		$name = trim($_GET['name']);
		$conditions[] = "name LIKE '%$name%'";
	}
	if (!empty($_GET['lastname'])) {
		$lastname = trim($_GET['lastname']);
		$conditions[] = "lastname LIKE '%$lastname%'";
	}
	if (!empty($_GET['course'])) {
		$conditions[] = "course = " . intval($_GET['course']);
	}
	if (!empty($_GET['gender'])) {
		$conditions[] = "gender = " . intval($_GET['gender']);
	}
	if (!empty($_GET['min_age'])) {
		$min_age = date('Y') - intval($_GET['min_age']);
		$conditions[] = "year(birthday) <= " . $min_age;
	}
	if (!empty($_GET['max_age'])) {
		$max_age = date('Y') - intval($_GET['max_age']);
		$conditions[] = "year(birthday) >= " . $max_age;
	}
	
	$from_where = "";
	if (count($conditions) == 1) {
		$from_where = "WHERE " . $conditions[0];
	} else if (count($conditions) > 1) {
		$from_where = "WHERE " . implode(" AND ", $conditions);
	}
	
	return $from_where;
}

?>