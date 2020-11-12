<?php

class Controller {
    public function __construct($model_name) {
        $this->view = new View();
        $this->validation = new validation();
        $this->hash = new Hash();
//        $this->auth = new Auth();
        $this->uploader = new \Verot\Upload\Upload();
        $this->load_model($model_name, 'models/');
//         $this->auth->auth();
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

