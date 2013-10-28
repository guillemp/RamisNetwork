<aside class="sidebar">
	<div class="avatar">
		<img src="<?php echo get_avatar($user->avatar); ?>" width="200" height="200" alt="" />
	</div>
	
	<?php echo $data['friend_button']; ?>
		
	<ul class="user-menu">
		<li><a href="<?php echo profile_uri($user->id); ?>">Wall</a></li>
		<li><a href="<?php echo profile_uri($user->id) . '&amp;view=photos'; ?>">Photos</a></li>
		<li><a href="<?php echo ROOT . 'messages.php?action=new&amp;to=' . $user->id; ?>">Send message</a></li>
		<li><a href="<?php echo profile_uri($user->id); ?>">Block</a></li>
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
		<?php if ($user->course) { ?>
			<p>Course: <a href="<?php echo search('course', $user->course_id); ?>"><?php echo $user->course; ?></a></p>
		<? } ?>
		<p>Age: <?php echo $user->get_age(); ?></p>
	</div>
	
	<?php if ($view == 'wall') { ?>
	
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
	<?php } else if ($view == 'photos') { ?>
		
		<h3>Photos</h3>
		
		<?php
			if ($photos) {
				foreach ($photos as $photos) {
					// print photo
				}
			} else {
				echo 'No photos yet.';
			}
		?>
		
	<?php } ?>
</section>