<?php
require_once __DIR__.'/bootstrap.php';

use App\Downloader;
use App\Page;
use App\Parser;
use App\Converter;

// Routes

$router->addRoute('', function () {
    $page = new Page(new Downloader(), new Parser(), new Converter());
    $page->index();
});

$router->addRoute('download', function () {
    if (!empty($_POST['url'])) {
        $page = new Page(new Downloader(), new Parser(), new Converter());
        $page->download($_POST['url']);
    }
});

$router->addRoute('convert', function () {
    if (!empty($_POST['gifDuration']) && !empty($_POST['videoId'])) {
        $page = new Page(new Downloader(), new Parser(), new Converter());
        $page->convert($_POST['fromSeconds'], $_POST['gifDuration'], $_POST['videoId']);
    }
});

$router->run();
