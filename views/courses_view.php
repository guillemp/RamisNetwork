<div class="sidebar">
	<h3>Activity</h3>
	
	<?php if ($activity) { ?>
		<ul>
		<?php foreach ($activity as $activity_id) { ?>
			<li><?php echo $activity_id; ?></li>
		<? } ?>
		</ul>
	<? } ?>
	
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