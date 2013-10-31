<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');
require(LIB . 'Course.php');

authenticated_users();

$id = intval($_REQUEST['id']);
$course = new Course();
$course->id = $id;
if (!$course->read()) {
	do_error("Course doesn't exists.");
}

$data['post_error'] = false;
if (isset($_POST['post'])) {
	$data['post_error'] = Post::save_post('course', $course->id);	
}

$data['join_leave_error'] = false;
if (isset($_POST['join_leave'])) {
	$data['join_leave_error'] = join_leave_course();	
}

$data['course'] = $course;
$data['posts'] = Post::get_posts('course', $course->id);
$data['users'] = Course::get_users($course->id);
$data['join_leave'] = join_leave_button();

do_header($course->name);
do_view('course', $data);
do_footer();

//
// course.php functions
//

function join_leave_course() {
	global $db, $course;
	
	$course = intval($_POST['course']);
	$user = intval($_POST['user']);
	
	header('Location: ' . ROOT . 'course.php?id=' . $course);
	die;
}

function join_leave_button() {
	global $db, $course, $current_user;

	$button_name = "Join course";
	$member = $db->get_var("SELECT count(*) FROM courses_users WHERE course = $course->id AND user = $current_user->id");
	if ($member) $button_name = "Leave course";

	$button = "";
	$button .= '<div style="margin-bottom:15px;">';
	$button .= '<form action="course.php" method="post">';
	$button .= '<input type="hidden" name="id" value="' . $course->id . '" />';
	$button .= '<input type="hidden" name="course" value="' . $course->id . '" />';
	$button .= '<input type="hidden" name="user" value="' . $current_user->id . '" />';
	$button .= '<input type="submit" name="join_leave" value="' . $button_name . '" class="button" style="width:200px;" />';
	$button .= '</form>';
	$button .= '</div>';
	
	return $button;
}

?>