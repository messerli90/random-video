<?php

namespace App\Console\Commands;

use Alaouy\Youtube\Facades\Youtube;
use App\Video;
use Illuminate\Console\Command;

class GetVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab new videos and save them';

    //protected $channel_title;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        //$this->channel_title = $this->argument('channel_title');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $channelId = 'UCPDis9pjXuqyI7RYLJ-TTSA';

        $videoList = Youtube::listChannelVideos($channelId, 50);

        foreach ($videoList as $video) {
            Video::firstOrCreate([
                'title' => $video->snippet->title,
                'description' => $video->snippet->description,
                'videoKey' => $video->id->videoId,
                //'published_at' => $video->snippet->publishedAt,
                'channel_title' => $video->snippet->channelTitle,
                'channel_key' => $video->snippet->channelId,
                'thumbnail_small' => $video->snippet->thumbnails->default->url,
                'thumbnail_medium' => $video->snippet->thumbnails->medium->url
            ]);
            $this->info('Video Added');
        }
    }
}
