<?php
namespace Acms\Core\Templates;

use Acms\Core\Templates\Template;
use Acms\Core\Data\Db;

class Blocks
{
    public function getBlocks($axis, $block_routes)
    {
        if (isset($block_routes)) {

            $axis->sql->dbSelect('blocks', '*', 'active = :active', ['active' => intval(2)], 'ORDER BY block_order');
            $result = $axis->sql->dbFetch();

            foreach ($result as $key => $value) {
                foreach ($block_routes as $block_route) {

                    if ($value['name'] === $block_route['name']) {
                        $namespaced_controller = $block_route['namespace']. '\\' . $block_route['controller'];
                        $block_controller = new $namespaced_controller;
                        $block_action = $block_route['action'];
                        $blocks[][$value['block_area']] = $block_controller->$block_action();
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