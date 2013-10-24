<div class="members">
	<ul>
		<? if ($users) { ?>
			<? foreach ($users as $user) { ?>
				<li class="member">
					<a href="<?=profile_uri($user->id)?>">
						<img src="<?=get_avatar($user->avatar)?>" width="100" height="100">
						<? echo $user->name; ?>
					</a>
				</li>
			<? } ?>
		<? } else { ?>
			<p>No members found.</p>
		<? } ?>
	</ul>
	<div class="clear"></div>
</div>