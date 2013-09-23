<?php
namespace PluginManager;

//use \Admin\AbstractAdmin;
use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Templates\Template;
use Symfony\Component\Finder\Finder;

class AdminPages extends AbstractAdmin
{
    public function currentPlugins()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/PluginManager/project/PluginManager/0.01/files/css/style.css'));

        // List plugins installed for all zones/domains
        $this->sql->dbSelect('plugins',
            'id, name, version, description, developer, developer_site, developer_email, folder_path, folder_name, created',
            'active = :active
            AND folder_path = :folder_path1
            OR folder_path = :folder_path2',
            [
                'active' => intval(2),
                'folder_path1' => 'zones/all/plugins/provider/',
                'folder_path2' => 'zones/all/plugins/custom/',
            ],
            'ORDER BY weight');

        $zoneAllPlugins = $this->sql->dbFetch();

        // List plugins installed for this specific zone/domain
        $this->sql->dbSelect('plugins',
            'id, name, version, description, developer, developer_email, developer_site, created',
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

        $zoneSpecificPlugins = $this->sql->dbFetch();

        // List currently installed Axis plugins
        $this->sql->dbSelect('plugins',
            'id, name, version, description, developer, developer_email, developer_site, created',
            'active = :active AND folder_path = :folder_path',
            [
            'active' => intval(2),
            'folder_path' => 'axis/plugins/',
            ],
            'ORDER BY weight');

        $axisPlugins = $this->sql->dbFetch();

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.current_plugins.tpl.php');

        if (1 === ((int) count($this->axisRoute->values['query_string']))) {
            $content->set('uninstallationSuccessful', true);
        } else {
            if (isset($this->axisRoute->values['query_string'][1])) {
                $content->set($this->axisRoute->values['query_string'][1], true);
            }

            if (isset($this->axisRoute->values['query_string'][2])) {
                $content->set($this->axisRoute->values['query_string'][2], true);
            }
            if (isset($this->axisRoute->values['query_string'][3])) {
                $content->set($this->axisRoute->values['query_string'][3], true);
            }

            if (isset($this->axisRoute->values['query_string'][4])) {
                $content->set($this->axisRoute->values['query_string'][4], true);
            }
        }

        $content->set('zoneAllPlugins', $zoneAllPlugins);
        $content->set('zoneSpecificPlugins', $zoneSpecificPlugins);
        $content->set('axisPlugins', $axisPlugins);
        $content->set('formHelper', $this->formHelper);

        return $content;
    }

    public function installLocalPlugins()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/PluginManager/project/PluginManager/0.01/files/css/style.css'));

        $zoneAllfinder = new \Symfony\Component\Finder\Finder();
        $zoneAllfinder->ignoreUnreadableDirs()->files()->name('details.php')->in(ZONES . 'all');

        $currentZonePath = str_replace(DS . 'dbConnection.php', '', DBCONNFILE);
        $zoneCurrentfinder = new \Symfony\Component\Finder\Finder();
        $zoneCurrentfinder->ignoreUnreadableDirs()->files()->name('details.php')->in($currentZonePath . DS . 'plugins');

