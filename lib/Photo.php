<?php

class Photo {	
	const DESTINATION = PATH . 'img/photos/';
	
	function __construct() {
		
	}
	
	private function insert_photo() {
		global $db;
		if ($db->query("INSERT INTO photos () VALUES ()")) {
			return $db->insert_id;
		}
		return false;
	}
	
	public static function upload_photo() {
		global $db, $user, $current_user;

		$temp = $_FILES['photo']['tmp_name'];
		$name = 'photo_' . uniqid() . '.jpg';

		if (empty($temp)) return false;

		if (is_uploaded_file($temp)) {
			// include phpthumb library
			require(LIB . 'phpthumb/ThumbLib.inc.php');

			// max photo size: 640 x 480
			$thumb = PhpThumbFactory::create($temp);
			$thumb->adaptiveResize(200, 200);
			$thumb->save($path.$name, 'jpg');

			// Insert a new activity, sure? not...
			insert_log('photo_new', 0, $user->id);
			return true;
		}
		return false;
	}
}

?>