<?php
namespace Admin;

use Acms\Core\Data\Db;

abstract class AbstractAdmin
{
    public function getTemplateVars()
    {
        return true;
    }

    public function getTemplateNav($axis)
    {
        $axis->sql->dbSelect('plugins', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)], 'ORDER BY weight');
        $result = $axis->sql->dbFetch();

        foreach ($result as $plugin) {

            if (file_exists(BASE_DIR . $plugin['folder_path'] . $plugin['folder_name'] . DS . 'AdminPages.php')) {

                $tempController = '\\' . $plugin['folder_name'] . '\\' . 'AdminPages';

                $tempObject = new $tempController;

                if (method_exists($tempObject, 'adminNavigation')) {
                    $navLinks[$plugin['folder_name']] = $tempObject->adminNavigation($axis);
                }
            }
        }

        return $navLinks;
    }

    public function getTemplateBlocks()
    {
        return true;
    }
}
