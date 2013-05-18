<?php

    class Menus
    {
        private $_menuController;
        private $_menuView;
        private $_menus;
        
        public function __construct($menu_area, $active = "2", $order_by = "menu_order") {
            
            $menuSql = new Db;
            $menuSql->dbSelect("menus", "link", "menu_area = ".intval($menu_area)." AND active = ".intval($active)." ORDER BY ".$order_by);
            $menuArray = $menuSql->dbFetch();
            
            $count = 0;
            while (!$menuArray->EOF) {
                
                $this->setMenuFiles($menuArray->fields['link']);
                
                $menu[$count] = new Template($this->getMenuView());
                require_once($this->getMenuController());
                
                $count++;
                $menuArray->MoveNext();
            }
            
            if (isset($menu)) {
                $this->setMenus($menu);
            } else {
                $this->setMenus("");
            }
        }
        
        public function setMenuFiles($link) {
            $viewFileName = substr_replace($link, ".tpl.php", -4);
            
            $this->_menuController = BASEDIR.$link;
            $this->_menuView = BASEDIR.$viewFileName;
        }
        
        public function getMenuController() {
            return $this->_menuController;
        }
        
        public function getMenuView() {
            return $this->_menuView;
        }
        
        public function setMenus($menus) {
            $this->_menus = $menus;
        }
        
        public function getMenus() {
            return $this->_menus;
        }
    }
?>