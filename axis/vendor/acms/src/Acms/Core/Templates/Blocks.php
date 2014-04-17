<?php
namespace Acms\Core\Templates;

use Acms\Core\ModuleLoader\AbstractModule;
use Acms\Core\Templates\Template;
use Acms\Core\Data\Db;

class Blocks extends AbstractModule
{
    public function getBlocks($block_routes)
    {
        $sql = new Db();

        if (isset($block_routes)) {

            $sql->dbSelect('blocks', '*', 'active = :active', ['active' => intval(2)], 'ORDER BY block_order');
            $result = $sql->dbFetch();

            foreach ($result as $key => $value) {
                foreach ($block_routes as $block_route) {

                    if ($value['name'] === $block_route['name']) {
                        $namespaced_controller = $block_route['namespace']. '\\' . $block_route['controller'];
                        $block_controller = new $namespaced_controller($this->axis);
                        $block_action = $block_route['action'];

                        if ($block_controller->$block_action() !== false) {
                            $blocks[][$value['block_area']] = $block_controller->$block_action();
                        }
                    }
                }
            }
        }

        if (isset($blocks)) {
            return $blocks;
        }

        return false;
    }
}