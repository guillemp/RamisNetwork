<?php

function do_header($title='') {
	global $current_user;
	
	$data['title'] = $title;
	
	$data['home'] = ROOT;
	if ($current_user->authenticated) {
		$data['home'] = ROOT . 'home.php';
	}
	
	do_view('header', $data);
}

function do_footer() {
	do_view('footer');
}

function do_error($msg='') {
	do_header();
	echo $msg;
	do_footer();
	die;
}

?>