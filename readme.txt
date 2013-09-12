=== T4B Featured Slider ===
Contributors: Iftekhar
Author URI: http://profiles.wordpress.org/moviehour/
Requires at least: 3.0
Tested up to: 3.6.1
Tags: Iftekhar, featured post, slider, featured post slider, get id from url, tips4blog
Stable Tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


"T4B Featured Slider" allows you to show featured posts on your blog using a smooth jQuery slider.


== Description == 
"T4B Featured Slider" is a simple and easy WordPress plugin to show featured posts on your blog using a smooth jQuery slider. You can use this plugin as an alternate of WordPress Sticky posts.

At first, you have to add the ID of a post, which you wish to see in the featured lists. To get the ID of a post simply enter the URL of the post in the given text field at the Featured page and click on Get ID button. It will show you the ID of the post. Just enter the ID into the second text field where the Add Post button exists and click on that button. If nothing goes wrong you will get a confirmation message that you have successfully inserted the post in the featured lists. You can also remove a featured post from the list. In the table of featured post lists you will get a Delete button beside each of the post list. Now, to remove a featured post, simply click on the Delete button that exists on that post row.

At the end, to show the featured slider, just enable the Show Featured Slider option located at the top of the Settings page, where you can also customize the Featured Slider from T4B Featured Slider Configuration by changing the options. You don't have to edit the Stylesheet, you can make changes directly in your Administration Panel (Settings >> T4B Featured Slider Configuration).

Finally, copy the below code and paste in your blog posts/pages, where you want to show the featured slider.


= Usage =

* Install and activate the plugin. Go to your Dashboard, then navigate to "T4B Slider >> Usage" for detail usage instructions.


= Features: =

* Add ID from post permalink.
* Show Featured post using slider.
* Enabled or Disabled Slider.
* Featured Slider Configuration.
* Lists of all Featured posts.


= Credits =

* Developer: [Md. Iftekharul Ibna Alam](http://facebook.com/IKIAlam)
* E-Mail: moviehour@gmail.com
* Website: [www.tips4blog.com](http://www.tips4blog.com)


== Changelog ==

= 1.0 (29-8-2013) = 
* First release.

= 1.1 (06-9-2013) =
* Second release.

= 1.2 (12-9-2013) =
* Third release.
* Included Settings >> T4B Featured Slider Configuration.


== Installation ==

1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Install and activate the plugin.
3. Go to: T4B Slider >> Usage
4. Place '<?php if(get_option('t4b_option')==Enabled) { if(function_exists(show_Featured_Post_Slider())) { show_Featured_Post_Slider(); } } ?>' in your template on a page/post to show the Slidehsow.
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

Use the code in your blog post/page:

	<?php
		if(get_option('t4b_option')==Enabled) {
			if(function_exists(show_Featured_Post_Slider())) { show_Featured_Post_Slider(); }
		}
	?>

= How to prevent duplicate posts from displaying =

To prevent duplicate posts from displaying while using featured slider, put the below code and get all posts, excepted the ones we have already outputted in the featured slider:

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
1. Plugin Usage.
2. Plugin Settings-1.
3. Plugin Settings-2.
4. Featured Slider.