<?php

namespace App;

use \Twig\Environment as TwigEnvironment;
use \Twig\Loader as TwigLoader;

/**
 * Class Controller
 * @package App
 */
class Controller
{
    /**
     * @var TwigLoader\FilesystemLoader
     */
    private $loader;
    /**
     * @var TwigEnvironment
     */
    private $twig;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->loader = new TwigLoader\FilesystemLoader(dirname(__DIR__) .'/templates');
        $this->twig = new TwigEnvironment($this->loader);
    }

    /**
     * @param $view
     * @param array $variable
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view($view, $variable = [])
    {
        echo $this->twig->render($view, $variable);
    }
}
