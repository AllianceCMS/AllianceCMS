<?php
namespace Acms\Core\Components;

use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;

abstract class AbstractPlugin
{
    protected $axis;
    protected $formHelper;
    protected $htmlHelper;
    protected $customHeaders;

    public function __construct($axis)
    {
        $this->axis = $axis;
        $this->formHelper = new FormHelper($this->axis->basePath);
        $this->htmlHelper = new HtmlHelper($this->axis->basePath);
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