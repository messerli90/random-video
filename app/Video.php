<?php

namespace App;

use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'videoKey', 'published_at', 'channel_title', 'channel_key', 'thumbnail_small', 'thumbnail_medium'];

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    public function getVideos()
    {
        $channelId = 'UCPDis9pjXuqyI7RYLJ-TTSA';

        $videoList = Youtube::listChannelVideos($channelId, 50);

        $random = rand(0, 49);

        $video = $videoList[$random];
    }

    public static function getRandom($channel_title = 'FailArmy')
    {
        $videos = self::where('channel_title', $channel_title)->get();

        return $videos->random();
    }
}
