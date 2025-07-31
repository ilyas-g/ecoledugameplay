<?php

/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */

// https://www.youtube.com/watch?v=DzXIC4flg0Q
// https://stackoverflow.com/questions/39975520/wordpress-child-theme-style-css-not-working

add_action('wp_enqueue_scripts', 'ecole_du_gameplay_style', 11);
function ecole_du_gameplay_style()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}

/**
 * Your code goes below.
 */


function blogdata_header_dark_switch_section()
{
	$blogdata_lite_dark_switcher = get_theme_mod('blogdata_lite_dark_switcher', 'true');
	if ($blogdata_lite_dark_switcher == true) {
		if (isset($_COOKIE["blogdata-site-mode-cookie"])) {
			$blogdata_skin_mode = $_COOKIE["blogdata-site-mode-cookie"];
		} else {
			$blogdata_skin_mode = get_theme_mod('blogdata_skin_mode', 'defaultcolor');
		} ?>
		<label class="switch d-none d-lg-inline-block" for="switch">
			<input type="checkbox" name="theme" id="switch" class="<?php echo esc_attr($blogdata_skin_mode); ?>" data-skin-mode="<?php echo esc_attr($blogdata_skin_mode); ?>">
			<span class="slider"></span>
		</label>
	<?php }
}



function blogdata_header_menu_section()
{

	$home_icon_disable = get_theme_mod('blogdata_home_icon', true); ?>
	<div class="navbar-wp">
		<button class="menu-btn">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<nav id="main-nav" class="nav-wp justify-center">
			<?php blogdata_target_element('panel', 'nav_menus', 'Click To Edit Menus.'); ?>
			<!-- Sample menu definition -->
			<?php
			if (is_rtl()) {
				$smRTL = ' sm-rtl';
			} else {
				$smRTL = '';
			}
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container'  => '',
				'menu_class' => 'sm sm-clean' . $smRTL . '',
				'fallback_cb' => 'blogdata_fallback_page_menu',
				'walker' => new blogdata_nav_walker()
			));
			?>
			<?php if (get_theme_mod('footer_social_icon_enable', true) == true) {
				do_action('blogdata_action_social_section');
			} ?>

		</nav>
	</div>
<?php }


function blogdata_date_content($date_format = 'default-date')
{ ?>
	<?php if ($date_format == 'default-date') { ?>
		<span class="bs-blog-date">
			<a href="<?php echo esc_url(get_month_link(esc_html(get_post_time('Y')), esc_html(get_post_time('m')))); ?>"><time datetime=""><?php echo get_the_date('j'); ?> <?php echo get_the_date('M'); ?> <?php echo get_the_date('Y'); ?></time></a>
		</span>
	<?php } else { ?>
		<span class="bs-blog-date">
			<a href="<?php echo esc_url(get_month_link(esc_html(get_post_time('Y')), esc_html(get_post_time('m')))); ?>"><time datetime=""><?php echo esc_html(get_the_date()); ?></time></a>
		</span>
	<?php } ?>
<?php }

add_action('created_category', 'blogdata_save_category_fields', 10, 4);
add_action('edited_category', 'blogdata_save_category_fields', 10, 4);
