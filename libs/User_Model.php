<?php

class User_Model extends Model {

    function __construct() {
        parent::__construct();
//        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        //$result = $this->db->delete(array('table' => 'users', 'where' => 'id = :id', 'data'=> array('id' => 9)));
    }

    function get_user($id) {
        $result = $this->db->select(array('table' => 'user', 'column' => '*', 'where' => 'id = :id', 'data' => array('id' => $id)));
        return $result[0];
    }

    function check_login_token($id, $login_token) {
        $result = $this->db->select(array('table' => 'user', 'column' => '*', 'where' => 'id = :id and login_token = :token and is_active = :is_active', 'data' => array('is_active'=>'1','id' => $id, 'token' => $login_token)));
        return $result;
    }

   
}
