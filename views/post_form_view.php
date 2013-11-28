<?php if ($parent == 0) { ?>
<div style="margin-bottom:20px;">
<?php } else { ?>
<div style="margin-top:10px;">
<?php } ?>
<form action="" method="post">
	<?php if ($parent == 0) { ?>
	<div style="float:left;width:60px;">
		<img src="<?php echo get_avatar($current_user->avatar); ?>" width="50" height="50" />
	<?php } else { ?>
		<div style="float:left;width:40px;">
			<img src="<?php echo get_avatar($current_user->avatar); ?>" width="30" height="30" />
	<?php } ?>
	</div>
	<?php if ($parent == 0) { ?>
		<div style="float:left;width:480px;">
			<textarea name="content" class="post-form"></textarea>
	<?php } else { ?>
		<div style="float:left;width:440px;">
			<textarea name="content" class="post-form" style="width:430px;"></textarea>
	<?php } ?>	
	</div>
	<input type="hidden" name="parent" value="<?php echo $parent; ?>" />
	<div style="text-align:right"><input type="submit" name="post" value="Send" class="button button-small" /></div>
</form>
<div class="clear"></div>
</div>