<?php

require('config.php');
require(LIB . 'html.php');
require(LIB . 'User.php');
require(LIB . 'Post.php');
require(LIB . 'Course.php');


authenticated_users();

$data['activity'] = get_activity();
$data['courses'] = Course::get_courses();

do_header('Courses');
do_view('courses', $data);
do_footer();


function get_activity() {
	global $db;
	
	$result = array();
	
	$logs = $db->get_results("SELECT * FROM logs WHERE log_type = 'course_post_new' ORDER BY log_id DESC LIMIT 7");
	if ($logs) {
		foreach ($logs as $log) {
			$result[] = get_course_post_new_log($log);
 		}
	}
	return $result;
}

function get_course_post_new_log($log) {
	
	$user_from = new User($log->log_user);
	$post = new Post($log->log_link);
	$course = new Course($post->link);
	
	$res = '';
	$res .= '<div class="sidebar-left">';
	$res .= '<a href="' . profile_uri($user_from->id) . '">';
	$res .= '<img src="' . get_avatar($user_from->avatar) . '" width="30" height="30" />';
	$res .= '</a>';
	$res .= '</div>';
	
	$res .= '<div class="sidebar-right">';
	$res .= '<a href="' . profile_uri($user_from->id) . '">' . $user_from->name . '</a>';
	$res .= ' wrote a message in <a href="' . $course->permalink() . '">' . $course->name . '</a>';
	$res .= '<br/><div class="post-date">'. time_ago(strtotime($log->log_date)) . ' ago</div>';
	$res .= '</div>';
	
	$res .= '<div class="clear"></div>';
	return $res;
}

?>