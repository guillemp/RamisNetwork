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
			$this->date = $post->post_date;
			$this->parent = $post->post_parent;
			$this->avatar = $post->avatar;
			return true;
		}
		return false;
	}
	
	public function store() {
		global $db;
		
		// insert into the database
		if ($db->query("INSERT INTO posts (post_author, post_link, post_content, post_parent) VALUES ($this->author, $this->link, '$this->content', $this->parent)")) {
			return $db->insert_id;
		}
		return false;
	}
	
	public static function save_post($link) {
		global $db, $current_user;
		
		// if user is not logged in, do nothing
		if (!$current_user->authenticated) return;
		
		$content = $db->escape(trim($_POST['content']));
		
		// return an error if empty post
		if (!$content) return 'Can\'t save empty post';
		
		$post = new Post();
		$post->author = $current_user->id;
		$post->link = $link;
		$post->content = $content;
		
		$post_id = $post->store();
		if ($post_id) {
			// save activity
			insert_log('post_new', $post_id, $post->author, $post->content);
			// redirect to profile page
			header('Location: ' . profile_uri($link));
			die;
		}
		return 'Unknown error.';
	}
	
	public function print_post() {
		$data['post'] = $this;
		do_view('post', $data);
	}
	
	public static function print_form() {
		global $db, $current_user;
		
		// if user is not logged in, don't show form
		if (!$current_user->authenticated) return;
		
		do_view('post_form');
	}
}

?>