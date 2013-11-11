<form action="login.php" method="post">
	<div class="login-box">
		<h2>Login</h2>
		
		<?php if ($error) echo '<div class="error">' . $error . '</div>'; ?>
		
		<label for="email">Email:</label>
		<div class="login-field"><input type="text" name="email" id="email" autofocus="autofocus" /></div>
	
		<label for="password">Password:</label>
		<div class="login-field"><input type="password" name="password" id="password" /></div>
		
		<div>
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<input type="submit" name="login" value="Login" class="button" style="float:left" />
			<div style="float:right"><input type="checkbox" name="remember" id="remember" value="1" />&nbsp;&nbsp;<label for="remember">Remember me</label></div>
			<div class="clear"></div>
		</div>
	</div>
</form>

<div class="forgot">
	<a href="#todo">Forgot my password</a>
</div>