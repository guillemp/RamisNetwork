<aside class="sidebar">
	<h3>Notifications</h3>
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