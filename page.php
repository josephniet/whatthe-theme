<?php 	
/**
 * Template Name: Default
 */

get_header();
?>
<div class="container">
	<h1 class="title"><?php the_title() ?></h1>
	<div class="content">
		<?php the_content() ?>
	</div>
</div>
<?php get_footer(); ?>

