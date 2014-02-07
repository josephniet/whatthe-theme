<?php
/**
  * Parent handler
  *
  */
class Item_Handler {
	
	public function render( $template = null){
		if (empty($template)) $template = $this->type;
		if ($template === 'excerpt' || $template === 'full') $template = $this->type . '_' . $template;
		$item     = $this;
		ob_start();
		
		include get_stylesheet_directory() . '/templates/' . $template . '.php';

		return ob_get_clean();
	}
};


function auto_builder( $post, $mode = 'full' ){
	//var_dump($post);
	switch( $post->post_type ) {
		case 'talk':
			$item = new Talk( $post );
			break;
		case 'event':
			$item = new Event( $post );
			break;
		case 'gallery':
			$item = new Gallery( $post, $mode );
			break;
		case 'music':
			$item = new Music( $post );
			break;
		case 'promobox':
			$item = new Promo( $post );
			break;
		default:
			$item = new Generic( $post );
	}
	return $item;
}

/**
  *  Event object wrapper
  *
  *  Wraps up 'event' post type for later template usage
  *  
  */
class Event extends Item_Handler {
	
	public function __construct( $post, $mode = 'full' ) {
		//var_dump($post);
		$this->id        = $post->ID;
		$this->title     = $post->post_title;
		$this->permalink = get_permalink();
		$this->slug      = $post->post_name;
		$this->post_date_gmt = $post->post_date_gmt;
		$this->date = get_the_date();
		$this->type      = $post->post_type;
		$this->thumbnail = @reset( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb' ) );
		$this->excerpt    = wp_trim_words($post->post_content, 10, '...');
		$this->excerpt =  $post->post_excerpt;
			global $more;    // Declare global $more (before the loop).
			$more = 0;       // Set (inside the loop) to display content above the more tag.
			$this->excerpt = get_the_content('more');
		$this->dates     = array();
		$this->start_date = ( intval(get_field('start_date')) /1000 );
		$this->end_date = ( intval(get_field('end_date')) /1000 );
		$now = new DateTime();
		$start = new DateTime('@' .$this->start_date);
		//var_dump($start,  $now );
		$this->archive = !($start > $now );
		if( $mode == 'full' ) {
			$this->content   = apply_filters('the_content', $post->post_content);
			$this->call_to_action = get_field('call_to_action', $post->ID);
			//var_dump($this->call_to_action);
			$this->tickets_link = (object)@reset(get_field('tickets_link', $post->ID));
			//$this->excerpt   = apply_filters('get_the_excerpt', $post->post_excerpt);
			$this->additionalContent = get_field('expandable_content', $post->ID);
				foreach($this->additionalContent as &$item){
					$item = json_decode(json_encode($item));
				}
			$this->attachedItems = get_field('attached_items', $post->ID);			
				//Resolve attached items
				foreach ($this->attachedItems as &$item){
						$obj = auto_builder($item['attached_item'][0], 'slim');
						$item = json_decode(json_encode($item));
						$item->attached_item = $obj;
					//$item = auto_builder($item[0][0]);	
				}
			$this->communications = get_field('communications', $post->ID);
			$this->communications_text = get_field('communications_text');
			foreach ($this->communications as &$com){
				$com = (object)$com;
			}	
		}
	}//end constructor 
	
	public function gallery( $limit = -1 ) {
		$gallery = array();
		
		if( empty( $this->gallery ) )
			$this->gallery = get_field('gallery', $this->id);
		
		if( count( $this->gallery ) > 0 ) {
			$gallery = $this->gallery;
			
			if( $limit > 0 && $limit <= count( $this->gallery ) )
				$gallery = array_slice( $this->gallery, 0, $limit );
		}
		
		return $gallery;
	}
	
	public function talks( $limit = -1 ) {
		return isset( $this->talks ) ? $this->talks : $this->talks = ll_event_talks( $this->id, $limit );
	}
	
	
}



class Gallery extends Item_Handler {
	public function __construct( $post,  $mode = 'full' ){
		//global $post;
		$this->thumbnail   = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'carousel') );	
		$this->id = $post->ID;
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->permalink    = get_permalink( $post->ID );
		$this->content = apply_filters( 'the_content', $post->post_content );
		if ($mode === 'full') {
			$this->collection   = get_field('collection', $post->ID);
		}
	}
}

