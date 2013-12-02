<aside class="sidebar">
	
	<?php if ($requests) { ?>
		<h3>Friend requests</h3>
		
		<?php
		
		echo '<ul class="notifications">';
		foreach ($requests as $request) {
			echo '<li>';
			
			$user = new User($request->friend_from);
			
			echo '<div class="sidebar-left">';
			echo '<img src="' . get_avatar($user->avatar) . '" width="30" height="30" />';
			echo '</div>';
			
			echo '<div class="sidebar-right">';
			echo  '<a href="' . profile_uri($user->id) . '">' . $user->name . '</a>';
			
			echo '<form action="" method="post" style="float:right">';
			echo '<input type="hidden" name="id" value="' . $request->friend_id . '" />';
			echo '<input type="submit" name="accept" value="Accept" class="button button-small" />';
			echo '</form>';
			
			echo '</div>';
			echo '<div class="clear"></div>';
			
			echo '</li>';
		}
		echo '</ul>';
		
		?>
		
	<?php } ?>
	
	<h3>Notifications</h3>
	
	<?php

	if ($notifications) {
		echo '<ul class="notifications">';
		foreach ($notifications as $notify) {
			echo '<li>' . $notify . '</li>';
		}
		echo '</ul>';
	}

	?>
</aside>

<section class="main">
<?php

if ($logs) {
	echo '<ul class="logs">';
	foreach ($logs as $log) {
		echo '<li>' . $log . '</li>';
	}
	echo '</ul>';
}

?>
</section>