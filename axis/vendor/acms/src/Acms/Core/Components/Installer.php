<?php
namespace Acms\Core\Components;

use Acms\Core\Application;
use Symfony\Component\Filesystem\Filesystem;

class Installer
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
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
        if ($fs->exists($this->app['paths']->get('dir.base') . $modulePath . $moduleName . DIRECTORY_SEPARATOR . 'assets')) {
            $fs->mkdir($this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets', 0755);
            $fs->mirror($this->app['paths']->get('dir.base') . $modulePath . $moduleName . DIRECTORY_SEPARATOR . 'assets', $this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets', null, ['override' => true, 'copyonwindows' => true, 'delete' => true]);
            return true;
        }
        return false;
    }

    public function removeAssets($modulePath, $moduleName)
    {
        $fs = new Filesystem();

        // Does module asset folder exist?
        if ($fs->exists($this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets')) {
            $fs->remove($this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'assets');

            // Remove module directory from resources if it is empty
            if ($this->is_dir_empty($this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName)) {
                $fs->remove($this->app['paths']->get('dir.www_resources') . 'modules' . DIRECTORY_SEPARATOR . $moduleName);
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
