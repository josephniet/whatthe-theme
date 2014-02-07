<article class="music">
	<div class="inner">
		<?php switch($item->content_type) {
		case 'embed': 
			echo $item->attached;
			break;
		case 'link' : 
			echo "<a class='link' href='{$item->attached}'>
				<div class='link-content'>
				<b>{$item->title}:</b>
				<span>{$item->attached}</span>
				</div>
				<img src='$item->thumbnail' />
			</a>";
			break;
		}?>
		<!--<h2 class="title"><?php echo $item->title ?></h2>-->
		<div class="content">
			<?php echo $item->content ?>
		</div>
		
	</div>
</article>