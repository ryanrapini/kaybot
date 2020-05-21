<?php

namespace App\Services;

use App\GeneratedTweet;
use DG\Twitter\Twitter;

class TweetService
{
	private $twitter;

	public function __construct()
    {
		$this->twitter = new Twitter(
	        config('services.twitter.consumer_key'), 
	        config('services.twitter.consumer_secret'),
	        config('services.twitter.access_token'),
	        config('services.twitter.access_token_secret')
	    );
    }

    public function getTweets()
    {
    	return $this->twitter->load(Twitter::ME);
    }

    public function sendTweet()
    {
    	$tweet = GeneratedTweet::where('is_tweeted', false)->first();

        if(is_null($tweet)){
            \Log::info("Tried to tweet but out of tweets");

            return "Out of tweets :[";
        }
        \Log::info("Tweeted: " . $tweet->tweet);

        try {
            $this->twitter->send($tweet->tweet);
        } catch (DG\Twitter\Exception $e) {
            return "Error: " . $e->getMessage();
        }

        $tweet->is_tweeted = true;
        $tweet->tweeted_at = now();
        $tweet->save();

        return "Success";
    }

}
