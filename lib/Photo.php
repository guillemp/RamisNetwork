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
		return ROOT  . 'img/photos/' . $this->name;
	}
	
	// static functions

	public static function print_form() {
		global $db, $current_user;
		if (!$current_user->authenticated) return;
		do_view('photo_form');
	}
	
	public static function save_photo($type, $link) {
		global $db, $current_user;
		
		if (!$current_user->authenticated) return;
		
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
		if ($photo_id) {
			insert_log('photo_new', $photo_id, $photo->author, $photo->name);
			//insert_notify('post_new', $post_id, $post->author, $link);
			return false;
		}
		return 'Unknown error.';
	}
	
	public static function upload_photo() {
		
		$temp = $_FILES['photo']['tmp_name'];
		$name = 'photo_' . uniqid() . '.jpg';
		$path = PATH . 'img/photos/';
		
		if (empty($temp)) return false;

		if (is_uploaded_file($temp)) {
			// include phpthumb library
			require(LIB . 'phpthumb/ThumbLib.inc.php');

			// max photo size: 640 x 480
			$thumb = PhpThumbFactory::create($temp);
			$thumb->resize(640, 480);
			$thumb->save($path.$name, 'jpg');

			// I return the name
			return $name;
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