<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');
require(LIB . 'Course.php');

authenticated_users();

$course = new Course();
$course->id = intval($_REQUEST['id']);
if (!$course->read()) {
	do_error("Course doesn't exists.");
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = Post::save_post('course', $course->id);	
}

$data['course'] = $course;
$data['posts'] = Post::get_posts('course', $course->id);
$data['users'] = Course::get_users($course->id);

do_header($course->name);
do_view('course', $data);
do_footer();

?>