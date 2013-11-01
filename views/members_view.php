<div class="sidebar">
	<h3>Search for people</h3>
	<form action="<?php echo ROOT; ?>members.php" method="get">
		<div><input type="text" name="name" value="<?php echo $input_name; ?>" placeholder="Name" /></div>
		<div><input type="text" name="lastname" value="<?php echo $input_lastname; ?>" placeholder="Last name" /></div>
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
					for ($i=12; $i<=100; $i++) {
						if ($input_max_age == $i) {
							echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						} else {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
					}
				?>
			</select>
		</div>
		<div><input type="submit" value="Search" class="button" /> <a href="<?php echo ROOT; ?>members.php">Clear search</a></div>
	</form>
</div>

<div class="main">
	<div class="members">
		<?php if ($users) { ?>
			<ul>
				<?php foreach ($users as $user) { ?>
					<li class="member">
						<a href="<?php echo profile_uri($user->id); ?>">
							<div style="float:left;width:70px;"><img src="<?php echo get_avatar($user->avatar); ?>" width="60" height="60" alt="" /></div>
							<div style="float:left;">
								<div style="margin-bottom:5px;"><?php echo $user->name; ?></div>
								<?php if ($user->course) { ?>
									<div style="margin-bottom:3px;color:#666;font-size:12px;"><?php echo $user->course; ?></div>
								<?php } ?>
								<div style="margin-bottom:3px;color:#666;font-size:12px;"><?php echo $user->get_age(); ?> years old</div>
							</div>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php } else { ?>
			<p>No members found.</p>
		<?php } ?>
	</div>
</div>