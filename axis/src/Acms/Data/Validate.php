<?php
namespace Acms\Data;

class Validate
{
    public function isValidVenueName($venueName)
    {
        $venueNameRegex = '/^[A-z]+[A-z0-9\s-]+[A-z0-9]$/';

        if (!preg_match($venueNameRegex, $venueName)) {
            /*
            $this->errorRegexTrue = 1;
            $this->errorRegex .= '/' . $field . 'RegexError.' . intval(1);
            //*/

            return false;
        }

        return true;
    }

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
}