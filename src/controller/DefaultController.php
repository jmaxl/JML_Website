<?php
declare(strict_types=1);

namespace Project\Controller;

use Project\View\ViewRenderer;
use Project\Configuration;

/**
 * Class DefaultController
 * @package Project\Controller
 */
class DefaultController
{
    protected $viewRenderer;

    protected $configuration;

    public function __construct()
    {
        $this->configuration = new Configuration();
        $this->viewRenderer = new ViewRenderer($this->configuration);
    }
}