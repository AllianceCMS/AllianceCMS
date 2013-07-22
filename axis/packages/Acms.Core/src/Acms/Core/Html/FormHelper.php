<?php
/**
 * @file
 * Form Helper.
 */

/**
 *
 * @defgroup FormHelper FormHelper Functionality
 * @ingroup HtmlHelpers
 * @{
 *
 * Documentation for FormHelper Class
 *
 */

/**
 * Class FormHelper
 *
 * This Class is used to process forms.
 *
 * Functions of this Class:
 * Create and Setup HTML Forms
 * Create and Setup Common Form Input Fields
 * Improve Security by Validating Input and Escape Output on the fly
 */

namespace Acms\Core\Html;

/**
 *
 *
 */
class FormHelper
{

    /**
     * Create An Opening Form Tag
     *
     * @param string  $action
     * @param string  $method
     * @param array   $attributes array($attribute => $value);
     * @param string  $name
     * @param string  $target
     * @return string
     */

    public function inputFormStart($action = "", $method = "POST", $attributes = "", $name = "", $target = "") {
        $completeTag = "<form action=\"{$action}\" method=\"{$method}\"";

        if ($name != "") {
            $completeTag .= " name=\"{$name}\"";
        }

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= " {$attribute}=\"{$value}\"";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= " $attributes";
            }
        }

        if ($target != "") {
            $completeTag .= " target=\"$target\"";
        }

        $completeTag .= ">\n";

        echo $completeTag;
    }

    /**
     * Create A Closing Form Tag
     *
     * @return string
     */

    public function inputFormEnd() {
        $completeTag = "</form>\n";

        echo $completeTag;
    }

    /**
     * Accept Form Inputs And Create A Complete Form
     *
     * @param array $inputTags
     * @return string
     */

    public function inputFormDisplay() {

    }

    /**
     * Create A Text Field Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param integer $maxlength
     * @param integer $readonly
     * @param integer $disabled
     * @return string
     */

    public function inputText($name = "", $value = "", $attributes = "", $maxlength = "", $readonly = "", $disabled = "") {
        $completeTag = "<input type=\"text\" name=\"{$name}\" value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        if ($maxlength != "") {
            $completeTag .= "maxlength=\"{$maxlength}\" ";
        }

        if ($readonly != "") {
            $completeTag .= "readonly=\"readonly\" ";
        }

        if ($disabled != "") {
            $completeTag .= "disabled=\"disabled\" ";
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create A Password Text Field Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param integer $maxlength
     * @param integer $readonly
     * @param integer $disabled
     * @return string
     */

    public function inputPassword($name = "", $value = "", $attributes = "", $maxlength = "", $readonly = "", $disabled = "") {
        $completeTag = "<input type=\"password\" name=\"{$name}\" value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        if ($maxlength != "") {
            $completeTag .= "maxlength=\"{$maxlength}\" ";
        }

        if ($readonly != "") {
            $completeTag .= "readonly=\"readonly\" ";
        }

        if ($disabled != "") {
            $completeTag .= "disabled=\"disabled\" ";
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create A TextArea Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param integer $rows
     * @param integer $cols
     * @param integer $readonly
     * @param integer $disabled
     * @return string
     */

    public function inputTextArea($name = "", $value = "", $attributes = "", $rows = "", $cols = "", $readonly = "", $disabled = "") {
        $completeTag = "<textarea name=\"{$name}\"";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= " {$attribute}=\"{$value}\"";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= " $attributes";
            }
        }

        if ($rows != "") {
            $completeTag .= " rows=\"{$rows}\"";
        }

        if ($cols != "") {
            $completeTag .= " cols=\"{$cols}\"";
        }

        if ($readonly != "") {
            $completeTag .= " readonly=\"readonly\"";
        }

        if ($disabled != "") {
            $completeTag .= " disabled=\"disabled\"";
        }

        $completeTag .= ">";
        $completeTag .= $value;
        $completeTag .= "</textarea>\n";

        echo $completeTag;
    }

    /**
     * Create A Select Tag With Options
     *
     * @param string  $name
     * @param array   $options array(array($displayName, $value, $selected, $disabled), array($displayName, $value, $selected, $disabled));
     * @param array   $attributes array($attribute => $value);
     * @param integer $multiple
     * @param integer $size
     * @param integer $disabled
     * @return string
     */

    public function inputSelect($name = "", $options = "", $attributes = "", $multiple = "", $size = "", $disabled = "") {
        $completeTag = "<select name=\"{$name}\"";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= " {$attribute}=\"{$value}\"";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= " $attributes";
            }
        }

        if ($multiple != "") {
            $completeTag .= " multiple=\"multiple\"";
        }

        if ($size != "") {
            $completeTag .= " size=\"{$size}\"";
        }

        if ($disabled != "") {
            $completeTag .= " disabled=\"disabled\"";
        }

        $completeTag .= ">\n";

        // $displayName, $value, $selected, $disabled
        if ($options != "") {
            for ($i = 0; $i < count($options); $i++) {
                $completeTag .= "<option";

                if (isset($options[$i][1]) && ($options[$i][1] != "")) {
                    $completeTag .= " value=\"".$options[$i][1]."\"";
                }

                if (isset($options[$i][2]) && ($options[$i][2] != "")) {
                    $completeTag .= " selected=\"selected\"";                    }

                if (isset($options[$i][3]) && ($options[$i][3] != "")) {
                    $completeTag .= " disabled=\"disabled\"";
                }

                $completeTag .= ">";

                $completeTag .= $options[$i][0];

                $completeTag .= "</option>\n";
            }
        }

        $completeTag .= "</select>\n";

        echo $completeTag;
    }

    /**
     * Create A Checkbox Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param string  $checked
     * @param integer $readonly
     * @param integer $disabled
     * @return string
     */

    public function inputCheckBox($name = "", $value = "", $attributes = "", $checked = "", $readonly = "", $disabled = "") {
        $completeTag = "<input type=\"checkbox\" name=\"{$name}\" value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        if ($checked != "") {
            $completeTag .= "checked=\"checked\" ";
        }

        if ($readonly != "") {
            $completeTag .= "readonly=\"readonly\" ";
        }

        if ($disabled != "") {
            $completeTag .= "disabled=\"disabled\" ";
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create A Radio Button Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param string  $checked
     * @param integer $readonly
     * @param integer $disabled
     * @return string
     */

    public function inputRadio($name = "", $value = "", $attributes = "", $checked = "", $readonly = "", $disabled = "") {
        $completeTag = "<input type=\"radio\" name=\"{$name}\" value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        if ($checked != "") {
            $completeTag .= "checked=\"checked\" ";
        }

        if ($readonly != "") {
            $completeTag .= "readonly=\"readonly\" ";
        }

        if ($disabled != "") {
            $completeTag .= "disabled=\"disabled\" ";
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create
     *
     * @param
     * @param
     * @param
     * @return string
     */

    public function inputButton() {

    }

    /**
     * Create A File Field Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    public function inputFile() {

    }

    /**
     * Create A Hidden Field Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @return string
     */

    public function inputHidden($name = "", $value = "", $attributes = "") {
        $completeTag = "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create A Reset Field Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    public function inputReset() {

    }

    /**
     * Create A Submit Button Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @param integer $size
     * @param integer $disabled
     * @return string
     */

    public function inputSubmit($name = "", $value = "", $attributes = "class=\"button\"", $size = "", $disabled = "") {
        $completeTag = "<input type=\"submit\" ";

        if ($name != "") {
            $completeTag .= "name=\"{$name}\" ";
        }

        $completeTag .= "value=\"{$value}\" ";

        if ($attributes != "") {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= "{$attribute}=\"{$value}\" ";
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= "$attributes ";
            }
        }

        if ($size != "") {
            $completeTag .= "size=\"{$size}\" ";
        }

        if ($disabled != "") {
            $completeTag .= "disabled=\"disabled\" ";
        }

        $completeTag .= "/>\n";

        echo $completeTag;
    }

    /**
     * Create A Generic Input Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    public function inputGeneric() {

    }

}

/** @} */ // End group FormHelper */
