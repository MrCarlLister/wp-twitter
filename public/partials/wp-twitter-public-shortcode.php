<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://mrcarllister.co.uk
 * @since      1.0.0
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/public/partials
 */


$x = file_get_contents('tweets.json');
$statuses = json_decode($x, true);
$g = $a['count'];

	$i=0;
	foreach($statuses as $status)
	{	
		$img_url=$has_image='';
		
		if(isset($status['extended_entities'])){
			$has_image = $status['extended_entities'];
			$medias = $status['extended_entities']['media'][0];
			$img_url = $medias['media_url_https'];

			$m_type = $medias['type'];
			if(isset($medias['video_info'])): //VIDEO
				$v = $medias['video_info']['variants'][1]['url']; 
			endif;
		};

		$id = $status['id'];
		$at = $status['user']['screen_name'];
		$tweet = $status['text'];

		$tweet = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet);
		$tweet = preg_replace("/#([A-Za-z0-9\/]*)/", "<a target=\"_new\" href=\"https://twitter.com/search?q=$1\">#$1</a>", $tweet);
		$tweet = preg_replace("/@([A-Za-z0-9\/]*)/", "<a target=\"_blank\" href=\"https://www.twitter.com/$1\">@$1</a>", $tweet);

		$v = $size = '';
		if($i==$g) break;



		$filename = get_stylesheet_directory().'/xtweets/xtweet--single.php';

        if (file_exists($filename)) {
            include( $filename );    
        } else {
            include( 'templates/xtweet--single.php' );    
        }

	

		$i++;						
	}

	?>