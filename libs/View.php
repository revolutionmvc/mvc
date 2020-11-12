<?php


class View {

    function __construct() {
//        echo 'This is the View' . '<br/>';
    }

    public function render($name) {
        require 'views/' .UI_THEME.'/'. $name . '.php';
    }

}
