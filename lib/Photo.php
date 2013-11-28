<?php

class Photo {
	public $id = 0;
	public $author = 0;
	public $type = 'wall';
	public $link = 0;
	public $name = '';
	public $date = false;
		
	function __construct($id = 0) {	
		if ($id > 0) {
			$this->id = $id;
			$this->read();
		}
	}
	
	public function read() {
		global $db;
		
		$photo = $db->get_row("SELECT * FROM photos, users WHERE photo_author = id AND photo_id = $this->id");
		if ($photo) {
			$this->id = $photo->photo_id;
			$this->author = $photo->photo_author;
			$this->author_name = $photo->name;
			$this->type = $photo->photo_type;
			$this->link = $photo->photo_link;
			$this->name = $photo->photo_name;
			$this->date = strtotime($photo->photo_date);
			$this->avatar = $post->avatar;
			return true;
		}
		return false;
	}
	
	public function store() {
		global $db;
		if ($db->query("INSERT INTO photos (photo_author, photo_type, photo_link, photo_name) VALUES ($this->author, '$this->type', $this->link, '$this->name')")) {
			return $db->insert_id;
		}
		return false;
	}
	
	public function src() {
		return ROOT  . 'img/photos/thumb_' . $this->name . '.jpg';
	}
	public function src2() {
		return ROOT  . 'img/photos/photo_' . $this->name . '.jpg';
	}
	
	// static functions

	public static function print_form($link) {
		global $db, $current_user;
		if (!$current_user->authenticated) return;
		if ($link != $current_user->id) return;
		do_view('photo_form');
	}
	
	public static function save_photo($type, $link) {
		global $db, $current_user;
		
		if (!$current_user->authenticated) return;
		
		if ($type == 'wall' && $link != $current_user->id) {
			return 'Not your wall';
		}
		
		$photo_name = Photo::upload_photo();
		if ($photo_name === false) {
			return 'Select a photo to upload';
		}
		
		$photo = new Photo();
		$photo->author = $current_user->id;
		$photo->type = $type;
		$photo->link = $link;
		$photo->name = $photo_name;
		
		$photo_id = $photo->store();
		if ($photo_id > 0) {
			// insert activity
			insert_log($type.'_photo_new', $photo_id, $photo->author, $photo->name);
			// redirect provisional!!!!!
			header("Location: " . profile_uri($link) . '&view=photos');
			die;
		}
		return 'Unknown error.';
	}
	
	public static function upload_photo() {
		
		$temp = $_FILES['photo']['tmp_name'];
		
		if (empty($temp)) return false;
		
		$uniqid = uniqid(true);
		
		$photo_b = 'photo_' . $uniqid  . '.jpg';
		$photo_s = 'thumb_' . $uniqid  . '.jpg';
		
		$path = PATH . 'img/photos/';

		if (is_uploaded_file($temp)) {
			// include phpthumb library
			require(LIB . 'phpthumb/ThumbLib.inc.php');
			
			$thumb = PhpThumbFactory::create($temp);
			$thumb->resize(640, 480);
			$thumb->save($path.$photo_b, 'jpg');
			
			$thumb = PhpThumbFactory::create($temp);
			$thumb->adaptiveResize(180, 135);
			$thumb->save($path.$photo_s, 'jpg');

			// I return the name
			return $uniqid;
		}
		return false;
	}
	
	public static function get_photos($type, $link) {
		global $db;

		$photos_ids = $db->get_col("SELECT photo_id FROM photos WHERE photo_type = '$type' AND photo_link = $link ORDER BY photo_id DESC");
		if ($photos_ids) {
			foreach ($photos_ids as $id) {
				$photo = new Photo();
				$photo->id = $id;
				if ($photo->read()) {
					$photos_array[] = $photo;
				}
			}
			return $photos_array;
		}
		return false;
	}
}

?>