        foreach ($zoneAllfinder as $file) {

            $absoluteFolderArray = explode(DS, $file->getRealpath());
            $relativeFolderArray = explode(DS, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DS . $zoneName . DS . str_replace(DS . $folder_name, '', $file->getRelativePath()) . DS;

            // Is this plugin already installed?
            $this->sql->dbSelect('plugins',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneAllPlugins = $this->sql->dbFetch();

            if (!$installedZoneAllPlugins) {

                include $file->getRealpath();

                $zoneAllPlugins = [
                    [
                        'name' => $details['name'],
                        'version' => $details['version'],
                        'description' => urlencode($details['description']),
                        'developer' => $details['developer'],
                        'developer_site' => $details['developer_site'],
                        'developer_email' => $details['developer_email'],
                        'folder_path' => $folder_path,
                        'folder_name' => $folder_name,
                    ],
                ];
            }
        }

        foreach ($zoneCurrentfinder as $file) {

            $absoluteFolderArray = explode(DS, $file->getRealpath());
            $relativeFolderArray = explode(DS, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DS . $zoneName . DS . str_replace(DS . $folder_name, '', $file->getRelativePath()) . DS;

            $absoluteFolderArray = explode(DS, $file->getRealpath());

            // Is this plugin already installed?
            $this->sql->dbSelect('plugins',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneSpecificPlugins = $this->sql->dbFetch();

            if (!$installedZoneSpecificPlugins) {

                include $file->getRealpath();

                $zoneSpecificPlugins = [
                    [
                        'name' => $details['name'],
                        'version' => $details['version'],
                        'description' => urlencode($details['description']),
                        'developer' => $details['developer'],
                        'developer_site' => $details['developer_site'],
                        'developer_email' => $details['developer_email'],
                        'folder_path' => $folder_path,
                        'folder_name' => $folder_name,
                    ],
                ];
            }
        }

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_local_plugins.tpl.php');

        if (1 === ((int) count($this->axisRoute->values['query_string']))) {
            $content->set('installationSuccessful', true);
        } else {
            if (isset($this->axisRoute->values['query_string'][1])) {
                $content->set($this->axisRoute->values['query_string'][1], true);
            }

            if (isset($this->axisRoute->values['query_string'][2])) {
                $content->set($this->axisRoute->values['query_string'][2], true);
            }
        }

        if (!isset($zoneAllPlugins))
            $zoneAllPlugins = '';

        if (!isset($zoneSpecificPlugins))
            $zoneSpecificPlugins = '';

        $content->set('zoneAllPlugins', $zoneAllPlugins);
        $content->set('zoneSpecificPlugins', $zoneSpecificPlugins);
        $content->set('formHelper', $this->formHelper);

        return $content;
    }

    public function installPlugin()
    {
        // Add entry to plugins database table
        $tableColumns = [
            'name' => $_POST['name'],
            'version' => $_POST['version'],
            'description' => urldecode($_POST['description']),
            'developer' => $_POST['developer'],
            'developer_site' => $_POST['developer_site'],
            'developer_email' => $_POST['developer_email'],
            'folder_path' => str_replace('\\', '/', $_POST['folder_path']),
            'folder_name' => $_POST['folder_name'],
            'active' => 2,
            'created' => date("Y-m-d H:i:s", time()),
        ];

        $result_plugin = $this->sql->dbInsert('plugins', $tableColumns);

        if ($result_plugin) {
            $lastInsertId = $this->sql->dbLastInsertId();

            $pluginPath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DS;

            include $pluginPath . 'details.php';

            // Add entries to links database table
            foreach ($details['links'] as $label => $url) {
                $tableColumns = [
                    'plugin_id' => $lastInsertId,
                    'label' => $label,
                    'url' => $url,
                    'active' => 2,
                    'created' => date("Y-m-d H:i:s", time()),
                ];

                $result_links = $this->sql->dbInsert('links', $tableColumns);
            }
        }

        // Create plugin tables and insert data

        include $pluginPath . 'schema.php';

        foreach ($schema as $version) {
            // Create Tables
            if (isset($version['create']['table'])){
                foreach ($version['create']['table'] as $tableName => $index) {
                    $this->sql->dbCreateTable($tableName, $index);
                }
            }

            // Insert Data Into Database
            if (isset($version['insert']['table'])) {
                foreach ($version['insert']['table'] as $loopTables) {

                    foreach ($loopTables as $tableName => $loopFields) {
                        foreach ($loopFields as $columns) {
                            $result = $this->sql->dbInsert($tableName, $columns);
                        }
                    }
                }
            }

            // Alter Database Tables
            if (isset($version['alter']['table'])) {
                foreach ($version['alter']['table'] as $loopTables) {
                    foreach ($loopTables as $tableName => $statement) {
                        $this->sql->dbAlterTable($tableName, $statement);
                    }
                }
            }
        }

        // Enter schema version to schemas database table

        // Get the most recent schema version for this database install
        end($schema); // move the internal pointer to the end of the array
        $schemaVersion = key($schema); // fetches the key of the element pointed to by the internal pointer
        reset($schema);

        $schemaColumns = [
            'system_name' => $_POST['name'],
            'schema_version' => $schemaVersion,
            'created' => date("Y-m-d H:i:s", time()),
            'modified' => date("Y-m-d H:i:s", time()),
        ];

        $this->sql->dbInsert('schemas', $schemaColumns);

        $queryString = '';

        if (!$result_plugin) {
            $queryString .= '/result_plugin';
        }

        if (!$result_links) {
            $queryString .= '/result_links';
        }

        header('Location: ' . $this->basePath . '/admin/plugin-manager/install-local-plugins/installation-attempted' . $queryString);
        exit;
    }

    public function uninstallPlugin()
    {
        // Remove plugin from Plugins Database Table
        $resultDeletePlugins = $this->sql->dbDelete(
            'plugins',
            'id = :id',
            [
	           'id' => $_POST['id'],
            ]
        );

        // Remove plugin links from Links Database Table
        $resultDeleteLinks = $this->sql->dbDelete(
            'links',
            'plugin_id = :plugin_id',
            [
            'plugin_id' => $_POST['id'],
            ]
        );

        // Drop Plugin Tables

        $pluginPath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DS;

        include $pluginPath . 'schema.php';

        foreach ($schema as $version) {
            if (isset($version['create']['table'])){
                foreach ($version['create']['table'] as $tableName => $index) {
                    $resultDeletePluginTables[] = $this->sql->dbDropTable($tableName);
                }
            }
        }

        // Remove database schema info from Schemas database table

        $resultDeleteSchema = $this->sql->dbDelete(
            'schemas',
            'system_name = :system_name',
            [
            'system_name' => $_POST['folder_name'],
            ]
        );

        $queryString = '';

        if (!$resultDeletePlugins) {
            $queryString .= '/result_delete_plugins';
        }

        if (!$resultDeleteLinks) {
            $queryString .= '/result_delete_links';
        }

        if (isset($resultDeletePluginTables)) {
            if (count($resultDeletePluginTables) > 1) {
                $queryString .= '/result_delete_plugin_tables';
            }
        }

        if (!$resultDeleteSchema) {
            $queryString .= '/result_delete_schema';
        }

        header('Location: ' . $this->basePath . '/admin/plugin-manager/current-plugins/uninstall-attempted' . $queryString);
        exit;
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
                'Current Plugins' => '/plugin-manager/current-plugins',
                'Install Plugins' => '/plugin-manager/install-local-plugins',
                //'Install Remote Plugins' => '/plugin-manager/install-remote-plugins',
            ],
        ];

        return $adminNav;
    }
}
