<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RamisNetwork - <?=$title?></title>
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>css/estils.css">
</head>
<body>

<header>
	<div class="wrap">
		<h1><a href="<?=$home?>">RamisNetwork</a></h1>
		<nav class="algo">
			<ul>
				<? if ($current_user->authenticated) {?>
					<li><a href="<?=profile_uri($current_user->id)?>"><?=$current_user->name?></a></li>
					<li><a href="<?=ROOT?>members.php">Members</a></li>
					<li><a href="#">Messages</a></li>
					<li><a href="#">Privacy</a></li>
					<li><a href="#">Settings</a></li>
					<li><a href="<?=ROOT?>login.php?action=logout">Logout</a></li>
				<? } else { ?>
					<li><a href="<?=ROOT?>members.php">Members</a></li>
					<li><a href="<?=ROOT?>login.php">Login</a></li>
				<? } ?>
			</ul>
			<div class="clear"></div>
		</nav>
		<div class="clear"></div>
	</div>
</header>

<div class="wrap">
	<section class="content">