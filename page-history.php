<?php 	
/**
 * Template Name: History
 */

get_header();
$events = get_events();	
foreach($events as $event){
	if ($event->archive){
		echo $event->render('excerpt');
	}
}
?>

<?php get_footer(); ?>

