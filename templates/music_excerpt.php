<article class="music">
	<div class="inner">
		<?php switch($item->content_type) {
		case 'embed': 
			echo $item->attached;
			break;
		case 'link' : 
			echo "<a class='link' href='{$item->attached}'>
				<div class='link-content'>{$item->attached}</div>
				<img src='$item->thumbnail' />
			</a>";
			break;
		}?>	
	</div>
</article>