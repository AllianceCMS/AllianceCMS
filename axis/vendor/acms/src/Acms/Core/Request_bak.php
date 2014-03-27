<?php
namespace Acms\Core;

use Acms\Core\System\PathBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest
{
    /*
    public function __construct(array $pathParameters = array()) {
        parent::__construct();

        $this->systemPaths = new PathBag($pathParameters);
    }
    //*/

    public function addSystemPaths(array $pathParameters = array())
    {
        $this->systemPaths = new PathBag($pathParameters);
    }
}