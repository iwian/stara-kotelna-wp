<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Check if portfolio post type then go to another template
$post_type = get_post_type();

if($post_type == 'galleries')
{
	get_template_part("galleries");
	exit;
}
else
{
	//Get archive page layout setting
	$tg_blog_archive_layout = get_theme_mod('tg_blog_archive_layout', 'blog_g');
	
	$located = locate_template($tg_blog_archive_layout.'.php');
	if (!empty($located))
	{
		get_template_part($tg_blog_archive_layout);
	}
	else
	{
		echo 'Error can\'t find page template you selected';
	}
}
?>