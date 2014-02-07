<?php 	
/**
 * Template Name: Music
 */

get_header();
$items = get_musics();
?>
<div class="container">
	<h1 class="title"><?php the_title() ?></h1>
	<div class="content">
		<?php the_content() ?>
	</div>
	<div class="music-container">
	<?php 
	foreach($items as $item){
		//var_dump($event);
		echo $item->render();
	}
	 ?>
	 </div>
</div>
<?php get_footer(); ?>

