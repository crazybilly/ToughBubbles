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
add_action ('thematic_indexloop','twitter_client');


//add subtitle (via wp subtitle plugin)
/*
function subtitles($posttitle) {

	$yo = get_the_subheading('53');
	echo $yo;

	$tryit = $posttitle;
	$tryit .= "<h3 class='subtitle'>";
	$tryit .= $yo;
	$tryit .= "</h3>";
	
	return $tryit;

	}

//insert subtitles
add_filter ('thematic_postheader_posttitle','subtitles');
*/

/*
function toughbubbles_postheader_posttitle() {
    global $id, $post, $authordata;

    
    if (is_single() || is_page()) {
        $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
	//	$posttitle .= the_subheading( /*'<h2 class="subtitle">', '</h2>'  );
    } elseif (is_404()) {    
        $posttitle = '<h1 class="entry-title">' . __('Not Found', 'thematic') . "</h1>\n";
    } else {
        $posttitle = '<h2 class="entry-title"><a href="';
        $posttitle .= get_permalink();
        $posttitle .= '" title="';
        $posttitle .= __('Permalink to ', 'thematic') . the_title_attribute('echo=0');
        $posttitle .= '" rel="bookmark">';
        $posttitle .= get_the_title();   
        $posttitle .= "</a> yo </h2>\n";
        //$posttitle .= get_the_subheading(59,"<h3>","</h3>","false");
	}

	$posttitle = apply_filters('thematic_postheader_posttitle',$posttitle); 

	return $posttitle;
}   

add_filter('thematic_postheader_posttitle','toughbubbles_postheader_posttitle')
*/

?>
