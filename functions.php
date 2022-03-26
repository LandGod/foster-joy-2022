<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );

function afs4kids_scripts() {
	wp_enqueue_script( 'afs4kids-scripts', get_stylesheet_directory_uri() . '/js/afs4kids.js', array('jquery'), '1.0.0', true );

	// Load page specific CSS & JS for tagtree page only if we're actually on a tagtree page
	if (is_page_template('tagtree.php')) {
		wp_enqueue_style("bootstrap4", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"); // Load Bootstrap css
		// Supply file updated time as version number so that the most recent version is always used
		wp_enqueue_style(
			'tagtree-css', 
			get_stylesheet_directory_uri() . '/css/tagtree.css', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/css/tagtree.css'))
		);
		wp_enqueue_script(
			'tagtree-js', 
			get_stylesheet_directory_uri() . '/js/tagtree.js', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/js/tagtree.js')), 
			true
		);
	} elseif (is_page_template('backpack-drive.php')) {
		wp_enqueue_style("bootstrap4", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"); // Load Bootstrap css
		// Supply file updated time as version number so that the most recent version is always used
		wp_enqueue_style(
			'backpack-drive-css', 
			get_stylesheet_directory_uri() . '/css/backpack-drive.css', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/css/backpack-drive.css'))
		);
		wp_enqueue_script(
			'backpack-drive-js', 
			get_stylesheet_directory_uri() . '/js/backpack-drive.js', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/js/backpack-drive.js')), 
			true
		);
	} elseif (is_page_template('camp-drive.php')) {
		wp_enqueue_style("bootstrap4", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"); // Load Bootstrap css
		// Supply file updated time as version number so that the most recent version is always used
		wp_enqueue_style(
			'camp-drive-css', 
			get_stylesheet_directory_uri() . '/css/camp-drive.css', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/css/camp-drive.css'))
		);
		wp_enqueue_script(
			'camp-drive-js', 
			get_stylesheet_directory_uri() . '/js/camp-drive.js', 
			array(), 
			date('ymd-Gis', filemtime(get_stylesheet_directory() . '/js/camp-drive.js')), 
			true
		);
	}
};

add_action( 'wp_enqueue_scripts', 'afs4kids_scripts' );

register_nav_menus( array(
	'quick_menu' => 'Footer Quick Menu',
	'afs_menu' => 'Footer AFS Menu',
));