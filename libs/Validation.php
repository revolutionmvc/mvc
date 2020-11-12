<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validate
 *
 * @author Asanka
 */
class Validation {

    public $errors = array();

    function __construct() {
        
    }

    /**
     * 
     * @param array $array get information data
     * @return array Errors
     */
    function form_validate($array) {

        foreach ($array as $key => $value) {
            $methods = explode(',', $value[1]);
            $errors = NULL;
            foreach ($methods as $name) {
                if (method_exists($this, trim($name))) {
                    $errors .= $this->{trim($name)}($value[0]);
                }
                if (!empty($errors)) {
                    $errors .= ', ';
                }
            }

            if (!empty($errors)) {
                $errors = trim($errors, ', ');
                $this->add_error($key, $errors);
            }
        }

        return $this->errors;
    }

    private function add_error($key, $value) {
        $this->errors[$key] = $value;
    }

    private function is_password_mached($data) {
        $passwords = explode('&', $data);

        if (empty($passwords[0]) && empty($passwords[1])) {
            return 'Password could not be empty';
        } else if ($passwords[0] != $passwords[1]) {
            return 'Password did not matched';
        }
    }

    private function min_length($data) {
        
    }

    private function max_length($data) {
        
    }

    private function is_integer($data) {
        if (!empty($data)) {
            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                return 'Enter Validate Integer';
            }
        }
    }

    private function is_alnum($data) {
        $data = trim($data);
        $error_chars = NULL;
        $error = array();
        $chars = array('.', '+', '-', '*', ',', '<', '>', '/', '?', '"', "'", ':', ';', ']', '}', '{', '[', '|', '=', ')', '(', '&', '^', '%', '$', '#', '@', '!', '`', '~');

        foreach ($chars as $value) {
            if (strstr($data, $value)) {
                array_push($error, 1);
                $error_chars .= $value . ' ';
            } else {
                array_push($error, 0);
            }
        }
        if (in_array(1, $error)) {
            return 'Can not be include this characters ( ' . $error_chars . ' )';
        }
    }

    private function is_empty($data) {
        if (strlen($data) == 0) {
            return 'Field could not be empty';
        }
    }

    private function is_email($data) {
        if (!empty($data)) {
            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                return 'Enter Validate Email.';
            }
        }
    }

}
