<?php
/**
 * @file
 * HTML Helper.
 */

/**
 * @defgroup HtmlHelpers HTML Helpers
 * @{
 * Documentation for all HTML Helper related functionality.
 * @}
 */

/**
 *
 * @defgroup HtmlHelper HtmlHelper Functionality
 * @ingroup HtmlHelpers
 * @{
 *
 * Documentation for HtmlHelper Class
 *
 */

/**
 * Class HtmlHelper
 *
 * This Class is used to process html tags.
 *
 * Functions of this Class:
 * Create and Setup HTML tags
 * Improve Security by Validating Input and Escape Output on the fly
 *
 */

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

/** @} */ // End group HtmlHelper */

