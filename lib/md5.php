<?php

if (isset($_POST['send'])) {
	echo md5($_POST['password']);
}

?>
<form action="md5.php" method="post">
	<input type="password" name="password">
	<input type="submit" name="send" value="MD5">
</form>