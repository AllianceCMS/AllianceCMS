<?php
namespace ModuleManager;

//use \Admin\AbstractAdmin;
use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Templates\Template;
use Symfony\Component\Finder\Finder;

class AdminPages extends AbstractAdmin
{
    public function currentModules()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/ModuleManager/project/ModuleManager/0.01/files/css/style.css'));

        // List modules installed for all zones/domains
        $this->sql->dbSelect('modules',
            'id, name, version, description, developer, developer_site, developer_email, folder_path, folder_name, created',
            'active = :active
            AND folder_path = :folder_path1
            OR folder_path = :folder_path2',
            [
                'active' => intval(2),
                'folder_path1' => 'zones/all/modules/provider/',
                'folder_path2' => 'zones/all/modules/custom/',
            ],
            'ORDER BY weight');

        $zoneAllModules = $this->sql->dbFetch();

        // List modules installed for this specific zone/domain
        $this->sql->dbSelect('modules',
            'id, name, version, description, developer, developer_email, developer_site, created',
            'active = :active
            AND folder_path != :folder_path1
            AND folder_path != :folder_path2
            AND folder_path != :folder_path3',
            [
                'active' => intval(2),
                'folder_path1' => 'zones/all/modules/provider/',
                'folder_path2' => 'zones/all/modules/custom/',
                'folder_path3' => 'axis/modules/',
            ],
            'ORDER BY weight');

        $zoneSpecificModules = $this->sql->dbFetch();

        // List currently installed Axis modules
        $this->sql->dbSelect('modules',
            'id, name, version, description, developer, developer_email, developer_site, created',
            'active = :active AND folder_path = :folder_path',
            [
            'active' => intval(2),
            'folder_path' => 'axis/modules/',
            ],
            'ORDER BY weight');

        $axisModules = $this->sql->dbFetch();

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.current_modules.tpl.php');

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

        $content->set('zoneAllModules', $zoneAllModules);
        $content->set('zoneSpecificModules', $zoneSpecificModules);
        $content->set('axisModules', $axisModules);
        $content->set('formHelper', $this->formHelper);

        return $content;
    }

    public function installLocalModules()
    {
        $this->addCustomHeader($this->htmlHelper->styleSheetLink('http://www.alliancecms.com/ModuleManager/project/ModuleManager/0.01/files/css/style.css'));

        $zoneAllfinder = new \Symfony\Component\Finder\Finder();
        $zoneAllfinder->ignoreUnreadableDirs()->files()->name('details.php')->in(ZONES . 'all');

        $currentZonePath = str_replace(DS . 'dbConnection.php', '', DBCONNFILE);
        $zoneCurrentfinder = new \Symfony\Component\Finder\Finder();
        $zoneCurrentfinder->ignoreUnreadableDirs()->files()->name('details.php')->in($currentZonePath . DS . 'modules');

        foreach ($zoneAllfinder as $file) {

            $absoluteFolderArray = explode(DS, $file->getRealpath());
            $relativeFolderArray = explode(DS, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DS . $zoneName . DS . str_replace(DS . $folder_name, '', $file->getRelativePath()) . DS;

            // Is this module already installed?
            $this->sql->dbSelect('modules',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneAllModules = $this->sql->dbFetch();

            if (!$installedZoneAllModules) {

                include $file->getRealpath();

                $zoneAllModules = [
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

            // Is this module already installed?
            $this->sql->dbSelect('modules',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneSpecificModules = $this->sql->dbFetch();

            if (!$installedZoneSpecificModules) {

                include $file->getRealpath();

                $zoneSpecificModules = [
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

        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_local_modules.tpl.php');

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

        if (!isset($zoneAllModules))
            $zoneAllModules = '';

        if (!isset($zoneSpecificModules))
            $zoneSpecificModules = '';

        $content->set('zoneAllModules', $zoneAllModules);
        $content->set('zoneSpecificModules', $zoneSpecificModules);
        $content->set('formHelper', $this->formHelper);

        return $content;
    }

    public function installModule()
    {
        // Add entry to modules database table
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

        $result_module = $this->sql->dbInsert('modules', $tableColumns);

        if ($result_module) {
            $lastInsertId = $this->sql->dbLastInsertId();

            $modulePath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DS;

            include $modulePath . 'details.php';

            // Add entries to links database table
            foreach ($details['links'] as $label => $url) {
                $tableColumns = [
                    'module_id' => $lastInsertId,
                    'label' => $label,
                    'url' => $url,
                    'active' => 2,
                    'created' => date("Y-m-d H:i:s", time()),
                ];

                $result_links = $this->sql->dbInsert('links', $tableColumns);
            }
        }

        // Create module tables and insert data

        include $modulePath . 'schema.php';

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

        if (!$result_module) {
            $queryString .= '/result_module';
        }

        if (!$result_links) {
            $queryString .= '/result_links';
        }

        header('Location: ' . $this->basePath . '/admin/module-manager/install-local-modules/installation-attempted' . $queryString);
        exit;
    }

    public function uninstallModule()
    {
        // Remove module from Modules Database Table
        $resultDeleteModules = $this->sql->dbDelete(
            'modules',
            'id = :id',
            [
	           'id' => $_POST['id'],
            ]
        );

        // Remove module links from Links Database Table
        $resultDeleteLinks = $this->sql->dbDelete(
            'links',
            'module_id = :module_id',
            [
            'module_id' => $_POST['id'],
            ]
        );

        // Drop Module Tables

        $modulePath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DS;

        include $modulePath . 'schema.php';

        foreach ($schema as $version) {
            if (isset($version['create']['table'])){
                foreach ($version['create']['table'] as $tableName => $index) {
                    $resultDeleteModuleTables[] = $this->sql->dbDropTable($tableName);
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

        if (!$resultDeleteModules) {
            $queryString .= '/result_delete_modules';
        }

        if (!$resultDeleteLinks) {
            $queryString .= '/result_delete_links';
        }

        if (isset($resultDeleteModuleTables)) {
            if (count($resultDeleteModuleTables) > 1) {
                $queryString .= '/result_delete_module_tables';
            }
        }

        if (!$resultDeleteSchema) {
            $queryString .= '/result_delete_schema';
        }

        header('Location: ' . $this->basePath . '/admin/module-manager/current-modules/uninstall-attempted' . $queryString);
        exit;
    }

    /*
    public function installRemoteModules()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.install_remote_modules.tpl.php');
        $content->set('greeting', 'Install Remote Modules!');

        return $content;
    }
    //*/

    public function adminNavigation()
    {
        $adminNav = [
            'Module Manager' => [
                'Current Modules' => '/module-manager/current-modules',
                'Install Modules' => '/module-manager/install-local-modules',
                //'Install Remote Modules' => '/module-manager/install-remote-modules',
            ],
        ];

        return $adminNav;
    }
}
