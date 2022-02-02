<?php

namespace App;

/**
 * Class Page
 * @package App
 */
class Page extends Controller
{
    /**
     * @var Downloader
     */
    private $download;
    /**
     * @var Parser
     */
    private $parser;
    /**
     * @var Converter
     */
    private $converter;

    /**
     * Page constructor.
     * @param Downloader $download
     * @param Parser $parser
     * @param Converter $converter
     */
    public function __construct(Downloader $download, Parser $parser, Converter $converter)
    {
        parent::__construct();
        $this->download = $download;
        $this->parser = $parser;
        $this->converter = $converter;
    }

    /**
     * Index (main page) route.
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): void
    {
        $this->view('index.html.twig');
    }

    /**
     * Download route.
     * @param $url
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function download($url): void
    {
        $videoUrl = $this->parser->getPage($url);
        $video = $this->download->downloadVideo($videoUrl);
        $this->view('download.html.twig', ['filename' => $video]);
    }

    /**
     * Gif converter route.
     * @param $fromSeconds
     * @param $gifDuration
     * @param $videoId
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function convert($fromSeconds, $gifDuration, $videoId): void
    {
        $gifId = $this->converter->convertToGif($fromSeconds, $gifDuration, $videoId);

        $this->view('gif.html.twig', ['gif' => "user_videos/" . $gifId . ".gif"]);
    }
}
