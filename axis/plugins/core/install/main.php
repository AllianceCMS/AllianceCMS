<?php
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;

$pluginRoutes['Install']['Start Installation']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Start Installation']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Start Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Start Installation']['specs']['values'] = array('controller' => 'install_start'); // Required: Callback function

function install_start($values)
{
    // Installation Welcome Screen
    $formHelper = new FormHelper();

    $tpl = new Template();
    $tpl->set("title", "AllianceCMS: Installation");
    $tpl->set("author", "jburns131");
    $tpl->set("styleSheet", BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . "views" . DS . "welcome.tpl.php");
    $body->set("images", BASE_URL . 'themes/core/emplode/images');
    $body->set("formHelper", $formHelper);

    $menu[0] = new Template(dirname(__FILE__) . DS . "views" . DS . "menu.tpl.php");
    $menu[0]->set("installStage", "0");
    $menu[0]->set("images", BASE_URL . 'themes/core/emplode/images');

    $tpl->set("body", $body);
    $tpl->set("menu", $menu);

    // echo $tpl->fetch(THEMES . DS . 'core' . DS . 'emplode' . DS . '/theme.tpl.php');

    echo $tpl->fetch(dirname(__FILE__) . DS . "views" . DS . "index.tpl.php");
    // $body = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');
    // $body->set('name', $values['name'][0]);

    return $body;
}
