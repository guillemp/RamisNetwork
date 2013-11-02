<?php

class Post {
	public $id = 0;
	public $author = 0;
	public $type = 'wall';
	public $link = 0;
	public $content = '';
	public $date = false;
	public $parent = 0;
	
	function __construct($id = 0) {	
		if ($id > 0) {
			$this->id = $id;
			$this->read();
		}

	}
	
	public function read() {
		global $db;
		
		$post = $db->get_row("SELECT * FROM posts, users WHERE post_author = id AND post_id = $this->id");
		if ($post) {
			$this->id = $post->post_id;
			$this->author = $post->post_author;
			$this->name = $post->name;
			$this->type = $post->post_type;
			$this->link = $post->post_link;
			$this->content = $post->post_content;
			$this->date = strtotime($post->post_date);
			$this->parent = $post->post_parent;
			$this->avatar = $post->avatar;
			return true;
		}
		return false;
	}
	
	public function store() {
		global $db;
		
		// insert into the database
		if ($db->query("INSERT INTO posts (post_author, post_type, post_link, post_content, post_parent) VALUES ($this->author, '$this->type', $this->link, '$this->content', $this->parent)")) {
			return $db->insert_id;
		}
		return false;
	}
	
	public function print_post() {
		global $current_user;
		
		$data['post'] = $this;
		$data['likes'] = get_user_likes('post', $this->id);
		$data['likes_count'] = get_likes_count('post', $this->id);
		
		do_view('post', $data);
		
	}
	
	public function insert_like($type) {
		global $db, $current_user;
		
		$like_exists = $db->get_var("SELECT count(*) FROM likes WHERE type = '$type' AND link = $this->id AND user = $current_user->id");
		if (!$like_exists) {
			if ($db->query("INSERT INTO likes (type, link, user) VALUES ('$type', $this->id, $current_user->id)")) {
				$db->query("UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = $this->id");
				insert_log($type . '_like', $this->id, $current_user->id);
				insert_notify($type . '_like', $this->id, $current_user->id, $this->author);
				return true;
			}
		}
		return false;
	}
	
	//
	// static methods
	//
	
	public static function save_post($type, $link) {
		global $db, $current_user;
		
		if (!$current_user->authenticated) return;
		
		$content = $db->escape(trim($_POST['content']));
		
		// return an error if empty post
		if (!$content) return 'Can\'t save empty post';
		
		$post = new Post();
		$post->author = $current_user->id;
		$post->type = $type;
		$post->link = $link;
		$post->content = $content;
		
		$post_id = $post->store();
		if ($post_id) {
			insert_log('post_new', $post_id, $post->author, $post->content);
			insert_notify('post_new', $post_id, $post->author, $link);
			return false;
		}
		return 'Unknown error.';
	}
	
	public static function print_form() {
		global $db, $current_user;
		
		// if user is not logged in, don't show form
		if (!$current_user->authenticated) return;
		
		do_view('post_form');
	}
	
	public static function get_posts($type, $link) {
		global $db;

		$post_ids = $db->get_col("SELECT post_id FROM posts WHERE post_type = '$type' AND post_link = $link ORDER BY post_id DESC");
		if ($post_ids) {
			foreach ($post_ids as $id) {
				$post = new Post();
				$post->id = $id;
				if ($post->read()) {
					$posts_array[] = $post;
				}
			}
			return $posts_array;
		}
		return false;
	}
}

?>