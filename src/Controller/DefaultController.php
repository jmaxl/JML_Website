<?php

namespace JML\Controller;

use JML\Configuration;
use JML\Module\Database\Database;
use JML\View\ViewRenderer;

/**
 * Class DefaultController
 * @package JML\Controller
 */
class DefaultController
{
    /** @var ViewRenderer $viewRenderer */
    protected $viewRenderer;

    /** @var Configuration $configuration */
    protected $configuration;

    /** @var Database $database */
    protected $database;

    protected $valueObjectService;

    /**
     * DefaultController constructor.
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->viewRenderer = new ViewRenderer($this->configuration);
        $this->database = new Database($this->configuration);

        $this->setDefaultViewConfig();
    }

    /**
     * Sets default view parameter for sidebar etc.
     */
    protected function setDefaultViewConfig(): void
    {
        $this->viewRenderer->addViewConfig('page', 'notfound');
    }

    public function notFoundAction(): void
    {
        $this->viewRenderer->addViewConfig('page', 'notfound');

        $this->viewRenderer->renderTemplate();
    }

    public function errorPageAction(): void
    {
        $this->showStandardPage('error');
    }

    protected function showStandardPage(string $name): void
    {
        try {
            $this->viewRenderer->addViewConfig('page', $name);

            $this->viewRenderer->renderTemplate();
        } catch (\InvalidArgumentException $error) {
            $this->notFoundAction();
        }
    }
}