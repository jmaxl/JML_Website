<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Configuration;

use JML\Utilities\Tools;
use JML\View\JsonModel;

/**
 * Class BackendController
 * @package Project\Controller
 */
class JsonController extends DefaultController
{
    /** @var JsonModel $jsonModel */
    protected $jsonModel;

    /**
     * JsonController constructor.
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);

        $this->jsonModel = new JsonModel();
    }

    public function testAction()
    {

        $this->jsonModel->addJsonConfig('view', $this->viewRenderer->renderJsonView('page/home.twig'));

        $this->jsonModel->send();
    }
}