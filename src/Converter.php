<?php


namespace App;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate as Coordinate;

/**
 * Class Converter
 * @package App
 */
class Converter
{

    /**
     * Function that takes the video and converts it to gif.
     * @param $fromSeconds
     * @param $gifDuration
     * @param $videoId
     * @return string
     */
    public function convertToGif($fromSeconds, $gifDuration, $videoId): string
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open(dirname(__DIR__) .'/user_videos/' . $videoId . '.mp4');

        $video
            ->gif(Coordinate\TimeCode::fromSeconds($fromSeconds), new Coordinate\Dimension(300, 533), $gifDuration)
            ->save(dirname(__DIR__). '/user_videos/' . $videoId . '.gif');

        return $videoId;
    }
}
