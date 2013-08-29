=== T4B Featured Slider ===
Contributors: Iftekhar
Author URI: http://www.tips4blog.com/
Tags: Iftekhar, featured, slider, featured post slider, get id from url, tips4blog
Requires at least: 3.0
Tested up to: 3.6
Stable Tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


"T4B Featured Slider" allows you to show featured posts on your blog using a smooth jQuery slider. You can easily make a post as featured post by adding the post-ID, which you will get by entering the post URL.


== Description == 
"T4B Featured Slider" is a simple and easy WordPress plugin. You can use this plugin as an alternate of WordPress sticky posts. First, you have to add the ID of featured posts. To get the ID of a post simply enter the URL of the post in the given text field and then click on Get ID button. Copy the ID and paste into the second text field where the Add ID button exists. After that, click on Add ID button. If nothing goes wrong you will get a confirmation message that you have successfully inserted the post-ID. You can also remove a featured post by entering the ID of a post in the third text field. After entering the ID, click on the Delete ID button. At the end, you will be shown all the featured posts list that you have added. Now, if you want to show the featured slider, then enable the featured slider, which is located at the top of settings page. Finally, copy the code (to get the code see FAQ) and paste where you want to show featured slider.

= Usage =

* Install and activate the plugin. Go to your Dashboard, then navigate to "T4B Slider >> Usage" for detail usage instructions.


= Features: =
- Add ID from post permalink.
- Show featured post using slider.
- Enabled or Disabled Slider.
- Lists of all featured posts.


= Credits =
* Developer: [Md. Iftekharul Ibna Alam](http://facebook.com/IKIAlam)
* E-Mail: moviehour@gmail.com
* Website: [www.tips4blog.com](http://www.tips4blog.com)


== Changelog ==

= 1.0 (29-8-2013) = 
* First release.

== Installation ==

1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Install and activate the plugin.
3. Go to: T4B Slider >> Usage


== Frequently Asked Questions ==

= How does it work? =

* Use the code in your blog post/page:

 	<?php if(get_option('t4b_option')==Enabled) { ?>
	<?php
		show_Featured_Post_Slider();
		$stickies = t4bFeaturedPost();
		rsort( $stickies );		/* Sort the stickies with the newest ones at the top */
		$stickies = array_slice( $stickies, 0, 10 );		/* Get the 5 newest stickies (change 5 for a different number) */
		$args = array( 'post__in' => $stickies, 'caller_get_posts' => 1 );
		$featured = new WP_Query( $args );
	?>
	<?php if ($featured->have_posts()): ?>	 <!--If there is one or more sticky post we create our new slider -->
		<div id="pcover">
			<div id="pslider">
				<?php while( $featured->have_posts() ) : $featured->the_post(); ?>
						<div class="mytext">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink() ?>"><img class="slimg" src="<?php get_image_url(); ?>" alt="t4b"/></a>
							<?php } else { ?>
								<a href="<?php the_permalink() ?>">
									<img class="slimg" src="<?php bloginfo('template_directory'); ?>/images/dummy.png" alt="tips4blog" />
								</a>
							<?php } ?>
                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                            <span>By <?php the_author_posts_link(); ?> On <?php the_time('M j, Y'); ?><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
							<p><?php the_excerpt(); ?></p>
						</div>
			    <?php endwhile; wp_reset_query(); ?>
			</div>
		</div>
   	<?php endif; ?>
	<?php } ?>

* Before Deactivating the plugin disabled the show featured slider option.
* After Deactivating the plugin remove also the code from your blog post/page.


== Screenshots ==
1. Plugin Usage.
2. Plugin Settings.
3. Featured Slider.