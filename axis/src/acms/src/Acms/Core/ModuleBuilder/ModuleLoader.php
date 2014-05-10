<?php
namespace Acms\Core\ModuleBuilder;

use Acms\Core\Application;
use Symfony\Component\Routing\RouteCollection;

class ModuleLoader
{
    private $app;
    private $modules;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->modules = $this->listActiveModules();
    }

    public function loadActiveModules()
    {
        $this->autoloadModules();
        $this->buildModuleRoutes();
        $this->addModuleEvents();
        $this->addModuleListeners();
    }

    public function listActiveModules()
    {
        $sql = $this->app['model'];

        // Include only installed modules 'routes.php' so we have access to routes
        $sql->dbSelect('modules', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);

        $result = $sql->dbFetch();

        foreach ($result as $row => $val) {
            $activeModules[$val['folder_name']] = $this->app['paths']->get('dir.base') . '/' . $val['folder_path'] . $val['folder_name'];
        }

        return $activeModules;
    }

    public function getActiveModules()
    {
        return $this->modules;
    }

    public function autoloadModules()
    {
        $classLoader = $this->app['class_loader'];

        foreach ($this->modules as $row => $val) {

            $classLoader->addPrefix($row, $this->app['paths']->get('dir.axis_modules'));

        }

        $classLoader->register();

        return true;
    }

    public function buildModuleRoutes()
    {
        $this->app->route_collection = new RouteCollection();

        foreach ($this->modules as $row => $val) {

            if(file_exists($this->app['paths']->get('dir.axis_modules') . '/' . $row . '/routes.php')) {

                // look inside *this* directory
                $locator = new \Symfony\Component\Config\FileLocator(array($this->app['paths']->get('dir.axis_modules') . '/' . $row));
                $loader = new \Symfony\Component\Routing\Loader\PhpFileLoader($locator);
                $this->app->route_collection->addCollection($loader->load('routes.php'));

            }

        }
    }

    public function addModuleEvents()
    {
        //$request = $this->app['request'];

        $route_collection = $this->app->route_collection->all();

        /*
        echo '<br /><pre>$route_collection: ';
        echo print_r($route_collection['homepage']->getDefault('_namespace'));
        echo '</pre><br />';
        //exit;
        //*/

        //*
        echo '<br />_namespace is: ' . $route_collection['devmod_home']->getDefault('_controller') . '<br />';
        //exit;
        //*/

        /*
        echo '<br />_namespace is: ' . $route_collection['homepage']->getDefault('_namespace') . '<br />';
        //exit;
        //*/

        //*
        echo '<br /><pre>$route_collection: ';
        echo print_r($route_collection);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this->app->route_collection->all(): ';
        echo print_r($this->app->route_collection->all());
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this->app->route_collection: ';
        echo print_r($this->app->route_collection);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this->app: ';
        echo print_r($this->app);
        echo '</pre><br />';
        //exit;
        //*/

        return true;
    }

    public function addModuleListeners()
    {
        return true;
    }
}