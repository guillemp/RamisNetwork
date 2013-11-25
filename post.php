<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'Post.php');

authenticated_users();

$post = new Post();
$post->id = intval($_GET['id']);
if (!$post->read()) {
	do_error("Post doesn't exists.");
}

$data['post'] = $post;

do_header('Post');
do_view('post', $data);
do_footer();

?>