function post_thumbnail($post, $size = 'thumb'){
	$thumb = get_post_thumbnail_id($post->ID);
	if ($thumb === "") return get_stylesheet_directory_uri() . '/img/thumbs/' . ($post->post_type) . '.jpg';
	return wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
}

class Music extends Item_Handler {
	public function __construct( $post,  $mode = 'full' ){
		$this->thumbnail   = post_thumbnail($post);
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->permalink    = get_permalink( $post->ID );
		$this->content_type = get_field('content_type', $post->ID);
		$this->attached = get_field($this->content_type, $post->ID);
		$this->content = apply_filters( 'the_content', $post->post_content );
		if ($mode === 'full') {
		}
	}
}


/**
  *  Promo object wrapper
  *
  *  Object wraps up blocks that will show up in the filtered area
  *  
  */
class Promo extends Item_Handler {
	public function __construct( $post ){
		$this->link    = get_field( 'external_link', $post->ID );
		if ( ! $this->link ){
			$this->link = get_field( 'internal_link', $post->ID );
		}
		$this->image   = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'carousel') );	
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->content = apply_filters( 'the_content', get_the_content() );
	}
}

/**
  *  Speaker object wrapper
  *
  *  Object wraps up blocks
  *  
  */
class Speaker extends Item_Handler {
	public function __construct( $post ){
		$this->id      = $post->ID;
		$this->link    = get_permalink( $post->ID );
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->content = apply_filters( 'the_content', $post->post_content );
		$this->photo   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID , 'small' ) );
		$this->photo = $this->photo[0];
		if (!$this->photo) { $this->photo = get_stylesheet_directory_uri() . '/img/avatar.png';}
		
		//$this->photo   = get_the_post_thumbnail($post->ID, 'medium');
	}
}

/**
  *  Partner object wrapper
  *
  *  Object wraps up blocks
  *  
  */
class Generic extends Item_Handler {
	public function __construct( $post ){
		$this->id      = $post->ID;
		$this->permalink    = get_permalink( $post->ID );
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->priority_link = get_field('priority_link');
		$this->link    = $this->priority_link ? $this->priority_link : $this->permalink; //permalink or overriding user supplied link		
		$this->content = apply_filters( 'the_content', $post->post_content );
		$this->excerpt = wp_trim_words($post->post_content, 20, '...');
		$this->thumbnail   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'carousel' );
		$this->thumbnail   = $this->thumbnail[0];
		$this->gallery = get_field('gallery', $post->ID);
	
		$this->featured_items = '';
		if ( $_items = get_field('featured_items', $post->ID) ) {
			foreach ( $_items as $post ){
				$this->featured_items[] = auto_builder( $post );
			}
		}
		
		$this->videos  = get_field('youtube_videos');
		if (is_array($this->videos)){
			foreach ($this->videos as &$video){
				$video = json_decode($video);
			}	
		}
	}
}

class Partner extends Generic{
};
/**
  *  Project object wrapper
  *
  *  Object wraps up blocks
  *  
  */
class Project extends Generic{
};

/**
 * Friend object wrapper
 *
 */
class Friend extends Item_Handler {
	
	public function __construct( $post ) {
	    $this->id      = $post->ID;
		$this->link    = get_field('link');
		$this->type    = $post->post_type;
		$this->title   = $post->post_title;
		$this->content = apply_filters( 'the_content', $post->post_content );
		$this->excerpt = wp_trim_words($post->post_content, 20, '...');
		$this->photo   = @reset( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ) );
	}
}

/**
  *  Category View object wrapper
  *
  *  Object wraps up blocks that will show up in the filtered area
  *  
  */
class View_Item extends Item_Handler {
	
	public function __construct( $item ) {
		$this->talks = '';
		
		// If 'event' or 'speaker' filters applied
		if( $item instanceof WP_Post ) {
			$this->id    = $item->ID;
			$this->title = $item->post_title;
			$this->type  = $item->post_type;
		} else {
		// If 'tag' or 'category' filters applied
			$this->id    = $item->term_id;
			$this->title = $item->name;
			$this->type  = $item->taxonomy;
		}
	}
	
}

/**
  *  Search View object wrapper
  *
  *  Object wraps up blocks that will show up in the search area
  *  
  */
class Search_Item extends Item_Handler {
	
	public function __construct( $item ) {
		$this->item   = auto_builder( $item );
		$this->date   = get_field('date', $item->ID);
		$this->search = true;
	}
	
}
?>