<?php

namespace Acms\Core;

class Template {
    private $vars; /// Holds all the template variables
    private $file;

    /**
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    public function __construct($file = null) {
        $this->file = $file;
    }

    /**
     * Set a template variable.
     */
    public function set($name, $value) {
        if (is_array($value)) {
            for ($i = 0; $i < count($value); $i++) {
                if (is_object($value[$i])) {
                    if ($value[$i] instanceof Template) {
                        $this->vars[$name][$i] = $value[$i]->fetch();
                    } else {
                        $this->vars[$name][$i] = $value[$i];
                    }
                } else {
                    $this->vars[$name] = $value; // original
                    //$this->vars[$name][$i] = $value; // testing, for menu functionality
                }
                $this->vars[$name][$i] = is_object($value[$i]) ? $value[$i]->fetch() : $value[$i];
            }
        } else {
            if (is_object($value)) {
                if ($value instanceof Template) {
                    $this->vars[$name] = $value->fetch();
                } else {
                    $this->vars[$name] = $value;
                }
            } else {
                $this->vars[$name] = $value;
            }

        }

    }

    /**
     * Open, parse, and return the template file.
     *
     * @param $file string the template file name
     */
    public function fetch($file = null) {
        if(!$file) $file = $this->file;

        if (is_array($this->vars)) {
            extract($this->vars);          // Extract the vars to local namespace
        }

        ob_start();                    // Start output buffering
        include($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }
}