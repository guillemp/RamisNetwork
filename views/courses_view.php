<?php foreach ($courses as $course) { ?>
	<a href="courses.php?id=<?php echo $course->id ?>"><?php echo $course->name ?></a><br/>
<? } ?>