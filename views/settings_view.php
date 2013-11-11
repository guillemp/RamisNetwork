
<div class="sidebar">
	<h3>Settings</h3>
	<ul class="user-menu">
		<li><a href="<?php echo ROOT; ?>settings.php">Profile</a></li>
		<li><a href="<?php echo ROOT; ?>settings.php#todo">Privacy</a></li>
	</ul>
</div>

<div class="main">
	
	<? if ($msg['done']) echo '<div class="done">' . $msg['done'] . '</div>'; ?>
	<? if ($msg['error']) echo '<div class="error">' . $msg['error'] . '</div>'; ?>
	
	<form action="settings.php" method="post" enctype="multipart/form-data">
	
	<fieldset>
	Name: <input type="text" name="name" value="<?=$user->name?>" /><br/>
	Last name: <input type="text" name="lastname" value="<?=$user->lastname?>" /><br/>
	Email: <input type="email" name="email" value="<?=$user->email?>" /><br/>
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
			<?php if ($user->gender == 1) { ?>
				<label for="male">Male <input type="radio" name="gender" id="male" value="male" checked="checked"></label>
				<label for="female">Female <input type="radio" name="gender" id="female" value="female"></label>
			<?php } else if ($user->gender == 2) { ?>
				<label for="male">Male <input type="radio" name="gender" id="male" value="male"></label>
				<label for="female">Female <input type="radio" name="gender" id="female" value="female" checked="checked"></label>
			<?php } ?>
		</fieldset>
		
		<fieldset>
			<img src="<?=get_avatar($user->avatar)?>" width="60" height="60" style="float:right;"/>
			<div><input type="file" name="avatar"></div>
		</fieldset>
		
		<fieldset>
		Password: <input type="password" name="password" /><br/>
		Password2: <input type="password" name="password2" /><br/>
		</fieldset>
		

	<input type="submit" name="save_settings" value="Save changes" class="button" />
</form>

</div>