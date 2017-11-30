<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Module\Article\ArticleService;
use JML\Module\GenericValueObject\Id;

/**
 * Class IndexController
 * @package JML\Controller
 */
class IndexController extends DefaultController
{
    /**
     * main action for the index page
     */
    public function indexAction(): void
    {
        $articleService = new ArticleService($this->database);
        var_dump($articleService->getAllArticleOrderByDate());

    }

    /**
     * action for impressum site
     */
    public function impressumAction(): void
    {
        $this->showStandardPage('impressum');
    }

    /**
     * @todo remove if function was understood
     * example action
     */
    public function differentIndexAction(): void
    {
        try {
            $this->viewRenderer->addViewConfig('slider', 'sliderVariable');
            $this->viewRenderer->addViewConfig('page', 'home');

            $this->viewRenderer->renderTemplate();
        } catch (\InvalidArgumentException $error) {
            $this->notFoundAction();
        }
    }
}