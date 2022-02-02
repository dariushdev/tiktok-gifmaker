<?php

namespace App;

/**
 * Class Downloader
 * @package App
 */
class Downloader
{

    /**
     * Function that downloads and saves the video.
     * @param $videoUrl
     * @return string
     */
    public function downloadVideo($videoUrl): string
    {
        $ch = curl_init($videoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.tiktok.com/');
        curl_setopt($ch, CURLOPT_ENCODING, 'utf-8');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        $video = curl_exec($ch);

        $filename = uniqid('gif');
        $d = fopen('user_videos/' . $filename . '.mp4', "w");
        fwrite($d, $video);
        fclose($d);

        return $filename;
    }
}
