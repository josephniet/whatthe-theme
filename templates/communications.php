<!-- <article class="email">
<h2><?php echo $item->title ?></h2>

<div class="content"><?php echo $item->content ?></div>
</article> -->



<div class="dropdown">
	<div class="strapline"><?php echo $item->title ?><div class="dropdown-icon"><img src="<?php echo get_stylesheet_directory_uri()?>/img/plus.png" alt="expand"/></div></div>
	<div class="dropdown-content dropdown-hide">
		<?php echo $item->content ?>
	</div>
</div>
