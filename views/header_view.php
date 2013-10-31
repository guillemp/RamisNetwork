<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>RamisNetwork - <?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT; ?>css/estils.css">
</head>
<body>

<header>
	<div class="wrap">
		<h1><a href="<?php echo $home_link; ?>">RamisNetwork</a></h1>
		<nav class="algo">
			<ul>
				<?php if ($current_user->authenticated) {?>
					<li><a href="<?php echo profile_uri($current_user->id); ?>"><?php echo $current_user->name; ?></a></li>
					<li><a href="<?php echo ROOT; ?>courses.php">Courses</a></li>
					<li><a href="<?php echo ROOT; ?>members.php">Members</a></li>
					<li><a href="<?php echo ROOT; ?>messages.php">Messages</a></li>
					<li><a href="<?php echo ROOT; ?>settings.php">Settings</a></li>
					<li><a href="<?php echo ROOT; ?>login.php?action=logout">Logout</a></li>
				<?php } else { ?>
					<li><a href="<?php echo ROOT; ?>members.php">Members</a></li>
					<li><a href="<?php echo ROOT; ?>register.php">Register</a></li>
					<li><a href="<?php echo ROOT; ?>login.php">Login</a></li>
				<?php } ?>
			</ul>
			<div class="clear"></div>
		</nav>
		<div class="clear"></div>
	</div>
</header>

<div class="wrap">
	<div class="content">