<?php

class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

        //$result = $this->db->delete(array('table' => 'users', 'where' => 'id = :id', 'data'=> array('id' => 9)));
        
    }
}

