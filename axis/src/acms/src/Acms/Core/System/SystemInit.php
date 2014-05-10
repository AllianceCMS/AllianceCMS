<?php
namespace Acms\Core\System;

class SystemInit
{
    private $params = [];

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }
}