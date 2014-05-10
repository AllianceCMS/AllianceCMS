<?php
namespace Acms\Core\Components;

use Acms\Core\Application;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractModule
{
    protected $moduleName;

    protected $app;

    protected $axis;
    //protected $acmsLoader;
    //protected $axisRoute;
    //protected $basePath;
    protected $sessionAxis;
    protected $segmentUser;
    protected $currentUser;
    protected $sql;
    protected $formHelper;
    protected $htmlHelper;
    protected $customHeaders;

    //public function __construct(Request $request, \stdClass $axis)
    public function __construct(Application $app)
    {
        $this->app = $app;
        /*
        $var_array = get_defined_vars();
        //*/

        /*
        echo '<br /><pre>$var_array: ';
        echo var_dump($var_array);
        echo '</pre><br />';
        exit;
        //*/

        /*
        $this->axis = $axis;

        $this->acmsLoader = $axis->acmsLoader;
        $this->basePath = $axis->basePath;
        $this->axisRoute = $axis->axisRoute;
        $this->sessionAxis = $axis->sessionAxis;
        $this->segmentUser = $axis->segmentUser;
        $this->currentUser = $axis->currentUser;

        $this->moduleName = $this->axisRoute->values['namespace'];

        $this->formHelper = new FormHelper($this->basePath);
        $this->htmlHelper = new HtmlHelper($this->basePath);
        //*/
    }

    public function getThisObject()
    {
        $reflection = new \ReflectionClass($this);
        $tempController = '\\' . $reflection->getNamespaceName() . '\\' . 'AdminPages';
        $tempObject = new $tempController;

        return $tempObject;
    }

    public function addCustomHeader($customHeader)
    {
        if (!empty($customHeader)) {
            $this->customHeaders[] = $customHeader;
            return true;
        }

        return false;
    }

    public function getCustomHeaders()
    {
        if (!empty($this->customHeaders))
            return $this->customHeaders;

        return false;
    }

}