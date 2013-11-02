<?php

class Post {
	public $id;
	public $author;
	public $type;
	public $link;
	public $content;
	public $date;
	public $parent;
	
	function __construct($id=0) {
		$this->id = 0;
		$this->author = 0;
		$this->type = 'wall';
		$this->link = 0;
		$this->content = '';
		$this->date = false;
		$this->parent = 0;
		
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
	
	public static function save_post($type, $link) {
		global $db, $current_user;
		
		// if user is not logged in, do nothing
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
	
	public function print_post() {
		$data['post'] = $this;
		do_view('post', $data);
		
	}
	
	public function insert_like() {
		global $db, $current_user;
		$like_exists = $db->get_var("SELECT count(*) FROM likes WHERE like_link = $this->id AND like_user = $current_user->id");
		if (!$like_exists) {
			if ($db->query("INSERT INTO likes (like_link, like_user) VALUES ($this->id, $current_user->id)")) {
				$db->query("UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = $this->id");
				insert_log('post_like', $this->id, $current_user->id);
				insert_notify('post_like', $this->id, $current_user->id, $this->author);
				return true;
			}
		}
		return false;
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