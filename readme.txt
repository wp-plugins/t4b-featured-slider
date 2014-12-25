=== T4B Featured Slider ===
Contributors: moviehour
Requires at least: 3.5
Tested up to: 4.1
Tags: Iftekhar, featured post, slider, featured post slider, get id from url, tips4blog
Stable Tag: 1.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


"T4B Featured Slider" allows you to show featured posts on your blog using a smooth jQuery slider.


== Description == 
"T4B Featured Slider" is a simple and easy WordPress plugin to show featured posts on your blog using a smooth jQuery slider. You can use this plugin as an alternate of WordPress Sticky posts.

To get started click on Add Post button under Featured section. Add featured posts as many as you want to show in your blog by entering the post ID. You can easily findout the post id from the right sidebar. Just enter the URL of the post and click on Get ID button. Later you can edit, delete and reorder featured posts at any time.

Now, copy the below code and paste it in your blog posts/pages, where you want to show featured slider. In the end, enable the featured slider located at the top under Settings section. There you can also easily configure the slider by changing the settings without editing the stylesheet.


= Usage =

* Install and activate the plugin. Go to your Dashboard, then navigate to "T4B Slider >> Usage" for detail usage instructions.


= Features =

* Show Featured post using slider.
* Enabled or Disabled Slider.
* Featured Slider Configuration.
* Edit, delete and reorder featured posts at any time.
* Lists of all Featured posts.


= Credits =

* Developer: [Md. Iftekharul Ibna Alam](http://facebook.com/IKIAlam)
* Website: [TiPS4BLOG](http://www.tips4blog.com)


== Changelog ==

= 1.0 (29-8-2013) = 
* First release.

= 1.1 (06-9-2013) =
* Second release.

= 1.2 (12-9-2013) =
* Third release.
* Included Settings >> T4B Featured Slider Configuration.

= 1.3 (21-2-2014) =
* Fourth release.
* Fixed some bugs.

= 1.4 (26-12-2014) =
* Fifth release.
* Fixed some bugs.
* Make the slider even more user friendly.

== Installation ==

1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Install and activate the plugin.
3. Go to: T4B Slider >> Usage
4. Place the given code in your blog page/post to show the Slidehsow.
5. Edit Layout & Settings in WP-Admin (Settings >> T4B Featured Slider Configuration)


== License ==

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


== Frequently Asked Questions ==

= How does it work? =

Put the below code snippet in your blog posts/pages, where you want to show featured slider:

	<?php
		if(get_option('t4b_option')==Enabled) {
			if(function_exists(show_Featured_Post_Slider())) { show_Featured_Post_Slider(); }
		}
	?>

= How to prevent duplicate posts from displaying =

To prevent duplicate posts from displaying while using featured slider, take the help from the below code snippet to get an idea before quering. It will help you to get all the posts that have been queried, except the ones we have already outputted in the featured slider:

	<?php
		$stickies = t4bFeaturedPost();
		$temp = $wp_query;
		$wp_query = null;
		if(get_option('t4b_option') == Enabled) {
			$wp_query = new WP_Query(array( 'post__not_in' => $stickies ));
		} else {
			$wp_query = new WP_Query();
		}
	?>
	//Then put the rest of the codes.

= What to do after deactivating the plugin =

Before Deactivating the plugin disabled the "Show Featured Slider" option.
After Deleting the plugin remove also the above CODE from your blog post/page.

= Where can I insert the Slider? =

You can Insert the Slider almost everywhere you want (it looks best under Navigation Bar)!

= Where can I edit the Stylesheet? =

You don't have to edit the Stylesheet you can make changes directly in your Administration Panel (Settings >> T4B Featured Slider Configuration).


== Screenshots ==
1. List of Featured Post.
2. Edit/Add Featured Post.
3. Slider Settings.
4. Featured Slider Display.