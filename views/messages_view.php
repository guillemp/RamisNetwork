<div class="sidebar">
	<a href="<?php echo ROOT; ?>messages.php?action=new">New message</a>
</div>

<div class="main">
	<?php
	
	switch ($action) {
		case 'new':
			Post::print_form();
			break;
		case 'read':
			break;
		case 'inbox':
		default:
			break;
	}
	
	?>
</div>