<?php
function get_all_posts($type, $args = null){
	$items = array();
	$defaults = array(
		'post_type' => $type,
		'posts_per_page' => -1
	);	
	$args = wp_parse_args($defaults, $args);
	// The Query
	$the_query = new WP_Query( $args );
	
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			array_push($items, auto_builder($the_query->post));
		}
	} else {
		// no posts found
		return false;
	}	
	wp_reset_postdata();
	//var_dump($items);
	return $items;
}



function get_events(){
	$events = get_all_posts('event', array(
	'orderby' => 'meta_value_num',
	'meta_key' => 'start_date'
	));
	return $events;
}
function getLatestEvent(){
	
}

function getEvent($ID){}



// ================ MUSIC =============


function get_musics(){
	$items = get_all_posts('music');
	return $items;
}




// ================ Gallery =============
function get_galleries(){
	return get_all_posts('gallery');
}



?>
