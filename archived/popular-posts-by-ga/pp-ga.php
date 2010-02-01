<?php 
/*
Plugin Name: Popular Posts by Google Analytics
Plugin URI:  http://listento.jaketolbert.com
Version: 0.1
Author: crazybilly
Description: a sidebar widget that displays your most popular posts based on Google Analytics data; requires that your site visitors be tracked by Google Analytics
*/

//check for a/o create class for functions

if (!class_exists("pp_ga")) {
	class pp_ga {
		function pp_ga () { //constructor
		

		// a sample action
		function addHeaderCode () {
			?> <!--a comment to make sure it works --> <?
		}

		/*--------------GET THE ADMIN OPTIONS -------------------*/

			//note: I'm using example names to keep it simple for now, I'll need change them later

		function getAdminOptions () {
			//set defaults
			$pp_ga_AdminOptions = array (
				'show_header' => 'true',
				'add_content' => 'true',
				'comment_author' => 'true',
				'content' => ''
			);

			//look in the db for some
			$pp_ga_Options = get_option($this->adminOptionsName);

			//if you've got something from the db, use those
			if (!emtpy(pp_ga_Options)) {
				foreach ($pp_ga_Options as $key => $option) {
					$pp_ga_AdminOptions[$key] = $option;
					}
				}

			//store what you've got in the db
			update_option($this->adminOptionsName,$pp_ga_AdminOptions);

			//your values
			return $pp_ga_AdminOptions;

		}

		//grab the initial values when you turn the plugin on
		function init () {
			$this->getAdminOptions();
		}




	/*----------------PRINT THE ADMIN PAGE ----------------------*/

		function printAdminPage () {

			//get the default or saved options
			$pp_ga_Options = $this->getAdminOptions();

			//look for user input and update if necessary
			if (isset($_POST['update_pp_ga_Settings'])) {
				if (isset ($_POST['pp_ga_Header'])) {
					$pp_ga_Options['show_header'] = $_POST['pp_ga_Header'];
				}

				if (isset ($_POST['pp_ga_AddContent'])) {
					$pp_ga_Options['add_content'] = $_POST['pp_ga_AddContent'];
				}

				if (isset ($_POST['pp_ga_Author'])) {
					$pp_ga_Options['comment_author'] = $_POST['pp_ga_Author'];
				}

				if (isset ($_POST['pp_ga_Content'])) {
					$pp_ga_Options['content'] = apply_filters('content_save_pre', $_POST['pp_ga_Content']);
				}

				//save to db
				update_option($this->adminOptionsName,$pp_ga_AdminOptions);

				?>
			
				<div class="updated">
					<p>
						<strong><?php _e("Settings UPdated.","pp_ga"); ?></strong>
					</p>
				</div>

				<?
			}
		
			//Create the admin panel
			?>
			
			<div class="wrap">
				<form method="post" action"<?php echo $_SERVER["REQUEST_URI"]; ?>">
				<h2>Popular Posts by Google Analytics</h2>

				<h3>Content to Add to the end of the post</h3>

					<textarea name="pp_ga_Content" style="width: 80%; height: 100px;">
						<?php _e(apply_filters('format_to_edit',$pp_ga_Options['content']),'pp_ga') ?>
					</textarea>

				<h3>Allow Comment Code in the Header?</h3>

					<p>Selecting "No" will disable the comment code inserted in the header</p>
					<p><label for="pp_ga_Header_yes">
						<input type="radio" id="pp_ga_Header_yes" name="pp_ga_Header" value="true"
							<?php if ($pp_ga_Options['show_header'] == 'true') {
									_e('checked="checked"','pp_ga'); 
									}
								?> />
							Yes
						</label>
						
						&nbsp;&nbsp;&nbsp;&nbsp;
						
						<label for "pp_ga_Header_no">
							<input type="radio" id="pp_ga_Header_no" name="pp_ga_Header" value="false"
								<?php if ($pp_ga_Options['Header'] == "false") {
									_e('checked="checked"','pp_ga');
									}
								?> />
							No
						</label>
					</p>

				<h3>Allow Content Added to the End of a Post?</h3>

				<p>Selecting "No" will disable the comment from being added in the post end</p>

		
				<p><label for="pp_ga_AddContent_yes">
					<input type="radio" id="pp_ga_AddContent_yes" name="pp_ga_AddContent" value="true" 
						<?php if ($pp_ga_Options['add_content'] == "true") { 
							_e('checked="checked"', "pp_ga"); }
								?> /> 
						Yes
					</label>
					
					&nbsp;&nbsp;&nbsp;&nbsp;
					
					<label for="pp_ga_AddContent_no">
						<input type="radio" id="pp_ga_AddContent_no" name="pp_ga_AddContent" value="false" 
							<?php if ($pp_ga_Options['add_content'] == "false") { 
								_e('checked="checked"', "pp_ga");
								}?>/> 
							No
					</label>
				</p>

				<h3>Allow Comment Authors to be Uppercase?</h3>

				<p>Selecting "No" will leave the comment authors alone.</p>

				<p><label for="pp_ga_Author_yes">
					<input type="radio" id="pp_ga_Author_yes" name="pp_ga_Author" value="true" 
						<?php if ($pp_ga_Options['comment_author'] == "true") { 
							_e('checked="checked"', "pp_ga"); 
							}?> /> 
						Yes
					</label>
					
					&nbsp;&nbsp;&nbsp;&nbsp;
					
					<label for="pp_ga_Author_no">
						<input type="radio" id="pp_ga_Author_no" name="devloungeAuthor" value="false" 
							<?php if ($pp_ga_Options['comment_author'] == "false") { 
								_e('checked="checked"', "pp_ga_PluginSeries"); 
								}?>/> 
						No
					</label>
				</p>

				<div class="submit">
					<input type="submit" name="update_pp_ga_Settings" value="
						<? _e('Update Settings', 'pp_ga') ?>" />
				</div>

			</form>
		</div>
			<?
	} // admin function



	}} //end class definition
} //end checking for class_exists 







if (class_exists("pp_ga")) {
	$dl_pp_ga = new pp_ga();
	}


//Initalize the admin panel
if (!function_exists("pp_ga_ap")) {
	function pp_ga_ap () {
		global $dl_pp_ga;

		if (!isset($dl_pp_ga)) {
			return;
			}

		if (function_exists('add_options_page')) {
			add_options_page('Popular Posts by Google Analytics','Popular Posts by GA',9,basename(_FILE_),array(&$dl_pp_ga,'printAdminPage'));
			}
		}
	}

//Actions and Filters

if (isset($dl_pp_ga)) {
	
	//Actions - use these to ADD code

		//call the sample action
//		add_action('wp_head', array(&$pp_ga, 'addHeaderCode'),1);

		//get the default values when you turn the plugin on
		add_action('popular-posts-by-ga/pp-ga.php', array (&$dl_pp_ga, 'init'));

		//call the function to write the admin page
		add_action('admin_menu','pp_ga_ap');
		
	//Filters - use these to modify code

}

?>
