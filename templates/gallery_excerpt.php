<article class="gallery excerpt">
	<div class="inner">
		<a href="<?php echo $item->permalink ?>">
			<?php echo get_the_post_thumbnail($item->id, 'thumbnail'); ?>
			<div class="info-overlay">	
				<div class="prompt hidden">view</div>
			</div>
			<div class="gallery-title"><?php echo $item->title ?></div>
		</a>
	</div>
</article>