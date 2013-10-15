<aside class="sidebar">
	<div class="avatar">
		<img src="<?=get_avatar($user->id)?>" width="200" height="200" />
	</div>
	
	<form>
		<input type="submit" name="friend" value="Request friend">
	</form>
		
	<ul class="user-menu">
		<li><a href="#">Wall</a></li>
		<li><a href="#">Photos</a></li>
		<li><a href="#">Groups</a></li>
	</ul>
		
	<h3>Friends</h3>
	<?
	if ($friends) {
		foreach ($friends as $friend) {
			echo '<a href="'.profile_uri($friend->id).'">';
			echo '<img src="'.get_avatar($friend->id).'" width="50" height="50" />';
			echo '</a>';
		}
	} else {
		echo 'No friends yet.';
	}
	?>		
</aside>

<section class="main">
	<div class="user-details">
		<h2><?=$user->name?> <?=$user->lastname?></h2>
		<p>Birthday: <?=$user->get_birthday()?></p>
		<p>Gender: <a href="<?=search('gender', $user->gender)?>"><?=$user->get_gender()?></a></p>
		<? if ($user->course) { ?>
			<p>Course: <a href="<?=search('course', $user->course_id)?>"><?=$user->course?></a></p>
		<? } ?>
		<p>Age: <?=$user->get_age()?></p>
	</div>
	
	<h3>Wall</h3>
	
	<? if ($post_error) echo $post_error; ?>
	
	<? Post::print_form(); ?>
	
	<?
	if ($posts) {
		foreach ($posts as $post) {
			$post->print_post();
		}
	}
	?>
</section>