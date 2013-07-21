<?php


namespace Acms\Core\Html;

class HtmlHelper
{

    public function htmlLink($address, $caption="", $target="") {

        $completeTag = "<a href=\"{$address}\"";

        if (!empty($target)) {
            $completeTag .=" target=\"{$target}\"";
        }

        $completeTag .= ">";

        if (!empty($caption)) {
            $completeTag .= $caption;
        } else {
            $completeTag .= $address;
        }

        $completeTag .= "</a>";

        echo $completeTag;

    }

    public function htmlMailTo($address, $caption="") {

        $completeTag = "<a href=\"mailto:{$address}\">";

        if (!empty($caption)) {
            $completeTag .= $caption;
        } else {
            $completeTag .= $address;
        }

        $completeTag .= "</a>";

        echo $completeTag;

    }
}
