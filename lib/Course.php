<?php

class Course {
	public $id = 0;
	public $name = '';
	
	function __construct($id=0) {
		if ($id > 0) {
			$this->id = $id;
			$this->read();
		}
	}
	
	public function read() {
		global $db;
		
		$course = $db->get_row("SELECT * FROM courses WHERE course_id = $this->id");
		if ($course) {
			$this->id = $course->course_id;
			$this->name = $course->course_name;
			return true;
		}
		return false;
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
	
	public static function get_users($id) {
		global $db;

		$user_ids = $db->get_col("SELECT user FROM courses_users WHERE course = $id ORDER BY id DESC");
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
}

?>