<?php if ($is_reply) { ?>
<div class="post-reply">
	<div class="post-avatar-reply">
<?php } else { ?>
<div class="post">
	<div class="post-avatar">
<?php } ?>
		<a href="<?php echo profile_uri($post->author); ?>">
			<?php if ($is_reply) { ?>
				<img src="<?php echo get_avatar($post->avatar); ?>" width="30" height="30" alt="<?php echo $post->name; ?>" />
			<?php } else { ?>
				<img src="<?php echo get_avatar($post->avatar); ?>" width="50" height="50" alt="<?php echo $post->name; ?>" />
			<?php } ?>
		</a>
	</div>
<?php if ($is_reply) { ?>
	<div class="post-body-reply">
<?php } else { ?>
	<div class="post-body">
<?php } ?>
		<div class="post-name"><a href="<?php echo profile_uri($post->author); ?>"><?php echo $post->name; ?></a></div>
		<div class="post-content"><?php echo $post->content; ?></div>
		<div class="post-links">
			<span id="like-<?php echo $post->id; ?>"><a href="javascript:like('<?php echo $post->id; ?>', '<?php echo $current_user->id; ?>');">Like</a></span> · 
			<?php if (!$is_reply) { ?>
			<a href="#" onclick="$('#box-<?php echo $post->id; ?>').toggle();return false;">Comment</a> · 
			<?php } ?>
			<a href="<?php echo $post->permalink(); ?>" style="color:#AAA;" title="<?php echo date("d-m-Y H:i", $post->date); ?>"><?php echo time_ago($post->date); ?> ago</a>
		</div>
		<?php if ($likes) { ?>
			<div class="post-likes"><?php echo $likes; ?> <?php if ($likes_count > 1) echo 'like'; else echo 'likes'; ?> this</div>
		<?php } ?>
		
		<div id="box-<?php echo $post->id; ?>" style="display:none;">
			<?php Post::print_form($post->id); ?>
		</div>
		
		<?php if ($replies) { ?>
			<div class="post-replies">
				<?php foreach ($replies as $reply) { ?>
					<?php $reply->print_post(); ?>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div>