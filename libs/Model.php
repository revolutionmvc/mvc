<?php

class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $this->db_alumni = new Database(DB_TYPE, DB_HOST, 'vtasl_db_alumni', DB_USER, DB_PASS);
    }
}

