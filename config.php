<?php

// root URL
$host = $_SERVER['HTTP_HOST'];
define('HOST', $host);
define('URL', 'http://example.com/');
define('PUBLIC_URL', URL.'public/'); //public folder css js files. NOT ajax include here

// Database
define('DB_TYPE', "mysql");
define('DB_NAME', "db_name");
define('DB_USER', "db_user");
define('DB_PASS', "db_pass");
define('DB_HOST', "host");

//Mail
define('MHOST', "");
define('MUSERNAME', '');
define('MPASSWORD', '');
define('MTITLE', "");
define('MPORT', 587);
