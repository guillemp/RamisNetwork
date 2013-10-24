<? if ($error) echo $error; ?>

<form action="settings.php" method="post" enctype="multipart/form-data">
	Name: <input type="text" name="name" value="<?=$user->name?>" /><br/>
	Last name: <input type="text" name="lastname" value="<?=$user->lastname?>" /><br/>
	Email: <input type="email" name="email" value="<?=$user->email?>" /><br/>
	Password: <input type="password" name="password" /><br/>
	Birthday <select name="day">
		<option value="">Day</option>
		<?php
		
		for ($i=1; $i<=31; $i++) {
			$checked = '';
			if ($i == date("j", $user->birthday)) {
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
				if ($i == date("n", $user->birthday)) {
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
					if ($i == date("Y", $user->birthday)) {
						$checked = ' selected="selected"';
					}
					echo '<option value="' . $i . '"' . $checked . '>' . $i . '</option>';
				}

				?>
		</select>
		<br/>
		<label for="male">Male <input type="radio" name="gender" id="male" value="male"></label>
		<label for="female">Female <input type="radio" name="gender" id="female" value="female"></label>
		<br/>
		<input type="file" name="avatar">
		<br/>
	<input type="submit" name="save" value="Save changes">
</form>

<img src="<?=get_avatar($user->avatar)?>" width="200" height="200" />