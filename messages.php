<?php

require('config.php');
require(LIB . 'html.php');

do_header('Messages');
do_view('messages', $data);
do_footer();

?>