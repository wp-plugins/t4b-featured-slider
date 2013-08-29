<?php
/*
Plugin Name: T4B Featured Slider
Plugin URI: http://www.tips4blog.com/
Description: This plugin will help you to find the ID of posts from the post URL and show those posts as featured post using slider.
Version: 1.0
Author: Iftekhar
Author URI: http://www.tips4blog.com/about-me/
Text Domain: t4b
*/

if(is_admin())
	include 't4b_admin.php';

add_action( 'init', 'featured_post_install', 1 );
add_action( 'switch_blog', 'featured_post_install' );

function featured_post_install() {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;
	global $charset_collate;
	
    $wpdb->t4b_id_lists = "{$wpdb->prefix}t4b_id_lists";

	$sql_create_table = "CREATE TABLE {$wpdb->t4b_id_lists} (
	          id INT NOT NULL AUTO_INCREMENT,
    	      post_id VARCHAR(200) NOT NULL default '0',
        	  post_title varchar(200) NOT NULL,
	          activity_date datetime NOT NULL default '0000-00-00 00:00:00',
    	      PRIMARY KEY  (id)
	     ) $charset_collate; ";
 
	dbDelta( $sql_create_table );
}

function get_post_ul_meta($post_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix."t4b_id_lists"; 
	$sql="select post_id, post_title from $table_name where post_id=$post_id;";
	$result=$wpdb->get_var($sql);
	if(empty($result))
	{
		$result=0;
	}
	return $result;
}

function get_featured_post_lists()
{
	global $wpdb;
	$table_name = $wpdb->prefix."t4b_id_lists"; 
	$sql_to_all = "SELECT * FROM $table_name ORDER BY id ASC";

	$result = $wpdb->get_results($sql_to_all);
	if($result === NULL){
		$result = 0;
	}
	return $result;
}

function add_featured_post($post_id, $post_title) {
	global $wpdb;
	$table_name = $wpdb->prefix."t4b_id_lists";
	$duplicate = get_post_ul_meta($post_id);

	if($duplicate) {
		$sql_to_update = "update $table_name set post_title=".($post_title)." where post_id='$post_id';";
		$wpdb->query($sql_to_update);
		$msg = "Congratulations! You have successfully updated the post ID.";
		return $msg;
	} else {
		$sql_to_insert = "insert into $table_name(post_id,post_title,activity_date) values('$post_id','$post_title',NOW());";
		$wpdb->query($sql_to_insert);
		$msg = "Congratulations! You have successfully inserted the post ID.";
		return $msg;
	}
}

function remove_featured_post($post_id) {
	global $wpdb;
	$table_name = $wpdb->prefix."t4b_id_lists";
	$duplicate = get_post_ul_meta($post_id);

	if($duplicate) {
		$sql_to_delete = "delete from $table_name where post_id='$post_id';";
		$wpdb->query($sql_to_delete);
		$msg = "Congratulations! You have successfully deleted the post ID.";
		return $msg;
	} else {
		$msg = "Sorry! The ID you have inserted in not exist in our database!";
		return $msg;
	}
}

function t4bFeaturedPost() {
	
	$fpID = array();
	$all_lists = get_featured_post_lists();
	foreach($all_lists as $flists) {
		$fpID[] = $flists->post_id;
	}
	return $fpID;
}

function t4b_enqueue_scripts(){
	if(get_option('t4b_option')==Enabled) {
		wp_enqueue_script('jquery');
		wp_enqueue_style('t4b-front-css', WP_PLUGIN_URL .'/t4b-featured-slider/css/t4b-front.css?v=1.0');
		wp_register_script('t4b-front-js', WP_PLUGIN_URL .'/t4b-featured-slider/js/t4b-front.js', array('jquery'), '1.0');
		wp_enqueue_script('t4b-front-js');
	}
}

add_action('init', 't4b_enqueue_scripts');

function show_Featured_Post_Slider() {
?>
<script type="text/javascript">

 jQuery(document).ready(function(){
    jQuery('#pslider').bxSlider({
	  mode: 'fade',
	  controls:false,
	  auto:true,
	  pager: true
	});
  });

</script>
<?php
}
?>