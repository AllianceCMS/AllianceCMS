<?php
namespace Acms\Core\Users;

use Zend\Permissions\Rbac\AbstractRole;

/**
 * Manages RBAC Roles
 */

class AxisRole extends AbstractRole
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}