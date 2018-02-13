<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'extra-style';
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'extra-child',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
	);
	
	wp_enqueue_script( 'font-awesome-5', get_stylesheet_directory_uri() . '/vendor/fontawesome/fontawesome-all.js', array(), '', false );
}

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

// ===============================================
// Add widgets to child theme.
// ===============================================
define('FULLCIRCLE_CHILD_THEME_DIRECTORY', get_stylesheet_directory());

include(FULLCIRCLE_CHILD_THEME_DIRECTORY . '/widgets/asufse-endorsed-footer-widget.php');
include(FULLCIRCLE_CHILD_THEME_DIRECTORY . '/widgets/asufse-socialicons-footer-widget.php');

// ===============================================
// Add supporting functions for External_News CPT, if the plugin is installed.
// ===============================================

include(get_stylesheet_directory() . '/includes/externalnews-misc.php');