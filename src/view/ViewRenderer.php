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

    protected $templateName;

    public function __construct(Configuration $configuration)
    {
        $template = $configuration->getEntryByName('template');

        $this->templateDir = TemplateDir::fromString($template['dir']);
        $this->cacheDir = CacheDir::fromString($template['cacheDir']);
        $this->templateName = $template['name'];

        $loaderFilesystem = new \Twig_Loader_Filesystem($this->templateDir->getTemplateDir());
        $this->viewRenderer = new \Twig_Environment($loaderFilesystem, array(
            //'cache' => $template['cacheDir'],
        ));
    }

    /**
     * @todo Man kann auch template switchen und optional machen, denn meist wird ja eh index als basis geladen werden. Bei jedem Aufruf spart man somit.
     * @param string $template
     * @param array $config
     */
    public function renderTemplate(string $template, array $config = []): void
    {
        $config['templateDir'] =  "templates/" . $this->templateName;

        echo $this->viewRenderer->render($template, $config);
    }
}