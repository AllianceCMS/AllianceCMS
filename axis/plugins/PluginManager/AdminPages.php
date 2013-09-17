<?php
namespace PluginManager;

use \Admin\AbstractAdmin;
use Acms\Core\Templates\Template;

class AdminPages extends AbstractAdmin
{
    public function currentPlugins()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/PluginManager/project/PluginManager/0.01/files/css/style.css'));

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.current_plugins.tpl.php');

        $this->axis->sql->dbSelect('plugins',
            'name, version, description, developer, developer_email, developer_site, created',
            'active = :active',
            ['active' => intval(2)],
            'ORDER BY weight');

        $plugins = $this->axis->sql->dbFetch();

        $content->set('plugins', $plugins);

        return $content;
    }

    public function installLocalPlugins()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_local_plugins.tpl.php');
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
