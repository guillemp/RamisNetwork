<div class="sidebar">
	<div class="avatar">
		<img src="<?php echo ROOT; ?>img/course.jpg" width="200" height="200" alt="" />
	</div>
	
	<h3>Members</h3>
	
	<?php
		if ($users) {
			foreach ($users as $user) {
				echo '<a href="' . profile_uri($user->id) . '">';
				echo '<img src="' . get_avatar($user->avatar) . '" width="50" height="50" alt="" />';
				echo '</a>';
			}
		} else {
			echo 'No users yet.';
		}
	?>
</div>

<div class="main">
	<h2><?php echo $course->name; ?></h2>
	
	<?php if ($course->description) { ?>
		<p class="desc"><?php echo $course->description; ?></p>
	<?php } ?>
	
	<h3>Wall</h3>
	
	<?php if ($post_error) echo '<div class="error">' . $post_error . '</div>'; ?>

	<?php Post::print_form(); ?>

	<?php
		if ($posts) {
			foreach ($posts as $post) {
				$post->print_post();
			}
		} else {
			echo 'No posts yet.';
		}
	?>
</div>