<?
// add a promo box
function index_promo () {
	if (is_home() & !is_paged()) { ?>
	
	<div class="index-promo">

		<div class="promo-box">
			<h3 class="widgettitle" id="promo-box">
				A Promo Box
			</h3>

			<p>You should sign up for my blog. Cause I blog about really interesting stuff.</p>
			<p>
				And I'm funny. Really funny.
			</p>

		</div> <!--promo-box-->

		<img id="cartoon" src="<? bloginfo('stylesheet_directory'); ?>/images/cartoon.png"/>

		<div id="rss-links">
			<a href="<? bloginfo_rss('url') ?>"><img src="<? bloginfo('stylesheet_directory'); ?>/images/RSS-badge.png" alt="Subscribe"></a>
			<a href="http://www.twitter.com/crazybilly"><img src="<? bloginfo('stylesheet_directory'); ?>/images/twitter-badge.png" alt="Follow me on Twitter"></a>
		</div> <!--rss-links-->

	</div> <!--index-promo-->

<? 
	}
}

// insert the promo
add_action('thematic_header','index_promo');


//add in my twitter updates
function twitter_client() {
	if (is_home() & !is_paged()) {	
		?>	
		<div id="twitter-content">
			<h3 id="twitter-title" class="entry-title">Twitter</h3>
			<ul id="twitter_update_list"></ul>
		</div>
		
		<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/crazybilly.json?callback=twitterCallback2&count=6"></script>	

<?
	}
}

//insert twitter
//temporarily removed to speed up debugging
//add_action ('thematic_indexloop','twitter_client');



//add subtitle (via wp subtitle plugin)
function toughbubbles_postheader_posttitle() {
    global $id, $post, $authordata;

    
    if (is_single() || is_page()) {
        $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
        $posttitle .= get_the_subheading($id,"<h3 class='subtitle'>","</h3>",FALSE);
    } elseif (is_404()) {    
        $posttitle = '<h1 class="entry-title">' . __('Not Found', 'thematic') . "</h1>\n";
    } else {
        $posttitle = '<h2 class="entry-title"><a href="';
        $posttitle .= get_permalink();
        $posttitle .= '" title="';
        $posttitle .= __('Permalink to ', 'thematic') . the_title_attribute('echo=0');
        $posttitle .= '" rel="bookmark">';
        $posttitle .= get_the_title();   
        $posttitle .= "</a> </h2>\n";
        $posttitle .= get_the_subheading($id,"<h3 class='subtitle'>","</h3>",FALSE);
	}


	return $posttitle;
}   

add_filter('thematic_postheader_posttitle','toughbubbles_postheader_posttitle');


//change entry-meta
function toughbubbles_postheader_postmeta() {
    global $id, $post, $authordata;

	$postmeta = '<div class="entry-meta">';
    //$postmeta .= '</a></span><span class="meta-sep meta-sep-entry-date"> | </span>';
    //$postmeta .= '<span class="meta-prep meta-prep-entry-date">' . __('Published: ', 'thematic') . '</span>';
    	//the date
		$postmeta .= '<span class="entry-date"><abbr class="published" title="';
			//note: change the date format in the wp admin settings
	    	$postmeta .= get_the_time(thematic_time_title()) . '">';
	    	$postmeta .= get_the_time(thematic_time_display());
		    $postmeta .= '</abbr></span>';

		//a spacer
    	$postmeta .= '</a></span><span class="meta-sep meta-sep-entry-date"> | </span>';

		//comment count
		if (comments_open()) {
        	$postcommentnumber = get_comments_number();
	        if ($postcommentnumber > '1') {
    	        $postmeta .= ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
        	    $postmeta .= get_comments_number() . __(' Comments', 'thematic') . '</a></span>';
        	} elseif ($postcommentnumber == '1') {
            	$postmeta .= ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
	            $postmeta .= get_comments_number() . __(' Comment', 'thematic') . '</a></span>';
    	    } elseif ($postcommentnumber == '0') {
            	$postmeta .= ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
	            $postmeta .= __('Leave a comment', 'thematic') . '</a></span>';
    	    }
	    } else {
	        $postmeta .= ' <span class="comments-link comments-closed-link">' . __('Comments closed', 'thematic') .'</span>';
    }
		


    // Display edit link
    if (current_user_can('edit_posts')) {
        $postmeta .= ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . $posteditlink . '</span>';
    }

	//close the meta
    $postmeta .= "</div><!-- .entry-meta -->\n";

	return $postmeta;


	}

add_filter('thematic_postheader_postmeta','toughbubbles_postheader_postmeta');

	
//change menu around a bit

//remove the original access section first
function remove_thematic_menu() {
	remove_action('thematic_header','thematic_access',9);
	}

add_action('init','remove_thematic_menu');

//now add the stuff back in

// in retrospect, this function isn't getting used - it needs to be deleted or commented out
function toughbubbles_access () {

	?>
	<div id="access" class="menu sf-menu">
		<div class="skip-link">
			<a href="#content" title="<? _e("Skip navigation to the content", "thematic") ?>"
				><? _e("Skip to content", "thematic") ?>
			</a>
		</div>
		<ul id="top-menu">	
<?
		//Categories
			//for just a select box:
			//	wp_dropdown_categories();

?>
		<li id="categories">
			<a title="Categories"><?php _e('Categories'); ?></a>
				<ul id="categories_list">
					<? wp_list_categories('title_li='); ?>
				</ul>
		
		</li>
		
		<li id="Tags">
			<a title="Tags"><? _e('Tags'); ?></a>

<? 

		//Tags
	
$tags = wp_tag_cloud('smallest=100&largest=100&unit=%&number=0&format=array&echo=0');


$i=0;
foreach ($tags as $val) {
		unset ($matches);
			$tagmatch = "/>([a-z ]+)<\/a/i";
		preg_match ($tagmatch,$val,$matches);
		$newtags[$i] = $matches[1];
		
			$urlmatch = "/a href='(.*)' class/";
			//$urlmatch = "/a href/i";
		unset ($matches);
		preg_match ($urlmatch,$val,$matches);
		$newtagURLs[$i] = $matches[1];

	$i++;
	}

//combine the URLs and the tag name
$tagsForMenu = array_combine($newtagURLs,$newtags);

//sort them in alphabetical order
asort($tagsForMenu);


$result = array();
foreach ($tagsForMenu as $url => $string) {

	//get the first letter and capitalize it
   	$firstLetter = strtoupper(substr($string, 0, 1));
    $result[$firstLetter][] = Array ($url,$string);
	
	}


?><ul><?

foreach(array_keys($result) as $letter)
//foreach (str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ") as $letter)

{
    echo "<li><a>$letter</a>\n<ul>";
    foreach ($result[$letter] as $string)
    {
        echo "<li><a href='$string[0]'>$string[1]</a></li>\n";
    }
    echo "</ul>\n</li>\n";
}

?></ul>

</li>
<li>
	<a title="Archives">Archives</a>
		<ul id="archives_list">
<?
		//Archives - need to put into a real list
		wp_get_archives();

?>
		</ul>
</li>
<li>	
	<a title="Pages">Pages</a>
<?
		//Pages
			//wp_dropdown_pages();
			wp_page_menu();
?>

</li>
<li id="menu_search">
<?
		//Search
		get_search_form();
	?> 
</li>
</ul>
	
	</div><!--access--> <?


}

//add_action ('thematic_header','toughbubbles_access',9);

