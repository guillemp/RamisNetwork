<?php

class Course {
	public $id;
	public $name;
	
	function __construct() {
	}
	
	public static function get_courses() {
		global $db;

		$courses = $db->get_results("SELECT * FROM courses");
		if ($courses) {
			foreach ($courses as $c) {
				$course = new Course();
				$course->id = $c->course_id;
				$course->name = $c->course_name;
				$courses_array[] = $course;
			}
			return $courses_array;
		}
		return false;
	}
}

?>