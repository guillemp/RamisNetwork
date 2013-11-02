<?php

include('../config.php');
include(LIB . 'Post.php');
header('Content-Type: application/json; charset=UTF-8');

if (empty($_REQUEST['user'])) {
	print_error('User fail');
}

if ($current_user->id != $_REQUEST['user']) {
	print_error('Incorrect user');
}

if (empty($_REQUEST['link'])) {
	print_error('Comment link id');
}

$post = new Post();
$post->id = intval($_REQUEST['link']);
if (!$post->read()) {
	print_error('Post error');
}

if ($post->author == $current_user->id) {
	print_error('Can\'t like own posts');
}

if (!$post->insert_like()) {
    print_error('Error inserting like');
}

echo "Like!";

function print_error($mess) {
    echo $mess;
    die;
}

?>