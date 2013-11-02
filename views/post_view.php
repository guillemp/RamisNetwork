<div class="post">
	<div class="post-avatar">
		<a href="<?php echo profile_uri($post->author); ?>">
			<img src="<?php echo get_avatar($post->avatar); ?>" width="50" height="50" alt="<?php echo $post->name; ?>" />
		</a>
	</div>
	<div class="post-body">
		<div class="post-name"><a href="<?php echo profile_uri($post->author); ?>"><?php echo $post->name; ?></a></div>
		<div class="post-content"><?php echo $post->content; ?></div>
		<div class="post-links">
			<span id="like-<?php echo $post->id; ?>"><a href="javascript:like('<?php echo $post->id; ?>', '<?php echo $current_user->id; ?>');">Like</a></span> · 
			<a href="#">Comment</a> · 
			<a href="#" style="color:#AAA;"><?php echo time_ago($post->date); ?></a>
		</div>
	</div>
	<div class="clear"></div>
</div>