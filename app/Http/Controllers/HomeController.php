<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TweetService;

class HomeController extends Controller
{
    private $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->middleware('auth');
        $this->tweetService = $tweetService;
    }

    public function sendTweet()
    {
        return response()->json($this->tweetService->sendTweet());
    }

    public function getLiveTweets()
    {
        $statuses = $this->tweetService->getTweets();
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
