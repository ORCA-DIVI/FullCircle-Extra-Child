<?php

function theme_enqueue_styles() {
	wp_enqueue_style( 'extra', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'font-awesome-5', get_template_directory_uri() . 'vendor/fontawesome/fontawesome-all.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* Disable star ratings */
function disable_ratings() { return false; }
add_filter('extra_is_post_rating_enabled', 'disable_ratings');


/* Add new widget location in secondary bar (Upper Left) */
function fsExtra_widgets_init() {
	register_sidebar( array(
		'name'          => 'Secondary Bar Widget (Upper Left)',
		'id'            => 'secondary_bar_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'fsExtra_widgets_init' );


/**
 * Public Post Preview nonce expiration date set to 7 days in globally applied MU plugin.
 * See: /wp-content/mu-plugins/fseupstream-utility.php
 */

 /* Change Twitter Card type to summary_large_image. */
 /* See: https://github.com/twitter/wordpress/wiki/Cards for more details */
function twitter_card_type( $card_type, $query_type, $object_id ) {
	return 'summary_large_image';
}
add_filter('twitter_card_type', 'twitter_card_type', 10, 3);

// Add widgets to child theme
define('FULLCIRCLE_CHILD_THEME_DIRECTORY', get_stylesheet_directory());
include(FULLCIRCLE_CHILD_THEME_DIRECTORY . '/widgets/asufse-endorsed-footer-widget.php');
include(FULLCIRCLE_CHILD_THEME_DIRECTORY . '/widgets/asufse-socialicons-footer-widget.php');