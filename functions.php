<?php
include "post_types.php";


/*
** Adding custom ACF plugins
*/
function acf_register_fields() {
	include_once('inc/acf-repeater/repeater.php');
}
add_action('acf/register_fields', 'acf_register_fields');


add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'menus' );
$args = array(
	'default-color' => 'rgb(79, 192, 255)',
	'wp-head-callback' => 'change_custom_background_cb',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg',
);
add_theme_support( 'custom-background', $args );




 function writeDate($date){
		if (!$date) return;
		echo "<div style='display:none;'>{$date}</div>";
		date_default_timezone_set('UTC');
		$date = new DateTime('@' . $date);
		$date->setTimezone( new DateTimeZone('UTC') );
		//var_dump($date);	
		$datestring = date_format($date, 'l d F Y');
		echo "<div class='date'>{$datestring}</div>";
	}
 
 
 function doFeatured($item){ foreach ($item->attachedItems as $item) { include dirname(__FILE__) . "/templates/attached_item.php";} }
 
function doAdditional($item){foreach ($item->additionalContent as $item){ ?>
	<section class="dropdown">
		<div class="strapline"><?php echo $item->title ?><div class="dropdown-icon"><img alt="expand" src="<?php echo get_stylesheet_directory_uri()?>/img/plus.png"/></div></div>
		<div class="dropdown-content dropdown-hide"><?php echo $item->content ?></div>
	</section> 
<?php } } 


/* ======================= custom BG ============================ */


function change_custom_background_cb() {
	$background = get_background_image();
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );

		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';

		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );

		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';

		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );

		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';

		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
<style type="text/css">
#bg { <?php echo trim( $style ); ?> }
</style>
<?php
}
