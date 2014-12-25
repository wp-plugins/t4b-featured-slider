<?php function t4b_sidebar() { ?>
	<?php
	featured_post_install();
	$msg = '** Enter URL of a post to get ID **';
	if($_POST['get_id'] == 'Get ID') {
		$url = $_POST['post_link'];
		$postid = url_to_postid( $url );
		$title = get_the_title(url_to_postid($url));
		$postdata = get_post($postid, ARRAY_A);
		$authorID = $postdata['post_author'];
		$user_info = get_userdata($authorID);
		$author_name = $user_info->user_login;
		if($postid) {
			$msg = '<b>Post URL:</b> <a href="'.$url.'" target="_blank">'.$url.'</a><br />
					<b>Post ID:</b> '.$postid.'<br />
					<b>Post Title:</b> '.$title.'<br />
					<b>Post Author:</b> '.$author_name.'<br />';
		} else {	$msg = '<font color="red">Invalid URL!</font>'; }
	}
	?>
	<div class="postbox-container" style="width:25%">
		<div id="t4bsidebar">
			<div id="t4busage-features" class="t4busage-sidebar">
			<form method="post" id="get_ID" enctype="multipart/form-data">
				<input type="hidden" name="get_post_id" value="urltoid" />
				<h3>Get the ID</h3>
				<div class="inside">
					<p>To get the ID of a post simply enter the URL of the post and click on Get ID button:</p>
					<table class="form-table">
						<tr valign="top">
							<td>URL:</td>
							<td><input type="text" name="post_link" value="" size="10" /></td>
							<td><input type="submit" name="get_id" class="button-primary" value="Get ID"></td>
						</tr>

						<tr valign="top"><td colspan="3"><?php echo $msg; ?></td></tr>
					</table>
				</div>
			</form>
			</div>
			<div id="t4busage-info" class="t4busage-sidebar">
				<h3>Plugin Info</h3>
				<ul class="t4busage-list">
					<li>Price: Free!</li>
					<li>Version: 1.4</li>
					<li>Scripts: PHP + JS + CSS</li>
					<li>Requires: Wordpress 3.5+</li>
					<li>First release: 29 August 2013</li>
					<li>Developer: <a href="http://facebook.com/IKIAlam" target="_blank">Iftekhar</a></li>
					<li>Website: <a href="http://www.tips4blog.com" target="_blank">www.tips4blog.com</a></li>
					<li>Published under: <a href="http://www.gnu.org/licenses/gpl.txt" target="_blank">GNU General Public License</a></li>
					<li><a href="http://wordpress.org/plugins/t4b-featured-slider/faq/" target="_blank">FAQ</a> | <a href="http://wordpress.org/plugins/t4b-featured-slider/changelog/" target="_blank">Changelog</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php } ?>