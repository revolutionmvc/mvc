<?php

// root URL
$host = $_SERVER['HTTP_HOST'];
define('HOST', $host);

define('URL', 'http://example.com/');
define('URL_Admin', 'http://'.$host.'/dashboard/');

//THEME
define('UI_THEME', 'theme-a'); //public and views folder change when theme changed
define('PUBLIC_URL', URL_Admin.'public/'.UI_THEME.'/'); //public folder css js files. NOT ajax include here

// Database
define('DB_TYPE', "mysql");
define('DB_NAME', "db_name");
define('DB_USER', "db_user");
define('DB_PASS', "db_pass");
define('DB_HOST', "host");

define('AUTH_PREFIX', 'abc');
define('THEME_PREFIX', 'abc');
define('MAX_TRY', 3);

//SALT
define('SALT', 'bla_bla');