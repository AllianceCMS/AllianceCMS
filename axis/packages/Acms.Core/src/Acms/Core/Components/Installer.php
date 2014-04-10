<?php
namespace Acms\Core\Components;

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
        if ($fs->exists(BASE_DIR . $modulePath . $moduleName . DIRECTORY_SEPARATOR . 'assets')) {
            $fs->mkdir(RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets', 0755);
            $fs->mirror(BASE_DIR . $modulePath . $moduleName . DIRECTORY_SEPARATOR . 'assets', RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets', null, ['override' => true, 'copyonwindows' => true, 'delete' => true]);
            return true;
        }
        return false;
    }

    public function removeAssets($modulePath, $moduleName)
    {
        $fs = new Filesystem();

        // Does module asset folder exist?
        if ($fs->exists(RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets')) {
            $fs->remove(RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets');

            // Remove module directory from resources if it is empty
            if ($this->is_dir_empty(RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName)) {
                $fs->remove(RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName);
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
