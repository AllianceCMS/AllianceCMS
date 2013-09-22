<?php
namespace Acms\Core\Components;

use Acms\Core\Components\AbstractPlugin;
use Acms\Core\Templates\Template;

abstract class AbstractAdmin extends AbstractPlugin
{
    public function adminNavCategories()
    {
        $adminNavCategories = [
            'Dashboard' => '#',
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
        $this->sql->dbSelect('plugins', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)], 'ORDER BY weight');
        $result = $this->sql->dbFetch();

        foreach ($result as $plugin) {

            if (file_exists(BASE_DIR . $plugin['folder_path'] . $plugin['folder_name'] . DS . 'AdminPages.php')) {

                $tempController = '\\' . $plugin['folder_name'] . '\\' . 'AdminPages';

                $tempObject = new $tempController($this->axis);

                if (method_exists($tempObject, 'adminNavigation')) {
                    $navLinks[$plugin['folder_name']] = $tempObject->adminNavigation();
                }
            }
        }

        return $navLinks;
    }

    public function getNavbar($adminTheme)
    {

        // Get currently loaded URL. Used to determine which link gets the 'active' css class
        $currentlyLoadedUrl =  BASE_URL . $this->axisRoute->matches[0];

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
                    $categoryLink = $this->basePath . '/admin' . $categoryLink;
                }

                $buildNavigation[$categoryLabel]['catLink'] = $categoryLink;

                foreach ($adminNavDataArray as $categoryData) {

                    if (!empty($categoryData[$categoryLabel])) {

                        $linkCount = 0;
                        foreach ($categoryData[$categoryLabel] as $tempLabel => $tempLink) {

                            if ('#' !== $tempLink[0]) {
                                $tempLink = $this->basePath . '/admin' . $tempLink;
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

            $buildNav = new Template(THEMES . $adminTheme . DS . 'admin.nav2.tpl.php');

            $buildNav->set('adminNavLinks', $buildNavigation);
        }

        return $buildNav;
    }

    public function compileTabs($tabLabels, $tabContent, $active = 1)
    {
        if (count($tabLabels) !== count($tabContent)) {
            echo "You need to have the same amount of labels as content";
            exit;
        }

        $tabData = new Template(TEMPLATES . 'admin.tabs.tpl.php');
        $tabData->set('active', $active);
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
