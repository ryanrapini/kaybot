<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DG\Twitter\Twitter;
use App\GeneratedTweet;

class HomeController extends Controller
{
    private $twitter;

    public function __construct()
    {
        $this->middleware('auth');

        $this->twitter = new Twitter(
            config('services.twitter.consumer_key'), 
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret')
        );
    }

    public function sendTweet()
    {
        $tweet = GeneratedTweet::where('is_tweeted', false)->first();
        \Log::debug($tweet->tweet);
        // try {
        //     $this->twitter->send($tweet->tweet);
        // } catch (DG\Twitter\Exception $e) {
        //     return response()->json("Error: " . $e->getMessage());
        // }
        $tweet->is_tweeted = true;
        return response()->json("Success");
    }

    public function getLiveTweets()
    {
        $statuses = $this->twitter->load(Twitter::ME);
        return response()->json($statuses);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
