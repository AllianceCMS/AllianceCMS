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
            'Statistics' => '#',
            'Plugin Manager' => '#',
            'Theme Manager' => '#',
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

    public function getNavbar($adminTheme)
    {

        // Get currently loaded URL. Used to determine which link gets the 'active' css class
        $currentlyLoadedUrl =  BASE_URL . $this->axis->axisRoute->matches[0];

        $adminNavCategories = $this->adminNavCategories();
        $adminNavDataArray = $this->getNavData();

        // Build Admin Navbar Links
        if((!empty($adminNavCategories)) && (!empty($adminNavDataArray))) {

            // Add Parent Category Links
            foreach ($adminNavDataArray as $pluginName => $linkStack) {

                foreach ($linkStack as $pluginNavCategory => $linkData) {
                    if ($pluginNavCategory === 'Parent') {

                        foreach ($linkData as $categoryLabel => $categoryLink) {
                            if (!array_key_exists($categoryLabel, $adminNavCategories)) {
                                $adminNavCategories[$categoryLabel] = $categoryLink;
                            }
                        }
                    }
                }

                unset($adminNavDataArray[$pluginName]['Parent']);
            }

            foreach ($adminNavCategories as $categoryLabel => $categoryLink) {

                if ('#' !== $categoryLink[0]) {
                    $categoryLink = $this->axis->basePath . '/admin' . $categoryLink;
                }

                $buildNavigation[$categoryLabel]['catLink'] = $categoryLink;
                
                foreach ($adminNavDataArray as $categoryData) {

                    if (!empty($categoryData[$categoryLabel])) {

                        $linkCount = 0;
                        foreach ($categoryData[$categoryLabel] as $tempLabel => $tempLink) {

                            if ('#' !== $tempLink[0]) {
                                $tempLink = $this->axis->basePath . '/admin' . $tempLink;
                            }
                            
                            if ($currentlyLoadedUrl === $tempLink)
                                $categoryData[$categoryLabel]['activeLink'] = $tempLink;

                            $categoryData[$categoryLabel][$tempLabel] = $tempLink;
                            ++$linkCount;
                        }

                        $buildNavigation[$categoryLabel] = array_merge($buildNavigation[$categoryLabel], $categoryData[$categoryLabel]);
                        $buildNavigation[$categoryLabel]['count'] = $linkCount;

                    }
                }
                
                if ($currentlyLoadedUrl === $categoryLink)
                    $buildNavigation[$categoryLabel]['activeCategoryLink'] = $categoryLink;
            }

            $buildNav = new Template(THEMES . $adminTheme . DS . 'admin.nav.tpl.php');

            $buildNav->set('adminNavLinks', $buildNavigation);
        }

        return $buildNav;
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
