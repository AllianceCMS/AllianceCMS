<?php
namespace Ciao;

class Perms
{
    public function definePerms()
    {
        $perms = [
           'view_ciao' => 'User Can View Ciao Page',
           'edit_ciao' => 'User Can Edit Ciao Page',
        ];
        
        return $perms;
    }
}