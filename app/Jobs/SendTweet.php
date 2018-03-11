<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\TweetSent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Twitter\TwitterService;

class SendTweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;
    public $handle;
    public $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $handle, $text)
    {
        $this->id =$id;
        $this->handle =$handle;
        $this->text =$text;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TwitterService $twitter)
    {
        $twitter->sendTweet("@{$this->handle} {$this->text}", $this->id);

        event(new TweetSent($this->id));
        
    }
}
