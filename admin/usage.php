<div class="wrap">
	<h2><img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/t4b_slide.png" alt="t4b feature slide" /> T4B Featured Slider 1.1</h2><br/>
	<div style="width: 65%; float: left;">
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">About "T4B Featured Slider" Plugin</h3>
			<div class="inside"><p align="justify">"T4B Featured Slider" is a simple and easy WordPress plugin. You can use this plugin as an alternate of WordPress <strong>Sticky</strong> posts. At first, you have to add the ID of a post, which you wish to see in the featured lists. To get the ID of a post simply enter the URL of the post in the given text field and click on <strong>Get ID</strong> button. It will show you the ID of the post. Just enter the ID into the second text field where the <strong>Add Post</strong> button exists and click on that button. If nothing goes wrong you will get a confirmation message that you have successfully inserted the post in the featured lists. You can also remove a featured post from the list. In the table of featured post lists you will get a <strong>Delete</strong> button beside each of the post list. Now, to remove a featured post, simply click on the <strong>Delete</strong> button that exists on that post row. At the end, to show the featured slider, just enable the <strong>Show Featured Slider</strong> option located at the top of the settings page. Finally, copy the below code and paste in your blog posts/pages, where you want to show the featured slider.</p></div>
		</div>

		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Code Usage Instruction</h3>
			<div class="inside">
				<p><b>Put this code in your blog post/page, where you want to show featured slider:</b><br/><br />
					<code><span style="color: #0000BB">   &#60;&#63;php if&#40;get_option&#40;&#39;t4b_option&#39;&#41;&#61;&#61;Enabled) &#123; if&#40;function_exists&#40;show_Featured_Post_Slider&#40;&#41;&#41;&#41; &#123; show_Featured_Post_Slider&#40;&#41;&#59; &#125; &#125; &#63;&#62;</span></code></p>
				<p><b>To prevent duplicate posts from displaying while using featured slider, put the below code and get all posts, excepted the ones we have already outputted in the featured slider:</b><br/><br />
					<code><span style="color: #0000BB">
						&#60;&#63;php<br />
						&#36;stickies &#61; t4bFeaturedPost&#40;&#41;&#59;<br />
						&#36;temp &#61; &#36;wp_query&#59;<br />
						&#36;wp_query &#61; null&#59;<br />
						if&#40;get_option&#40;&#39;t4b_option&#39;&#41; &#61;&#61; Enabled&#41; &#123;<br />
							&#36;wp_query &#61; new WP_Query&#40;array&#40; &#39;post__not_in&#39; &#61;&#62; &#36;stickies &#41;&#41;&#59;<br />
						&#125; else &#123;<br />
							&#36;wp_query &#61; new WP_Query&#40;&#41;&#59;<br />
						&#125;<br />
						&#63;&#62;
					</span></code></p>
				<p><b>Then put the rest of the codes.</b></p>
			</div>
		</div>
		
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left;width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Important Note</h3>
			<div class="inside"><p align="justify">
				* Before Deactivating the plugin please disabled the "Show Featured Slider" option, which is located at the top of setiings page.<br />
				* After Deleting the plugin remove also the above CODE from your blog post/page.<br />
				* This is very important, otherwise there will be an error message on your blog.
			</p></div>
		</div>
		
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left;width: 99%;">
			<div class="inside"><p align="justify">
    This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.<br /><br />
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.<br /><br />
    You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA.
			</p></div>
		</div>
</div>

<?php echo t4b_sidebar(); ?>
</div>