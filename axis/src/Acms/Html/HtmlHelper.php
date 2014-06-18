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

namespace Acms\Html;

class HtmlHelper
{
    /**
     * Adds base URL, for use in page redirects: i.e. href="", src="" header('Location: ...');
     *
     * Includes server name and current venue.
     *
     * Needed to attach base url and venue name to html href/src (so devs don't have to do this manually)
     *
     * @param string $basePath
     */

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function htmlLink($address, $caption='', $target='') {

        // Starts with http|https|www or ends with .{somezone}

        // '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/'

        $has_protocal = preg_match('/^[http|https]/', $address);
        $is_external_address = preg_match('/[.][A-z]{2,4}/', $address);

        if (!empty($is_external_address)) {
            if ($has_protocal) {
                $completeTag = '<a href="' . $address . '"';
            } else {
                $completeTag = '<a href="http://' . $address . '"';
            }
        } else {
            $completeTag = '<a href="' . $this->basePath . $address . '"';
        }

        if (!empty($target)) {
            $completeTag .=' target="' . $target . '"';
        }

        $completeTag .= '>';

        if (!empty($caption)) {
            $completeTag .= $caption;
        } else {
            $completeTag .= $address;
        }

        $completeTag .= '</a>';

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

    public function styleSheetLink($href) {

        // Closing quote is on next line to keep each additional link aligned (see 'View Source')
        $completeTag = '<link rel="stylesheet" href="' . $href . '" />
';

        return $completeTag;
    }
}

/** @} */ // End group HtmlHelper */

