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
		}

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
				if (isset $_POST['pp_ga_Header'])) {
					$pp_ga_Options['show_header'] = $_POST['pp_ga_Header'];
				}

				if (isset $_POST['pp_ga_AddContent'])) {
					$pp_ga_Options['add_content'] = $_POST['pp_ga_AddContent'];
				}

				if (isset ($_POST['pp_ga_Author'])) {
					$pp_ga_Options['comment_author'] = $_POST['pp_ga_Author'];
				}

				if (isset ($_POST['pp_ga_Content'])) {
					$pp_ga_Options['content'] = apply_filters('content_save_pre', $_POST['pp_ga_Content'];
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

			<!-- am working from here: http://www.devlounge.net/articles/constructing-an-wordpress-plugin-admin-panel

			on the section that's all html --><?





}

if (class_exists("pp_ga")) {
	$dl_pluginSeries = new pp_ga();
	}

//Actions and Filters

if (isset($dl_pluginSeries)) {
	
	//Actions - use these to ADD code

		//call the sample action
		add_action('wp_head', array(&$pp_ga, 'addHeaderCode'),1);

		//get the default values when you turn the plugin on
		add_action('popular-posts-by-ga/pp-ga.php', array (&$dl_pluginSeries, 'init'));
		
	//Filters - use these to modify code

}

?>

