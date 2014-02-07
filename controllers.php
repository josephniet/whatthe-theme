<?php

class Controller {
	public function render($template){
		$item = $this->temp;
		$template = $template ? $template : $item->type;	
		ob_start();
		include 'templates/' . $template . '.php';
		
		return ob_get_clean();
	}
}


class Event extends Controller {
	public function __construct($post, $mode = 'full'){
			global $data;	$this->temp = $data->events[0];
	}
}

class Gallery extends Controller {
	public function __construct($post, $mode = 'full'){
			global $data;	$this->temp = $data->gallery[0];
	}
}



?>