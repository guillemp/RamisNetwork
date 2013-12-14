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
			$this->password = $user->password;
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
	
	function friend_button() {
		global $db, $current_user;

		// can't add myself as a friend
		if ($this->id == $current_user->id) {
			return false;
		}
		
		if ($db->get_var("SELECT count(*) FROM friends WHERE friend_from=$current_user->id AND friend_to=$this->id")) {
			$button = "";
			$button .= '<div style="margin-bottom:15px;">';
			$button .= '<input type="submit" name="add_friend" value="Waiting" class="button-disabled" style="width:200px;" />';
			$button .= '</div>';
			return $button;
		}
		
		if ($db->get_var("SELECT count(*) FROM friends WHERE friend_from=$this->id AND friend_to=$current_user->id")) {
			$button = "";
			$button .= '<div style="margin-bottom:15px;">';
			$button .= '<form action="" method="post">';
			$button .= '<input type="hidden" name="from" value="' . $current_user->id . '" />';
			$button .= '<input type="hidden" name="to" value="' . $this->id . '" />';
			$button .= '<input type="submit" name="add_friend" value="Accept request" class="button" style="width:200px;" />';
			$button .= '</form>';
			$button .= '</div>';
			return $button;
		}

		$button = "";
		$button .= '<div style="margin-bottom:15px;">';
		$button .= '<form action="" method="post">';
		$button .= '<input type="hidden" name="from" value="' . $current_user->id . '" />';
		$button .= '<input type="hidden" name="to" value="' . $this->id . '" />';
		$button .= '<input type="submit" name="add_friend" value="Send request" class="button" style="width:200px;" />';
		$button .= '</form>';
		$button .= '</div>';

		return $button;
	}
	
	function is_friend($to) {
		global $db;
		if ($db->get_var("SELECT count(*) FROM friends WHERE friend_from=$this->id AND friend_to=$to")) {
			if ($db->get_var("SELECT count(*) FROM friends WHERE friend_from=$to AND friend_to=$this->id")) {
				return true;
			}
		}
		return false;
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
	
	public static function add_friend($from, $to) {
		global $db;

		if ($db->query("INSERT INTO friends (friend_from, friend_to) VALUES ($from, $to)")) {
			header('Location: ' . profile_uri($to));
			die;
		}
		return 'Error adding as a friend';
	}
	
	public static function accept_request($id) {
		global $db;
		
		$request = $db->get_row("SELECT * FROM friends WHERE friend_id=$id");
		if ($request) {
			if ($db->query("INSERT INTO friends (friend_from, friend_to) VALUES ($request->friend_to, $request->friend_from)")) {
				// update friend status
				$new_id = $db->insert_id;
				$db->query("UPDATE friends SET friend_status=1 WHERE friend_id=$new_id");
				$db->query("UPDATE friends SET friend_status=1 WHERE friend_id=$id");
				
				// add log and notify
				insert_notify('friend_new', $id, $request->friend_to, $request->friend_from);
				insert_log("friend_new", $id);
				
				// redirect
				header('Location: ' . ROOT);
				die;
			}
		}
		return 'Error accepting friend request';
	}
	
	public static function get_friends($user_id) {
		global $db;

		$friend_ids = User::get_friend_ids($user_id);
		if ($friend_ids) {
			foreach ($friend_ids as $id) {
				$friend = new User();
				$friend->id = $id;
				if ($friend->read()) {
					$friends_array[] = $friend;
				}
			}
			return $friends_array;
		}
		return false;
	}
	
	// return an array of ids
	/*
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
	*/
	
	public static function get_friend_ids($from=false) {
		global $db, $current_user;

		$user_id = $current_user->id;
		if ($from !== false) {
			$user_id = $from;
		}

		$friend_ids = $db->get_col("SELECT friend_to FROM friends WHERE friend_from = $user_id AND friend_status=1 UNION SELECT friend_from FROM friends WHERE friend_to = $user_id AND friend_status=1");
		if ($friend_ids) {
			return (array)$friend_ids;
		}

		return array();
	}
	
}

?>