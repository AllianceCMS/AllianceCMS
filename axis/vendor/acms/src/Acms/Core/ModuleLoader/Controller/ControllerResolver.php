<?php
namespace Acms\Core\ModuleLoader\Controller;

use Acms\Core\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as SymfonyControllerResolver;

class ControllerResolver extends SymfonyControllerResolver
{
    private $app;
    private $request;

    public function __construct(Application $app, LoggerInterface $logger = null)
    {
        parent::__construct($logger);

        $this->app = $app;
        $this->request = $app['request'];
    }

    /**
     * Returns a callable for the given controller.
     *
     * @param string $controller A Controller string
     *
     * @return mixed A PHP callable
     *
     * @throws \InvalidArgumentException
     */
    protected function createController($controller)
    {
        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$controller: ';
        echo var_dump($controller);
        echo '</pre><br />';
        //exit;
        //*/

        if (false === strpos($controller, '::')) {
            throw new \InvalidArgumentException(sprintf('Unable to find controller "%s".', $controller));
        }

        list($class, $method) = explode('::', $controller, 2);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
        }

        /*
        echo '<br />$class is: ' . $class . '<br />';
        //exit;
        //*/

        /*
        echo '<br />$method is: ' . $method . '<br />';
        //exit;
        //*/

        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        $axis = new \stdClass;
        //$axis->acmsLoader = 'acmsLoader';
        //$axis->basePath = 'basePath';
        //$axis->axisRoute = 'axisRoute';
        $axis->sessionAxis = 'sessionAxis';
        $axis->segmentUser = 'segmentUser';
        $axis->currentUser = 'currentUser';

        return array(new $class($this->app, $this->request), $method);
    }

    protected function doGetArguments(Request $request, $controller, array $parameters)
    {
        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$parameters: ';
        echo print_r($parameters);
        echo '</pre><br />';
        //exit;
        //*/

        $attributes = $request->attributes->all();

        /*
        echo '<br /><pre>$attributes: ';
        echo print_r($attributes);
        echo '</pre><br />';
        //exit;
        //*/

        $arguments = array();
        foreach ($parameters as $param) {
            if (array_key_exists($param->name, $attributes)) {
                $arguments[] = $attributes[$param->name];
            } elseif ($param->getClass() && $param->getClass()->isInstance($request)) {
                $arguments[] = $request;
            } elseif ($param->isDefaultValueAvailable()) {
                $arguments[] = $param->getDefaultValue();
            } else {
                if (is_array($controller)) {
                    $repr = sprintf('%s::%s()', get_class($controller[0]), $controller[1]);
                } elseif (is_object($controller)) {
                    $repr = get_class($controller);
                } else {
                    $repr = $controller;
                }

                throw new \RuntimeException(sprintf('Controller "%s" requires that you provide a value for the "$%s" argument (because there is no default value or because there is a non optional argument after this one).', $repr, $param->name));
            }
        }

        /*
        echo '<br /><pre>$arguments: ';
        echo print_r($arguments);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        return $arguments;
    }
}