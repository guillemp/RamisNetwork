<div class="sidebar">
	<h3>Search for people</h3>
	<form action="<?php echo ROOT; ?>members.php" method="get">
		<div><input type="text" name="name" value="<?php echo $input_name; ?>" /></div>
		<div><input type="text" name="lastname" value="<?php echo $input_lastname; ?>" /></div>
		<div>
			<select name="gender">
				<option value="">Gender</option>
				<?php if ($input_gender == 1) { ?>
					<option value="1" selected="selected">Male</option>
					<option value="2">Female</option>
				<?php } else if ($input_gender == 2) { ?>
					<option value="1">Male</option>
					<option value="2" selected="selected">Female</option>
				<?php } else { ?>
					<option value="1">Male</option>
					<option value="2">Female</option>
				<?php } ?>
			</select>
		</div>
		<div>
			<select name="course">
				<option value="">Course</option>
				<?php
					if ($courses) {
						foreach ($courses as $course) {
							if ($input_course == $course->id) {
								echo '<option value="' . $course->id . '" selected="selected">' . $course->name . '</option>';
							} else {
								echo '<option value="' . $course->id . '">' . $course->name . '</option>';
							}
						}
					}
				?>
			</select>
		</div>
		<div>
			<select name="min_age">
				<option value="">Min age</option>
				<?php
					for ($i=12; $i<=80; $i++) {
						if ($input_min_age == $i) {
							echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						} else {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
					}
				?>
			</select>
			<select name="max_age">
				<option value="">Max age</option>
				<?php
					for ($i=12; $i<=80; $i++) {
						if ($input_max_age == $i) {
							echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						} else {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
					}
				?>
			</select>
		</div>
		<div><input type="submit" value="Search" class="button" /></div>
	</form>
</div>

<div class="main">
	<div class="members">
		<?php if ($users) { ?>
			<ul>
				<?php foreach ($users as $user) { ?>
					<li class="member">
						<a href="<?php echo profile_uri($user->id); ?>">
							<div><img src="<?php echo get_avatar($user->avatar); ?>" width="60" height="60" alt="" /></div>
							<div style="position:absolute;left:70px;top:0;"><?php echo $user->name; ?></div>
							<div style="position:absolute;left:70px;top:20px;font-size:12px;color:#000;"><?php echo $user->course; ?></div>
							<div style="position:absolute;left:70px;top:40px;font-size:12px;color:#000;"><?php echo $user->get_age(); ?></div>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php } else { ?>
			<p>No members found.</p>
		<?php } ?>
	</div>
</div>