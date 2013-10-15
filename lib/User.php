<?php

class User {
	public $id;
	public $name;
	public $lastname;
	public $email;
	private $password;
	public $birthday;
	public $gender; // 1=Male, 2=Female
	public $course;
	public $course_id;
	
	function __construct($id=0) {
		if ($id > 0) {
			$this->id = $id;
			$this->read();
		}
	}
	
	public function read() {
		global $db;
		
		$user = $db->get_row("SELECT * FROM users LEFT JOIN courses ON course = course_id WHERE id = $this->id");
		if ($user) {
			$this->id = $user->id;
			$this->name = $user->name;
			$this->lastname = $user->lastname;
			$this->email = $user->email;
			$this->birthday = $user->birthday;
			$this->gender = $user->gender;
			$this->course = $user->course_name;
			$this->course_id = $user->course_id;
			return true;
		}
		return false;
	}
	
	public function get_birthday() {
		$time = strtotime($this->birthday);
		return date("F j, Y", $time);
	}
	
	public function get_age() {
		$time = strtotime($this->birthday);
		return date('Y') - date('Y', $time);
	}
	
	public function get_gender() {
		switch ($this->gender) {
			case 1: return 'Male';
			case 2: return 'Female';
			default: return 'Unknown';
		}
	}
	
	// return an array of ids
	public static function get_friends($from) {
		global $db;

		$friends = array();
		$friend_ids = $db->get_col("SELECT friend_to FROM friends WHERE friend_from=$from UNION SELECT friend_from FROM friends WHERE friend_to=$from");
		if ($friend_ids) {
			foreach ($friend_ids as $id) {
				$friends[] = $id;
			}
		}
		return $friends;
	}
}

?>