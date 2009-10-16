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
				And I'm funny.
			</p>

		</div> <!--promo-box-->

		<img id="cartoon" src="http://jaket.is-a-geek.com/demo/wp-content/themes/toughbubbles/mockups/profiles/madmen_fullbody-cutout2.png"/>

		<div id="rss-links">
			<a href="<? bloginfo_rss('url') ?>"><img src="images/RSS-badge.png" alt="Subscribe"></a>
			<a href="http://www.twitter.com/crazybilly"><img src="images/twitter-badge.png" alt="Follow me on Twitter"></a>
		</div> <!--rss-links-->

	</div> <!--index-promo-->

<? 
	}
}

add_action('thematic_header','index_promo');




