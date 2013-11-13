<div class="sidebar">
	&nbsp;
</div>

<div class="main">
	<?php if ($courses) { ?>
		<ul class="courses">
		<?php foreach ($courses as $course) { ?>
			<li><a href="course.php?id=<?php echo $course->id ?>"><?php echo $course->name ?></a></li>
			<? } ?>
		</ul>
	<? } ?>
</div>