<?php 	
get_header();
$events = get_events();	
//foreach($events as $event){
	//var_dump($event);
	echo $events[0]->render('event');
//}
?>


<?php get_footer(); ?>

