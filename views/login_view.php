<?
if ($error) {
	echo $error;
}
?>
<form action="login.php" method="post">
	<input type="text" name="email"><br/>
	<input type="password" name="password"><br/>
	<input type="submit" name="login" value="Login">
</form>