<?php
/* ------------------------------------------------------------------------ */
/* Footer Twitter
/* ------------------------------------------------------------------------ */

global $sd_data;

//Twitter OAUTH
$username = $sd_data['sd_twitter_username'];
$consumer_key = $sd_data['sd_consumer_key'];
$consumer_secret = $sd_data['sd_consumer_secret'];
$access_token = $sd_data['sd_access_token'];
$access_token_secret = $sd_data['sd_access_token_secret'];
$tweetscount = '3';

if ( !empty( $username ) && !empty( $consumer_key ) && !empty( $consumer_secret ) && !empty( $access_token ) && !empty( $access_token_secret ) ) { 
	
	if ( $username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $tweetscount ) { 
		$transName = 'sd_twitter_feed';
		$cacheTime = 10;
		delete_transient($transName);
	
		if(false === ($twitterData = get_transient($transName))) {
			// require the twitter auth class
			@require_once 'twitteroauth/twitteroauth.php';
			$twitterConnection = new TwitterOAuth(
				$consumer_key,	// Consumer Key
				$consumer_secret,   	// Consumer secret
				$access_token,       // Access token
				$access_token_secret    	// Access token secret
			);
			
			$twitterData = $twitterConnection->get(
								  'statuses/user_timeline',
								  array(
									'screen_name'     => $username,
									'count'           => $tweetscount,
									'exclude_replies' => false
								  )
								);
			if($twitterConnection->http_code != 200) {
				$twitterData = get_transient($transName);
			}
		}
		// Save our new transient.
		set_transient($transName, $twitterData, 60 * $cacheTime);
	};
			$twitter = get_transient($transName);
		function ago($time)
		{
		   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		   $lengths = array("60","60","24","7","4.35","12","10");
	
		   $now = time();
	
			   $difference     = $now - $time;
			   $tense         = "ago";
	
		   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			   $difference /= $lengths[$j];
		   }
	
		   $difference = round($difference);
	
		   if($difference != 1) {
			   $periods[$j].= "s";
		   }
	
		   return "$difference $periods[$j] ago ";
		}
}
?>

<div class="sd-twitter-wrapper clearfix">
	<div class="container">
		<div class="sd-twitter-feed clearfix"> <i class="fa fa-twitter fa-3x pull-left hidden-xs"></i>
			<div class="sd-latest-tweets-slider">
			<?php if ( !empty( $username ) && !empty( $consumer_key ) && !empty( $consumer_secret ) && !empty( $access_token ) && !empty( $access_token_secret ) ) : ?>
				<?php if ( is_array( $twitter ) ) : ?>
				<ul class="slides">
					<?php foreach( $twitter as $tweet): ?>
					<li>
						<?php
				$latestTweet = $tweet->text;
				$latestTweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet );
				$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1:</a>&nbsp;', $latestTweet );
				echo $latestTweet;
			?>
						<?php
				$twitterTime = strtotime($tweet->created_at);
				$timeAgo = ago($twitterTime);
			?>
						<a class="sd-time-ago" href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" ><?php echo $timeAgo; ?></a> </li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>