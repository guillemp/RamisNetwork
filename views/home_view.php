<aside class="sidebar">
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