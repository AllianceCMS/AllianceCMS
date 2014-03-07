<?php
namespace ModuleManager;

use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Components\Installer;
use Acms\Core\Data\Assets;
use Acms\Core\Data\Db;
use Acms\Core\Templates\Template;
use Symfony\Component\Finder\Finder;

class AdminPages extends AbstractAdmin
{
    public function currentModules()
    {
        $sql = new Db();
        $assets = new Assets();

        $this->addCustomHeader($this->htmlHelper->styleSheetLink($assets->getAssetPath($this->moduleName, 'css', 'style.css')));

        // List modules installed for all zones/domains
        $sql->dbSelect('modules',
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

        $zoneAllModules = $sql->dbFetch();

        // List modules installed for this specific zone/domain
        $sql->dbSelect('modules',
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

        $zoneSpecificModules = $sql->dbFetch();

        // List currently installed Axis modules
        $sql->dbSelect('modules',
            'id, name, version, description, developer, developer_email, developer_site, created',
            'active = :active AND folder_path = :folder_path',
            [
            'active' => intval(2),
            'folder_path' => 'axis/modules/',
            ],
            'ORDER BY weight');

        $axisModules = $sql->dbFetch();

        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/admin.current_modules.tpl.php');

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
        $sql = new Db();
        $assets = new Assets();

        $this->addCustomHeader($this->htmlHelper->styleSheetLink($assets->getAssetPath($this->moduleName, 'css', 'style.css')));

        $zoneAllfinder = new \Symfony\Component\Finder\Finder();
        $zoneAllfinder->ignoreUnreadableDirs()->files()->name('install.php')->in(ZONES . 'all');

        $currentZonePath = str_replace(DIRECTORY_SEPARATOR . 'dbConnection.php', '', DBCONNFILE);
        $zoneCurrentfinder = new \Symfony\Component\Finder\Finder();
        $zoneCurrentfinder->ignoreUnreadableDirs()->files()->name('install.php')->in($currentZonePath . DIRECTORY_SEPARATOR . 'modules');

        foreach ($zoneAllfinder as $file) {

            $absoluteFolderArray = explode(DIRECTORY_SEPARATOR, $file->getRealpath());
            $relativeFolderArray = explode(DIRECTORY_SEPARATOR, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DIRECTORY_SEPARATOR . $zoneName . DIRECTORY_SEPARATOR . str_replace(DIRECTORY_SEPARATOR . $folder_name, '', $file->getRelativePath()) . DIRECTORY_SEPARATOR;

            // Is this module already installed?
            $sql->dbSelect('modules',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneAllModules = $sql->dbFetch();

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

            $absoluteFolderArray = explode(DIRECTORY_SEPARATOR, $file->getRealpath());
            $relativeFolderArray = explode(DIRECTORY_SEPARATOR, $file->getRelativePath());

            $zoneName = $absoluteFolderArray[count($absoluteFolderArray) - 5];
            $folder_name = $relativeFolderArray[count($relativeFolderArray) -1];
            $folder_path = 'zones' . DIRECTORY_SEPARATOR . $zoneName . DIRECTORY_SEPARATOR . str_replace(DIRECTORY_SEPARATOR . $folder_name, '', $file->getRelativePath()) . DIRECTORY_SEPARATOR;

            $absoluteFolderArray = explode(DIRECTORY_SEPARATOR, $file->getRealpath());

            // Is this module already installed?
            $sql->dbSelect('modules',
                'name, version, description, developer, developer_email, developer_site, created',
                'active = :active
                AND folder_name = :folder_name',
                [
                    'active' => intval(2),
                    'folder_name' => $folder_name,
                ]
            );

            $installedZoneSpecificModules = $sql->dbFetch();

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

        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/admin.install_local_modules.tpl.php');

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
        $sql = new Db();
        $installer = new Installer();

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

        $result_module = $sql->dbInsert('modules', $tableColumns);

        if ($result_module) {
            $lastInsertId = $sql->dbLastInsertId();

            $modulePath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DIRECTORY_SEPARATOR;

            include $modulePath . 'install.php';

            // Add entries to links database table
            foreach ($details['links'] as $label => $url) {
                $tableColumns = [
                    'module_id' => $lastInsertId,
                    'label' => $label,
                    'url' => $url,
                    'active' => 2,
                    'created' => date("Y-m-d H:i:s", time()),
                ];

                $result_links = $sql->dbInsert('links', $tableColumns);
            }
        }

        // Create module tables and insert data

        include $modulePath . 'schema.php';

        foreach ($schema as $version) {
            // Create Tables
            if (isset($version['create']['table'])){
                foreach ($version['create']['table'] as $tableName => $index) {
                    $sql->dbCreateTable($tableName, $index);
                }
            }

            // Insert Data Into Database
            if (isset($version['insert']['table'])) {
                foreach ($version['insert']['table'] as $loopTables) {

                    foreach ($loopTables as $tableName => $loopFields) {
                        foreach ($loopFields as $columns) {
                            $result = $sql->dbInsert($tableName, $columns);
                        }
                    }
                }
            }

            // Alter Database Tables
            if (isset($version['alter']['table'])) {
                foreach ($version['alter']['table'] as $loopTables) {
                    foreach ($loopTables as $tableName => $statement) {
                        $sql->dbAlterTable($tableName, $statement);
                    }
                }
            }
        }

        // Move assets to public_html

        $installer->mirrorAssets($_POST['folder_path'], $_POST['folder_name']);

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

        $sql->dbInsert('schemas', $schemaColumns);

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
        $sql = new Db();
        $installer = new Installer();

        // Remove module from Modules Database Table
        $resultDeleteModules = $sql->dbDelete(
            'modules',
            'id = :id',
            [
	           'id' => $_POST['id'],
            ]
        );

        // Remove module links from Links Database Table
        $resultDeleteLinks = $sql->dbDelete(
            'links',
            'module_id = :module_id',
            [
            'module_id' => $_POST['id'],
            ]
        );

        // Drop Module Tables

        $modulePath = BASE_DIR . $_POST['folder_path'] . $_POST['folder_name'] . DIRECTORY_SEPARATOR;

        include $modulePath . 'schema.php';

        foreach ($schema as $version) {
            if (isset($version['create']['table'])){
                foreach ($version['create']['table'] as $tableName => $index) {
                    $resultDeleteModuleTables[] = $sql->dbDropTable($tableName);
                }
            }
        }

        // Remove assets from public_html
        $installer->removeAssets($_POST['folder_path'], $_POST['folder_name']);

        // Remove database schema info from Schemas database table

        $resultDeleteSchema = $sql->dbDelete(
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

        /*
        if (isset($resultDeleteModuleTables)) {
            if (count($resultDeleteModuleTables) > 1) {
                $queryString .= '/result_delete_module_tables';
            }
        }
        //*/

        if (!$resultDeleteSchema) {
            $queryString .= '/result_delete_schema';
        }

        header('Location: ' . $this->basePath . '/admin/module-manager/current-modules/uninstall-attempted' . $queryString);
        exit;
    }

    /*
    public function installRemoteModules()
    {
        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/admin.install_remote_modules.tpl.php');
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
