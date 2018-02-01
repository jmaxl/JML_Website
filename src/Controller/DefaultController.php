<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Configuration;
use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\User\UserService;
use JML\Utilities\Tools;
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

    protected $userService;

    protected $loggedInUser;

    /**
     * DefaultController constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->viewRenderer = new ViewRenderer($this->configuration);
        $this->database = new Database($this->configuration);
        $this->userService = new UserService($this->database);

        if (Tools::getValue('userId') !== false){
            $userId = Id::fromString(Tools::getValue('userId'));
        $this->loggedInUser = $this->userService->getLoggedInUserByUserId($userId);
        }

        $this->setDefaultViewConfig();
    }

    /**
     *  use this function if there is nothing found
     */
    public function notFoundAction(): void
    {
        $this->viewRenderer->addViewConfig('page', 'notfound');

        $this->viewRenderer->renderTemplate();
    }

    /**
     * use this function if there is an error
     */
    public function errorPageAction(): void
    {
        $this->showStandardPage('error');
    }

    /**
     * Sets default view parameter for sidebar etc.
     */
    protected function setDefaultViewConfig(): void
    {
        if ($this->loggedInUser !== null){
            $this->viewRenderer->addViewConfig('loggedInUser', $this->loggedInUser);

        }
        $this->viewRenderer->addViewConfig('page', 'notfound');
    }

    /**
     * @param string $name
     */
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