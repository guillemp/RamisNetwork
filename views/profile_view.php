<div class="sidebar">
	<div class="avatar">
		<img src="<?php echo get_avatar($user->avatar); ?>" width="200" height="200" alt="" />
	</div>
	
	<?php echo $friend_button; ?>
		
	<ul class="user-menu">
		<li><a href="<?php echo profile_uri($user->id); ?>">Wall</a></li>
		<li><a href="<?php echo profile_uri($user->id) . '&amp;view=photos'; ?>">Photos</a></li>
		<li><a href="<?php echo profile_uri($user->id) . '&amp;view=friends'; ?>">Friends</a></li>
		<?php if ($current_user->id != $user->id) { ?>
			<li><a href="<?php echo ROOT . 'messages.php?action=new&amp;to=' . $user->id; ?>">Send message</a></li>
		<?php } ?>
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
</div>

<div class="main">
	<div class="user-details">
		<h2><?php echo $user->name; ?> <?php echo $user->lastname; ?></h2>		
		<p>Gender: <a href="<?php echo search('gender', $user->gender); ?>"><?php echo $user->get_gender(); ?></a></p>
		<p>Course: <a href="<?php echo search('course', $user->course); ?>"><?php echo $user->course_name; ?></a></p>
		<p>Birthday: <?php echo date("F j", $user->birthday); ?></p>
		<p>Age: <?php echo $user->get_age(); ?></p>
	</div>
	
	<?php /* WALL SECTION  */ ?>
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
	
	<?php /* PHOTOS SECTION  */ ?>
	<?php } else if ($view == 'photos') { ?>
		
		<h3>Photos</h3>
		
		<?php if ($photo_error) echo '<div class="error">' . $photo_error . '</div>'; ?>
		
		<?php Photo::print_form($user->id); ?>
		
		<?php
			if ($photos) {
				foreach ($photos as $photo) {
					echo '<a href="' . $photo->src2() . '">';
					echo '<img src="' . $photo->src() .'" width="180" height="135" />';
					echo '</a>';
				}
			} else {
				echo 'No photos yet.';
			}
		?>
	
	<?php /* FRIENDS SECTION  */ ?>
	<?php } else if ($view == 'friends') { ?>	
		
		<h3>Friends</h3>
		
		<?php
			if ($friends) {
				echo '<ul class="logs">';
				foreach ($friends as $friend) {
					echo '<li>';
					echo '<a href="' . profile_uri($friend->id) . '">';
					echo '<img src="' . get_avatar($friend->avatar) . '" width="50" height="50" />';
					echo $friend->name;
					echo '</a>';
					echo '</li>';
				}
				echo '</ul>';
			} else {
				echo 'No friends yet.';
			}
		?>
		
	<?php } ?>
</div>