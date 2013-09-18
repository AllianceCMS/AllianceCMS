<?php
namespace PluginManager;

use \Admin\AbstractAdmin;
use Acms\Core\Templates\Template;
use Symfony\Component\Finder\Finder;

class AdminPages extends AbstractAdmin
{
    public function currentPlugins()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/PluginManager/project/PluginManager/0.01/files/css/style.css'));

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.current_plugins.tpl.php');

        // List plugins installed for all zones/domains
        $this->axis->sql->dbSelect('plugins',
            'name, version, description, developer, developer_email, developer_site, created',
            'active = :active
            AND folder_path = :folder_path1
            OR folder_path = :folder_path2',
            [
                'active' => intval(2),
                'folder_path1' => 'zones/all/plugins/provider/',
                'folder_path2' => 'zones/all/plugins/custom/',
            ],
            'ORDER BY weight');

        $zoneAllPlugins = $this->axis->sql->dbFetch();

        // List plugins installed for this specific zone/domain
        $this->axis->sql->dbSelect('plugins',
            'name, version, description, developer, developer_email, developer_site, created',
            'active = :active
            AND folder_path != :folder_path1
            AND folder_path != :folder_path2
            AND folder_path != :folder_path3',
            [
                'active' => intval(2),
                'folder_path1' => 'zones/all/plugins/provider/',
                'folder_path2' => 'zones/all/plugins/custom/',
                'folder_path3' => 'axis/plugins/',
            ],
            'ORDER BY weight');

        $zoneSpecificPlugins = $this->axis->sql->dbFetch();

        // List currently installed Axis plugins
        $this->axis->sql->dbSelect('plugins',
            'name, version, description, developer, developer_email, developer_site, created',
            'active = :active AND folder_path = :folder_path',
            [
            'active' => intval(2),
            'folder_path' => 'axis/plugins/',
            ],
            'ORDER BY weight');

        $axisPlugins = $this->axis->sql->dbFetch();

        $content->set('zoneAllPlugins', $zoneAllPlugins);
        $content->set('zoneSpecificPlugins', $zoneSpecificPlugins);
        $content->set('axisPlugins', $axisPlugins);

        return $content;
    }

    public function installLocalPlugins()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_local_plugins.tpl.php');

        $currentZonePath = str_replace(DS . 'dbConnection.php', '', DBCONNFILE);

        $zoneAllfinder = new \Symfony\Component\Finder\Finder();

        $zoneAllfinder->ignoreUnreadableDirs()->files()->name('routes.php')->in(ZONES . 'all');

        $zoneCurrentfinder = new \Symfony\Component\Finder\Finder();
        $zoneCurrentfinder->ignoreUnreadableDirs()->files()->name('routes.php')->in($currentZonePath . DS . 'plugins');

        foreach ($zoneAllfinder as $file) {

            $absoluteFolderArray = explode(DS, $file->getRealpath());
            $relativeFolderArray = explode(DS, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DS . $zoneName . DS . str_replace(DS . $folder_name, '', $file->getRelativePath());

            // Is this plugin already installed?
            $this->axis->sql->dbSelect('plugins',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $zoneAllPlugins = $this->axis->sql->dbFetch();

            if (!$zoneAllPlugins) {
                //*
                echo '<br />Display this plugin<br />';
                //exit;
                //*/

                //*
                echo '<br />$folder_name is: ' . $folder_name . '<br />';
                //exit;
                //*/

                //*
                echo '<br />$folder_path is: ' . $folder_path . '<br />';
                //exit;
                //*/

                //*
                echo '<br />$file->getRealpath() is: ' . $file->getRealpath() . '<br />';
                //exit;
                //*/

                /*
                 echo '<br />$file->getRelativePath() is: ' . $file->getRelativePath() . '<br />';
                //exit;
                //*/

                /*
                 echo '<br />$file->getRelativePathname() is: ' . $file->getRelativePathname() . '<br />';
                //exit;
                //*/

                //*
                echo '<br /><pre>$zoneAllPlugins: ';
                echo print_r($zoneAllPlugins);
                echo '</pre><br />';
                //exit;
                //*/
            }

            /*
            echo '<br /><pre>$zoneAllPlugins: ';
            echo var_dump($zoneAllPlugins);
            echo '</pre><br />';
            //exit;
            //*/

            //$zoneAllPlugins = '';

        }

        $content->set('greeting', 'Install Local Plugins!');

        //*
        echo '<br /><hr><br />';
        //exit;
        //*/

        foreach ($zoneCurrentfinder as $file) {

            $absoluteFolderArray = explode(DS, $file->getRealpath());
            $relativeFolderArray = explode(DS, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DS . $zoneName . DS . str_replace(DS . $folder_name, '', $file->getRelativePath());

            $absoluteFolderArray = explode(DS, $file->getRealpath());

            /*
            echo '<br /><pre>$absoluteFolderArray: ';
            echo print_r($absoluteFolderArray);
            echo '</pre><br />';
            //exit;
            //*/

            //$zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];

            // Is this plugin already installed?
            $this->axis->sql->dbSelect('plugins',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $zoneAllPlugins = $this->axis->sql->dbFetch();

            if (!$zoneAllPlugins) {
                //*
                echo '<br />Display this plugin<br />';
                //exit;
                //*/

                //*
                echo '<br />$zoneName is: ' . $zoneName . '<br />';
                //exit;
                //*/

                //*
                echo '<br />$folder_name is: ' . $folder_name . '<br />';
                //exit;
                //*/

                //*
                echo '<br />$folder_path is: ' . $folder_path . '<br />';
                //exit;
                //*/

                //*
                echo '<br />$file->getRealpath() is: ' . $file->getRealpath() . '<br />';
                //exit;
                //*/

                /*
                 echo '<br />$file->getRelativePath() is: ' . $file->getRelativePath() . '<br />';
                //exit;
                //*/

                /*
                 echo '<br />$file->getRelativePathname() is: ' . $file->getRelativePathname() . '<br />';
                //exit;
                //*/
            }
        }

        /*
        echo '<br /><pre>$zoneAllfinder: ';
        echo var_dump($zoneAllfinder);
        echo '</pre><br />';
        //exit;
        //*/



        $content->set('greeting', 'Install Local Plugins!');

        return $content;
    }

    /*
    public function installRemotePlugins()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_remote_plugins.tpl.php');
        $content->set('greeting', 'Install Remote Plugins!');

        return $content;
    }
    //*/

    public function adminNavigation()
    {
        $adminNav = [
            'Plugin Manager' => [
                'Current Plugins' => '/plugin-manager',
                'Install Plugins' => '/plugin-manager/install-local-plugins',
                //'Install Remote Plugins' => '/plugin-manager/install-remote-plugins',
            ],
        ];

        return $adminNav;
    }
}
