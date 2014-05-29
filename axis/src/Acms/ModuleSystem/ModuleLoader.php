<?php
namespace Acms\ModuleSystem;

use Acms\Data\Db;

class ModuleLoader
{
    public function listActiveModules()
    {
        $sql = new Db();

        // Include only installed modules 'routes.php' so we have access to routes
        $sql->dbSelect('modules', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);
        $result = $sql->dbFetch();

        return $result;

        /*
        foreach ($result as $row => $val) {
            $modules[$val['folder_name']] = BASE_DIR . '/' . $val['folder_path'] . $val['folder_name'];
        }

        return $modules;
        //*/

        /*
        $sql = $this['model'];

        // Include only installed modules 'routes.php' so we have access to routes
        $sql->dbSelect('modules', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);

        $result = $sql->dbFetch();

        foreach ($result as $row => $val) {
            $modules[$val['folder_name']] = $this['paths']->get('dir.base') . '/' . $val['folder_path'] . $val['folder_name'];
        }

        return $modules;
        //*/
    }
}