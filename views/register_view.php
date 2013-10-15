<? if ($error) echo $error; ?>

<form action="register.php" method="post">
	Name: <input type="text" name="name" value="<?=$_POST['name']?>" /><br/>
	Last name: <input type="text" name="lastname" value="<?=$_POST['lastname']?>" /><br/>
	Email: <input type="email" name="email" value="<?=$_POST['email']?>" /><br/>
	Password: <input type="password" name="password" /><br/>
	Birthday <select name="day">
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
		<br/>
		<label for="male"></label>
		<label for="female"></label>
	<input type="submit" name="register" value="Register">
</form>