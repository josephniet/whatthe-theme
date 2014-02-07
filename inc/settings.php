<?php

$settings = new stdClass();
$src = new WP_Query( 'pagename=settings');
 $src->the_post();
$src = $post;
function get_thing ($field){
	global $post;
	$thing = (object)get_field($field, $post->ID);
	if (!isset($thing->url)) return '';
	return $thing->url;
}
$settings->header_strip = get_thing('header_strip');
$settings->logo = get_thing('logo');
$settings->dropdown_background = get_thing('dropdown_background');
$settings->header_background = get_thing('header_background');
wp_reset_query();
wp_reset_postdata();