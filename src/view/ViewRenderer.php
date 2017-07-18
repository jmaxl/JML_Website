<?php
declare(strict_types=1);

namespace Project\View;

use Project\Configuration;
use Project\View\ValueObject\TemplateDir;
use Project\View\ValueObject\CacheDir;

class ViewRenderer
{
    /**
     * @var TemplateDir $templateDir
     */
    protected $templateDir;

    protected $cacheDir;

    protected $viewRenderer;

    public function __construct(Configuration $configuration)
    {
        $template = $configuration->getEntryByName('template');

        $this->templateDir = TemplateDir::fromString($template['dir']);
        $this->cacheDir = CacheDir::fromString($template['cacheDir']);

        $loaderFilesystem = new \Twig_Loader_Filesystem($this->templateDir->getTemplateDir());
        $this->viewRenderer = new \Twig_Environment($loaderFilesystem, array(
            'cache' => $template['cacheDir'],
        ));
    }

    public function renderTemplate(string $template, array $config): void
    {
        echo $this->viewRenderer->render($template, $config);
    }
}