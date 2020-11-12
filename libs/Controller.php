<?php

class Controller {
    public function __construct() {
        $this->view = new View();
        $this->validation = new Validation();
        $this->uploader = new \Verot\Upload\Upload();
        $this->mail = new Mail(MHOST, MUSERNAME, MPASSWORD, MTITLE, MPORT);
        $this->mail2 = new Mail(MHOST, MUSERNAME, MPASSWORD, MTITLE, MPORT);

    }
    
    public function load_model($name, $model_path){
        $path = $model_path . $name . '_model.php';
        if (file_exists($path)) {
            require $path;
            $model_name = $name . '_Model';
            $this->model = new $model_name();
        }
    }
}

