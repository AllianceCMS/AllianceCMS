<?php
namespace Home;

use Acms\Core\Templates\Template;

class HomeBlocks{

    public function welcomeToAcms()
    {
        $block_content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/welcome.tpl.php');

        $block['title'] = 'Welcome To AllianceCMS!!!';
        $block['content'] = $block_content;

        return $block;
    }

    public function contactUs()
    {
        $block_content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/contact_us.tpl.php');

        $block['title'] = 'Contact Us';
        $block['content'] = $block_content;

        return $block;
    }
}