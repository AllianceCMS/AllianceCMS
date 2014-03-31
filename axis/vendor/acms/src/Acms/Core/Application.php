<?php
namespace Acms\Core;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class Application extends \Pimple implements HttpKernelInterface, TerminableInterface
{

    public function __construct(array $values = array())
    {
        parent::__construct();


    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        // TODO Auto-generated method stub
    }

    public function terminate(Request $request, Response $response)
    {
        // TODO Auto-generated method stub
    }
}