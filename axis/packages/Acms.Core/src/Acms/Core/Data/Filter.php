<?php
namespace Acms\Core\Data;

class Filter
{
    public function alterRegex($alterFields)
    {
        foreach ($alterFields as $field) {

            if (isset($_POST[$field[0]])) {
                $_POST[$field[0]] = preg_replace($field[1], $field[2], $_POST[$field[0]] );
            }
        }
        return true;
    }
}