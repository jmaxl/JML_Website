<?php
declare (strict_types=1);

namespace JML\View;

use JML\Configuration;
use JML\Utilities\Converter;
use JML\View\ValueObject\CacheDir;
use JML\View\ValueObject\TemplateDir;

/**
 * Class ViewRenderer
 * @package JML\View
 */
class ViewRenderer
{
    const DEFAULT_PAGE_TEMPLATE = 'index.twig';

    /** @var TemplateDir $templateDir */
    protected $templateDir;

    /** @var CacheDir $cacheDir */
    protected $cacheDir;

    /** @var \Twig_Environment $viewRenderer */
    protected $viewRenderer;

    /** @var  string $templateName */
    protected $templateName;

    /** @var  array $config */
    protected $config = [];

    /**
     * ViewRenderer constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $template = $configuration->getEntryByName('template');

        $this->templateDir = TemplateDir::fromString($template['dir']);
        $this->cacheDir = CacheDir::fromString($template['cacheDir']);
        $this->templateName = $template['name'];

        $loaderFilesystem = new \Twig_Loader_Filesystem($this->templateDir->getTemplateDir());
        $this->viewRenderer = new \Twig_Environment($loaderFilesystem);

        $this->addViewFilter();

        $this->addViewConfig('templateDir', 'templates/' . $this->templateName);
    }

    /**
     * @param string $template
     * @throws \Twig_Error_Loader
     */
    public function renderTemplate(string $template = self::DEFAULT_PAGE_TEMPLATE): void
    {
        echo $this->viewRenderer->render($template, $this->config);
    }

    /**
     * @param string $template
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderJsonView(string $template = self::DEFAULT_PAGE_TEMPLATE): string
    {
        return $this->viewRenderer->render($template, $this->config);
    }

    /**
     * @param string $name
     * @param        $value
     */
    public function addViewConfig(string $name, $value): void
    {
        $this->config[$name] = $value;
    }

    /**
     * Add filter
     */
    protected function addViewFilter(): void
    {
        $weekDayFilter = new \Twig_SimpleFilter('weekday', function ($integer) {
            return Converter::convertIntToWeekday($integer);
        });

        $this->viewRenderer->addFilter($weekDayFilter);

        $weekDayShortFilter = new \Twig_SimpleFilter('weekdayShort', function ($integer) {
            return Converter::convertIntToWeekdayShort($integer);
        });

        $this->viewRenderer->addFilter($weekDayShortFilter);
    }
}