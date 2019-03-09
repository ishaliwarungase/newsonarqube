<?php
function scrape_insta_hash($tag) {
	$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/');
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	return json_decode($insta_json[0], TRUE);
}
$tag = 'rangerover';
$results_array = scrape_insta_hash($tag);

// var_dump($results_array);

// $from = 1;
// $to = $limit = 3;

$limit = 50;


// $image_array = $like_array = array();
$image_array = array();


for ($i= 0; $i < $limit; $i++) { 
	$like = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['edge_liked_by']['count'];
	$image_list = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['display_url'];
	//array_push($like_array, $total_like);
	array_push($image_array, $image_list);
	echo'<img src='.$image_list.' height="400" width="350" title="'.$like.'">&nbsp;&nbsp;';

}

