<aside class="sidebar">
	<div class="avatar">
		<img src="<?php echo get_avatar($user->avatar); ?>" width="200" height="200" />
	</div>
	
	<form>
		<input type="submit" name="friend" value="Request friend">
	</form>
		
	<ul class="user-menu">
		<li><a href="#">Wall</a></li>
		<li><a href="#">Photos</a></li>
		<li><a href="#">Groups</a></li>
	</ul>
		
	<h3>Friends</h3>
	<?php
	if ($friends) {
		foreach ($friends as $friend) {
			echo '<a href="' . profile_uri($friend->id) . '">';
			echo '<img src="' . get_avatar($friend->avatar) . '" width="50" height="50" />';
			echo '</a>';
		}
	} else {
		echo 'No friends yet.';
	}
	?>		
</aside>

<section class="main">
	<div class="user-details">
		<h2><?php echo $user->name; ?> <?php echo $user->lastname; ?></h2>
		<p>Birthday: <?php echo date("F j, Y", $user->birthday); ?></p>
		<p>Gender: <a href="<?php echo search('gender', $user->gender); ?>"><?php echo $user->get_gender(); ?></a></p>
		<? if ($user->course) { ?>
			<p>Course: <a href="<?php echo search('course', $user->course_id); ?>"><?php echo $user->course; ?></a></p>
		<? } ?>
		<p>Age: <?php echo $user->get_age(); ?></p>
	</div>
	
	<h3>Wall</h3>
	
	<?php if ($post_error) echo $post_error; ?>
	
	<?php Post::print_form(); ?>
	
	<?php
	if ($posts) {
		foreach ($posts as $post) {
			$post->print_post();
		}
	}
	?>
</section>