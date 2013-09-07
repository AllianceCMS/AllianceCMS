<?php
namespace Admin;

use Acms\Core\Data\Db;
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;

abstract class AbstractAdmin
{
    private $axis;
    private $formHelper;
    private $htmlHelper;

    public function __construct($axis)
    {
        $this->axis = $axis;
        $this->formHelper = new FormHelper($this->axis->basePath);
        $this->htmlHelper = new HtmlHelper($this->axis->basePath);
    }

    public function getThisObject()
    {
        $reflection = new \ReflectionClass($this);
        $tempController = '\\' . $reflection->getNamespaceName() . '\\' . 'AdminPages';
        $tempObject = new $tempController;

        return $tempObject;
    }

    public function adminNavCategories()
    {
        $adminNavCategories = [
            'Dashboard' => '/dashboard',
            'Venues' => '#',
            'Users' => '#',
            'Content' => '#',
            'Plugin Manager' => '#',
            'Theme Manager' => '#',
            'Statistics' => '#',
            'Other' => '#',
        ];

        return $adminNavCategories;
    }

    public function getNavData()
    {
        $this->axis->sql->dbSelect('plugins', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)], 'ORDER BY weight');
        $result = $this->axis->sql->dbFetch();

        foreach ($result as $plugin) {

            if (file_exists(BASE_DIR . $plugin['folder_path'] . $plugin['folder_name'] . DS . 'AdminPages.php')) {

                $tempController = '\\' . $plugin['folder_name'] . '\\' . 'AdminPages';

                $tempObject = new $tempController;

                if (method_exists($tempObject, 'adminNavigation')) {
                    $navLinks[$plugin['folder_name']] = $tempObject->adminNavigation($this->axis);
                }
            }
        }

        return $navLinks;
    }

    public function compilePage($tabLabels, $tabContent)
    {
        if (count($tabLabels) !== count($tabContent)) {
            echo "You need to have the same amount of labels as content";
            exit;
        }

        $tabData = new Template(THEMES . 'Delta' . DS . 'admin.tabs.tpl.php');
        $tabData->set('tabLabels', $tabLabels);
        $tabData->set('tabContent', $tabContent);

        return $tabData;
    }

    public function getTemplateVars()
    {
        return true;
    }

    public function getTemplateBlocks()
    {
        return true;
    }
}
