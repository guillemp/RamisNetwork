<form action="" method="post">
	<img src="<?=get_avatar($current_user->id)?>" width="50" height="50" />
	<textarea name="content" cols="60" rows="3"></textarea>
	<input type="submit" name="post" value="Enviar">
</form>