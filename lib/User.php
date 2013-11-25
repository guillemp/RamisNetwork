<?php

class User {
	public $id;
	public $name;
	public $lastname;
	public $email;
	public $password;
	public $birthday;
	public $gender; // 1=Male, 2=Female
	public $avatar;
	public $course;
	public $course_name;
	
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
			$this->birthday = strtotime($user->birthday);
			$this->gender = $user->gender;
			$this->avatar = $user->avatar;
			$this->course = $user->course;
			$this->course_name = $user->course_name;
			return true;
		}
		return false;
	}
	
	public function store() {
		global $db;
		
		if ($this->id > 0) {
			// is an update
			if ($db->query("UPDATE users SET name='$this->name', lastname='$this->lastname', email='$this->email', password='$this->password', birthday='$this->birthday', gender=$this->gender, avatar='$this->avatar', course=$this->course WHERE id = $this->id")) {
				return true;
			}
		} else {
			// is an insert
			if ($db->query("INSERT INTO users (name, lastname, email, password, birthday, gender, course) VALUES ('$this->name', '$this->lastname', '$this->email', '$this->password', '$this->birthday', $this->gender, $this->course)")) {
				// Insert a new activity
				insert_log('user_new', 0, $db->insert_id);
				return $db->insert_id;
			}
		}
		return false;
	}
	
	public function get_birthday() {
		return date("F j, Y", $this->birthday);
	}
	
	public function get_age() {
		return date('Y') - date('Y', $this->birthday);
	}
	
	public function get_gender() {
		switch ($this->gender) {
			case 1: return 'Male';
			case 2: return 'Female';
			default: return 'Unknown';
		}
	}
	
	public static function save_user() {
		global $db;

		$user = new User();
		$user->name = $db->escape($_POST['name']);
		$user->lastname = $db->escape($_POST['lastname']);
		$user->email = $db->escape(trim($_POST['email']));
		$user->password = md5(trim($_POST['password']));
		$user->birthday = intval($_POST['year']) . '-' . intval($_POST['month']) . '-' . intval($_POST['day']);
		$user->gender = ($_POST['gender'] == 'male') ? 1 : 2;
		$user->course = intval($_POST['course']);

		// insert user into the DB
		return $user->store();
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