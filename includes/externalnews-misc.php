<?php
/* Included functions for External_News CPT. Borrows functions from parent theme's "timeline" view. */

// ------------------------
// Fancy code for the timeline presentation for In the News Sections.
// ------------------------
function externalnews_get_timeline_menu_month_groups() {
	global $wpdb;

	$externalnews_month_groups = $wpdb->get_col( "SELECT DISTINCT DATE_FORMAT( {$wpdb->posts}.post_date, '%M-%Y' ) as date_slug FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_type = 'external_news' AND {$wpdb->posts}.post_status = 'publish'  ORDER BY {$wpdb->posts}.post_date desc" );
	
	return $externalnews_month_groups;
}

function externalnews_get_timeline_posts( $args = array() ) {
	$default_args = array(
		'nopaging'            => true,
		'posts_per_page'      => -1,
		'post_type'           => 'external_news',
		'orderby'             => 'date',
		'order'               => 'desc',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	);

	$args = wp_parse_args( $args, $default_args );

	$posts = new WP_Query( $args );

	return $posts;
}

function externalnews_get_timeline_posts_onload() {
	// Get all posts published, regardless of year.
	$externalnews_timeline_posts = externalnews_get_timeline_posts();
	return $externalnews_timeline_posts;
}
