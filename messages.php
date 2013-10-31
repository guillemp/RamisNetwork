<?php

require('config.php');
require(LIB . 'html.php');

authenticated_users();

do_header('Messages');
do_view('messages', $data);
do_footer();

?>