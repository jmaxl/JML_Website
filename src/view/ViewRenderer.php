<?php
declare(strict_types = 1);

namespace Project\View;


class ViewRenderer
{
    const TEMPLATE_DIR = ROOT_PATH . '/templates';
    const CACHE_DIR = ROOT_PATH . '/cache';

    protected $viewRenderer;

    public function __construct()
    {
        $loaderFilesystem = new \Twig_Loader_Filesystem(self::TEMPLATE_DIR);
        $this->viewRenderer = new \Twig_Environment($loaderFilesystem, array(
            'cache' => self::CACHE_DIR,
        ));
    }


    public function renderTemplate(string $template, array $config): void
    {
        echo $this->viewRenderer->render($template, $config);
    }
}