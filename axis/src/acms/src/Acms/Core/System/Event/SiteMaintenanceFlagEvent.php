<?php
namespace Acms\Core\System\Event;

use Acms\Core\Application;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SiteMaintenanceFlagEvent extends GetResponseEvent
{
    private $app;

    public function __construct($kernel, $request, $requestType, Application $app)
    {
        parent::__construct($kernel, $request, $requestType);

        $this->app = $app;
    }

    public function getFlagValue()
    {
        return $this->app['maintenance_flag'];
    }

    public function setFlagValue($value)
    {
        if (((int) $value === intval(1)) || ((int) $value === intval(2))) {
            $this->app['maintenance_flag'] = $value;
        } else {
            throw new \Exception('Invalid value');
        }
    }
}