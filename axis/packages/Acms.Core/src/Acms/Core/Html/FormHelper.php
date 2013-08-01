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
     * Add current base URL
     *
     * Includes server name and current venue.
     *
     * Needed to attach base url and venue name to form action (so devs don't have to do this manually.
     *
     * @param string $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

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

    public function inputFormStart($action = '', $method = 'POST', $attributes = '', $name = '', $target = '') {
        $completeTag = '<form action="' . $this->basePath . $action . '" method="' . $method . '"';

        if ($name != '') {
            $completeTag .= ' name="' . $name . '"';
        }

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= ' ' . $attribute . '="' . $value . '"';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= ' ' . $attributes;
            }
        }

        if ($target != '') {
            $completeTag .= ' target="' . $target . '"';
        }

        $completeTag .= '>';

        echo $completeTag;
    }

    /**
     * Create A Closing Form Tag
     *
     * @return string
     */

    public function inputFormEnd() {
        $completeTag = '</form>';

        echo $completeTag;
    }

    /*
     * Accept Form Inputs And Create A Complete Form
     *
     * @param array $inputTags
     * @return string
     */

    /*
    public function inputFormDisplay() {

    }
    //*/

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

    public function inputText($name = '', $value = '', $attributes = '', $maxlength = '', $readonly = '', $disabled = '') {
        $completeTag = '<input type="text" name="' . $name . '" value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        if ($maxlength != '') {
            $completeTag .= 'maxlength="' . $maxlength . '" ';
        }

        if ($readonly != '') {
            $completeTag .= 'readonly="readonly" ';
        }

        if ($disabled != '') {
            $completeTag .= 'disabled="disabled" ';
        }

        $completeTag .= '/>';

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

    public function inputPassword($name = '', $value = '', $attributes = '', $maxlength = '', $readonly = '', $disabled = '') {
        $completeTag = '<input type="password" name="' . $name . '" value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        if ($maxlength != '') {
            $completeTag .= 'maxlength="' . $maxlength . '" ';
        }

        if ($readonly != '') {
            $completeTag .= 'readonly="readonly" ';
        }

        if ($disabled != '') {
            $completeTag .= 'disabled="disabled" ';
        }

        $completeTag .= '/>';

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

    public function inputTextArea($name = '', $value = '', $attributes = '', $rows = '', $cols = '', $readonly = '', $disabled = '') {
        $completeTag = '<textarea name="' . $name . '"';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= ' ' . $attribute . '="' . $value . '"';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= ' ' . $attributes;
            }
        }

        if ($rows != '') {
            $completeTag .= ' rows="' . $rows . '"';
        }

        if ($cols != '') {
            $completeTag .= ' cols="' . $cols . '"';
        }

        if ($readonly != '') {
            $completeTag .= ' readonly="readonly"';
        }

        if ($disabled != '') {
            $completeTag .= ' disabled="disabled"';
        }

        $completeTag .= '>';
        $completeTag .= $value;
        $completeTag .= '</textarea>';

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

    public function inputSelect($name = '', $options = '', $attributes = '', $multiple = '', $size = '', $disabled = '') {
        $completeTag = '<select name="' . $name . '"';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= ' ' . $attribute . '="' . $value . '"';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= ' ' .$attributes;
            }
        }

        if ($multiple != '') {
            $completeTag .= ' multiple="multiple"';
        }

        if ($size != '') {
            $completeTag .= ' size="' .$size . '"';
        }

        if ($disabled != '') {
            $completeTag .= ' disabled="disabled"';
        }

        $completeTag .= '>';

        // $displayName, $value, $selected, $disabled
        if ($options != '') {
            for ($i = 0; $i < count($options); $i++) {
                $completeTag .= '<option';

                if (isset($options[$i][1]) && ($options[$i][1] != '')) {
                    $completeTag .= ' value="' . $options[$i][1] . '"';
                }

                if (isset($options[$i][2]) && ($options[$i][2] != '')) {
                    $completeTag .= ' selected="selected"';                    }

                if (isset($options[$i][3]) && ($options[$i][3] != '')) {
                    $completeTag .= ' disabled="disabled"';
                }

                $completeTag .= '>';

                $completeTag .= $options[$i][0];

                $completeTag .= '</option>';
            }
        }

        $completeTag .= '</select>';

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

    public function inputCheckBox($name = '', $value = '', $attributes = '', $checked = '', $readonly = '', $disabled = '') {
        $completeTag = '<input type="checkbox" name="' . $name . '" value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        if ($checked != '') {
            $completeTag .= 'checked="checked" ';
        }

        if ($readonly != '') {
            $completeTag .= 'readonly="readonly" ';
        }

        if ($disabled != '') {
            $completeTag .= 'disabled="disabled" ';
        }

        $completeTag .= '/>';

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

    public function inputRadio($name = '', $value = '', $attributes = '', $checked = '', $readonly = '', $disabled = '') {
        $completeTag = '<input type="radio" name="' . $name . '" value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        if ($checked != '') {
            $completeTag .= 'checked="checked" ';
        }

        if ($readonly != '') {
            $completeTag .= 'readonly="readonly" ';
        }

        if ($disabled != '') {
            $completeTag .= 'disabled="disabled" ';
        }

        $completeTag .= '/>';

        echo $completeTag;
    }

    /*
     * Create A Form Button
     *
     * @param
     * @param
     * @param
     * @return string
     */

    /*
    public function inputButton() {

    }
    //*/

    /*
     * Create A File Field Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    /*
    public function inputFile() {

    }
    //*/

    /**
     * Create A Hidden Field Tag
     *
     * @param string  $name
     * @param string  $value
     * @param array   $attributes array($attribute => $value);
     * @return string
     */

    public function inputHidden($name = '', $value = '', $attributes = '') {
        $completeTag = '<input type="hidden" name="' . $name . '" value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        $completeTag .= '/>';

        echo $completeTag;
    }

    /*
     * Create A Reset Field Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    /*
    public function inputReset() {

    }
    //*/

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

    public function inputSubmit($name = '', $value = '', $attributes = 'class="button"', $size = '', $disabled = '') {
        $completeTag = '<input type="submit" ';

        if ($name != '') {
            $completeTag .= 'name="' . $name . '" ';
        }

        $completeTag .= 'value="' . $value . '" ';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $attribute => $value) {
                    $completeTag .= $attribute . '="' . $value . '" ';
                }
                unset($attribute);
                unset($value);
            } else {
                $completeTag .= $attributes . ' ';
            }
        }

        if ($size != '') {
            $completeTag .= 'size="' . $size . '" ';
        }

        if ($disabled != '') {
            $completeTag .= 'disabled="disabled" ';
        }

        $completeTag .= '/>';

        echo $completeTag;
    }

    /*
     * Create A Generic Input Tag
     *
     * @param
     * @param
     * @param
     * @return string
     */

    /*
    public function inputGeneric() {

    }
    //*/

    /**
     * Check if required fields are present in $_POST or $_GET
     *
     * Used in the controller the form is passed to
     *
     * @param array $requiredFields  An indexed array of required field names
     * @return boolean
     */

    public function checkRequired($requiredFields)
    {
        $this->errorRequiredTrue = false;
        $this->errorRequired = '';

        /*
        echo '<br /><pre>$_POST: ';
        echo print_r($_POST);
        echo '</pre><br />';
        //exit;

        echo '<br /><pre>$_GET: ';
        echo print_r($_GET);
        echo '</pre><br />';
        //exit;

        echo '<br /><pre>$requiredFields: ';
        echo print_r($requiredFields);
        echo '</pre><br />';
        //exit;
        //*/

        if (!empty($_POST)) {
            foreach ($requiredFields as $requiredField) {
                /*
                echo '<br />$requiredField is: ' . $requiredField  . '<br />';
                echo '<br />$_POST[\''.$requiredField.'\'] is: ' . $_POST[$requiredField]  . '<br />';
                //*/

                if ($_POST[$requiredField] == '') {
                    $this->errorRequiredTrue = true;
                }
            }

            if ($this->errorRequiredTrue) {
                //$this->errorRequired .= '/infoError.' . intval(1);
                foreach($requiredFields as $requiredField) {
                    /*
                    echo '<br />$requiredField is: ' . $requiredField  . '<br />';
                    echo '<br />$_POST[\''.$requiredField.'\'] is: ' . $_POST[$requiredField]  . '<br />';
                    //*/

                    if ($_POST[$requiredField] != '') {
                        // Convert periods to |_|, and convert / to |-| (if not, URLs will break routing)
                        $this->errorRequired .= '/' . $requiredField . '.' . str_replace('.', '|_|', str_replace('/', '|-|', $_POST[$requiredField]));
                    }
                }
            }
        }

        if (!empty($_GET)) {
            foreach ($requiredFields as $requiredField) {
                if ($_GET[$requiredField] == '') {
                    $this->errorRequiredTrue = true;
                }
            }

            if ($this->errorRequiredTrue) {
                $this->errorRequired = '/infoError.' . intval(1);
                foreach($requiredFields as $requiredField) {
                    if ($_GET[$requiredField] != '') {
                        // Convert periods to |_|, and convert / to |-| (if not, URLs will break routing)
                        $this->errorRequired .= '/' . $requiredField . '.' . str_replace('.', '|_|', str_replace('/', '|-|', $_GET[$requiredField]));
                    }
                }
            }
        }

        /*
        echo '<br />$this->errorRequiredTrue is: ' . $this->errorRequiredTrue . '<br />';
        echo '<br />$this->errorRequired is: ' . $this->errorRequired . '<br />';
        //*/
    }

    /**
     * Check if two fields have the same value (i.e. password and confirmPassword)
     *
     * Used in the controller the form is passed to
     *
     * @param array $fields
     * @return boolean
     */

    public function checkMatches($matchingFields)
    {
        $this->errorMatchesTrue = false;
        $this->errorMatches = '';

        /*
        echo '<br /><pre>$$matchingFields: ';
        echo print_r($matchingFields);
        echo '</pre><br />';
        //exit;
        //*/

        if (!empty($_POST)) {
            foreach ($matchingFields as $key => $value) {
                /*
                echo '<br />$key is: ' . $key . '<br />';
                echo '<br />$value is: ' . $value . '<br />';
                //*/
                if (($_POST[$key] != '') && ($_POST[$value] != '')) {
                    if ($_POST[$key] != $_POST[$value]) {
                        $this->errorMatchesTrue = true;
                        $this->errorMatches .= '/' . $key . '.' . $value;
                    }
                }
            }
        }

        if (!empty($_GET)) {
            foreach ($matchingFields as $key => $value) {
                /*
                echo '<br />$key is: ' . $key . '<br />';
                echo '<br />$value is: ' . $value . '<br />';
                //*/
                if (($_GET[$key] != '') && ($_GET[$value] != '')) {
                    if ($_GET[$key] != $_GET[$value]) {
                        $this->errorMatchesTrue = true;
                        $this->errorMatches .= '/' . $key . '.' . $value;
                    }
                }
            }
        }

        /*
        echo '<br />$this->errorMatchesTrue is: ' . $this->errorMatchesTrue . '<br />';
        echo '<br />$this->errorMatches is: ' . $this->errorMatches . '<br />';
        //*/
    }

    /**
     * Check if a specific form field's input matches a specified regular expression (preg_match())
     *
     * Used in the controller the form is passed to
     *
     * @param array $fields
     * @return boolean
     */

    public function checkRegex($validateFields)
    {
        /*
        echo '<br /><pre>$validateFields: ';
        echo print_r($validateFields);
        echo '</pre><br />';
        //exit;
        //*/

        $this->errorRegexTrue = null;
        $this->errorRegex = '';

        if (!empty($_POST)) {
            foreach ($validateFields as $field => $regex) {
                /*
                echo '<br />$field is: ' . $field . '<br />';
                echo '<br />$regex is: ' . $regex . '<br />';
                //*/
                if (!preg_match($regex, $_POST[$field])) {
                    $this->errorRegexTrue = 1;
                    $this->errorRegex .= '/' . $field . '.' . intval(1);
                }
            }
        }
    }

    /**
     * Returns regex to check for a valid email address
     *
     * @return string
     */
    public function isValidEmail()
    {
        return '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
    }

    /**
     * Process all defined checks
     *
     * Used in the controller the form is passed to
     *
     * @return boolean | redirect False if all defined checks pass, redirects to $route if otherwise
     */

    public function findErrors($route)
    {
        if ($this->errorRequiredTrue) {
            /*
            echo '<br />$this->errorRequired is: ' . $this->errorRequired . '<br />';
            //*/
            $this->processedErrors .= '/errorRequired.' . intval(1) . $this->errorRequired;
            /*
            echo '<br />$this->processedErrors is: ' . $this->processedErrors . '<br />';
            //*/
        }

        if ($this->errorMatchesTrue) {
            /*
            echo '<br />$this->errorMatches is: ' . $this->errorMatches . '<br />';
            //*/
            $this->processedErrors .= '/errorMatches.' . intval(1) . $this->errorMatches;
            /*
            echo '<br />$this->processedErrors is: ' . $this->processedErrors . '<br />';
            //*/
        }

        if ($this->errorRegexTrue) {
            /*
            echo '<br />$this->errorRegex is: ' . $this->errorRegex . '<br />';
            //*/
            $this->processedErrors .= '/errorRegex.' . intval(1) . $this->errorRegex;
            /*
            echo '<br />$this->processedErrors is: ' . $this->processedErrors . '<br />';
            //*/
        }

        /*
        echo '<br /><strong>Final</strong>: $this->processedErrors is: ' . $this->processedErrors . '<br />';
        //*/

        if (isset($this->processedErrors)) {
            //*
            header('Location: ' . $this->basePath . $route . $this->processedErrors);
            exit;
            //*/
        }

        return false;
    }

    public function displayErrors()
    {
        echo '<br />You Have Errors<br />';
    }

    /*
     * Process errors sent from the controller.
     *
     * Creates error messages and processes existing values for form input values (this way the form
     * is populated with values that were previously entered, rather than requiring the user to fill
     * out the entire form again)
     *
     * To be used in a Template containing the form we are processing
     *
     * @param unknown $errors
     * @return mixed
     */

    /*
    public function processErrors($errors)
    {
        return true;
    }
    //*/

}

/** @} */ // End group FormHelper */
