<?php

require('config.php');
require(LIB . 'html.php');

// only logged users can view this
if (!$current_user->authenticated) {
	header('Location: ' . ROOT);
	die;
}

do_header('Messages');
do_view('messages', $data);
do_footer();

?>