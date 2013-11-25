<form action="register.php" method="post">
	<div class="login-box">
		<h2>Register</h2>
		
		<?php if ($error) echo '<div class="error">' . $error . '</div>'; ?>
		
		<label for="name">Name:</label>
		<div class="login-field"><input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" /></div>
		
		<label for="lastname">Last name:</label>
		<div class="login-field"><input type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname']; ?>" /></div>
			
		<label for="email">Email:</label>
		<div class="login-field"><input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" /></div>
	
		<label for="password">Password:</label>
		<div class="login-field"><input type="password" name="password" id="password" /></div>
		
		<label for="course">Course:</label>
		<div class="login-field">
			<select name="course">
				<option value="">Course</option>
				<?php
					foreach ($courses as $course) {
						$checked = '';
						if ($course->id == $_POST['course']) {
							$checked = ' selected="selected"';
						}
						echo '<option value="' . $course->id . '"' . $checked . '>' . $course->name . '</option>';
					}
				?>
			</select>
		</div>
	
		<label>Birthday:</label>
		<div class="login-field">
			<select name="day">
				<option value="">Day</option>
				<?php
					for ($i=1; $i<=31; $i++) {
						$checked = '';
						if ($i == $_POST['day']) {
							$checked = ' selected="selected"';
						}
						echo '<option value="' . $i . '"' . $checked . '>' . $i . '</option>';
					}
				?>
			</select>
			&nbsp;
			<select name="month">
				<option value="">Month</option>
				<?php
					for ($i=1; $i<=12; $i++) {
						$checked = '';
						if ($i == $_POST['month']) {
							$checked = ' selected="selected"';
						}
						echo '<option value="' . $i . '"' . $checked . '>' . $i . '</option>';
					}
				?>
			</select>
			&nbsp;
			<select name="year">
				<option value="">Year</option>
				<?php
					for ($i=date('Y')-12; $i>date('Y')-100; $i--) {
						$checked = '';
						if ($i == $_POST['year']) {
							$checked = ' selected="selected"';
						}
						echo '<option value="' . $i . '"' . $checked . '>' . $i . '</option>';
					}
				?>
			</select>
		</div>
		
		<div style="margin-bottom:20px;">
			<?php
				$checked_male = ($_POST['gender'] == 'male') ? 'checked="checked"' : '';
				$checked_female = ($_POST['gender'] == 'female') ? 'checked="checked"' : '';
			?>
			<label for="male">Male&nbsp;&nbsp;<input type="radio" name="gender" id="male" value="male" <?php echo $checked_male ?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="female">Female&nbsp;&nbsp;<input type="radio" name="gender" id="female" value="female" <?php echo $checked_female ?> /></label>
		</div>
		<div><input type="submit" name="register" value="Register" class="button" /></div>
	</div>
</form>