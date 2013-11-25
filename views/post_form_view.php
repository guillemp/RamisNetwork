<div style="margin-bottom:20px;">
<form action="" method="post">
	<div style="float:left;width:60px;">
		<img src="<?php echo get_avatar($current_user->avatar); ?>" width="50" height="50" />
	</div>
	<div style="float:left;width:480px;"><textarea name="content" class="post-form"></textarea></div>
	<div style="text-align:right"><input type="submit" name="post" value="Send" class="button" /></div>
</form>
</div>