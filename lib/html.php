<?php

header('Content-type: text/html; charset=utf-8');

// this is the header loader
function do_header($title='') {
	global $current_user;
	
	$data['title'] = $title;
	
	$data['home_link'] = ROOT;
	if ($current_user->authenticated) {
		$data['home_link'] = ROOT . 'home.php';
	}
	
	do_view('header', $data);
}

// this loads the footer
function do_footer() {
	do_view('footer');
}

// this function loads the VIEW
function do_view($name, $data=null) {
	global $current_user;
	
	$_view = VIEWS . $name . '_view.php';
	
	if (!file_exists($_view)) {
		die('File <strong>' . $_view . '</strong> does not exists.');
	}
	
	if (is_array($data)) {
		// import variables from an array
		// into the current symbol table
		extract($data);
	}
	
	require($_view);
}

// display an error and then, die.
function do_error($msg='') {
	do_header('Error');
	echo '<div class="error">' . $msg . '</div>';
	do_footer();
	die;
}

?>