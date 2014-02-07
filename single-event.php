<?php 	
/**
 * Template Name: History
 */

get_header();
while (have_posts()) {
	the_post();
	$event = new Event($post);
	echo $event->render();
}
?>

<?php get_footer(); ?>

