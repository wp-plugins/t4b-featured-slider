<div class="wrap">
	<h2><img src="<?php echo WP_PLUGIN_URL; ?>/t4b-featured-slider/images/featured-slider.png" alt="T4B Featured Slider Lists"> T4B Featured Slider Lists</h2>
	<?php
	featured_post_install();
	$msg = 'Please enter the URL of a post to get the ID';
	if($_POST['get_id'] == 'Get ID') {
		$url = $_POST['post_link'];
		$postid = url_to_postid( $url );
		$title = get_the_title(url_to_postid($url));
		$postdata = get_post($postid, ARRAY_A);
		$authorID = $postdata['post_author'];
		$user_info = get_userdata($authorID);
		$author_name = $user_info->user_login;
		if($postid) {
			$msg = '<b>The results are:</b> <br />
					<b>URL of the post:</b> <a href="'.$url.'" target="_blank">'.$url.'</a><br />
					<b>Post ID:</b> '.$postid.'<br />
					<b>Post Title:</b> '.$title.'<br />
					<b>Post Author Name:</b> '.$author_name.'<br />';
		} else {	$msg = '<font color="red">Invalid URL!</font>'; }
	} elseif ($_POST['list_id'] == 'Add Post') {
		$pid = $_POST['postID'];
		$postdata = get_post($pid, ARRAY_A);
		$post_title = $postdata['post_title'];
		$post_type = $postdata['post_type'];
		if($post_type == 'post') { $qres = add_featured_post ($pid, $post_title); }
		else { $qres = 'Sorry! The ID you have added is not a post!'; }
	} elseif ($_POST['unlist_id'] == 'Delete') {
		$pid = $_POST['rmvID'];
		$dres = remove_featured_post ($pid);
	}
	?>
	<?php if ($dres) { echo '<div id="message" class="updated"><p>'. $dres .'</p></div>'.PHP_EOL; } ?>
	<?php if ($qres) { echo '<div id="message" class="updated"><p>'. $qres .'</p></div>'.PHP_EOL; } ?>
	<div style="width: 68%; float: left;">
	<table class="form-table">
		<tr><td>
		<form method="post" id="myForm" enctype="multipart/form-data">
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Get the ID</h3>
			<div class="inside">
				<div><p align="justify">To get the ID of a post simply enter the URL of the post and then click on Get ID button:</p>
   					<table class="form-table">
       					<tr valign="top">
       						<td>Enter URL:</td>
       						<td width="50%"><input type="text" name="post_link" value="" size="60" /></td>
							<td><input type="submit" name="get_id" class="button-primary" value="Get ID"></td>
       					</tr>

        				<tr valign="top"><td colspan="3"><?php echo $msg; ?></td></tr>
   					</table>
				</div>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Add Post in the Featured Lists</h3>
			<div class="inside">
				<div><p align="justify">To make a post as featured simply enter the post ID and click on Add ID button.</p>
	   				<table class="form-table">
       					<tr valign="top">
   	   						<td width="30%">Enter the post ID:</td>
    	    				<td width="20%"><input type="text" name="postID" size="10" value="" /></td>
							<td><input type="submit" name="list_id" class="button-primary" value="Add Post" /></td>
   	   					</tr>
		    		</table>
				</div>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left;width:99%; background:#F4F4F2;">
			<h3 class="hndle" style="padding:5px; color:#007193;">Featured Post Lists</h3>
			<div class="inside">
				<div><p align="justify"><strong>Lists of all featured posts:</strong></p>
   					<?php
						$all_lists = get_featured_post_lists();
						$option = count($all_lists);
						$flists = '';
						$sn = 1;
						if(count($all_lists) > 0) {
					?>
							<table class="form-table" border="1" width="100%" bordercolor="#007193">
	        					<thead><tr valign="top">
									<th scope="row"><strong>SN</strong></th>
									<th scope="row"><strong>ID</strong></th>
       								<th scope="row"><strong>Post ID</strong></th>
       								<th scope="row"><strong>Post Title</strong></th>
	        						<th scope="row"><strong>Activity Date</strong></th>
	        						<th scope="row"><strong>Delete Post</strong></th>
       							</tr></thead>
								<tbody>
								<?php foreach($all_lists as $flists) { ?>
	        						<tr valign="top">
										<td width="2%"><?php echo $sn; ?></td>
										<td width="4%"><?php echo $flists->id; ?></td>
										<td width="9%"><?php echo $flists->post_id; ?></td>
										<td width="55%"><?php echo $flists->post_title; ?></td>
										<td width="18%"><?php echo $flists->activity_date; ?></td>
										<td width="12%"><input type="hidden" name="rmvID" value="<?php echo $flists->post_id; ?>" /><input type="submit" name="unlist_id" class="button-primary" value="Delete" /></td>
									</tr>
								<?php $sn++; } ?>
								</tbody>
		   					</table>
						<?php } else { echo "You didn't add any Featured Post yet!"; } ?>
				</div>
			</div>
		</div>
		</form>
		</td></tr>
	</table>
	</div>
	<?php echo t4b_sidebar(); ?>
</div>