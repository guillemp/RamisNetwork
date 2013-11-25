<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'Course.php');

authenticated_users();

$data['activity'] = get_activity();
$data['courses'] = Course::get_courses();

do_header('Courses');
do_view('courses', $data);
do_footer();


function get_activity() {
	global $db;
	
	$result = array();
	
	$logs = $db->get_col("SELECT log_link FROM logs WHERE log_type = 'course_post_new'");
	if ($logs) {
		foreach ($logs as $log_id) {
			$result[] = $log_id;
 		}
	}
	return $result;
}

?>