<?php
/**
 * @file
 * Form Helper.
 */

/*
 * @todo: Multiple Items
 * - Finish documenting class
 * - Find a way for devs to add errors before calling FormHelper::sendErrors()
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

namespace Acms\Html;

/**
 * This Class is used to process forms.
 *
 * Functions of this Class:
 *
 *     * Create and Setup Forms
 *     * Create and Setup Common Form Input Fields
 *     * Validate form input and send form data back to the form's controller if there are any errors
 */

class FormHelper
{
    /**
     * Adds base URL, for use in page redirects: i.e. form actions, header('Location: ...');
     *
     * Includes server name and current venue.
     *
     * Needed to attach base url and venue name to form action (so devs don't have to do this manually)
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

    public function inputPassword($name = '', $value = '', $attributes = '', $maxlength = '128', $readonly = '', $disabled = '') {
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
     *
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
     *
     * @return boolean
     */

    public function checkRequired($requiredFields)
    {
        $this->errorRequiredTrue = null;
        $this->errorRequired = '';

        if (!empty($_POST)) {
            foreach ($requiredFields as $requiredField) {

                if ($_POST[$requiredField] == '') {
                    $this->errorRequiredTrue = true;
                }
            }
        }

        if (!empty($_GET)) {
            foreach ($requiredFields as $requiredField) {

                if ($_GET[$requiredField] == '') {
                    $this->errorRequiredTrue = true;
                }
            }
        }
    }

    /**
     * Check if two fields have the same value (i.e. password and confirmPassword)
     *
     * Used in the controller the form is passed to
     *
     * @param array $matchingFields
     *
     * @return null
     */

    public function checkMatches($matchingFields)
    {
        $this->errorMatchesTrue = null;
        $this->errorMatches = '';

        if (!empty($_POST)) {
            foreach ($matchingFields as $key => $value) {

                if (($_POST[$key] != '') && ($_POST[$value] != '')) {
                    if ($_POST[$key] != $_POST[$value]) {
                        $this->errorMatchesTrue = true;
                        $this->errorMatches .= '/' . $key . 'MatchError.' . intval(1);
                    }
                }
            }
        }

        if (!empty($_GET)) {
            foreach ($matchingFields as $key => $value) {

                if (($_GET[$key] != '') && ($_GET[$value] != '')) {
                    if ($_GET[$key] != $_GET[$value]) {
                        $this->errorMatchesTrue = true;
                        $this->errorMatches .= '/' . $key . 'MatchError.' . intval(1);
                    }
                }
            }
        }
    }

    public function alterRegex($alterFields)
    {
        foreach ($alterFields as $field) {

            if (isset($_POST[$field[0]])) {
                $_POST[$field[0]] = preg_replace($field[1], $field[2], $_POST[$field[0]]);
            }
        }
        return true;
    }

    /**
     * Check if a specific form field's input matches a specified regular expression (preg_match())
     *
     * Used in the controller the form is passed to
     *
     * @param array $validateFields
     *
     * @return null
     */

    public function checkRegex($validateFields)
    {
        $this->errorRegexTrue = null;
        $this->errorRegex = '';

        if (!empty($_POST)) {
            foreach ($validateFields as $field => $regex) {

                //if (!preg_match($regex, $_POST[$field])) {
                if (!preg_match($regex, $_POST[$field])) {
                    $this->errorRegexTrue = 1;
                    $this->errorRegex .= '/' . $field . 'RegexError.' . intval(1);
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
     * @param string $route
     *
     * @return boolean | redirect False if all defined checks pass, redirects to $route if otherwise
     */

    public function sendErrors($route)
    {
        $formErrorTrue = false;
        $this->processedErrors = null;

        if (isset($this->errorRequiredTrue)) {
            $this->processedErrors .= $this->errorRequired;
            $formErrorTrue = 1;
        }

        if (isset($this->errorMatchesTrue)) {
            $this->processedErrors .= $this->errorMatches;
            $formErrorTrue = 1;
        }

        if (isset($this->errorRegexTrue)) {
            $this->processedErrors .= $this->errorRegex;
            $formErrorTrue = 1;
        }

        if (isset($this->addErrorTrue)) {
            $this->processedErrors .= $this->addError;
            $formErrorTrue = 1;
        }

        if (!empty($formErrorTrue)) {

            foreach($_POST as $key => $value) {

                if (strpos($key, 'password') !== false) {
                    $value = '';
                }

                // Convert periods to |_|, and convert / to |-| (if not, URLs will break routing)
                $this->processedErrors .= '/' . $key . '.' . str_replace('#', '||', str_replace('.', '|_|', str_replace('/', '|-|', $value)));
            }

            header('Location: ' . $this->basePath . $route . '/formErrors.' . intval(1) . $this->processedErrors);
            exit;
        } else {

            if (isset($_POST['formErrors'])) {
                unset($_POST['formErrors']);
            }

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'MatchError') !== false) {
                    unset($_POST[$key]);
                }

                if (strpos($key, 'RegexError') !== false) {
                    unset($_POST[$key]);
                }
            }
        }

        return false;
    }

    public function addError($error = '')
    {
        if (!empty($error)) {

            $this->addErrorTrue = true;
            $this->addError .= '/' . $error . '.' . intval(1);

            return true;
        }

        return false;
    }

    /**
     * Process errors sent from the controller.
     *
     * Creates error messages and then processes existing values for form input values (this way the form
     * is populated with values that were previously entered, rather than requiring the user to fill
     * out the entire form again)
     *
     * Used in the controller the form is created
     *
     * @param unknown $formErrors
     * @return mixed
     */

    public function processErrors($formErrors)
    {
        // Break down 'errors' route value into error array
        foreach ($formErrors as $value) {
            $errorsArray[] = explode('.', $value);
        }

        // Setup associative array so we can parse it and send it to the template via Template::set()
        if (isset($errorsArray)) {
            foreach ($errorsArray as $valueArray) {
                // Convert |_| back to periods, and convert |-| back to / (if not, URLs will break routing)
                $errors[$valueArray[0]] = str_replace('||', '#', str_replace('|_|', '.', str_replace('|-|', '/', $valueArray[1])));
            }

            // Setup any form data that's in $errors (since we don't have $_POST)
            foreach($errors as $key => $value) {
                $formData[$key] = $value;
            }
        }

        if (isset($formData)) {
            return $formData;
        } else {
            return false;
        }
    }
}

/** @} */ // End group FormHelper */
