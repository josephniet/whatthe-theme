<?php 	
/**
 * Template Name: Photos
 */

get_header();
$items = get_galleries();
 ?>
<div class="container">
	<h1 class="title"><?php the_title() ?></h1>
	<div class="content">
		<?php the_content() ?>
	</div>
	
	<section class="galleries-container">
	<?php foreach($items as $item){
		//var_dump($event);
		echo $item->render('excerpt');
	} ?>
	</section>
</div>

<?php get_footer(); ?>

