<?php
namespace Acms\Components;

use Symfony\Component\Filesystem\Filesystem;

class Installer
{
    public function checkDependencies()
    {
        return true;
    }

    public function installModule()
    {
        return true;
    }

    public function updateModule()
    {
        return true;
    }

    public function removeModule()
    {
        return true;
    }

    public function installData()
    {
        return true;
    }

    public function mirrorAssets($modulePath, $moduleName)
    {
        $fs = new Filesystem();

        // Does module asset folder exist?
        if ($fs->exists(BASE_DIR . $modulePath . '/' . $moduleName . '/assets')) {
            $fs->mkdir(WWW_RESOURCES_DIR . '/modules/' . $moduleName . '/assets', 0755);
            $fs->mirror(BASE_DIR . $modulePath . '/' . $moduleName . '/assets', WWW_RESOURCES_DIR . '/modules/' . $moduleName . '/assets', null, ['override' => true, 'copyonwindows' => true, 'delete' => true]);

            return true;
        }
        return false;
    }

    public function removeAssets($modulePath, $moduleName)
    {
        $fs = new Filesystem();

        // Does module asset folder exist?
        if ($fs->exists(WWW_RESOURCES_DIR . '/modules/' . $moduleName . '/assets')) {
            $fs->remove(WWW_RESOURCES_DIR . '/modules/' . $moduleName . '/assets');

            // Remove module directory from resources if it is empty
            if ($this->is_dir_empty(WWW_RESOURCES_DIR . '/modules/' . $moduleName)) {
                $fs->remove(WWW_RESOURCES_DIR . '/modules/' . $moduleName);
            }
            return true;
        }
        return false;
    }

    public function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL;
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function updateData()
    {
        return true;
    }

    public function updateAssets()
    {
        return true;
    }

    public function removeData()
    {
        return true;
    }

    public function currentSchema()
    {
        return true;
    }

    public function updateSchema()
    {
        return true;
    }

    public function removeSchema()
    {
        return true;
    }
}
