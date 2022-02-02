<?php

namespace App;

/**
 * Class Parser
 * @package App
 */
class Parser
{

    /**
     * Function that downloads page and parses tiktok video url.
     * @param $url
     * @return string
     */
    public function getPage($url): string
    {
        $useragent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_ENCODING, 'utf-8');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        $page = curl_exec($ch);
        curl_close($ch);
       
        $videoUrl = explode('"downloadAddr":"', $page);
        $videoUrl = explode("\"", $videoUrl[1])[0];
        $videoUrl = str_replace("\\u0026", "&", $videoUrl);
        $videoUrl = str_replace("\\u002F", "/", $videoUrl);

        return $videoUrl;
    }
}
