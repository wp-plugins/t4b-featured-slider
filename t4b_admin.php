<?php
add_action('admin_menu', 't4b_register_menu');
define( 'T4B_DOMAIN', 't4b-featured-slider' );

function t4b_register_menu() {
	add_menu_page('T4B Featured Slider', 'T4B Slider', 'add_users', __FILE__, 't4b_featured_plugin_menu', plugins_url('t4b-featured-slider/images/icon.png'));
	add_submenu_page(__FILE__, __('Usage', T4B_DOMAIN ), __('Usage', T4B_DOMAIN ), 'add_users', __FILE__, 't4b_featured_plugin_menu');
	add_submenu_page(__FILE__, 'Settings', 'Settings', 'manage_options', 't4b_settings', 't4b_settings_page');
	add_action( 'admin_init', 'register_t4b_settings' );
}

function register_t4b_settings() {
	register_setting( 't4b-settings-group', 't4b_option' );
}

include "admin/sidebar.php";

function t4b_featured_plugin_menu() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include "admin/usage.php";
}
function t4b_settings_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include "admin/settings.php";
}
?>