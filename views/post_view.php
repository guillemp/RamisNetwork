<div class="post">
	<div style="float:left;width:60px;">
		<a href="<?php echo profile_uri($post->author); ?>">
			<img src="<?php echo get_avatar($post->avatar); ?>" width="50" height="50" />
		</a>
	</div>
	<div style="float:left;width:480px;">
		<div><a href="<?php echo profile_uri($post->author); ?>"><?php echo $post->name; ?></a></div>
		<div><?php echo $post->content; ?></div>
	</div>
	<div class="clear"></div>
</div>