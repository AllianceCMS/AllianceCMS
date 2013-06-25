<?php
class CustomView extends \Slim\View
{
    public function render($template)
    {
        $template === 'show.php'
        $this->data['title'] === 'Sahara'
    }
}