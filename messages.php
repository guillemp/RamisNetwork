<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');

authenticated_users();

$data['action'] = 'inbox';
if (!empty($_GET['action'])) {
	$data['action'] = $_GET['action'];
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = send_message();	
}

do_header('Messages');
do_view('messages', $data);
do_footer();

//
// messages.php functions
//

function send_message() {
	$user = new User();
	$user->id = intval($_GET['to']);
	if ($user->read()) {
		return Post::save_post('private', $user->id);
	}
	return false;
}

?>