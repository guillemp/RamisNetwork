<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

$data['posts'] = get_posts();

do_header('Home');
do_view('home', $data);
do_footer();


function get_posts() {
	global $db, $user;
	
	$post_ids = $db->get_col("SELECT post_id FROM posts WHERE post_type = 'wall' ORDER BY post_id DESC");
	if ($post_ids) {
		foreach ($post_ids as $id) {
			$post = new Post();
			$post->id = $id;
			if ($post->read()) {
				$data[] = $post;
			}
		}
		return $data;
	}
	return false;
}

?>