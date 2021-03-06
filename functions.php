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
			<a href="<? bloginfo_rss('rss2_url') ?>"><img src="<? bloginfo('stylesheet_directory'); ?>/images/RSS-badge.png" alt="Subscribe"></a>
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
	?>	<div id="twitter-content">
			<h2 id="twitter-title" class="entry-title">Twitter</h2>
		<?
				twitter_messages("crazybilly",10,true,true,'<br>#'); 
		?>
		</div>
		<?
	}
}

//insert twitter
//temporarily removed to speed up debugging
add_action ('thematic_indexloop','twitter_client');



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

//add credits to the footer
function footer_credits() {
	?>
		<div class="footer-credits">
			<h2>Font Credits:</h2>
			<ul>
				<li><a href="http://friedrichalthausen.de/2006/01/01/vollkorn/">Vollkorn</a>: <a href="http://creativecommons.org/licenses/by/2.0/de/">CC-BY</a></li>
				<li><a href="http://www.exljbris.com">Fontin</a>: by <a href="http://www.exljbris.com">www.exljbris.nl</a></li>
			</ul>
		</div>
	<?
}

add_action('thematic_abovefooter','footer_credits');
