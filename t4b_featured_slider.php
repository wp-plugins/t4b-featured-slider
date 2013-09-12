<?php
/*
Plugin Name: T4B Featured Slider
Plugin URI: http://wordpress.org/plugins/t4b-featured-slider/
Version: 1.2
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

/* GET THUMBNAIL URL */
function get_featured_image_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large');
	$image_url = $image_url[0];
	echo $image_url;
}	
		
function wpe_excerptlength_feapost($length) {
	$t4b_slider_limit = get_option('limit');
	if(empty($t4b_slider_limit)){$t4b_slider_limit = 350;}
	return $t4b_slider_limit;
}
function wpe_excerptmore_feapost($more) {
	$t4b_slider_rmore = get_option('read_more');
	if(empty($t4b_slider_rmore)){$t4b_slider_rmore = "[...]";}
	return '<br /><a href="'. get_permalink($post->ID) . '">' . $t4b_slider_rmore . '</a>';
}
function t4b_wpe_excerpt($length_feapost='', $more_feapost='') {
    global $post;
    if(function_exists($length_feapost)){
        add_filter('excerpt_length', $length_feapost);
    }
    if(function_exists($more_feapost)){
        add_filter('excerpt_more', $more_feapost);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
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
<?php $t4b_slider_path =  WP_PLUGIN_URL . "/t4b-featured-slider"; ?>
<style>
#pslider{
	width:<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width;} else {echo "640";}?>px;
	height:<?php $t4b_slider_height = get_option('feat_height'); if(!empty($t4b_slider_height)) {echo $t4b_slider_height;} else {echo "300";}?>px;
	overflow:hidden;
}
#pcover{
	width:<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width;} else {echo "640";}?>px;
	height:<?php $t4b_slider_height = get_option('feat_height'); if(!empty($t4b_slider_height)) {echo $t4b_slider_height;} else {echo "300";}?>px;
	margin:<?php $t4b_slider_slider_top = get_option('slider_top'); if(!empty($t4b_slider_slider_top)) {echo $t4b_slider_slider_top;} else {echo "10";}?>px 0 <?php $t4b_slider_slider_bot = get_option('slider_bot'); if(!empty($t4b_slider_slider_bot)) {echo $t4b_slider_slider_bot;} else {echo "20";}?>px 5px ;
	position: relative; 
	background:#<?php $t4b_slider_bg = get_option('feat_bg'); if(!empty($t4b_slider_bg)) {echo $t4b_slider_bg;} else {echo "364D55";}?> url(<?php echo $t4b_slider_path; ?>/images/featured.png) 55px 0 no-repeat;
}
.mytext{
	position:relative;
	margin:20px 0px 0px 0px;
	width:<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width - 10;} else {echo "630";}?>px;
	height:<?php $t4b_slider_height = get_option('feat_height'); if(!empty($t4b_slider_height)) {echo $t4b_slider_height - 40;} else {echo "260";}?>px;
	display:inline;
	float:left;
}
.slimg{
	float:left;
	margin:23px 20px 10px 20px;
	width: <?php $t4b_slider_img_width = get_option('img_width'); if(!empty($t4b_slider_img_width)) {echo $t4b_slider_img_width;} else {echo "180";}?>px;
	height: <?php $t4b_slider_img_height = get_option('img_height'); if(!empty($t4b_slider_img_height)) {echo $t4b_slider_img_height;} else {echo "180";}?>px;
	padding:5px;
	background:#<?php $t4b_slider_img_bg = get_option('img_bg'); if(!empty($t4b_slider_img_bg)) {echo $t4b_slider_img_bg;} else {echo "4C666C";}?>;
}
.mytext-right{
	width:<?php $t4b_slider_cont_width = get_option('cont_width'); if(!empty($t4b_slider_cont_width)) {echo $t4b_slider_cont_width;} else {echo "395";}?>px;
	float:right;
}
.mytext-right h2{
	padding:10px 0px;
	color:#<?php $t4b_slider_title_color = get_option('title_color'); if(!empty($t4b_slider_title_color)) {echo $t4b_slider_title_color;} else {echo "FAFAFA";}?>;
	font-size: 18px ;
	font-weight:bold;
	text-decoration:none;
}
.mytext-right h2 a:link,.mytext-right h2 a:visited{
	color:#<?php $t4b_slider_title_visited = get_option('title_visited'); if(!empty($t4b_slider_title_visited)) {echo $t4b_slider_title_visited;} else {echo "F4F4F2";}?>;
	text-shadow:1px 1px 0px #111;
	text-decoration:none;
}
.mytext-right a {
	color:#<?php $t4b_slider_link_color = get_option('link_color'); if(!empty($t4b_slider_link_color)) {echo $t4b_slider_link_color;} else {echo "5E98BA";}?>;
	text-decoration:underline;
	outline:none;
}
.mytext-right a:hover {
	color:#<?php $t4b_slider_link_hover = get_option('link_hover'); if(!empty($t4b_slider_link_hover)) {echo $t4b_slider_link_hover;} else {echo "F4F4F2";}?>;
	text-decoration:none;
}
.mytext-right p{
	padding:10px 5px 0px 0px;
	color:#<?php $t4b_slider_text_color = get_option('text_color'); if(!empty($t4b_slider_text_color)) {echo $t4b_slider_text_color;} else {echo "aaa";}?>;
	font-size: 14px ;
	line-height:20px;
	text-shadow:1px 1px 0px #111;
}
.mytext-right span{
	padding:5px;
	background:#4C666C;
	color:#fafafa;
	font-size: 12px ;
	text-shadow:1px 1px 0px #111;
	border:1px solid #4a6974;
}
.bx-wrapper{
	width:<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width;} else {echo "640";}?>px!important;
}
.bx-window{
	height:<?php $t4b_slider_height = get_option('feat_height'); if(!empty($t4b_slider_height)) {echo $t4b_slider_height;} else {echo "300";}?>px!important;
	width:<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width;} else {echo "640";}?>px!important;
}
.bx-pager{
position:absolute;
padding:5px 10px 5px 5px;
bottom:10px;
right:10px;
z-index:1000;
}
a.pager-link{
width:12px;
height:12px;
display:block;
text-indent:-9000px;
background:url(<?php echo $t4b_slider_path; ?>/images/cog.png);
float:right;
margin-left:5px;
}
a.pager-active{
width:12px;
height:12px;
display:block;
text-indent:-9000px;
background:url(<?php echo $t4b_slider_path; ?>/images/coga.png);
float:right;
margin-left:5px;
}
</style>	
<?php
	$t4b_slider_sort = get_option('sort'); if(empty($t4b_slider_sort)){$t4b_slider_sort = "post_date";}
	$t4b_slider_order = get_option('order'); if(empty($t4b_slider_order)){$t4b_slider_order = "DESC";}
	$t4b_slider_post_limit = get_option('limit_posts'); if(empty($t4b_slider_limit_posts)){$t4b_slider_limit_posts = "-1";}

	$stickies = t4bFeaturedPost();
	rsort( $stickies );
	$stickies = array_slice( $stickies, 0, $t4b_slider_post_limit );
	$args = array( 'post__in' => $stickies, 'caller_get_posts' => 1, 'orderby' => $t4b_slider_sort, 'order' => $t4b_slider_order);
	$featured = new WP_Query( $args );
		
	if ($featured->have_posts()): ?>
		<div id="pcover">
		<div id="pslider">
		<?php while( $featured->have_posts() ) : $featured->the_post(); ?>
			<div class="mytext">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink() ?>"><img class="slimg" src="<?php get_featured_image_url(); ?>" alt="" /></a>
				<?php } else { ?>
					<a href="<?php the_permalink() ?>">
						<img class="slimg" src="<?php bloginfo('template_directory'); ?>/images/dummy.png" alt="" />
					</a>
				<?php } ?>
				<div class="mytext-right">
                   	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                   	<span>By&nbsp;&nbsp;<?php the_author_posts_link(); ?>&nbsp;&nbsp;On&nbsp;&nbsp;<?php the_time('M j, Y'); ?>&nbsp;&nbsp;<?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
					<?php t4b_wpe_excerpt('wpe_excerptlength_feapost', 'wpe_excerptmore_feapost'); ?>
				</div>
			</div>   	
	    <?php endwhile; wp_reset_query(); ?>
		</div>
		</div>
   	<?php endif; ?>
<?php
}
?>