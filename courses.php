<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'Course.php');

authenticated_users();

$data['courses'] = Course::get_courses();

do_header('Courses');
do_view('courses', $data);
do_footer();

?>