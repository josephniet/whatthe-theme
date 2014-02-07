<?php
add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

    $labels = array( 
        'name' => _x( 'events', 'event' ),
        'singular_name' => _x( 'event', 'event' ),
        'add_new' => _x( 'Add New', 'event' ),
        'add_new_item' => _x( 'Add New event', 'event' ),
        'edit_item' => _x( 'Edit event', 'event' ),
        'new_item' => _x( 'New event', 'event' ),
        'view_item' => _x( 'View event', 'event' ),
        'search_items' => _x( 'Search events', 'event' ),
        'not_found' => _x( 'No events found', 'event' ),
        'not_found_in_trash' => _x( 'No events found in Trash', 'event' ),
        'parent_item_colon' => _x( 'Parent event:', 'event' ),
        'menu_name' => _x( 'events', 'event' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'taxonomies' => array( 'category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'event', $args );
}

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'galleries', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'gallery', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'gallery', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( '', 'text_domain' ),
		'view_item'           => __( '', 'text_domain' ),
		'add_new_item'        => __( 'Add New gallery', 'text_domain' ),
		'add_new'             => __( 'New gallery', 'text_domain' ),
		'edit_item'           => __( 'Edit gallery', 'text_domain' ),
		'update_item'         => __( 'Update gallery', 'text_domain' ),
		'search_items'        => __( 'Search galleries', 'text_domain' ),
		'not_found'           => __( 'No galleries found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No galleries found in Trash', 'text_domain' ),
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'gallery', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );




add_action( 'init', 'register_cpt_music' );

function register_cpt_music() {

    $labels = array( 
        'name' => _x( 'music', 'music' ),
        'singular_name' => _x( 'music', 'music' ),
        'menu_name' => _x( 'music', 'music' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'taxonomies' => array( 'category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'music', $args );
}