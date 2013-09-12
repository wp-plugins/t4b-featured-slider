<div class="wrap">
	<h2><img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/Setting-icon.png" alt="T4B Featured Slider Settings"> T4B Featured Slider Settings</h2>
	<?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { 
		echo '<div id="message" class="updated"><p>'. __('Settings saved.') .'</p></div>'.PHP_EOL;
	} ?>

	<div style="width: 68%; float: left;">
		<form method="post" action="options.php">
		<?php
			settings_fields( 't4b-settings-group' );
			$t4b_option = get_option('t4b_option');
			if($t4b_option == "Enabled") { $color = "blue"; }
			elseif($t4b_option == "") { $t4b_option = "Disabled"; $color = "red"; }
		?>
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Featured Slider Enable/Disable</h3>
			<div class="inside">
				<div><p align="justify">Want to display your featured posts using slider? Its very easy! Just Enable and Save Changes your options below:</p>
					<table class="form-table">
   						<tr valign="top">
   							<th scope="row">Show Featured Slider:</th>
   							<td><input type="checkbox" name="t4b_option" value="Enabled" <?php if(get_option('t4b_option')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/<?php echo $color; ?>.png" alt="color" /> <font color="<?php echo $color; ?>"><?php echo $t4b_option; ?></font></td>
   						</tr>
					</table>
					<?php submit_button(); ?>
				</div>
			</div>
		</div>
		</form>

		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
		<form method="post" id="setForm" action="options.php" enctype="multipart/form-data"><?php wp_nonce_field('update-options'); ?>
			<h3 class="hndle" style="padding:5px; color:#007193;">T4B Featured Slider Configuration</h3>
			<div class="inside">
				<div><p align="justify">Use these field below to adjust the settings for the Slider.</p>
		    		<table class="form-table">
					    <tr>
						    <th><label for="sort">Choose Sorting of Posts/Pages</label></th>
						    <td>
							    <select name="sort">
								    <option value="post_date" <?php if(get_option('sort') == "post_date") {echo "selected=selected";} ?>>Date</option>
								    <option value="title" <?php if(get_option('sort') == "title") {echo "selected=selected";} ?>>Title</option>
								    <option value="rand" <?php if(get_option('sort') == "rand") {echo "selected=selected";} ?>>Random</option>
							    </select>
						    </td>
			    		</tr>
			    		<tr>
						    <th><label for="order">Choose Order of Posts/Pages</label></th>
						    <td>
							    <select name="order">
								    <option value="ASC" <?php if(get_option('order') == "ASC") {echo "selected=selected";} ?>>Ascending</option>
								    <option value="DESC" <?php if(get_option('order') == "DESC") {echo "selected=selected";} ?>>Descending</option>
							    </select>
						    </td>
					    </tr>
			    		<tr>
						    <th><label for="slider_top">Set Slider Top Position</label></th>
						    <td><input type="text" name="slider_top" value="<?php $t4b_slider_slider_top = get_option('slider_top'); if(!empty($t4b_slider_slider_top)) {echo $t4b_slider_slider_top;} else {echo "10";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="slider_bot">Set Slider Bottom Position</label></th>
						    <td><input type="text" name="slider_bot" value="<?php $t4b_slider_slider_bot = get_option('slider_bot'); if(!empty($t4b_slider_slider_bot)) {echo $t4b_slider_slider_bot;} else {echo "20";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="slider_left">Set Slider Left Position</label></th>
						    <td><input type="text" name="slider_left" value="<?php $t4b_slider_slider_left = get_option('slider_left'); if(!empty($t4b_slider_slider_left)) {echo $t4b_slider_slider_left;} else {echo "5";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="title_color">Set Title Color (hexadecimal)</label></th>
						    <td><input type="text" name="title_color" value="<?php $t4b_slider_title_color = get_option('title_color'); if(!empty($t4b_slider_title_color)) {echo $t4b_slider_title_color;} else {echo "FAFAFA";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="title_visited">Set Title Visited Color (hexadecimal)</label></th>
						    <td><input type="text" name="title_visited" value="<?php $t4b_slider_title_visited = get_option('title_visited'); if(!empty($t4b_slider_title_visited)) {echo $t4b_slider_title_visited;} else {echo "F4F4F2";}?>"></td>
			    		</tr>
					    <tr>
						    <th><label for="points">More Seperator</label></th>
						    <td><input type="text" name="read_more" value="<?php $t4b_slider_rmore = get_option('read_more'); if(!empty($t4b_slider_rmore)) { echo $t4b_slider_rmore; } else { echo "[...]"; } ?>"></td>
					    </tr>
					    <tr>
						    <th><label for="chars">Limit Description (Number of words)</label></th>
						    <td><input type="text" name="limit" value="<?php $t4b_slider_limit = get_option('limit'); if(!empty($t4b_slider_limit)) { echo $t4b_slider_limit; } else { echo "60"; } ?>"></td>
					    </tr>
			    		<tr>
						    <th><label for="limit_posts">Limit Number of Posts (0 = unlimited)</label></th>
						    <td><input type="text" name="limit_posts" value="<?php $t4b_slider_limit_posts = get_option('limit_posts'); if(!empty($t4b_slider_limit_posts)) { echo $t4b_slider_limit_posts; } else { echo "0"; } ?>"></td>
			    		</tr>
					    <tr>
						    <th><label for="feat_width">Set Slider Width</label></th>
						    <td><input type="text" name="feat_width" value="<?php $t4b_slider_width = get_option('feat_width'); if(!empty($t4b_slider_width)) {echo $t4b_slider_width;} else {echo "640";}?>"></td>
					    </tr>
			    		<tr>
						    <th><label for="feat_height">Set Slider Height</label></th>
						    <td><input type="text" name="feat_height" value="<?php $t4b_slider_height = get_option('feat_height'); if(!empty($t4b_slider_height)) {echo $t4b_slider_height;} else {echo "300";}?>"></td>
			    		</tr>
					    <tr>
						    <th><label for="feat_bg">Set BG Color (hexadecimal)</label></th>
						    <td><input type="text" name="feat_bg" value="<?php $t4b_slider_bg = get_option('feat_bg'); if(!empty($t4b_slider_bg)) {echo $t4b_slider_bg;} else {echo "364D55";}?>"></td>
					    </tr>
					    <tr>
						    <th><label for="text_color">Set Text Color (hexadecimal)</label></th>
						    <td><input type="text" name="text_color" value="<?php $t4b_slider_text_color = get_option('text_color'); if(!empty($t4b_slider_text_color)) {echo $t4b_slider_text_color;} else {echo "aaa";}?>"></td>
					    </tr>
					    <tr>
						    <th><label for="cont_width">Set Content Width</label></th>
						    <td><input type="text" name="cont_width" value="<?php $t4b_slider_cont_width = get_option('cont_width'); if(!empty($t4b_slider_cont_width)) {echo $t4b_slider_cont_width;} else {echo "395";}?>"></td>
					    </tr>
					    <tr>
						    <th><label for="img_width">Set Image Width</label></th>
						    <td><input type="text" name="img_width" value="<?php $t4b_slider_img_width = get_option('img_width'); if(!empty($t4b_slider_img_width)) {echo $t4b_slider_img_width;} else {echo "180";}?>"></td>
					    </tr>
			    		<tr>
						    <th><label for="img_height">Set Image Height</label></th>
						    <td><input type="text" name="img_height" value="<?php $t4b_slider_img_height = get_option('img_height'); if(!empty($t4b_slider_img_height)) {echo $t4b_slider_img_height;} else {echo "180";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="img_bg">Set Image Background (hexadecimal)</label></th>
						    <td><input type="text" name="img_bg" value="<?php $t4b_slider_img_bg = get_option('img_bg'); if(!empty($t4b_slider_img_bg)) {echo $t4b_slider_img_bg;} else {echo "4C666C";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="link_color">Set Link Color (hexadecimal)</label></th>
						    <td><input type="text" name="link_color" value="<?php $t4b_slider_link_color = get_option('link_color'); if(!empty($t4b_slider_link_color)) {echo $t4b_slider_link_color;} else {echo "5E98BA";}?>"></td>
			    		</tr>
			    		<tr>
						    <th><label for="link_hover">Set Link Hover (hexadecimal)</label></th>
						    <td><input type="text" name="link_hover" value="<?php $t4b_slider_link_hover = get_option('link_hover'); if(!empty($t4b_slider_link_hover)) {echo $t4b_slider_link_hover;} else {echo "F4F4F2";}?>"></td>
			    		</tr>
						<tr>
							<td colspan="2"><input type="hidden" name="action" value="update" /><input type="hidden" name="page_options" value="sort, order, slider_top, slider_bot, slider_left, title_color, title_visited, read_more, limit, limit_posts, feat_width, feat_height, feat_bg, feat_border, text_color, cont_width, img_width, img_height, img_bg, link_color, link_hover" /><input type="submit" name="upd_opt" class="button-primary" value="<?php _e('Update Options') ?>" /></td>
						</tr>
				    </table>
				</div>
			</div>
		</form>
		</div>
	</div>
	<?php echo t4b_sidebar(); ?>
</div>