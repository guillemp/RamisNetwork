<?php

class Login {
	function __construct() {
		global $db;
		
		$this->id = 0;
		$this->name = '';
		$this->authenticated = false;
		
		if (isset($_COOKIE['auth'])) {
			// read the cookie
			$user_id = intval($_COOKIE['auth']);
			$user = $db->get_row("SELECT id, name FROM users WHERE id = $user_id LIMIT 1");
			if ($user) {
				$this->id = $user->id;
				$this->name = $user->name;
				$this->authenticated = true;
			}
		}
	}
	
	public function authenticate($email, $password, $remember=false) {
		global $db;
		
		$user = $db->get_row("SELECT id, name, password FROM users WHERE email = '$email' LIMIT 1");
		if ($user) {
			if ($user->password == $password) {
				$this->id = $user->id;
				$this->name = $user->name;
				$this->authenticated = true;	
				// set the cookie
				$time = $remember ? time() + 2592000 : 0;
				setcookie('auth', $this->id, $time);
				return true;
			}
		}
		return false;
	}
	
	public function logout() {
		$this->id = 0;
		$this->name = '';
		$this->authenticated = false;
		// reset the cookie
		setcookie('auth', '', time() - 3600);
		header('Location: ' . ROOT);
		die;
	}
}

$current_user = new Login();

?>