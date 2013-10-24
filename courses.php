<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'Course.php');

$data['courses'] = get_courses();

do_header('Courses');
do_view('courses', $data);
do_footer();



function get_courses() {
	global $db, $current_user;
	
	$courses = $db->get_results("SELECT * FROM courses");
	if ($courses) {
		foreach ($courses as $c) {
			$course = new Course();
			$course->id = $c->course_id;
			$course->name = $c->course_name;
			$data[] = $course;
		}
		return $data;
	}
	return false;
}

?>