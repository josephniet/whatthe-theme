<article class="featured">
	<div class="attached-item">
	<?php
		$orig = $item;
		$item = $item->attached_item;
	//	var_dump($item->type);
		echo $item->render('excerpt');
		?>
	</div>
	<div class="context">
		<h2><?php echo $orig->title ?></h2>
		<p><?php echo $orig->content ?></p>
	</div>
</article>
