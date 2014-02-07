<?php get_header();
	// Start the Loop.
	while (have_posts()) {
		the_post();
		$items = get_field('collection');
		//var_dump($items, $post);
	}
?>
<div class="container">
	<h1 class="title"><?php the_title() ?></h1>
	<div class="content">
		<?php the_content() ?>
	</div>
	
	<section class="photos-container">
		<?php foreach($items as $item) {
			$item = json_decode(json_encode( $item['image'] ));
			//var_dump($item);
			echo "<article class='photo excerpt'>";
			echo "<div class='photo-inner'>";
			echo "<a href='$item->url' data-lightbox='gallery' title='{$item->id}'> ";
			echo "<div class='info-overlay'><div class='zoom'></div></div>";
			echo wp_get_attachment_image($item->id, 'thumbnail');
			echo "</a></div></article>";
		} ?>
	</section>
</div>
<?php get_footer(); ?>