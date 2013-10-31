<?php foreach ($courses as $course) { ?>
	<a href="course.php?id=<?php echo $course->id ?>"><?php echo $course->name ?></a><br/>
<? } ?>