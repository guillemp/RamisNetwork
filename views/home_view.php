<?php

if ($logs) {
	echo '<ul class="logs">';
	foreach ($logs as $log) {
		echo '<li>' . $log . '</li>';
	}
	echo '</ul>';
}

?>