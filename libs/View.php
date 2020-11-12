<?php


class View {

    function __construct() {
//        echo 'This is the View' . '<br/>';
           if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['vtalklanguage'])) {
            $_SESSION['vtalklanguage'] = 'english';
        }

        if ($_SESSION['vtalklanguage'] == 'english') {
            $this->language = 'en';
        } else if ($_SESSION['vtalklanguage'] == 'sinhala') {
            $this->language = 'si';
        } else if ($_SESSION['vtalklanguage'] == 'tamil') {
            $this->language = 'ta';
        } else {
            $this->language = 'en';
        }
    }

    public function render($name) {
        require 'views/' . $name . '.php';
    }

}
