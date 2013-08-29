<div class="wrap">
	<h2><img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/t4b_slide.png" alt="t4b feature slide" /> T4B Featured Slider Display</h2><br/>
	<div style="width: 65%; float: left;">
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px;"><span>About "T4B Featured Slider" Plugin</span></h3>
				<div class="inside"><p align="justify">"T4B Featured Slider" is a simple and easy WordPress plugin. You can use this plugin as an alternate of WordPress sticky posts. First, you have to add the ID of featured posts. To get the ID of a post simply enter the URL of the post in the given text field and then click on Get ID button. Copy the ID and paste into the second text field where the Add ID button exists. After that, click on Add ID button. If nothing goes wrong you will get a confirmation message that you have successfully inserted the post-ID. You can also remove a featured post by entering the ID of a post in the third text field. After entering the ID, click on the Delete ID button. At the end, you will be shown all the featured posts list that you have added. Now, if you want to show the featured slider, then enable the featured slider, which is located at the top of settings page. Finally, copy the below code and paste where you want to show featured slider.</p></div>
		</div>

		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px;"><span>Code Usage Instructions</span></h3>
			<div class="inside">
				<p><b>Put this code in your blog post/page, where you want to show featured slider:</b><br/>
					<textarea id="write_code" name="write_code" rows="27" cols="135" disabled="disabled">
	<?php 
	echo "<?php if(get_option('t4b_option')==Enabled) { ?>
	<?php
		show_Featured_Post_Slider();
		".'$stickies'." = t4bFeaturedPost();
		rsort( ".'$stickies'." );		/* Sort the stickies with the newest ones at the top */
		".'$stickies'." = array_slice( ".'$stickies'.", 0, 10 );		/* Get the 10 newest stickies (change 10 for a different number) */
		".'$args'." = array( 'post__in' => ".'$stickies'.", 'caller_get_posts' => 1 );
		".'$featured'." = new WP_Query( ".'$args'." );
	?>
	<?php if (".'$featured->have_posts()'."): ?>	 <!--If there is one or more sticky post we create our new slider -->
		<div id=\"pcover\">
			<div id=\"pslider\">
				<?php while( ".'$featured->have_posts()'." ) : ".'$featured->the_post()'."; ?>
					<div class=\"mytext\">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href=\"<?php the_permalink() ?>\"><img class=\"slimg\" src=\"<?php get_image_url(); ?>\" alt=\"\" /></a>
						<?php } else { ?>
							<a href=\"<?php the_permalink() ?>\">
								<img class=\"slimg\" src=\"<?php bloginfo('template_directory'); ?>/images/dummy.png\" alt=\"\" />
							</a>
						<?php } ?>
                           	<h2><a href=\"<?php the_permalink() ?>\" rel=\"bookmark\" title=\"<?php the_title(); ?>\"><?php the_title(); ?></a></h2>
                           	<span>By <?php the_author_posts_link(); ?> On <?php the_time('M j, Y'); ?><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
							<p><?php the_excerpt(); ?></p>
					</div>   	
			    <?php endwhile; wp_reset_query(); ?>
			</div>
		</div>
   	<?php endif; ?>
	<?php } ?>";
	?>
					</textarea>
				</p>
			</div>
		</div>
		
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left;width: 99%;">
			<div class="inside"><p align="justify">
				* Before Deleting the plugin disabled the show featured slider option.<br />
				* After Deleting the plugin remove also the code from your blog post/page
			</p></div>
		</div>
</div>

<?php echo t4b_sidebar(); ?>
</div>