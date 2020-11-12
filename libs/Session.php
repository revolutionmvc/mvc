<?php

class Session {

    function __construct() {
        
    }

    static function set($key, $value) {
        @session_start();
        $_SESSION[$key] = $value;
    }

    static function get($key) {
        @session_start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
    static function unset_session($key) {
        @session_start();
        if (isset($_SESSION[$key])) {
           unset($_SESSION[$key]);
        }
    }

}
