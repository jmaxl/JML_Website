<?php
declare (strict_types=1);


namespace JML\Controller;

use JML\Configuration;
use JML\Routing;

class BackendController extends DefaultController
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
        if ($this->loggedInUser === null){
            $this->showStandardPage(Routing::ERROR_ROUTE);
        }
    }

    public function backendAction(): void
    {

    }

}