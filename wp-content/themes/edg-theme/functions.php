<?php

/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */

add_action('wp_enqueue_scripts', 'edg_theme_style');
function edg_theme_style()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
	wp_enqueue_style('youtube-playlist-style', get_stylesheet_directory_uri() . '/fetchData/youtube-playlist-style.css');
	// wp_enqueue_script('edgtheme-youtube-playlist', get_stylesheet_directory_uri() . '/fetchData/youtube-playlist.js');
}

/**
 * Your code goes below.
 */

add_action('get_the_archive_title', 'change_my_title');

function change_my_title($title)
{
	if ($title == "Catégorie : ") $title = "Viewing All Offices";
	return $title;
}
// add_filter("get_the_archive_title", "change_my_title");

function change_archive_page_title($title)
{
	if (is_category()) {
		$title = single_cat_title('', false);
	}
	return $title;
}

add_filter('get_the_archive_title', 'change_archive_page_title');
