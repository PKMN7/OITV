<?php
require_once('twitter-api-php-master/TwitterAPIExchange.php');
require_once('config.php');

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=Reuters&count=5';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
     $lol = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(), true);
             //define arrays to store tweets and time of tweets
             $alltexts = [];
foreach($lol as $items)
    {
        //echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        $texts = ( $items['text']);
        $goodtexts = filter_var($texts, FILTER_SANITIZE_STRING);
        $alltexts[] = $goodtexts;
        //echo "Tweeted by: ". $items['user']['name']."<br />";
        //echo "Screen name: ". $items['user']['screen_name']."<br />";
        //echo "Followers: ". $items['user']['followers_count']."<br />";
        //echo "Friends: ". $items['user']['friends_count']."<br />";
        //echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
     echo json_encode($alltexts);
?>
