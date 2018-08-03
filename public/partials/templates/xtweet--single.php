<?php
/**
 * This is the single tweet template
 *
 * DO NOT EDIT THIS TEMPLATE. INSTEAD, COPY IT INTO YOUR-THEME/XTWEETS/XTWEET--SINGLE.PHP AND EDIT THAT WAY
 * 
 *
 * $has_image | Contains all the media information (image, video etc) if there is any
 * $id | ID of the individual tweet, used as part of the tweet url
 * $img_url | If the tweet has an image, this is the url
 * $at | The tweeters user name
 * 
 * 
 * There are a lot more. Just var_dump($status) to get the rest
 */
	// echo '<pre>';
	// 	var_dump($status);
	// echo '</pre>';
?>
<div>
	<a href="https://twitter.com/<?=$at;?>/status/<?=$id;?>" target="_blank" class="" style="">

		<?php if(!empty($has_image)){ ?> 
			<div>
				<div style="height:200px;overflow:hidden;background-image:url(<?=$img_url;?>);background-size:cover;width:100%;background-position:center;">
				</div>
			</div>
		<?php } ?>
	</a>

	<a href="https://twitter.com/<?=$at;?>/status/<?=$id;?>" target="_blank">@<?=$at;?></a>

	<p><?=$tweet;?></p>

	<div>
		<a href="https://twitter.com/intent/tweet?in_reply_to=<?=$id;?>" target="_blank">Reply</a>
		<a href="https://twitter.com/intent/retweet?tweet_id=<?=$id;?>" target="_blank">Retweet</a>
		<a href="https://twitter.com/intent/like?tweet_id=<?=$id;?>" target="_blank">Like</a>
	</div>
</div>