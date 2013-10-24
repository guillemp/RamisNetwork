<?php

class Login {
	public $id;
	public $name;
	public $avatar;
	public $authenticated;
	
	function __construct() {
		global $db;
		
		$this->id = 0;
		$this->name = '';
		$this->avatar = '';
		$this->authenticated = false;
		
		if (isset($_COOKIE['auth'])) {
			// read the cookie
			$user_id = intval($_COOKIE['auth']);
			$user = $db->get_row("SELECT id, name, avatar FROM users WHERE id = $user_id LIMIT 1");
			if ($user) {
				$this->id = $user->id;
				$this->name = $user->name;
				$this->avatar = $user->avatar;
				$this->authenticated = true;
			}
		}
	}
	
	public function authenticate($email, $password, $remember=false) {
		global $db;
		
		$user = $db->get_row("SELECT id, name, password, avatar FROM users WHERE email = '$email' LIMIT 1");
		if ($user) {
			if ($user->password == $password) {
				$this->id = $user->id;
				$this->name = $user->name;
				$this->avatar = $user->avatar;
				$this->authenticated = true;	
				// set the cookie
				$time = $remember ? time() + 2592000 : 0; // 2592000=30day
				setcookie('auth', $this->id, $time);
				return true;
			}
		}
		return false;
	}
	
	public function logout() {
		$this->id = 0;
		$this->name = '';
		$this->avatar = '';
		$this->authenticated = false;
		// remove the cookie
		setcookie('auth', 0, time() - 3600);
		header('Location: ' . ROOT);
		die;
	}
}

$current_user = new Login();

?>