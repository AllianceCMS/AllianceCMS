<?php
namespace Acms\Core\Users;


class AxisPermissions
{
    public function definePerms()
    {
        $this->perms = [
        'admin_ciao',
        'view_ciao',
        'edit_ciao',
        ];
    }
    
    public function addPerms($perms = '')
    {
        if (!empty($perms)) {
    
            $this->perms = array_merge((array) $this->perms, (array) $perms);
    
            $this->perms = array_unique($this->perms);
        }
    }
    
    public function getPerms()
    {
        return $this->perms;
    }
}