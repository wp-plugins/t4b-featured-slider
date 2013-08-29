<div class="wrap">
	<h2><img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/Setting-icon.png" alt="">T4B Featured Slider Settings</h2>
	<?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { 
		echo '<div id="message" class="updated"><p>'. __('Settings saved.') .'</p></div>'.PHP_EOL;
	} ?>

	<?php
	featured_post_install();
	if($_POST['get_id'] == 'Get ID') {
		$url = $_POST['post_link'];
		$postid = url_to_postid( $url );
		$title = get_the_title(url_to_postid($url));
		$postdata = get_post($postid, ARRAY_A);
		$authorID = $postdata['post_author'];
		$user_info = get_userdata($authorID);
		$author_name = $user_info->user_login;
		$msg = '<b>The results are:</b> <br />
				<b>URL of the post:</b> <a href="'.$url.'" target="_blank">'.$url.'</a><br />
				<b>Post ID:</b> '.$postid.'<br />
				<b>Post Title:</b> '.$title.'<br />
				<b>Post Author Name:</b> '.$author_name.'<br />';
	} else {
		$msg = 'Please enter the URL of a post to get the ID';
	}

	if ($_POST['list_id'] == 'Add ID') {
		$pid = $_POST['postID'];
		$postdata = get_post($pid, ARRAY_A);
		$post_title = $postdata['post_title'];
		$post_type = $postdata['post_type'];
		if($post_type == 'post') { $qres = add_featured_post ($pid, $post_title); }
		else { $qres = 'Sorry! The ID you have added is not a post!'; }
	}

	if ($_POST['unlist_id'] == 'Delete ID') {
		$pid = $_POST['rmvID'];
		$dres = remove_featured_post ($pid);
	}
	?>
		<div style="width: 65%; float: left;">
			<form method="post" action="options.php">
			<?php
				settings_fields( 't4b-settings-group' );
				$t4b_option = get_option('t4b_option');
				if($t4b_option == "Enabled") { $color = "blue"; }
				elseif($t4b_option == "") { $t4b_option = "Disabled"; $color = "red"; }
			?>
			<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
				<h3 class="hndle" style="padding:5px;"><span>Slider Options</span></h3>

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
			<form method="post" id="myForm" enctype="multipart/form-data">
			<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
				<h3 class="hndle" style="padding:5px;"><span>Get the ID</span></h3>

				<div class="inside">
					<div><p align="justify">To get the ID of a post simply enter the URL of the post and then click on Get ID button:</p>
				
    					<table class="form-table">
        					<tr valign="top">
        						<th scope="row">Enter URL:</th>
        						<td>
									<input type="text" name="post_link" value="" size="60" />
									<input type="submit" name="get_id" class="button-primary" value="Get ID">
								</td>
        					</tr>

	        				<tr valign="top"><th scope="row">&nbsp;</th><td><?php echo $msg; ?></td></tr>
	   					</table>
						
					</div>
				</div>
			</div>
			<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
				<h3 class="hndle" style="padding:5px;"><span>Add/Delete ID</span></h3>
				<div class="inside">
					<div><p align="justify">To make a post as featured simply enter the post ID and click on Add ID button. Again, to remove the featured post simply enter the ID of the post and click on Delete ID button.</p>
		   				<table class="form-table">
	       					<tr valign="top">
    	   						<th scope="row">Enter the post ID:</th>
	    	    				<td>
									<input type="text" name="postID" size="10" value="" />
									<input type="submit" name="list_id" class="button-primary" value="Add ID" />
								</td>
    	   					</tr>

		       				<?php if ($qres) { ?>
							<tr valign="top"><th scope="row">Result:</th><td><?php echo $qres; ?></td></tr>
							<?php } ?>
					
		       				<tr valign="top">
       							<th scope="row">Delete a post:</th>
	        					<td>
									<input type="text" name="rmvID" size="10" value="" />
									<input type="submit" name="unlist_id" class="button-primary" value="Delete ID" />
								</td>
       						</tr>

		       				<?php if ($dres) { ?>
							<tr valign="top"><th scope="row">Result:</th><td><?php echo $dres; ?></td></tr>
							<?php } ?>
			    		</table>
					</div>
				</div>
			</div>
			<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
				<h3 class="hndle" style="padding:5px;"><span>Featured Post Lists</span></h3>

				<div class="inside">
					<div><p align="justify"><strong>Lists of all featured posts:</strong></p>
				
    					<?php
							$all_lists = get_featured_post_lists();
							$option = count($all_lists);
							$flists = '';
							$sn = 1;
							if(count($all_lists) > 0) {
						?>
								<table class="form-table" border="1" width="100%">
		        					<thead><tr valign="top">
										<th scope="row"><strong>SN</strong></th>
										<th scope="row"><strong>ID</strong></th>
        								<th scope="row"><strong>Post ID</strong></th>
        								<th scope="row"><strong>Post Title</strong></th>
		        						<th scope="row"><strong>Activity Date</strong></th>
        							</tr></thead>
									<tbody>
						<?php
								foreach($all_lists as $flists) {
						?>
	        						<tr valign="top">
										<td width="5%"><?php echo $sn; ?></td>
										<td width="5%"><?php echo $flists->id; ?></td>
										<td width="10%"><?php echo $flists->post_id; ?></td>
										<td width="60%"><?php echo $flists->post_title; ?></td>
										<td width="20%"><?php echo $flists->activity_date; ?></td>
									</tr>
						<?php	
									$sn++;
								}
						?>
									</tbody>
			   					</table>
						<?php } else { echo "You didn't add any ID yet!"; } ?>
					</div>
				</div>
			</div>
			</form>
		</div>
	<?php echo t4b_sidebar(); ?>
</div>