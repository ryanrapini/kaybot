<?php

namespace App\Console\Commands;

use App\Setting;
use App\GeneratedTweet;
use App\Services\TweetService;

use Illuminate\Console\Command;

class TweetScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
        parent::__construct();
    }

    private $tweetService;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$settings = Setting::all();
        $min_delay = Setting::where('name', 'min_delay')->first()->value;
        $max_delay = Setting::where('name', 'max_delay')->first()->value;
        $lastTimeObj = Setting::where('name', 'last_time')->first();

        $current_seconds = explode(' ', microtime())[1];

        echo($current_seconds);
        echo($lastTimeObj->value);

        if($current_seconds > $lastTimeObj->value){
            echo('Tweeting via scheduler...');
            \Log::info('Tweeting via scheduler...');
            $this->tweetService->sendTweet();

            $offset = rand($min_delay, $max_delay);
            $offset = 4;
            \Log::info('Next offset: ' . $offset. ' seconds.');
            $lastTimeObj->value = $current_seconds + $offset;
            $lastTimeObj->save();
        }
    }
}
