<?php
/*
Plugin Name: T4B Featured Slider
Plugin URI: http://wordpress.org/plugins/t4b-featured-slider/
Version: 1.1
Description: "T4B Featured Slider" allows you to show featured posts on your blog using a smooth jQuery slider.
Author: Iftekhar
Author URI: http://profiles.wordpress.org/moviehour/
Text Domain: t4b
*/

/*  Copyright 2013  Iftekhar  (email : moviehour@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
		$msg = "The ID you have inserted is already exist in the featured lists! Try another.";
		return $msg;
	} else {
		$sql_to_insert = "insert into $table_name(post_id,post_title,activity_date) values('$post_id','$post_title',NOW());";
		$wpdb->query($sql_to_insert);
		$msg = "Congratulations! You have successfully inserted the post in the featured lists.";
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
		$msg = "The post successfully deleted from the featured lists.";
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
		$stickies = t4bFeaturedPost();
		rsort( $stickies );
		$stickies = array_slice( $stickies, 0, 10 );
		$args = array( 'post__in' => $stickies, 'caller_get_posts' => 1 );
		$featured = new WP_Query( $args );
		
		if ($featured->have_posts()): ?>
		<div id="pcover">
			<div id="pslider">
				<?php while( $featured->have_posts() ) : $featured->the_post(); ?>
					<div class="mytext">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>"><img class="slimg" src="<?php get_image_url(); ?>" alt="" /></a>
						<?php } else { ?>
							<a href="<?php the_permalink() ?>">
								<img class="slimg" src="<?php bloginfo('template_directory'); ?>/images/dummy.png" alt="" />
							</a>
						<?php } ?>
                           	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                           	<span>By <?php the_author_posts_link(); ?> On <?php the_time('M j, Y'); ?><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
							<p><?php wpe_excerpt('wpe_excerptlength_featp', ''); ?></p>
					</div>   	
			    <?php endwhile; wp_reset_query(); ?>
			</div>
		</div>
   	<?php endif; ?>
<?php
}
?>